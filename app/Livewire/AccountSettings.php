<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
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

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->github = $user->github;
        $this->linkedin = $user->linkedin;
        $this->twitter = $user->twitter;
        $this->currentAvatar = $user->getFirstMediaUrl('users');
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
            $user->addMediaFromDisk($this->avatar->getRealPath())->toMediaCollection('users');
            $this->currentAvatar = $user->getFirstMediaUrl('users');
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

        $company = Auth::user()->companies()->create(
            [
                'title' => $this->companyTitle,
                'description' => $this->companyDescription,
                'website' => $this->companyWebsite,
                'phone' => $this->companyPhone,
                'address' => $this->companyAddress,
                'user_id' => Auth::id(),
            ]
        );

        if ($this->companyLogo instanceof TemporaryUploadedFile) {
            $company->clearMediaCollection('companies');
            $company->addMediaFromDisk($this->companyLogo->getRealPath())->toMediaCollection('companies');
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
        $this->companyPreviewLogoUrl = $company->getFirstMediaUrl('companies');

    }

    public function editCompany()
    {
        $company = Auth::user()->companies()->findOrFail($this->editingCompanyId);

        $company->update([
            'title' => $this->companyTitle,
            'description' => $this->companyDescription,
            'website' => $this->companyWebsite,
            'phone' => $this->companyPhone,
            'address' => $this->companyAddress,
        ]);

        if ($this->companyLogo instanceof TemporaryUploadedFile) {
            $company->clearMediaCollection('companies');
            $company->addMediaFromDisk($this->companyLogo->getRealPath())->toMediaCollection('companies');
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

    public function render()
    {
        return view('livewire.account-settings');
    }
}
