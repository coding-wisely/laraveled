<section>
    <header>
        <flux:heading>
            {{ __('Account Settings') }}
        </flux:heading>
        <flux:subheading>
            {{ __('Update your profile information and password.') }}
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
                            <img src="{{ $previewAvatarUrl }}" alt="Avatar Preview"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                        @elseif ($currentAvatar)
                            <img src="{{ $currentAvatar }}" alt="Current Avatar"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                        @else
                            <img src="{{ asset('images/default-user.png') }}" alt="Default Avatar"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
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

                    <flux:input :label="__('Email')" wire:model="email" type="email" required autofocus
                        autocomplete="email" />
                </div>

                <flux:textarea :label="__('Bio')" wire:model="bio" rows="4" />

                <!-- Social Media Fields in 3 Columns (Responsive) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <flux:input :label="__('GitHub Profile')" wire:model="github" type="url"
                        placeholder="https://github.com/yourusername" />

                    <flux:input :label="__('LinkedIn Profile')" wire:model="linkedin" type="url"
                        placeholder="https://linkedin.com/in/yourusername" />

                    <flux:input :label="__('X Profile')" wire:model="twitter" type="url"
                        placeholder="https://x.com/yourusername" />
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

        <flux:fieldset class="p-6 border shadow-sm rounded-md">

            <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">
                {{ __('Manage Companies') }}
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300 mb-6">
                {{ __('View, edit or delete your companies. Click "Add More Companies" to add a new one.') }}
            </p>

            <div class="mb-4 flex justify-end">
                <flux:modal.trigger name="add-company-modal">
                    <flux:button>{{ __('Add Companies') }}</flux:button>
                </flux:modal.trigger>
            </div>

            <!-- Grid layout for company cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                @foreach ($companies as $company)
                    <flux:card class="rounded-lg border flex flex-col justify-between">

                        @if ($editingCompanyId === $company->id)
                            <!-- Editable Mode -->
                            <div class="space-y-3">
                                <div class="flex flex-col items-center">
                                    <label for="companyLogo" class="cursor-pointer relative">
                                        @if ($companyLogo)
                                            <img src="{{ $companyLogo->temporaryUrl() }}" alt="Company Logo Preview"
                                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                                        @elseif ($companyPreviewLogoUrl)
                                            <img src="{{ $companyPreviewLogoUrl }}" alt="Company Logo"
                                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                                        @else
                                            <img src="{{ asset('images/default-company.png') }}" alt="Default Logo"
                                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                                        @endif
                                        <div
                                            class="absolute bottom-0 right-0 bg-orange-600 text-white text-xs p-1 rounded-full">
                                            <span>{{ __('Edit') }}</span>
                                        </div>
                                    </label>

                                    <input id="companyLogo" type="file" wire:model="companyLogo" accept="image/*"
                                        class="hidden">
                                    <p class="text-sm mt-2">
                                        {{ __('Click to upload a new logo.') }}
                                    </p>
                                </div>

                                <flux:input wire:model.defer="companyTitle" label="Company Title" required />
                                <flux:textarea wire:model.defer="companyDescription" label="Description" rows="3" />
                                    <flux:field>
                                        <flux:label badge="Required">Website</flux:label>

                                        <flux:input.group>
                                            <flux:input.group.prefix>https://</flux:input.group.prefix>

                                            <flux:input wire:model.defer="companyWebsite" placeholder="The URL of your project website." />
                                        </flux:input.group>

                                        <flux:error name="companyWebsite" />
                                    </flux:field>
                                <flux:input wire:model.defer="companyPhone" label="Phone" type="text" />
                                <flux:input wire:model.defer="companyAddress" label="Address" type="text" />
                            </div>

                            <div class="mt-4 flex justify-end gap-2">
                                <flux:button wire:click="cancelEdit">{{ __('Cancel') }}</flux:button>
                                <flux:button wire:click="editCompany">{{ __('Save') }}</flux:button>
                            </div>
                        @else
                            <!-- View Mode -->
                            <div class=" gap-4">
                                <div class="flex justify-center">
                                    <img src="{{ $company->getFirstMediaUrl('companies') }}"
                                        alt="{{ $company->title }}" class="w-24 h-24 rounded-none object-cover">
                                </div>

                                <!-- Text Information -->
                                <div class="w-full">
                                    <strong class="text-xl block">{{ $company->title }}</strong>
                                    <p class="text-sm mt-1 break-words">{{ $company->description }}</p>
                                    <p class="text-sm mt-1 break-words">{{ $company->phone }}</p>
                                    <p class="text-sm mt-1 break-words">{{ $company->address }}</p>

                                    @if ($company->website)
                                        <flux:link href="{{ $company->website }}" target="_blank"
                                            class="text-sm mt-1 break-all block">
                                            {{ $company->website }}
                                        </flux:link>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-4 flex justify-end gap-2">
                                <flux:button wire:click="setEditingId({{ $company->id }})">Edit</flux:button>
                                <flux:button wire:click="deleteCompany({{ $company->id }})" variant="danger">Delete
                                </flux:button>
                            </div>
                        @endif

                    </flux:card>
                @endforeach
            </div>

            <!-- Add Company Modal -->
            <flux:modal name="add-company-modal" class="md:w-96 space-y-6">
                <flux:heading size="lg">{{ __('Add Company') }}</flux:heading>

                <form wire:submit.prevent="saveCompany" class="space-y-4">
                    <label for="companyLogo" class="cursor-pointer  justify-center items-center relative">
                        @if ($companyLogo)
                            <img src="{{ $companyLogo->temporaryUrl() }}" alt="Company Logo Preview"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                        @elseif ($companyPreviewLogoUrl)
                            <img src="{{ $companyPreviewLogoUrl }}" alt="Company Logo"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                        @else
                            <img alt="Upload Image"
                                class="w-24 h-24 rounded-full object-cover border border-gray-300 shadow">
                        @endif

                    </label>

                    <input id="companyLogo" type="file" wire:model="companyLogo" accept="image/*"
                        class="hidden">
                    <flux:input :label="__('Company Title')" wire:model.defer="companyTitle" required />
                    <flux:textarea :label="__('Company Description')" wire:model.defer="companyDescription"
                        rows="3" />
                   
                    <flux:field>
                        <flux:label badge="Required">Website</flux:label>

                        <flux:input.group>
                            <flux:input.group.prefix>https://</flux:input.group.prefix>

                            <flux:input wire:model.defer="companyWebsite" placeholder="The URL of your project website." />
                        </flux:input.group>

                        <flux:error name="companyWebsite" />
                    </flux:field>

                    <flux:input :label="__('Phone')" wire:model.defer="companyPhone" type="text" />
                    <flux:input :label="__('Address')" wire:model.defer="companyAddress" type="text" />


                    <div class="flex justify-end gap-4 mt-4">
                        <flux:button wire:click="cancel">Cancel</flux:button>
                        <flux:button type="submit">{{ __('Add Company') }}</flux:button>
                    </div>
                </form>
            </flux:modal>

        </flux:fieldset>



    </div>
</section>
