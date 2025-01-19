<form wire:submit="save">
    @if ($photos)
        @foreach($photos as $photo)
            <img src="{{ $photo->temporaryUrl() }}">
        @endforeach
    @endif

    <input type="file" wire:model="photos" multiple>

        @error('photos.*') <span class="error">{{ $message }}</span> @enderror

    <button type="submit">Save photo</button>
</form>
