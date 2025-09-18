<?php

namespace App\Http\Controllers;

use App\Mail\TaaResultsReady;
use App\Models\TaaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $requests = TaaRequest::where('status', 'paid')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dashboard', compact('requests'));
    }

    public function uploadResults(Request $request)
    {
        $request->validate([
            'request_id' => 'required|exists:taa_requests,id',
            'result_file' => 'required|file|mimes:pdf|max:20480' // 20MB max
        ]);

        $taaRequest = TaaRequest::findOrFail($request->request_id);

        // Store the PDF result
        $path = $request->file('result_file')->store('results');

        $taaRequest->update([
            'result_file_path' => $path,
            'status' => 'completed'
        ]);

        // Send email to customer
        try {
            Mail::to($taaRequest->email)->send(new TaaResultsReady($taaRequest));
            $taaRequest->update(['email_sent' => true]);
        } catch (\Exception $e) {
            \Log::error('Failed to send results email: ' . $e->getMessage());
        }

        return back()->with('success', 'Results uploaded and email sent successfully!');
    }

    public function downloadResult($id)
    {
        $taaRequest = TaaRequest::findOrFail($id);

        if (!$taaRequest->result_file_path || !Storage::disk('private')->exists($taaRequest->result_file_path)) {
            abort(404, 'File not found');
        }

        return Storage::disk('private')->download(
            $taaRequest->result_file_path,
            "TAA_Results_{$taaRequest->name}_{$taaRequest->id}.pdf"
        );
    }
}
