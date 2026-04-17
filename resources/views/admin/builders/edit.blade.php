@extends('layouts.admin')

@section('title', 'Edit Builder')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-heading text-zendo-navy font-semibold">Edit Builder</h2>
            <a href="{{ route('admin.builders.index') }}"
               class="inline-flex items-center px-4 py-2 text-sm text-gray-600 hover:text-zendo-navy transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to List
            </a>
        </div>

        <form action="{{ route('admin.builders.update', $builder) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tab Nav --}}
            <div class="border-b border-gray-200 px-6">
                <nav class="-mb-px flex space-x-6" id="builder-tabs">
                    @php
                        $tabs = [
                            ['id' => 'general',        'label' => 'General'],
                            ['id' => 'media',          'label' => 'Media'],
                            ['id' => 'common-details', 'label' => 'Common Details'],
                        ];
                    @endphp
                    @foreach($tabs as $i => $tab)
                    <button type="button"
                        data-tab="{{ $tab['id'] }}"
                        class="tab-btn whitespace-nowrap py-4 px-1 border-b-2 text-sm font-medium transition-colors
                               {{ $i === 0 ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        {{ $tab['label'] }}
                    </button>
                    @endforeach
                </nav>
            </div>

            <div class="p-6 space-y-6">

                {{-- ── TAB: GENERAL ── --}}
                <div id="tab-general" class="tab-panel space-y-6">

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Builder Name *</label>
                            <input type="text" name="name" value="{{ old('name', $builder->name) }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('name') border-red-500 @enderror">
                            @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Established Year</label>
                            <input type="number" name="established_year" value="{{ old('established_year', $builder->established_year) }}"
                                min="1800" max="{{ date('Y') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('established_year') border-red-500 @enderror">
                            @error('established_year')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="3"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('description') border-red-500 @enderror">{{ old('description', $builder->description) }}</textarea>
                        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    @if($builder->logo)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Logo</label>
                        <img src="{{ asset('storage/' . $builder->logo) }}" alt="{{ $builder->name }}"
                             class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $builder->logo ? 'Change Logo' : 'Upload Logo' }}</label>
                        <input type="file" name="logo" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('logo') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">JPEG, PNG, JPG, WEBP — max 2MB</p>
                        @error('logo')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-700 mb-4">Contact Information</h4>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" value="{{ old('email', $builder->email) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="text" name="phone" value="{{ old('phone', $builder->phone) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                            <input type="url" name="website" value="{{ old('website', $builder->website) }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('website')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="2"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('address', $builder->address) }}</textarea>
                            @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h4 class="text-sm font-semibold text-gray-700 mb-4">Settings</h4>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                                <input type="number" name="display_order" value="{{ old('display_order', $builder->display_order) }}" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('display_order') border-red-500 @enderror">
                                <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                                @error('display_order')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div class="flex flex-col justify-center space-y-3">
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="status" value="1" {{ old('status', $builder->status) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                    <span class="text-sm font-medium text-gray-700">Active (visible on website)</span>
                                </label>
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input type="checkbox" name="is_verified" value="1" {{ old('is_verified', $builder->is_verified) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                    <span class="text-sm font-medium text-gray-700">Verified Builder</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── TAB: MEDIA ── --}}
                <div id="tab-media" class="tab-panel hidden space-y-6">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">YouTube URL</label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url', $builder->youtube_url) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('youtube_url') border-red-500 @enderror"
                            placeholder="https://www.youtube.com/watch?v=...">
                        <p class="mt-1 text-sm text-gray-500">Paste a YouTube video link for this builder.</p>
                        @error('youtube_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    @if($builder->video_path)
                    <div class="p-3 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-sm font-medium text-gray-700 mb-2">Current Video</p>
                        <video controls class="w-full max-h-48 rounded-lg">
                            <source src="{{ asset('storage/' . $builder->video_path) }}" type="video/mp4">
                        </video>
                        <label class="flex items-center space-x-2 cursor-pointer mt-3">
                            <input type="checkbox" name="remove_video" value="1"
                                   class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                            <span class="text-sm text-red-600 font-medium">Remove current video</span>
                        </label>
                    </div>
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ $builder->video_path ? 'Replace Video' : 'Upload Video' }}</label>
                        <input type="file" name="video_path"
                            accept="video/mp4,video/quicktime,video/x-msvideo,video/x-ms-wmv"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('video_path') border-red-500 @enderror">
                        <p class="mt-1 text-sm text-gray-500">MP4, MOV, AVI, WMV — max 100MB</p>
                        @error('video_path')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- ── TAB: COMMON DETAILS ── --}}
                <div id="tab-common-details" class="tab-panel hidden space-y-6">

                    <p class="text-sm text-gray-500">Default amenities, project statuses and property page settings that apply across all this builder's properties.</p>

                    {{-- Amenities --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Amenities Offered</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            @foreach($amenities as $amenity)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                    {{ in_array($amenity->id, old('amenities', $builder->amenities->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm text-gray-700">{{ $amenity->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('amenities')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Project Statuses --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Project Statuses Available</label>
                        <div class="flex flex-wrap gap-3 p-4 border border-gray-200 rounded-lg bg-gray-50">
                            @foreach($projectStatuses as $ps)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="project_statuses[]" value="{{ $ps->id }}"
                                    {{ in_array($ps->id, old('project_statuses', $builder->projectStatuses->pluck('id')->toArray())) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm text-gray-700">{{ $ps->name }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('project_statuses')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <a href="{{ route('admin.builders.index') }}"
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Update Builder
                    </button>
                </div>

            </div>{{-- /p-6 --}}
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
(function () {
    const tabs   = document.querySelectorAll('.tab-btn');
    const panels = document.querySelectorAll('.tab-panel');

    function activate(id) {
        tabs.forEach(btn => {
            const active = btn.dataset.tab === id;
            btn.classList.toggle('border-zendo-gold', active);
            btn.classList.toggle('text-zendo-gold', active);
            btn.classList.toggle('border-transparent', !active);
            btn.classList.toggle('text-gray-500', !active);
        });
        panels.forEach(p => p.classList.toggle('hidden', p.id !== 'tab-' + id));
    }

    tabs.forEach(btn => btn.addEventListener('click', () => activate(btn.dataset.tab)));

    // Auto-open tab that contains a validation error
    @if($errors->any())
    const errorFields = @json($errors->keys());
    const tabMap = {
        general:        ['name','established_year','description','logo','email','phone','website','address','display_order','status','is_verified'],
        media:          ['youtube_url','video_path'],
        'common-details': ['amenities','project_statuses'],
    };
    for (const [tab, fields] of Object.entries(tabMap)) {
        if (fields.some(f => errorFields.includes(f) || errorFields.some(e => e.startsWith(f)))) {
            activate(tab); break;
        }
    }
    @endif
})();
</script>
@endpush
