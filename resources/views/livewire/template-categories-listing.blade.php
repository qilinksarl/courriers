<section class="grid grid-cols-6 bg-white shadow-xl shadow-amber-500/40 rounded-md overflow-hidden">
    <div class="col-span-2 p-6 bg-purple-100">
        @foreach($templateCategories as $templateCategory)
            <div class="cursor-pointer" wire:click.prevent="select({{ $templateCategory->id }})">{{ $templateCategory->name }}</div>
        @endforeach
    </div>
    <div class="col-span-4 py-4">
        @foreach($templates as $template)
            <a href="{{ route('frontend.template.edit', $template) }}" class="px-6 py-2 block">
                <div>{{ $template->name }}</div>
                <div class="text-xs">{{ $template->content }}</div>
            </a>
        @endforeach
    </div>
</section>
