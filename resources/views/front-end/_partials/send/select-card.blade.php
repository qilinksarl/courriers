<a href="{{ $card->url }}" class="bg-white shadow-xl shadow-amber-500/40 rounded-md p-6 grid grid-cols-1 gap-8">
    <div>{{ $card->picto }}</div>
    <div>{!! $card->content !!}</div>
    <div class="bg-purple-700 text-white h-12 px-3 rounded-sm flex items-center justify-center text-lg uppercase">{{ $card->label }}</div>
</a>
