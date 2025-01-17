<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
class UploadPhotos extends Component
{
    use WithFileUploads;

    #[Validate(['photos.*' => 'image|max:1024'])]
    public $photos = [];

    public function save()
    {

        foreach ($this->photos as $photo) {
            $photo->store('photos', 'minio'); // Upload each file individually
        }

    }
    public function render()
    {
        return view('livewire.upload-photos');
    }
}
