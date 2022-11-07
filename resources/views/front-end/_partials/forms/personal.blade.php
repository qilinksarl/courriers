<div class="flex flex-col">
    <label
        for="first_name"
        class="text-xs text-purple-700">Prénom</label>
    <input
        type="text"
        wire:model="sender.first_name"
        placeholder="prénom"
        id="first_name"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.first_name') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.first_name')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="flex flex-col">
    <label
        for="last_name"
        class="text-xs text-purple-700">Nom</label>
    <input
        type="text"
        wire:model="sender.last_name"
        placeholder="nom"
        id="last_name"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.last_name') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.last_name')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="col-span-1 md:col-span-2 flex flex-col">
    <label
        for="address_line_4"
        class="text-xs text-purple-700">Adresse</label>
    <input
        type="text"
        wire:model="sender.address_line_4"
        placeholder="numéro et libellé de la voie" id="address_line_4"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.address_line_4') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.address_line_4')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="col-span-1 md:col-span-2 flex flex-col">
    <div class="text-xs text-purple-700">Complément d'adresse</div>
    <div class="flex flex-col w-full">
        <label class="block">
            <input
                type="text"
                wire:model="sender.address_line_2"
                placeholder="service ou identité du destinataire"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.address_line_2') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.address_line_3')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
        <label class="block">
            <input
                type="text"
                wire:model="sender.address_line_3"
                placeholder="entrée, bâtiment, immeuble, résidence ou ZI"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.address_line_3') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.address_line_4')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
        <label class="block">
            <input
                type="text"
                wire:model="sender.address_line_5"
                placeholder="boite postale, mention légale ou commune géographique"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.address_line_5') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.address_line_5')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="flex flex-col">
    <label
        for="postal_code"
        class="text-xs text-purple-700">Code postal</label>
    <input
        type="text"
        wire:model="sender.postal_code"
        placeholder="code postal"
        id="postal_code"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.postal_code') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.postal_code')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="flex flex-col">
    <label
        for="city"
        class="text-xs text-purple-700">Localité</label>
    <input
        type="text"
        wire:model="sender.city"
        placeholder="localité" id="city"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.city') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.city')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
