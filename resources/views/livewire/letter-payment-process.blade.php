<form wire:submit.prevent="save">
    @unless(!$offerSelected)
        @include('front-end._partials.sale-process.offer-section')
    @else
        <h1 class="h1">Ma commande</h1>
        <div class="col-span-2 bg-white p-6 shadow-lg shadow-gray-300/40 rounded-md mb-4 md:mb-12 grid grid-cols-1 gap-1">
            <div class="h4 mb-3">Je vérifie mes documents</div>
            <div class="flex items-center gap-2 px-4 text-sm">
                <div class="flex-auto">Nom du fichier</div>
                <div class="text-right flex-none w-24">Nbr page</div>
                <div class="text-right flex-none w-20">Taille</div>
                <div class="text-right flex-none w-16">Format</div>
                <div class="w-8"></div>
            </div>
            @foreach($documents as $document)
                <div class="flex items-center bg-amber-500 text-white rounded-lg shadow-gray-300/40 h-[40px] gap-2 px-4 divide-x divide-amber-300">
                    <div class="flex-auto font-semibold">{{ $document->readable_file_name }}</div>
                    <div class="text-right flex-none w-24">{{ $document->number_of_pages }} page{{ $document->number_of_pages > 1 ? 's' : '' }}</div>
                    <div class="text-right flex-none w-20">@size($document->size)</div>
                    <div class="text-right flex-none w-16">{{ $document->type->value }}</div>
                    <div class="w-8 flex items-center justify-end">
                        <span class="cursor-pointer" wire:click.prevent="show({{ $document->path }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" class="h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" d="M13.23 6.246c.166.207.258.476.258.754 0 .279-.092.547-.258.754C12.18 9.025 9.79 11.5 7 11.5c-2.79 0-5.18-2.475-6.23-3.746A1.208 1.208 0 0 1 .512 7c0-.278.092-.547.258-.754C1.82 4.975 4.21 2.5 7 2.5c2.79 0 5.18 2.475 6.23 3.746Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="grid grid-cols-1 md:grid-cols-[1fr,33%] gap-4 md:gap-12">
            <div class="bg-white p-6 shadow-lg shadow-gray-300/40 rounded-md">
                <div class="h4">Je choisis mes options</div>
                <div id="hipay-form">
                    <div id="hipay-hostedfields-form"></div>
                    <div class="multiuse-container">
                        <input type="checkbox" id="save-card" name="save-card">
                        <label for="save-card">Save card</label>
                    </div>
                    <button type="submit" id="hipay-submit-button" disabled="true">
                        PAY
                    </button>
                    <div id="hipay-error-message"></div>
                </div>
            </div>
            <div class="bg-amber-50 p-6 rounded-sm">
                1
            </div>
        </div>
        @include('front-end._partials.sale-process.payment-section')
    @endunless
</form>
