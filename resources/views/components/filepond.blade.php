<div wire:ignore
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
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.create($refs.input)"
>

    <input type="file" x-ref="input" {{ $attributes }}>
</div>
