<?php

namespace App\Http\Controllers;

use App\Models\TaaRequest;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing');
    }

    public function submitRequest(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'attachments.*' => 'file|max:10240' // 10MB max per file
        ]);

        $attachments = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $attachments[] = [
                    'original_name' => $file->getClientOriginalName(),
                    'path' => $path,
                    'size' => $file->getSize()
                ];
            }
        }

        $taaRequest = TaaRequest::create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'attachments' => $attachments,
        ]);

        // Create Stripe checkout session
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'TA Analysis Engine Report',
                            'description' => 'Complete Target Audience Analysis with personas, pain signals, and Boolean queries',
                        ],
                        'unit_amount' => 9900, // $99.00 in cents
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['request_id' => $taaRequest->id]) . '&session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('home'),
            'metadata' => [
                'taa_request_id' => $taaRequest->id,
            ],
        ]);

        return redirect($session->url);
    }

    public function paymentSuccess(Request $request)
    {
        $taaRequest = TaaRequest::findOrFail($request->request_id);

        if ($request->has('session_id')) {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = StripeSession::retrieve($request->session_id);

            $taaRequest->update([
                'stripe_payment_intent_id' => $session->payment_intent,
                'status' => 'paid'
            ]);
        }

        return view('payment-success', compact('taaRequest'));
    }
}
