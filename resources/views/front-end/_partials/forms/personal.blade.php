<div class="flex flex-col">
    <label
        for="{{ $person }}_{{ $index }}_first_name"
        class="text-xs text-purple-700"
    >Prénom</label>
    <input
        type="text"
        wire:model.defer="{{ $person }}.{{ $index }}.first_name"
        placeholder="prénom"
        id="{{ $person }}_{{ $index }}_first_name"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.first_name') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.' . $index . '.first_name')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="flex flex-col">
    <label
        for="{{ $person }}_{{ $index }}_last_name"
        class="text-xs text-purple-700"
    >Nom</label>
    <input
        type="text"
        wire:model.defer="{{ $person }}.{{ $index }}.last_name"
        placeholder="nom"
        id="{{ $person }}_{{ $index }}_last_name"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.last_name') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.' . $index . '.last_name')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="col-span-1 md:col-span-2 flex flex-col">
    <label
        for="{{ $person }}_{{ $index }}_address_line_4"
        class="text-xs text-purple-700"
    >Adresse</label>
    <input
        type="text"
        wire:model.defer="{{ $person }}.{{ $index }}.address_line_4"
        placeholder="numéro et libellé de la voie" id="address_line_4"
        id="{{ $person }}_{{ $index }}_address_line_4"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.address_line_4') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.' . $index . '.address_line_4')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="col-span-1 md:col-span-2 flex flex-col">
    <div class="text-xs text-purple-700">Complément d'adresse</div>
    <div class="flex flex-col w-full">
        <label
            class="block"
            for="{{ $person }}_{{ $index }}_address_line_2"
        >
            <input
                type="text"
                wire:model.defer="{{ $person }}.{{ $index }}.address_line_2"
                placeholder="service ou identité du destinataire"
                id="{{ $person }}_{{ $index }}_address_line_2"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.address_line_2') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.' . $index . '.address_line_3')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
        <label
            class="block"
            for="{{ $person }}_{{ $index }}_address_line_3"
        >
            <input
                type="text"
                wire:model.defer="{{ $person }}.{{ $index }}.address_line_3"
                placeholder="entrée, bâtiment, immeuble, résidence ou ZI"
                id="{{ $person }}_{{ $index }}_address_line_3"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.address_line_3') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.' . $index . '.address_line_4')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
        <label
            class="block"
            for="{{ $person }}_{{ $index }}_address_line_5"
        >
            <input
                type="text"
                wire:model.defer="{{ $person }}.{{ $index }}.address_line_5"
                placeholder="boite postale, mention légale ou commune géographique"
                id="{{ $person }}_{{ $index }}_address_line_5"
                class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.address_line_5') border-red-500 @else border-purple-100 @enderror"
            />
        </label>
        @error($person . '.' . $index . '.address_line_5')
            <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="flex flex-col">
    <label
        class="text-xs text-purple-700"
        for="{{ $person }}_{{ $index }}_postal_code"
    >Code postal</label>
    <input
        type="text"
        wire:model.defer="{{ $person }}.{{ $index }}.postal_code"
        placeholder="code postal"
        id="{{ $person }}_{{ $index }}_postal_code"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.postal_code') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.' . $index . '.postal_code')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
<div class="flex flex-col">
    <label
        for="{{ $person }}_{{ $index }}_city"
        class="text-xs text-purple-700"
    >Localité</label>
    <input
        type="text"
        wire:model.defer="{{ $person }}.{{ $index }}.city"
        placeholder="localité"
        id="{{ $person }}_{{ $index }}_city"
        class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error($person . '.' . $index . '.city') border-red-500 @else border-purple-100 @enderror"
    />
    @error($person . '.' . $index . '.city')
        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
    @enderror
</div>
