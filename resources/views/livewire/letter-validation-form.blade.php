<form wire:submit.prevent="save">
    @if($showPreview)
        <div class="absolute z-50 inset-0 p-6 flex justify-center items-center">
            <div class="bg-[#7f7f7f] p-6 md:p-12 shadow-xl w-full max-w-4xl relative overflow-hidden rounded-md">
                <div class="w-6 h-6 absolute top-4 right-4 cursor-pointer"
                     wire:click.prevent="hidden"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14" class="w-6 h-6 text-white">
                        <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m13.5.5-13 13M.5.5l13 13"/>
                        </g>
                    </svg>
                </div>
                <object data="{{ $previewUrl }}" class="w-full h-full relative aspect-[210/297]"></object>
            </div>
        </div>
    @endif
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
            @foreach($cart->getDocuments() as $index => $document)
                <div class="flex items-center bg-amber-500 text-white rounded-lg shadow-gray-300/40 h-[40px] gap-2 px-4 divide-x divide-amber-300">
                    <div class="flex-auto font-semibold">{{ $document->readable_file_name }}</div>
                    <div class="text-right flex-none w-24">{{ $document->number_of_pages }} page{{ $document->number_of_pages > 1 ? 's' : '' }}</div>
                    <div class="text-right flex-none w-20">@size($document->size)</div>
                    <div class="text-right flex-none w-16">{{ $document->type->label() }}</div>
                    <div class="w-8 flex items-center justify-end">
                        <span class="cursor-pointer" wire:click.prevent="show({{ $index }})">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" class="h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" d="M13.23 6.246c.166.207.258.476.258.754 0 .279-.092.547-.258.754C12.18 9.025 9.79 11.5 7 11.5c-2.79 0-5.18-2.475-6.23-3.746A1.208 1.208 0 0 1 .512 7c0-.278.092-.547.258-.754C1.82 4.975 4.21 2.5 7 2.5c2.79 0 5.18 2.475 6.23 3.746Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 9a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/></svg>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12">
            <div class="bg-white p-6 shadow-lg shadow-gray-300/40 rounded-md flex flex-col gap-2">
                <div class="h4">Je choisis mes options</div>
                <div class="h5 mb-2">Options d'impression</div>
                <div class="flex border border-gray-200 rounded-md p-3 gap-3">
                    <div class="flex-auto"><strong>Impression couleur</strong> <em class="text-gray-400 text-sm">(par page)</em></div>
                    <div class="flex-none w-18 flex justify-end">+ @price($pricing['color_print'] - $pricing['black_print'])</div>
                    <div class="flex-none w-24 flex justify-end">
                        <div class="flex items-center justify-end">
                            <label for="color" class="font-light cursor-pointer inline-flex items-center">
                                <input type="checkbox" id="color" wire:model="options" value="color_print" class="toggle-checkbox"/>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="flex border border-gray-200 rounded-md p-3 gap-3">
                    <div class="flex-auto"><strong>Impression recto / verso</strong></div>
                    <div class="flex-none w-24 flex justify-end">
                        <div class="flex items-center justify-end">
                            <label for="color" class="font-light cursor-pointer inline-flex items-center">
                                <input type="checkbox" id="color" wire:model="options" value="recto_verso" class="toggle-checkbox"/>
                            </label>
                        </div>
                    </div>
                </div>
                @if($cart->getPostageType() === \App\Enums\PostageType::REGISTERED_LETTER)
                    <div class="h5 my-2">Options de suivi</div>
                    <div class="flex border border-gray-200 rounded-md p-3 gap-3">
                        <div class="flex-auto"><strong>Avec accusé réception</strong> <em class="text-gray-400 text-sm">(par destinataire)</em></div>
                        <div class="flex-none w-18 flex justify-end">@price($pricing['receipt'])</div>
                        <div class="flex-none w-24 flex justify-end">
                            <div class="flex items-center justify-end">
                                <label for="receipt" class="font-light cursor-pointer inline-flex items-center">
                                    <input type="checkbox" id="receipt" wire:model="options" value="receipt" class="toggle-checkbox"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 rounded-md p-3 gap-3 flex flex-col">
                        <div class="flex gap-3 flex">
                            <div class="flex-auto"><strong>Avec notification SMS</strong> <em class="text-gray-400 text-sm">(par destinataire)</em></div>
                            <div class="flex-none w-18 flex justify-end">@price($pricing['sms_notification'])</div>
                            <div class="flex-none w-24 flex justify-end">
                                <div class="flex items-center justify-end">
                                    <label for="sms_notification" class="font-light cursor-pointer inline-flex items-center">
                                        <input type="checkbox" id="sms_notification" wire:model="options" value="sms_notification" class="toggle-checkbox"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @if(in_array('sms_notification', $options, true))
                            <div>
                                <div class="flex flex-col">
                                    <label for="phone_number" class="text-xs text-purple-700">Je renseigne mon téléphone</label>
                                    <input type="text" id="phone_number"  wire:model.defer="phone" class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('customerCertifiesDocumentsAreCompliant') border-red-500 @else border-purple-100 @enderror"/>
                                </div>
                                @error('phone')
                                    <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="bg-amber-50 p-6 rounded-md flex flex-col gap-2 justify-between shadow-lg shadow-gray-300/40">
                <div class="flex flex-col divide-y divide-amber-500">
                    <div class="h4 mb-6">Mon récap' de commande</div>
                    <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                        <div class="text-sm flex-auto text-amber-700">Désignation</div>
                        <div class="text-sm flex-none w-20 text-right text-amber-700">P.U.</div>
                        <div class="text-sm flex-none w-8 text-right text-amber-700">Qté</div>
                        <div class="text-sm flex-none w-24 text-right text-amber-700">Total</div>
                    </div>
                    @if(in_array('color_print', $this->options, true))
                        <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                            <div class="flex-auto text-purple-700">Impression couleur {{ in_array('recto_verso', $this->options, true) ? 'R°V°' : '' }}</div>
                            <div class="flex-none w-20 text-right">@price($pricing['color_print'])</div>
                            <div class="flex-none w-8 text-right">{{ collect($cart->getDocuments())->sum('number_of_pages') }}</div>
                            <div class="flex-none w-24 text-right">@price($pricing['color_print'] * collect($cart->getDocuments())->sum('number_of_pages'))</div>
                        </div>
                    @else
                        <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                            <div class="flex-auto text-purple-700">Impression noir et blanc {{ in_array('recto_verso', $this->options, true) ? 'R°V°' : '' }}</div>
                            <div class="flex-none w-20 text-right">@price($pricing['black_print'])</div>
                            <div class="flex-none w-8 text-right">{{ collect($cart->getDocuments())->sum('number_of_pages') }}</div>
                            <div class="flex-none w-24 text-right">@price($pricing['black_print'] * collect($cart->getDocuments())->sum('number_of_pages'))</div>
                        </div>
                    @endif
                    @if(in_array('receipt', $this->options, true))
                        <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                            <div class="flex-auto text-purple-700">Affr. : {{ Str::lower($cart->getPostageType()->label()) }} avec AR</div>
                            <div class="flex-none w-20 text-right">@price($cart->getPostageType()->price() + $pricing['receipt'])</div>
                            <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                            <div class="flex-none w-24 text-right">@price(($cart->getPostageType()->price() + $pricing['receipt']) * $cart->getRecipients()->count())</div>
                        </div>
                    @else
                        <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                            <div class="flex-auto text-purple-700">Affr. : {{ Str::lower($cart->getPostageType()->label()) }}</div>
                            <div class="flex-none w-20 text-right">@price($cart->getPostageType()->price())</div>
                            <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                            <div class="flex-none w-24 text-right">@price($cart->getPostageType()->price() * $cart->getRecipients()->count())</div>
                        </div>
                    @endif
                    @foreach($options as $option)
                        @if($option === 'sms_notification')
                            <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                                <div class="flex-auto text-purple-700">Notification SMS</div>
                                <div class="flex-none w-20 text-right">@price($pricing['sms_notification'])</div>
                                <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                                <div class="flex-none w-24 text-right">@price($pricing['sms_notification'] * $cart->getRecipients()->count())</div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="flex items-center border-t-4 border-amber-500 pt-3">
                    <div class="flex-auto text-2xl font-bold text-purple-700">Montant total</div>
                    <div class="flex-none w-32 text-right text-2xl font-bold text-purple-700">@price($amount)</div>
                </div>
                <div>
                    <div class="border rounded-md p-3 gap-3 flex justify-between mt-3 @error('customerCertifiesDocumentsAreCompliant') border-red-500 @else border-amber-200 @enderror">
                        @if($cart->getDocuments()->count() > 1)
                            <div class="flex-auto">Je certifie que mes documents sont conformes</div>
                        @else
                            <div class="flex-auto">Je certifie que mon document est conforme</div>
                        @endif
                        <div class="flex-none w-24 flex justify-end">
                            <div class="flex items-center justify-end">
                                <label for="sms_notification" class="font-light cursor-pointer inline-flex items-center">
                                    <input type="checkbox" id="sms_notification" wire:model.defer="customerCertifiesDocumentsAreCompliant" value="true" class="toggle-checkbox toggle-checkbox-amber"/>
                                </label>
                            </div>
                        </div>
                    </div>
                    @error('customerCertifiesDocumentsAreCompliant')
                        <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                    @endif
                </div>
                <div class="flex justify-end mt-6">
                    <button
                        class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase"
                    >
                        Régler ma commande
                    </button>
                </div>
            </div>
        </div>
    @endunless
</form>
