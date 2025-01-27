<div wire:ignore
     class=""
     x-data
     x-init="
        FilePond.setOptions({
                labelIdle:'Drag & Drop your project images or screenshots here or <span class=\'filepond--label-action\'>Browse</span>',
               allowMultiple: {{ isset($attributes['multiple']) ? 'true' : 'false' }},
            server: {
                process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                    @this.upload('{{ $attributes['wire:model'] }}', file, load, error, progress)
                },
                revert: (uniqueFileId, load, error) => {
                    @this.removeUpload('{{ $attributes['wire:model'] }}', uniqueFileId, load)
                },
            }
        });
        FilePond.registerPlugin(FilePondPluginImagePreview,FilePondPluginFileValidateType,FilePondPluginFileValidateSize);
        FilePond.create($refs.input)"
>
    <input type="file" x-ref="input" {{ $attributes }} multiple
           data-allow-reorder="true"
           accept="image/png, image/jpeg, image/gif"
           data-max-file-size="3MB"
           data-max-files="3">
    <flux:subheading>
        Max files: 3, Max file size: 3MB
    </flux:subheading>
</div>
