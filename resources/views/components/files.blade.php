@props(['name' => 'documents'])

<label
    for="files"
    class="block w-full"
    wire:ignore
    x-data
    x-init="() => {
        const input = FilePond.create(
            $refs.input,
            {
                labelIdle: `Glisser & Déposer vos {{ $name }} ou <span class='filepond--label-action'>Parcourir</span>`,
                allowMultiple: true,
                server: {
                    process:(fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        @this.upload('{{ $attributes->whereStartsWith('wire:model')->first() }}', file, load, error, progress)
                    },
                    revert: (filename, load) => {
                        @this.removeUpload('{{ $attributes->whereStartsWith('wire:model')->first() }}', filename, load)
                    },
                }
            }
        );
    }"
>
    <input type="file" name="files" id="files" multiple x-ref="input" />
</label>
