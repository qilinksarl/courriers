<form wire:submit.prevent="save" class="grid grid-cols-2 gap-6 bg-white p-16 rounded-md shadow-xl shadow-amber-500/40">
    <div class="col-span-2 flex flex-col">
        <label
            for="address_line_1"
            class="text-xs text-purple-700">Raison social</label>
        <input
            type="text"
            wire:model="recipient.address_line_1"
            placeholder="ou dénomination"
            id="address_line_1"
            class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex flex-col">
        <label
            for="address_line_2"
            class="text-xs text-purple-700">Adresse</label>
        <input
            type="text"
            wire:model="recipient.address_line_2"
            placeholder="numéro et libellé de la voie" id="address_line_2"
            class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex flex-col">
        <div class="text-xs text-purple-700">Complément d'adresse</div>
        <div class="flex flex-col w-full">
            <label class="block">
                <input
                    type="text"
                    wire:model="recipient.address_line_3"
                    placeholder="service ou identité du destinataire"
                    class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
                />
            </label>
            <label class="block">
                <input
                    type="text"
                    wire:model="recipient.address_line_4"
                    placeholder="entrée, bâtiment, immeuble, résidence ou ZI"
                    class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
                />
            </label>
            <label class="block">
                <input
                    type="text"
                    wire:model="recipient.address_line_5"
                    placeholder="boite postale, mention légale ou commune géographique"
                    class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
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
            wire:model="recipient.postal_code"
            placeholder="code postal"
            id="postal_code"
            class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="flex flex-col">
        <label
            for="city"
            class="text-xs text-purple-700">Localité</label>
        <input
            type="text"
            wire:model="recipient.city"
            placeholder="localité" id="city"
            class="w-full border-b border-purple-100 outline-none h-8 placeholder:text-purple-200"
        />
    </div>
    <div class="col-span-2 flex justify-end">
        <button class="bg-purple-700 border-b-4  border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Suivant</button>
    </div>
</form>
