<form wire:submit.prevent="save"
      class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40">
    <div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aperiam architecto assumenda consequatur
            deleniti exercitationem iusto odio.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
    </div>
    <div class="col-span-1 md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
        @if($is_professional)
            @include('front-end._partials.forms.professional', ['person' => 'sender'])
        @else
            @include('front-end._partials.forms.personal', ['person' => 'sender'])
        @endif
        <div class="flex flex-col select">
            <label
                for="country"
                class="text-xs text-purple-700">Pays</label>
            <select
                wire:model="sender.country"
                id="country"
                class="appearance-none w-full border-b @error('sender.country') border-red-500 @else border-purple-100 @enderror outline-none h-8 placeholder:text-purple-200 bg-transparent rounded-none"
            >
                <option value="null">Selectionnez le pays</option>
                @foreach($countries as $country)
                    <option value="{{ Str::upper($country) }}">{{ Str::upper($country) }}</option>
                    @if($loop->first)
                        <option disabled>───</option>
                    @endif
                @endforeach
            </select>
            @error('sender.country')
                <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
            @enderror
        </div>
        @guest
            <div class="col-span-1 md:col-span-2 flex flex-col my-3 p-3 bg-amber-50">
                <label
                    for="email"
                    class="text-xs text-purple-700">Email</label>
                <input
                    type="email"
                    wire:model="sender.email"
                    placeholder="Courriel" id="email"
                    class="w-full border-b bg-amber-50 outline-none h-8 placeholder:text-purple-300 @error('sender.email') border-red-500 @else border-purple-200 @enderror"
                />
                @error('sender.email')
                    <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                @enderror
            </div>
        @endguest
    </div>
    <div class="col-span-1 md:col-span-3 flex justify-end">
        <button
            class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase"
            type="submit">Suivant
        </button>
    </div>
</form>
