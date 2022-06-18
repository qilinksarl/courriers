<form wire:submit.prevent="save">
    @if($offerSelected)
        @include('front-end._partials.sale-process.payment-section')
    @else
        @include('front-end._partials.sale-process.offer-section')
    @endif
</form>
