<form wire:submit.prevent="save" class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40">
    <div class="flex flex-col">
        <label
            for="first_name"
            class="text-xs text-purple-700">Prénom</label>
        <input
            type="text"
            wire:model="first_name"
            placeholder="prénom"
            id="first_name"
            class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('first_name') border-red-500 @else border-purple-100 @enderror"
        />
        @error('first_name')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex flex-col">
        <label
            for="last_name"
            class="text-xs text-purple-700">Nom</label>
        <input
            type="text"
            wire:model="last_name"
            placeholder="nom"
            id="last_name"
            class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('last_name') border-red-500 @else border-purple-100 @enderror"
        />
        @error('last_name')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-span-1 md:col-span-2 flex flex-col">
        <label
            for="email"
            class="text-xs text-purple-700">Courriel</label>
        <input
            type="email"
            wire:model="email"
            placeholder="courriel"
            id="email"
            class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('email') border-red-500 @else border-purple-100 @enderror"
        />
        @error('email')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-span-1 md:col-span-2 flex flex-col">
        <label
            for="phone"
            class="text-xs text-purple-700">Téléphone</label>
        <input
            type="text"
            wire:model="phone"
            placeholder="téléphone"
            id="phone"
            class="w-full border-b outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-1 md:col-span-2 flex flex-col select">
        <label
            for="object"
            class="text-xs text-purple-700">Objet</label>
        <select
            wire:model="object"
            id="object"
            class="appearance-none w-full border-b outline-none h-8 placeholder:text-purple-200 bg-transparent rounded-none"
        >
            <option value="null">selectionner un objet</option>
            @foreach($objects as $object)
                <option value="{{ $object }}">{{ $object }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-span-1 md:col-span-2 flex flex-col gap-y-2">
        <label
            for="message"
            class="text-xs text-purple-700">Message</label>
        <textarea
            wire:model="message"
            id="message"
            class="w-full border outline-none placeholder:text-purple-200 min-h-[10rem] p-3"
            placeholder="votre message…"
        ></textarea>
    </div>
    <div class="col-span-1 md:col-span-2 flex justify-end">
        <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Envoyer</button>
    </div>
</form>
