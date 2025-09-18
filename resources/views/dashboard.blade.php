@extends('layouts.app')

@section('title', 'Admin Dashboard - TA Analysis Engine')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600">Manage TA Analysis requests and upload results</p>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Paid Requests</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Request ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($requests as $request)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                #{{ $request->id }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $request->name }}</div>
                                <div class="text-sm text-gray-500">{{ $request->email }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate">
                                    {{ Str::limit($request->description, 100) }}
                                </div>
                                @if ($request->attachments)
                                    <div class="text-xs text-blue-600 mt-1">
                                        {{ count($request->attachments) }} attachment(s)
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                @if($request->status === 'paid') bg-blue-100 text-blue-800
                                @elseif($request->status === 'processing') bg-yellow-100 text-yellow-800
                                @elseif($request->status === 'completed') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($request->status) }}
                            </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $request->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm space-x-2">
                                @if($request->status === 'completed' && $request->result_file_path)
                                    <a href="{{ route('download.result', $request->id) }}"
                                       class="text-green-600 hover:text-green-900">Download</a>
                                @else
                                    <button onclick="openUploadModal({{ $request->id }}, '{{ $request->name }}')"
                                            class="text-blue-600 hover:text-blue-900">Upload Result</button>
                                @endif

                                <button onclick="viewDetails({{ json_encode($request) }})"
                                        class="text-gray-600 hover:text-gray-900">View Details</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                No paid requests found.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            @if ($requests->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $requests->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Upload Modal -->
    <div id="uploadModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Upload Analysis Results</h3>
                    <p class="text-sm text-gray-600" id="modalCustomerName"></p>
                </div>

                <form method="POST" action="{{ route('upload.results') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="request_id" id="modalRequestId">

                    <div class="px-6 py-4">
                        <label for="result_file" class="block text-sm font-medium text-gray-700 mb-2">
                            PDF Results File
                        </label>
                        <input type="file" name="result_file" id="result_file" required
                               accept=".pdf" class="w-full border border-gray-300 rounded-md px-3 py-2">
                        <p class="text-xs text-gray-500 mt-1">Upload the completed TA analysis PDF (max 20MB)</p>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                        <button type="button" onclick="closeUploadModal()"
                                class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm bg-primary text-white rounded-md hover:bg-primary/90">
                            Upload & Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Details Modal -->
    <div id="detailsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-96 overflow-y-auto">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Request Details</h3>
                </div>

                <div class="px-6 py-4 space-y-4" id="detailsContent">
                    <!-- Content will be populated by JavaScript -->
                </div>

                <div class="px-6 py-4 border-t border-gray-200 flex justify-end">
                    <button type="button" onclick="closeDetailsModal()"
                            class="px-4 py-2 text-sm text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUploadModal(requestId, customerName) {
            document.getElementById('modalRequestId').value = requestId;
            document.getElementById('modalCustomerName').textContent = 'Customer: ' + customerName;
            document.getElementById('uploadModal').classList.remove('hidden');
        }

        function closeUploadModal() {
            document.getElementById('uploadModal').classList.add('hidden');
            document.getElementById('result_file').value = '';
        }

        function viewDetails(request) {
            const content = document.getElementById('detailsContent');

            let attachmentsHtml = '';
            if (request.attachments && request.attachments.length > 0) {
                attachmentsHtml = '<div><strong>Attachments:</strong><ul class="list-disc list-inside ml-4">';
                request.attachments.forEach(attachment => {
                    attachmentsHtml += `<li>${attachment.original_name} (${Math.round(attachment.size/1024)}KB)</li>`;
                });
                attachmentsHtml += '</ul></div>';
            }

            content.innerHTML = `
        <div><strong>Request ID:</strong> #${request.id}</div>
        <div><strong>Customer:</strong> ${request.name}</div>
        <div><strong>Email:</strong> ${request.email}</div>
        <div><strong>Status:</strong> ${request.status}</div>
        <div><strong>Created:</strong> ${new Date(request.created_at).toLocaleDateString()}</div>
        <div><strong>Description:</strong><br>
            <div class="bg-gray-50 p-3 rounded mt-2 text-sm">${request.description}</div>
        </div>
        ${attachmentsHtml}
        <div><strong>Email Sent:</strong> ${request.email_sent ? 'Yes' : 'No'}</div>
    `;

            document.getElementById('detailsModal').classList.remove('hidden');
        }

        function closeDetailsModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.id === 'uploadModal') {
                closeUploadModal();
            }
            if (e.target.id === 'detailsModal') {
                closeDetailsModal();
            }
        });
    </script>
@endsection
