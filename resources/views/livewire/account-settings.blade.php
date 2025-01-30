<section>
    <header>
        <flux:heading>
            {{ __('Account Settings') }}
        </flux:heading>
        <flux:subheading>
            {{ __("Update your profile information and password.") }}
        </flux:subheading>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <flux:fieldset class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Profile Information') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ __("Update your account's profile information.") }}
            </p>

            <form wire:submit.prevent="updateProfileInformation" class="space-y-6">

                <flux:input :label="__('Name')" wire:model="name" required autofocus autocomplete="name" />

                <flux:input :label="__('Email')" wire:model="email" type="email" required autofocus autocomplete="email" />

                <flux:textarea :label="__('Bio')" wire:model="bio" rows="4" />

                <div class="flex items-center gap-4">
                    <flux:button type="submit">{{ __('Save Changes') }}</flux:button>
                    <x-action-message class="me-3" on="profile-updated">
                        {{ __('Saved.') }}
                    </x-action-message>
                </div>
            </form>
        </flux:fieldset>

        <flux:fieldset class="p-6 bg-white dark:bg-gray-800 shadow-lg rounded-lg">
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
