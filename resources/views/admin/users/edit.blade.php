@extends('layouts.admin')

@section('title', 'Edit User - ZendoIndia Admin')

@section('page-title', 'Edit User')
@section('page-description')
Update user information and settings.
@endsection

@section('content')
<!-- Breadcrumb -->
<div class="mb-6">
    <nav class="flex" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-zendo-navy">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                    Users
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500">Edit {{ $user->name }}</span>
                </div>
            </li>
        </ol>
    </nav>
</div>

<!-- Edit User Form -->
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <!-- User Info Header -->
        <div class="flex items-center mb-6 pb-6 border-b border-gray-200">
            <div class="w-16 h-16 bg-zendo-gold rounded-full flex items-center justify-center">
                <span class="text-white font-bold text-xl">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div class="ml-4">
                <h3 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h3>
                <p class="text-gray-600">{{ $user->email }}</p>
                <p class="text-sm text-gray-500">Member since {{ $user->created_at->format('M d, Y') }}</p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            
            <!-- Name Field -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $user->name) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-zendo-gold transition-colors @error('name') border-red-500 @enderror"
                       placeholder="Enter full name"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-zendo-gold transition-colors @error('email') border-red-500 @enderror"
                       placeholder="Enter email address"
                       required>
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Section -->
            <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                <h4 class="text-sm font-medium text-gray-900 mb-3">Change Password (Optional)</h4>
                <p class="text-sm text-gray-600 mb-4">Leave blank to keep current password</p>
                
                <!-- New Password Field -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                    <input type="password" 
                           name="password" 
                           id="password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-zendo-gold transition-colors @error('password') border-red-500 @enderror"
                           placeholder="Enter new password (min. 8 characters)">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                    <input type="password" 
                           name="password_confirmation" 
                           id="password_confirmation"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-zendo-gold transition-colors"
                           placeholder="Confirm new password">
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.users.index') }}" 
                       class="px-6 py-3 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-3 bg-zendo-gold text-white font-medium rounded-lg hover:bg-zendo-navy transition-colors">
                        Update User
                    </button>
                </div>
                
                @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block" 
                          onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                            Delete User
                        </button>
                    </form>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection