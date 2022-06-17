<a href="{{ $card->url }}" class="bg-white shadow-xl rounded-md p-6 grid grid-cols-1 gap-8">
    <div>{{ $card->picto }}</div>
    <div>{!! $card->content !!}</div>
    <div class="bg-green-700 text-white h-12 px-3 rounded-sm flex items-center justify-center text-lg uppercase">{{ $card->label }}</div>
</a>
