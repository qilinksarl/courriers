<div class="grid grid-cols-3">
    <label class="bg-white rounded-sm p-6 my-6 shadow-lg shadow-amber-500/40">
        <div>
            <input type="checkbox" name="promotion" wire:model="promotion" value="true">
        </div>
    </label>
    <div class="bg-white rounded-md p-6 shadow-xl shadow-amber-500/40 relarive z-10">
        @if($promotionMessage)
            <div>Vous devez sélectionner une offre</div>
        @endif
        <div>
            <div>lorem</div>
            <div>lorem</div>
            <div>lorem</div>
            <div>lorem</div>
        </div>
        <div class="flex justify-center">
            <div
                class="cursor-pointer bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase"
                wire:click.prevent="saveOffer"
            >
                Poursuivre
            </div>
        </div>
    </div>
    <label class="bg-amber-50 rounded-sm p-6 my-12">
        <div>
            <input type="checkbox" name="noPromotion" wire:model="noPromotion" value="true">
        </div>
    </label>
</div>
