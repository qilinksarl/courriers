<form wire:submit.prevent="save" class="grid grid-cols-2 gap-6 bg-white p-6 rounded-md shadow-xl shadow-amber-500/40">
    <x-editor
        wire:model="model.text"
        wire:poll.10000ms="autosave"
        class="col-span-2 outline-none border border-purple-100"
    ></x-editor>
    <div class="col-span-2"><x-files wire:model="files" name="pièces jointes" /></div>
    <div class="col-span-2 flex justify-end">
        <button class="bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Suivant</button>
    </div>
</form>
