@extends('layouts.app')

@section('title', 'Payment Successful - TA Analysis Engine')

@section('content')
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-white rounded-2xl shadow-xl p-8 text-center">
            <div class="w-16 h-16 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 mb-4">Payment Successful!</h1>

            <p class="text-lg text-gray-600 mb-6">
                Thank you, <strong>{{ $taaRequest->name }}</strong>! Your TA Analysis request has been received and payment confirmed.
            </p>

            <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                <h3 class="font-semibold mb-2">Request Details:</h3>
                <p><strong>Request ID:</strong> #{{ $taaRequest->id }}</p>
                <p><strong>Email:</strong> {{ $taaRequest->email }}</p>
                <p><strong>Status:</strong> <span class="text-green-600">Paid</span></p>
            </div>

            <div class="space-y-4">
                <h3 class="text-xl font-semibold">What Happens Next?</h3>
                <div class="grid md:grid-cols-3 gap-4 text-sm">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="font-semibold text-blue-600">Step 1</div>
                        <div>Analysis begins within 2 hours</div>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <div class="font-semibold text-yellow-600">Step 2</div>
                        <div>Deep research and persona creation</div>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="font-semibold text-green-600">Step 3</div>
                        <div>Detailed PDF report delivered via email</div>
                    </div>
                </div>
            </div>

            <div class="mt-8 p-4 bg-primary/10 rounded-lg">
                <p class="text-primary font-medium">
                    📧 Your comprehensive TA Analysis report will be delivered to <strong>{{ $taaRequest->email }}</strong> within 24-48 hours.
                </p>
            </div>

            <div class="mt-6">
                <a href="{{ route('home') }}" class="inline-block bg-primary text-white px-6 py-3 rounded-lg hover:bg-primary/90 transition">
                    Return to Home
                </a>
            </div>
        </div>
    </div>
@endsection
