<form wire:submit.prevent="save" class="grid grid-cols-1 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40">
    <div class="flex flex-col">
        <label
            for="email"
            class="text-xs text-purple-700">Email de souscription</label>
        <input
            type="email"
            wire:model="email"
            placeholder="email"
            id="email"
            class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('email') border-red-500 @else border-purple-100 @enderror"
        />
        @error('email')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
    <div class="flex justify-end">
        <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Résilier mon abonnement</button>
    </div>
</form>
