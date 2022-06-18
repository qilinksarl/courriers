<form wire:submit.prevent="save" class="grid grid-cols-2 gap-6 bg-white p-16 rounded-md shadow-xl shadow-amber-500/40">
    <div class="flex flex-col">
        <label
            for="first_name"
            class="text-xs text-purple-700">Prénom</label>
        <input
            type="text"
            wire:model="sender.first_name"
            placeholder="prénom"
            id="first_name"
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
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
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex flex-col">
        <label
            for="email"
            class="text-xs text-purple-700">Email</label>
        <input
            type="email"
            wire:model="sender.email"
            placeholder="numéro et libellé de la voie" id="email"
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex flex-col">
        <label
            for="address_line_2"
            class="text-xs text-purple-700">Adresse</label>
        <input
            type="text"
            wire:model="sender.address_line_2"
            placeholder="numéro et libellé de la voie" id="address_line_2"
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex flex-col">
        <div class="text-xs text-purple-700">Complément d'adresse</div>
        <div class="flex flex-col w-full">
            <label class="block">
                <input
                    type="text"
                    wire:model="sender.address_line_3"
                    placeholder="service ou identité du destinataire"
                    class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
                />
            </label>
            <label class="block">
                <input
                    type="text"
                    wire:model="sender.address_line_4"
                    placeholder="entrée, bâtiment, immeuble, résidence ou ZI"
                    class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
                />
            </label>
            <label class="block">
                <input
                    type="text"
                    wire:model="sender.address_line_5"
                    placeholder="boite postale, mention légale ou commune géographique"
                    class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
                />
            </label>
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
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="flex flex-col">
        <label
            for="city"
            class="text-xs text-purple-700">Localité</label>
        <input
            type="text"
            wire:model="sender.city"
            placeholder="localité" id="city"
            class="w-full border-b border-grey-50 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex justify-end">
        <button class="bg-purple-700 border-b-4  border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Suivant</button>
    </div>
</form>
