<div>
    <div class="mx-auto max-w-2xl{{ $category ? ' grid grid-cols-[4rem,1fr] gap-6' : '' }}">
        @if($category)
            <button wire:click.prevent="getBack()" class="text-purple-700 w-[56px] h-[56px] flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="w-8 h-8">
                    <g>
                        <polyline points="3.5 1.5 0.5 4.5 3.5 7.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></polyline>
                        <path d="M.5,4.5h9a4,4,0,0,1,0,8h-5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
            </button>
        @endif
        <div class="w-full text-center grid grid-cols-[5rem,1fr] h-16 bg-white rounded-sm border-b-4 border-gray-300 overflow-hidden">
            <div class="justify-center flex items-center bg-purple-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0.125 0.125 13.75 13.75" stroke-width="0.75" class="w-8 h-8">
                    <g>
                        <circle cx="9" cy="5" r="4.5" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></circle>
                        <path d="M10.25,3.67a1.5,1.5,0,0,0-2.31-.23" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></path>
                        <line x1="0.5" y1="13.5" x2="6.08" y2="8.43" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></line>
                    </g>
                </svg>
            </div>
            <label for="words" class="block w-full">
                <input type="text" wire:model.debounce="words" id="words"
                       class="placeholder:text-purple-200 w-full text-lg px-6 h-16 outline-none"
                       placeholder="Rechercher dans notre base de templates…"
                />
            </label>
        </div>
    </div>
    <article class="flex flex-col gap-8 items-center w-full max-w-7xl mx-auto py-12 md:py-16 px-0">
        <h2 class="text-4xl">{{ $words ? 'Vous recherchez : ' . $words : $category ?? 'Nos catégories' }}</h2>
        @unless($letters)
            <div class="grid gap-4 md:gap-8 grid-cols-1 md:grid-cols-3 w-full">
                @foreach($categories->chunk($categories->count() / 3) as $chunk)
                    <ul class="flex flex-col gap-4 md:gap-2">
                        @foreach($chunk as $item)
                            <li>
                                <span wire:click.prevent="getCategory({{ $item->id }})"
                                      class="cursor-pointer text-lg hover:text-amber-700 inline w-full">
                                    {{ $item->name }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-1 w-full">
                @foreach($letters->chunk(ceil(($letters->count() / 2))) as $chunk)
                    <ul class="flex flex-col divide-y divide-purple-100">
                        @foreach($chunk as $letter)
                            <li class="flex items-center">
                                <a href="{{ route('frontend.template.edit', $letter) }}"
                                      class="cursor-pointer text-lg hover:text-amber-700 inline w-full flex justify-between items-center pt-2.5 pb-2 leading-tight gap-2">
                                    <span class="pl-1">{{ $letter->name }}</span> <span class="flex-none text-sm bg-purple-700 text-white h-8 px-2 rounded-sm border-b-4 border-purple-100 inline-flex items-center justify-center gap-3">Utiliser cette lettre</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>
        @endunless
    </article>
</div>
