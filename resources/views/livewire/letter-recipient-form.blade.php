<form wire:submit.prevent="save"
      class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40">
    <div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aperiam architecto assumenda consequatur
            deleniti exercitationem iusto odio.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
    <div class="col-span-1 md:col-span-2 grid grid-cols-1 gap-6">
        @foreach($recipients as $index => $recipient)
            <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 border border-gray-100 p-6 shadow-md shadow-gray-300/20">
                <div class="grid grid-cols-2 col-span-1 md:col-span-2 justify-between w-full">
                    <label class="flex flex-col select">
                        <select
                            wire:model="recipients.{{ $index }}.type"
                            id="recipients_{{ $index }}_type"
                            class="appearance-none w-full border-b outline-none h-8 placeholder:text-purple-200 bg-transparent rounded-none border-purple-100"
                        >
                            @foreach(\App\Enums\AddressType::cases() as $addressType)
                                <option value="{{ $addressType }}" {{ ($addressType->value === $recipient['type']) ? 'selected' : '' }}>{{ $addressType->label() }}</option>
                            @endforeach
                        </select>
                    </label>
                    @if(!$loop->first)
                        <div class="flex justify-end">
                            <button
                                wire:click.prevent="remove({{ $index }})"
                                class="w-8 h-8 text-purple-700 cursor-pointer flex items-center justify-center text-xs bg-white border border-b-[3px] border-gray-200 rounded-sm"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="w-4 h-4 stroke-current">
                                    <path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M.5 7h13"/>
                                </svg>
                            </button>
                        </div>
                    @endif
                </div>
                @if($recipient['type'] === \App\Enums\AddressType::PROFESSIONAL->value)
                    @include('front-end._partials.forms.professional', ['person' => 'recipients', 'index' => $index])
                @else
                    @include('front-end._partials.forms.personal', ['person' => 'recipients', 'index' => $index])
                @endif
                <div>
                    <div class="flex flex-col select">
                        <label
                            for="recipients_{{ $index }}_country"
                            class="text-xs text-purple-700">Pays</label>
                        <select
                            wire:model.defer="recipients.{{ $index }}.country"
                            id="recipients_{{ $index }}_country"
                            class="appearance-none w-full border-b outline-none h-8 placeholder:text-purple-200 bg-transparent rounded-none @error('recipients.' . $index . '.country') border-red-500 @else border-purple-100 @enderror"
                        >
                            <option value="null">Selectionnez le pays</option>
                            @foreach($countries as $country)
                                <option value="{{ Str::upper($country) }}">{{ Str::upper($country) }}</option>
                                @if($loop->first)
                                    <option disabled>───</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    @error('recipients.' . $index . '.country')
                        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-span-1 md:col-span-3 flex justify-end gap-6">
        <button
            wire:click.prevent="add"
            class="underline text-purple-700"
        >Ajouter un autre destinataire</button>
        <button
            class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase"
            type="submit"
        >Suivant</button>
    </div>
</form>
