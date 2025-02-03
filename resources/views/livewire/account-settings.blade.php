<section>
    <header>
        <flux:heading>
            {{ __('Account Settings') }}
        </flux:heading>
        <flux:subheading>
            {{ __("Update your profile information and password.") }}
        </flux:subheading>
    </header>

    <div class="grid grid-cols-1 gap-6 mt-6">
        <flux:fieldset class="p-6 border shadow-sm rounded-md">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Profile Information') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ __("Update your account's profile information.") }}
            </p>

            <form wire:submit.prevent="updateProfileInformation" class="space-y-6">

            <div class="flex flex-col items-center">
                <label for="avatar" class="cursor-pointer relative">
                        @if ($previewAvatarUrl)
                            <img 
                                src="{{ $previewAvatarUrl }}" 
                                alt="Avatar Preview" 
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow"
                            >
                        @elseif ($currentAvatar)
                            <img 
                                src="{{ $currentAvatar }}" 
                                alt="Current Avatar" 
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow"
                            >
                        @else
                            <img 
                                src="{{ asset('images/default-user.png') }}" 
                                alt="Default Avatar" 
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow"
                            >
                        @endif
                        <div class="absolute bottom-0 right-0 bg-orange-600 text-white text-xs p-1 rounded-full">
                            <span>{{ __('Edit') }}</span>
                        </div>
                    </label>

                    <input id="avatar" type="file" wire:model="avatar" accept="image/*" class="hidden">
                    <p class="text-sm  mt-2">
                        {{ __('Click the avatar to upload a new image.') }}
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2  gap-6">
                    <flux:input :label="__('Name')" wire:model="name" required autofocus autocomplete="name" />

                    <flux:input :label="__('Email')" wire:model="email" type="email" required autofocus autocomplete="email" />
                </div>

                <flux:textarea :label="__('Bio')" wire:model="bio" rows="4" />

               <!-- Social Media Fields in 3 Columns (Responsive) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <flux:input :label="__('GitHub Profile')" wire:model="github" type="url" placeholder="https://github.com/yourusername" />

                    <flux:input :label="__('LinkedIn Profile')" wire:model="linkedin" type="url" placeholder="https://linkedin.com/in/yourusername" />

                    <flux:input :label="__('Twitter Profile')" wire:model="twitter" type="url" placeholder="https://twitter.com/yourusername" />
                </div>

                <div class="flex items-center gap-4">
                    <flux:button type="submit">{{ __('Save Changes') }}</flux:button>
                    <x-action-message class="me-3" on="profile-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>
        </flux:fieldset>

        <flux:fieldset class="p-6 border shadow-sm rounded-md">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Change Password') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ __('Update your password to keep your account secure.') }}
            </p>

            <form wire:submit.prevent="updatePassword" class="space-y-6">
                <flux:input :label="__('New Password')" type="password" wire:model="newPassword" required />

                <flux:input :label="__('Confirm Password')" type="password" wire:model="confirmPassword" required />

                <div class="flex items-center gap-4">
                    <flux:button type="submit">{{ __('Update Password') }}</flux:button>
                </div>
            </form>
        </flux:fieldset>
    </div>
</section>
