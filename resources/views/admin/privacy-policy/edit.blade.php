@extends('layouts.admin')

@section('title', 'Edit Privacy Policy')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-heading text-zendo-navy font-semibold">Privacy Policy Page</h2>
                <a href="{{ route('privacy-policy') }}" target="_blank"
                   class="inline-flex items-center px-4 py-2 text-sm text-blue-600 hover:text-blue-800 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                    View Public Page
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mx-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mx-6 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.privacy-policy.update') }}" method="POST" class="p-6 space-y-8">
            @csrf
            @method('PUT')

            <!-- Page Title -->
            <div class="">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Page Header</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Page Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $privacyPolicy->title) }}" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                    <p class="mt-1 text-sm text-gray-500">This will be displayed as the main heading on the privacy policy page.</p>
                </div>
            </div>

            <!-- Privacy Policy Content -->
            <div class="">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Privacy Policy Content</h3>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Content <span class="text-red-500">*</span></label>
                    <textarea name="content" id="content" rows="5" required
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('content', $privacyPolicy->content) }}</textarea>
                    <p class="mt-1 text-sm text-gray-500">Use the rich text editor to format your privacy policy content.</p>
                </div>
            </div>

            <!-- Dates -->
            <div class="">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Policy Dates</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Effective Date</label>
                        <input type="date" name="effective_date" 
                            value="{{ old('effective_date', $privacyPolicy->effective_date ? $privacyPolicy->effective_date->format('Y-m-d') : '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        <p class="mt-1 text-sm text-gray-500">The date when this policy became effective.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Last Updated</label>
                        <input type="date" name="last_updated" 
                            value="{{ old('last_updated', $privacyPolicy->last_updated ? $privacyPolicy->last_updated->format('Y-m-d') : date('Y-m-d')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        <p class="mt-1 text-sm text-gray-500">The date when this policy was last updated.</p>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <a href="{{ route('privacy-policy') }}" target="_blank"
                   class="inline-flex items-center px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Preview
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Privacy Policy
                </button>
            </div>
        </form>
    </div>
</div>

<!-- TinyMCE Editor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#content',
    height: 600,
    plugins: 'advlist lists link table preview fullscreen charmap paste code',
    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview fullscreen | code',
    menubar: false,
    content_style: 'body { font-family: "Nunito Sans", sans-serif; font-size: 14px; }'
});
</script>
@endsection
