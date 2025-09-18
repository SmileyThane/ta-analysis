@extends('layouts.app')

@section('title', 'TA Analysis Engine - Discover Your Perfect Audience')

@section('content')
    <div class="bg-gradient-to-br from-primary to-secondary text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="text-center">
                <h1 class="text-5xl font-bold mb-6">
                    Target Audience Analysis Engine
                </h1>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    Transform your product descriptions into deep audience insights with AI-powered analysis.
                    Get detailed personas, pain points, and targeted search strategies.
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <!-- Features Section -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Persona Builder</h3>
                <p class="text-gray-600">Create detailed customer personas based on demographics, psychographics, and behavioral patterns.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Pain Signal Extractor</h3>
                <p class="text-gray-600">Identify and analyze customer pain points from social media conversations and reviews.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="w-12 h-12 bg-primary rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Boolean Query Generator</h3>
                <p class="text-gray-600">Generate precise search queries for finding your target audience on various platforms.</p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-lg">
                <div class="w-12 h-12 bg-secondary rounded-lg flex items-center justify-center mb-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold mb-2">Interview Question Maker</h3>
                <p class="text-gray-600">Get Grok-style interview questions to validate and deepen your audience understanding.</p>
            </div>
        </div>

        <!-- Integration Section -->
        <div class="bg-white rounded-2xl shadow-xl p-8 mb-16">
            <h2 class="text-3xl font-bold text-center mb-8">Powered by Social Intelligence</h2>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div>
                    <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">R</span>
                    </div>
                    <h3 class="font-semibold mb-2">Reddit Integration</h3>
                    <p class="text-gray-600">Extract authentic pain signals from Reddit discussions and communities.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">L</span>
                    </div>
                    <h3 class="font-semibold mb-2">LinkedIn Insights</h3>
                    <p class="text-gray-600">Analyze professional conversations and industry-specific pain points.</p>
                </div>
                <div>
                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-white font-bold text-xl">Q</span>
                    </div>
                    <h3 class="font-semibold mb-2">Quora Analysis</h3>
                    <p class="text-gray-600">Discover detailed question patterns and audience curiosities.</p>
                </div>
            </div>
        </div>

        <!-- CTA Form Section -->
        <div class="bg-gradient-to-r from-primary to-secondary rounded-2xl shadow-2xl p-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-white text-center mb-2">Get Your TA Analysis Report</h2>
                <p class="text-white/90 text-center mb-8">Complete analysis with personas, pain signals, Boolean queries, and interview questions - $99</p>

                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('submit.request') }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-white font-medium mb-2">Full Name</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 rounded-lg border-0 focus:ring-4 focus:ring-white/25 focus:outline-none"
                                   placeholder="Enter your full name" value="{{ old('name') }}">
                        </div>

                        <div>
                            <label for="email" class="block text-white font-medium mb-2">Email Address</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 rounded-lg border-0 focus:ring-4 focus:ring-white/25 focus:outline-none"
                                   placeholder="Enter your email" value="{{ old('email') }}">
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-white font-medium mb-2">Product/Service Description</label>
                        <textarea id="description" name="description" rows="6" required
                                  class="w-full px-4 py-3 rounded-lg border-0 focus:ring-4 focus:ring-white/25 focus:outline-none resize-none"
                                  placeholder="Describe your product or service in detail. Include target market, key features, benefits, and any current marketing challenges you're facing...">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="attachments" class="block text-white font-medium mb-2">Additional Materials (Optional)</label>
                        <input type="file" id="attachments" name="attachments[]" multiple
                               class="w-full px-4 py-3 rounded-lg bg-white border-0 focus:ring-4 focus:ring-white/25 focus:outline-none"
                               accept=".pdf,.doc,.docx,.txt,.png,.jpg,.jpeg">
                        <p class="text-white/75 text-sm mt-1">Upload marketing materials, product sheets, or any relevant documents (max 10MB each)</p>
                    </div>

                    <button type="submit"
                            class="w-full bg-white text-primary font-bold py-4 px-8 rounded-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                        Get My TA Analysis - $99
                    </button>

                    <p class="text-white/75 text-sm text-center">
                        Secure payment via Stripe. You'll receive your detailed analysis within 24-48 hours.
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
