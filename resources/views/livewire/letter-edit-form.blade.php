<form wire:submit.prevent="save" class="grid grid-cols-1 gap-6 bg-white p-6 rounded-md shadow-xl shadow-gray-300/40">
    @if($template['is_new_type'])
        <x-editor
            :is-editable="$isEditable"
            wire:model="template.model"
            wire:poll.10000ms="autosave"
            class="outline-none"
        ></x-editor>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="border border-purple-100 rounded-sm p-6 flex flex-col gap-6">
                @foreach($template['group_fields']['fields'] as $key => $field)
                    @if($field['type'] === 'string' && $key !== 'complement_document' && $key !== '')
                        <div class="flex flex-col">
                            <label
                                for="{{ $key }}"
                                class="text-xs text-purple-700">{{ $field['label'] }}</label>
                            <input
                                type="text"
                                wire:model="{{ 'template.group_fields.fields.' . $key . '.value' }}"
                                placeholder="{{ $field['label'] }}"
                                id="{{ $key }}"
                                class="w-full border-b outline-none h-8 placeholder:text-purple-200 border-purple-100"
                            >
                            @error('template.group_fields.fields.' . $key . '.value')
                                <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif($field['type'] === 'string' && $key === 'complement_document')
                        <div class="col-span-1 md:col-span-2 flex flex-col gap-y-2">
                            <label
                                for="{{ $key }}"
                                class="text-xs text-purple-700">{{ $field['label'] }}</label>
                            <textarea
                                wire:model="{{ 'template.group_fields.fields.' . $key . '.value' }}"
                                id="{{ $key }}"
                                class="w-full border outline-none placeholder:text-purple-200 min-h-[10rem] p-3"
                                placeholder="{{ $field['label'] }}…"
                            ></textarea>
                            @error('template.group_fields.fields.' . $key . '.value')
                                <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif($field['type'] === 'select')
                        <div class="flex flex-col select">
                            <label
                                for="{{ $key }}"
                                class="text-xs text-purple-700">{{ $field['label'] }}</label>
                            <select
                                wire:model="{{ 'template.group_fields.fields.' . $key . '.value' }}"
                                id="{{ $key }}"
                                class="appearance-none w-full border-b outline-none h-8 placeholder:text-purple-200 bg-transparent rounded-none"
                            >
                                <option value="null">Selectionnez {{ Str::lower($field['label']) }}</option>
                                @foreach($field['options'] as $option)
                                    <option value="{{ $option['value'] }}">{{ $option['value'] }}</option>
                                @endforeach
                            </select>
                            @error('template.group_fields.fields.' . $key . '.value')
                                <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @elseif($field['type'] === 'date' && $key !== 'date_now')
                        <div class="flex flex-col">
                            <label
                                for="{{ $key }}"
                                class="text-xs text-purple-700">{{ $field['label'] }}</label>
                            <input
                                type="date"
                                wire:model="{{ 'template.group_fields.fields.' . $key . '.value' }}"
                                placeholder="{{ $field['label'] }}"
                                id="{{ $key }}"
                                class="w-full border-b outline-none h-8 placeholder:text-purple-200 border-purple-100"
                            >
                            @error('template.group_fields.fields.' . $key . '.value')
                                <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="relative border border-purple-100 rounded-sm aspect-[210/297]">
                <div class="absolute inset-0 z-10"></div>
                <article class="p-8 text-sm">
                    {!! $template['letter'] !!}
                </article>
            </div>
        </div>
    @endif
    <div><x-files wire:model="files" name="pièces jointes" /></div>
    <div class="flex justify-end">
        <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Suivant</button>
    </div>
</form>
