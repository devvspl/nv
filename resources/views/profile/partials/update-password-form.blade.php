<form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
        <label for="update_password_current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password *</label>
        <input type="password" 
               name="current_password" 
               id="update_password_current_password" 
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('current_password', 'updatePassword') border-red-500 @enderror"
               autocomplete="current-password">
        @error('current_password', 'updatePassword')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="update_password_password" class="block text-sm font-medium text-gray-700 mb-2">New Password *</label>
        <input type="password" 
               name="password" 
               id="update_password_password" 
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('password', 'updatePassword') border-red-500 @enderror"
               autocomplete="new-password">
        @error('password', 'updatePassword')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="update_password_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password *</label>
        <input type="password" 
               name="password_confirmation" 
               id="update_password_password_confirmation" 
               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-zendo-gold focus:border-transparent @error('password_confirmation', 'updatePassword') border-red-500 @enderror"
               autocomplete="new-password">
        @error('password_confirmation', 'updatePassword')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200">
        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" 
               x-show="show" 
               x-transition 
               x-init="setTimeout(() => show = false, 3000)"
               class="text-sm text-green-600 font-medium">
                Password updated successfully!
            </p>
        @endif
        
        <button type="submit" 
                class="inline-flex justify-center items-center px-6 py-2 bg-zendo-gold text-white font-semibold rounded-lg hover:bg-opacity-90 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            Update Password
        </button>
    </div>
</form>
