<div class="grid grid-cols-6 bg-white shadow-xl shadow-gray-300/40 rounded-md overflow-hidden">
    <div class="col-span-2 p-6 grid grid-cols-1 gap-1 border-r border-gray-200">
        <div
            class="cursor-pointer rounded-sm px-3 py-1.5 {{ (!$categoryId) ? 'bg-amber-500 text-white' : 'bg-purple-50 text-purple-700' }} hover:bg-purple-700 hover:text-white"
            wire:click.prevent="select(null)">
            Toutes les catégories
        </div>
        @foreach($templateCategories as $templateCategory)
            <div
                class="cursor-pointer rounded-sm px-3 py-1.5 {{ ($categoryId === $templateCategory->id) ? 'bg-amber-500 text-white' : 'bg-purple-50 text-purple-700' }} hover:bg-purple-700 hover:text-white"
                wire:click.prevent="select({{ $templateCategory->id }})">
                {{ $templateCategory->name }}
            </div>
        @endforeach
    </div>
    <div class="col-span-4 my-6 px-6">
        <div class="pb-6">
            <input
                wire:model.debounce="search"
                type="text"
                class="px-3 h-12 bg-gray-50 w-full outline-none rounded-md"
                placeholder="Filtrer votre recherche"/>
        </div>
        <div class="grid grid-cols-1 gap-1 divide-y divide-gray-100 max-h-[410px] overflow-x-scroll">
            @foreach($templates as $template)
                <a href="{{ route('frontend.template.edit', $template) }}" class="px-3 py-1.5 block hover:text-purple-700">
                    <div>{{ $template->name }}</div>
                    <div class="text-xs">{{ $template->content }}</div>
                </a>
            @endforeach
        </div>
    </div>
</div>
