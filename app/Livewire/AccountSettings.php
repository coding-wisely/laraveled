<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class AccountSettings extends Component
{
    use WithFileUploads;

    public $name;

    public $email;

    public $bio;

    public $github;

    public $linkedin;

    public $twitter;

    public $avatar;

    public $currentAvatar;

    public $currentCompanyLogo;

    public $previewAvatarUrl;

    public $newPassword;

    public $confirmPassword;

    public $companies;

    public $companyId = null;

    public $companyTitle;

    public $companyDescription;

    public $companyWebsite;

    public $companyPhone;

    public $companyAddress;

    public $companyLogo;

    public $companyPreviewLogoUrl;

    public $showEditModal = false;

    public $editingCompanyId = null;

    public $deleteAccountPassword;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->github = $user->github;
        $this->linkedin = $user->linkedin;
        $this->twitter = $user->twitter;
        // $this->currentAvatar = $user->getFirstMediaUrl('users');
        $mediaItem = $user->getFirstMedia('users');
        $this->currentAvatar = $mediaItem ? Storage::disk('s3')->temporaryUrl(
            $mediaItem->getPath(), now()->addMinutes(60)
        ) : null;
        $this->companies = $user->companies()->orderBy('id', 'desc')->get();
    }

    public function updatedAvatar()
    {
        if ($this->avatar instanceof TemporaryUploadedFile) {
            $this->previewAvatarUrl = $this->avatar->temporaryUrl();
        }
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => 'nullable|string|max:500',
            'github' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        if ($this->avatar instanceof TemporaryUploadedFile) {
            $user->clearMediaCollection('users');
            $user->addMedia($this->avatar->getRealPath())->toMediaCollection('users');
            // $this->currentAvatar = $user->getFirstMediaUrl('users');
            $mediaItem = $user->getFirstMedia('users');
            $this->currentAvatar = $mediaItem ? Storage::disk('s3')->temporaryUrl(
                $mediaItem->getPath(), now()->addMinutes(60)
            ) : null;
            $this->previewAvatarUrl = null;
        }

        $user->update($validated);

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function saveCompany()
    {
        $this->validate([
            'companyTitle' => 'required|string|max:255',
            'companyDescription' => 'nullable|string',
            'companyWebsite' => 'nullable|string|max:255',
            'companyPhone' => 'nullable|string|max:15',
            'companyAddress' => 'nullable|string|max:255',
        ]);

        $website = $this->companyWebsite;
        if ($website && ! (str_starts_with($website, 'http://') || str_starts_with($website, 'https://'))) {
            $website = 'https://'.$website;
        }

        $company = Auth::user()->companies()->create(
            [
                'title' => $this->companyTitle,
                'description' => $this->companyDescription,
                'website' => $website,
                'phone' => $this->companyPhone,
                'address' => $this->companyAddress,
                'user_id' => Auth::id(),
            ]
        );

        if ($this->companyLogo instanceof TemporaryUploadedFile) {
            $company->clearMediaCollection('companies');
            $company->addMedia($this->companyLogo->getRealPath())->toMediaCollection('companies');
        }

        $this->resetCompanyFields();
        $this->companies = Auth::user()->companies()->orderBy('id', 'desc')->get();
        $this->editingCompanyId = null;

        Flux::modals()->close();

        Flux::toast(
            heading: 'Company added',
            text: 'Company has been added.',
            variant: 'success',
        );
    }

    public function setEditingId($companyId)
    {
        $company = Auth::user()->companies()->findOrFail($companyId);

        $this->editingCompanyId = $companyId;
        $this->companyId = $company->id;
        $this->companyTitle = $company->title;
        $this->companyDescription = $company->description;
        $this->companyWebsite = $company->website;
        $this->companyPhone = $company->phone;
        $this->companyAddress = $company->address;
        // $this->companyPreviewLogoUrl = $company->getFirstMediaUrl('companies');
        $mediaItem = $company->getFirstMedia('companies');
        $this->companyPreviewLogoUrl = $mediaItem ? Storage::disk('s3')->temporaryUrl(
            $mediaItem->getPath(), now()->addMinutes(60)
        ) : null;
    }

    public function editCompany()
    {
        $company = Auth::user()->companies()->findOrFail($this->editingCompanyId);

        $website = $this->companyWebsite;
        if ($website && ! (str_starts_with($website, 'http://') || str_starts_with($website, 'https://'))) {
            $website = 'https://'.$website;
        }

        $company->update([
            'title' => $this->companyTitle,
            'description' => $this->companyDescription,
            'website' => $website,
            'phone' => $this->companyPhone,
            'address' => $this->companyAddress,
        ]);

        if ($this->companyLogo instanceof TemporaryUploadedFile) {
            $company->clearMediaCollection('companies');
            $company->addMedia($this->companyLogo->getRealPath())->toMediaCollection('companies');
        }
        $this->resetCompanyFields();
        $this->companies = Auth::user()->companies()->orderBy('id', 'desc')->get();
        $this->editingCompanyId = null;

        Flux::modals()->close();

        Flux::toast(
            heading: 'Company edited',
            text: 'Company has been edited.',
            variant: 'success',
        );
    }

    public function cancelEdit()
    {
        $this->editingCompanyId = null;
        $this->resetCompanyFields();

        Flux::modals()->close();

    }

    public function cancel()
    {

        Flux::modals()->close();
    }

    private function resetCompanyFields()
    {
        $this->reset(['companyId', 'companyTitle', 'companyDescription', 'companyWebsite', 'companyPhone', 'companyAddress', 'companyLogo', 'companyPreviewLogoUrl']);
    }

    public function deleteCompany($companyId)
    {
        Auth::user()->companies()->findOrFail($companyId)->delete();
        $this->companies = Auth::user()->companies()->get();

        Flux::toast(
            heading: 'Company deleted',
            text: 'Company has been deleted.',
            variant: 'success',
        );
    }

    public function confirmDeleteAccount()
    {
        $this->validate([
            'deleteAccountPassword' => 'required|string',
        ]);

        $user = Auth::user();

        if (! Hash::check($this->deleteAccountPassword, $user->password)) {
            $this->addError('deleteAccountPassword', __('The provided password does not match our records.'));

            return;
        }

        // Delete the user account and log out
        $user->delete();
        Auth::logout();

        return redirect('/');
    }

    // NEW: Cancel deletion (reset field and close modal)
    public function cancelDeleteAccount()
    {
        $this->reset('deleteAccountPassword');
        Flux::modals()->close('delete-account-modal');
    }

    public function render()
    {
        return view('livewire.account-settings');
    }
}
