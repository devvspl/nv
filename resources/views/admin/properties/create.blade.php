@extends('layouts.admin')

@section('title', 'Add New Property - ZendoIndia Admin')

@section('page-title', 'Add New Property')
@section('page-description', 'Create a new property listing')

@section('content')
<div class="max-w-5xl" x-data="{ activeTab: 'basic' }">
    <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <!-- Tab Navigation -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex -mb-px overflow-x-auto">
                    <button type="button" @click="activeTab = 'basic'" 
                            :class="activeTab === 'basic' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Basic Information
                    </button>
                    <button type="button" @click="activeTab = 'pricing'" 
                            :class="activeTab === 'pricing' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Pricing & Area
                    </button>
                    <button type="button" @click="activeTab = 'specifications'" 
                            :class="activeTab === 'specifications' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Specifications
                    </button>
                    <button type="button" @click="activeTab = 'location'" 
                            :class="activeTab === 'location' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Location
                    </button>
                    <button type="button" @click="activeTab = 'amenities'" 
                            :class="activeTab === 'amenities' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Amenities
                    </button>
                    <button type="button" @click="activeTab = 'images'" 
                            :class="activeTab === 'images' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Images
                    </button>
                    <button type="button" @click="activeTab = 'settings'" 
                            :class="activeTab === 'settings' ? 'border-zendo-gold text-zendo-gold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                            class="whitespace-nowrap py-4 px-6 border-b-2 font-medium text-sm transition-colors">
                        Settings
                    </button>
                </nav>
            </div>

            <!-- Tab Content -->
            <div class="p-6">
                <!-- Basic Information Tab -->
                <div x-show="activeTab === 'basic'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Property Title *</label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea name="description" rows="4"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Property Type *</label>
                            <select name="property_type_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Property Type</option>
                                @foreach($propertyTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('property_type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('property_type_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">BHK *</label>
                            <select name="bhk_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select BHK</option>
                                @foreach($bhks as $bhk)
                                    <option value="{{ $bhk->id }}" {{ old('bhk_id') == $bhk->id ? 'selected' : '' }}>
                                        {{ $bhk->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('bhk_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">City *</label>
                            <select name="city_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('city_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                            <select name="location_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Location</option>
                                @foreach($locations as $location)
                                    <option value="{{ $location->id }}" {{ old('location_id') == $location->id ? 'selected' : '' }}>
                                        {{ $location->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('location_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Project Status *</label>
                            <select name="project_status_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Status</option>
                                @foreach($projectStatuses as $status)
                                    <option value="{{ $status->id }}" {{ old('project_status_id') == $status->id ? 'selected' : '' }}>
                                        {{ $status->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('project_status_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Builder</label>
                            <select name="builder_id"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Builder</option>
                                @foreach($builders as $builder)
                                    <option value="{{ $builder->id }}" {{ old('builder_id') == $builder->id ? 'selected' : '' }}>
                                        {{ $builder->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('builder_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Pricing & Area Tab -->
                <div x-show="activeTab === 'pricing'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price (₹) *</label>
                            <input type="number" name="price" value="{{ old('price') }}" required step="0.01"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('price')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Price per Sqft (₹)</label>
                            <input type="number" name="price_per_sqft" value="{{ old('price_per_sqft') }}" step="0.01"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('price_per_sqft')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Carpet Area (sqft)</label>
                            <input type="number" name="carpet_area" value="{{ old('carpet_area') }}" step="0.01"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('carpet_area')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Built-up Area (sqft)</label>
                            <input type="number" name="built_up_area" value="{{ old('built_up_area') }}" step="0.01"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('built_up_area')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Plot Area (sqft)</label>
                            <input type="number" name="plot_area" value="{{ old('plot_area') }}" step="0.01"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            @error('plot_area')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div x-show="activeTab === 'specifications'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Total Floors</label>
                            <input type="number" name="total_floors" value="{{ old('total_floors') }}" min="1"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Floor Number</label>
                            <input type="number" name="floor_number" value="{{ old('floor_number') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bedrooms</label>
                            <input type="number" name="bedrooms" value="{{ old('bedrooms') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Bathrooms</label>
                            <input type="number" name="bathrooms" value="{{ old('bathrooms') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Balconies</label>
                            <input type="number" name="balconies" value="{{ old('balconies') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Parking Spaces</label>
                            <input type="number" name="parking_spaces" value="{{ old('parking_spaces') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Furnishing Status</label>
                            <select name="furnishing_status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Status</option>
                                <option value="unfurnished" {{ old('furnishing_status') == 'unfurnished' ? 'selected' : '' }}>Unfurnished</option>
                                <option value="semi_furnished" {{ old('furnishing_status') == 'semi_furnished' ? 'selected' : '' }}>Semi Furnished</option>
                                <option value="fully_furnished" {{ old('furnishing_status') == 'fully_furnished' ? 'selected' : '' }}>Fully Furnished</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Facing</label>
                            <select name="facing"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                                <option value="">Select Facing</option>
                                <option value="north" {{ old('facing') == 'north' ? 'selected' : '' }}>North</option>
                                <option value="south" {{ old('facing') == 'south' ? 'selected' : '' }}>South</option>
                                <option value="east" {{ old('facing') == 'east' ? 'selected' : '' }}>East</option>
                                <option value="west" {{ old('facing') == 'west' ? 'selected' : '' }}>West</option>
                                <option value="north_east" {{ old('facing') == 'north_east' ? 'selected' : '' }}>North East</option>
                                <option value="north_west" {{ old('facing') == 'north_west' ? 'selected' : '' }}>North West</option>
                                <option value="south_east" {{ old('facing') == 'south_east' ? 'selected' : '' }}>South East</option>
                                <option value="south_west" {{ old('facing') == 'south_west' ? 'selected' : '' }}>South West</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Age of Property (years)</label>
                            <input type="number" name="age_of_property" value="{{ old('age_of_property') }}" min="0"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Possession Date</label>
                            <input type="date" name="possession_date" value="{{ old('possession_date') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">RERA ID</label>
                            <input type="text" name="rera_id" value="{{ old('rera_id') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Location Tab -->
                <div x-show="activeTab === 'location'" x-cloak>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                            <textarea name="address" rows="2"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">{{ old('address') }}</textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                                <input type="number" name="latitude" value="{{ old('latitude') }}" step="any"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                                <input type="number" name="longitude" value="{{ old('longitude') }}" step="any"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Amenities Tab -->
                <div x-show="activeTab === 'amenities'" x-cloak>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($amenities as $amenity)
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="amenities[]" value="{{ $amenity->id }}"
                                       {{ in_array($amenity->id, old('amenities', [])) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm text-gray-700">{{ $amenity->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- Images Tab -->
                <div x-show="activeTab === 'images'" x-cloak>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Upload Images (First image will be the main image)</label>
                        <input type="file" name="images[]" multiple accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        <p class="mt-1 text-sm text-gray-500">Accepted formats: JPEG, PNG, JPG, WEBP. Max size: 2MB per image.</p>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div x-show="activeTab === 'settings'" x-cloak>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm font-medium text-gray-700">Active</span>
                            </label>
                        </div>

                        <div>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm font-medium text-gray-700">Featured</span>
                            </label>
                        </div>

                        <div>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="checkbox" name="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-zendo-gold focus:ring-zendo-gold">
                                <span class="text-sm font-medium text-gray-700">Verified</span>
                            </label>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Published At</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end space-x-4">
            <a href="{{ route('admin.properties.index') }}" 
               class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                Cancel
            </a>
            <button type="submit" 
                    class="px-6 py-2 bg-zendo-gold text-white rounded-lg hover:bg-zendo-navy transition-colors">
                Create Property
            </button>
        </div>
    </form>
</div>
@endsection
