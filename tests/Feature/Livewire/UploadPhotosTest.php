<?php

use App\Livewire\UploadPhotos;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UploadPhotos::class)
        ->assertStatus(200);
});
it('upload photos', function () {
    // Use Storage fake to mock the default disk
    Storage::fake();

    // Create a fake image
    $file = UploadedFile::fake()->image('avatar.png');

    // Test the Livewire component
    Livewire::test(UploadPhotos::class)
        ->set('photos', [$file]) // Photos should be an array
        ->call('save');

    // Assert the file was stored in the 'photos' directory
    Storage::assertExists('photos/' . $file->hashName());
});
