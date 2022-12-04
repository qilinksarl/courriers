<div>
    <h1 class="h1">Ma commande</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-12">
        <div class="bg-amber-50 p-6 rounded-md flex flex-col gap-2 justify-between shadow-lg shadow-gray-300/40">
            <div class="flex flex-col divide-y divide-amber-500">
                <div class="h4 mb-6">Mon récap' de commande</div>
                <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                    <div class="text-sm flex-auto text-amber-700">Désignation</div>
                    <div class="text-sm flex-none w-20 text-right text-amber-700">P.U.</div>
                    <div class="text-sm flex-none w-8 text-right text-amber-700">Qté</div>
                    <div class="text-sm flex-none w-24 text-right text-amber-700">Total</div>
                </div>
                @if(array_key_exists('color_print', $options))
                    <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                        <div class="flex-auto text-purple-700">Impression couleur {{ array_key_exists('recto_verso', $options) ? 'R°V°' : '' }}</div>
                        <div class="flex-none w-20 text-right">@price($options['color_print'])</div>
                        <div class="flex-none w-8 text-right">{{ collect($cart->getDocuments())->sum('number_of_pages') }}</div>
                        <div class="flex-none w-24 text-right">@price($options['color_print'] * collect($cart->getDocuments())->sum('number_of_pages'))</div>
                    </div>
                @else
                    <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                        <div class="flex-auto text-purple-700">Impression noir et blanc {{ array_key_exists('recto_verso', $options) ? 'R°V°' : '' }}</div>
                        <div class="flex-none w-20 text-right">@price($options['black_print'])</div>
                        <div class="flex-none w-8 text-right">{{ collect($cart->getDocuments())->sum('number_of_pages') }}</div>
                        <div class="flex-none w-24 text-right">@price($options['black_print'] * collect($cart->getDocuments())->sum('number_of_pages'))</div>
                    </div>
                @endif
                @if(array_key_exists('receipt', $options))
                    <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                        <div class="flex-auto text-purple-700">Affr. : {{ Str::lower($cart->getPostageType()->label()) }} avec AR</div>
                        <div class="flex-none w-20 text-right">@price($cart->getPostageType()->price() + $options['receipt'])</div>
                        <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                        <div class="flex-none w-24 text-right">@price(($cart->getPostageType()->price() + $options['receipt']) * $cart->getRecipients()->count())</div>
                    </div>
                @else
                    <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                        <div class="flex-auto text-purple-700">Affr. : {{ Str::lower($cart->getPostageType()->label()) }}</div>
                        <div class="flex-none w-20 text-right">@price($cart->getPostageType()->price())</div>
                        <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                        <div class="flex-none w-24 text-right">@price($options['receipt'] * $cart->getRecipients()->count())</div>
                    </div>
                @endif
                @foreach($options as $option => $price)
                    @if($option === 'sms_notification')
                        <div class="flex gap-3 items-center py-2 divide-x divide-amber-500">
                            <div class="flex-auto text-purple-700">Notification SMS</div>
                            <div class="flex-none w-20 text-right">@price($price)</div>
                            <div class="flex-none w-8 text-right">{{ $cart->getRecipients()->count() }}</div>
                            <div class="flex-none w-24 text-right">@price($price * $cart->getRecipients()->count())</div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="flex items-center border-t-4 border-amber-500 pt-3">
                <div class="flex-auto text-2xl font-bold text-purple-700">Montant total</div>
                <div class="flex-none w-32 text-right text-2xl font-bold text-purple-700">@price($amount)</div>
            </div>

        </div>
        <div class="bg-white p-6 shadow-lg shadow-gray-300/40 rounded-md flex flex-col gap-2">
            <div>

            </div>
            <div>
                <div class="border rounded-md p-3 gap-3 flex justify-between mt-3 @error('customerCertifiesDocumentsAreCompliant') border-red-500 @else border-gray-100 @enderror">
                    <div class="flex-auto">Je certifie avoir lu les <span wire:click.prevent="show" class="underline text-purple-700 cursor-pointer">conditions générales de vente</span></div>
                    <div class="flex-none w-24 flex justify-end">
                        <div class="flex items-center justify-end">
                            <label for="sms_notification" class="font-light cursor-pointer inline-flex items-center">
                                <input type="checkbox" id="sms_notification" wire:model.defer="customerCertifiesHavingReadTheGeneralConditionsOfSale" value="true" class="toggle-checkbox"/>
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
                    Payer ma commande
                </button>
            </div>
        </div>
    </div>
</div>
