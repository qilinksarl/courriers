<div class="grid grid-cols-1 md:grid-cols-6 bg-white shadow-xl shadow-gray-300/40 rounded-md overflow-hidden">
    <div class="hidden md:grid col-span-2 p-6 grid-cols-1 gap-1 border-r border-gray-200">
        <div
            class="cursor-pointer rounded-sm px-3 py-1.5 {{ (!$categoryId) ? 'bg-amber-500 text-white' : 'bg-purple-50 text-purple-700' }} hover:bg-purple-700 hover:text-white flex items-center"
            wire:click.prevent="select(null)">
            <span class="flex-auto">Toutes les catégories</span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="flex-none h-3 stroke-current"><path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M3.85.5 10 6.65a.48.48 0 0 1 0 .7L3.85 13.5"/></svg>
        </div>
        @foreach($templateCategories as $templateCategory)
            <div
                class="cursor-pointer rounded-sm px-3 py-1.5 {{ ($categoryId === $templateCategory->id) ? 'bg-amber-500 text-white' : 'bg-purple-50 text-purple-700' }} hover:bg-purple-700 hover:text-white flex items-center"
                wire:click.prevent="select({{ $templateCategory->id }})">
                <span class="flex-auto">{{ $templateCategory->name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="flex-none h-3 stroke-current"><path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M3.85.5 10 6.65a.48.48 0 0 1 0 .7L3.85 13.5"/></svg>
            </div>
        @endforeach
    </div>
    <div class="col-span-1 md:col-span-4 my-6 px-6">
        <div class="pb-6">
            <div class=" flex items-center bg-gray-50 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="flex-none h-6 ml-3 text-purple-700 stroke-current"><g fill="none" stroke-linecap="round" stroke-linejoin="round"><circle cx="5.92" cy="5.92" r="5.42"/><path d="M13.5 13.5 9.75 9.75"/></g></svg>
                <input
                    wire:model.debounce="search"
                    type="text"
                    class="px-3 h-12 bg-gray-50 outline-none rounded-md flex-auto"
                    placeholder="Filtrer votre recherche"/>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-1 divide-y divide-gray-100 max-h-[410px] overflow-x-scroll">
            @foreach($templates as $template)
                <a href="{{ route('frontend.template.edit', $template) }}" class="px-3 py-1.5 block hover:text-purple-700 flex items-center">
                    <span class="flex-auto">{{ $template->name }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="flex-none h-3 stroke-current"><path fill="none" stroke-linecap="round" stroke-linejoin="round" d="M3.85.5 10 6.65a.48.48 0 0 1 0 .7L3.85 13.5"/></svg>
                </a>
            @endforeach
        </div>
    </div>
</div>
