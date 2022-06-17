<div class="max-w-5xl mx-auto h-20 flex items-center justify-between gap-8">
    <div>LOGO</div>
    @if(!in_array(request()->segment(2), ['rediger', 'importer', 'recipient', 'sender']) || !request()->segments())
        <nav class="flex gap-8">
            <a href="{{ route('frontend.homepage') }}">Accuel</a>
            <a href="{{ route('frontend.staticpage', ['slug' => 'envoyer']) }}">Envoyer</a>
            <a href="{{ route('frontend.contact') }}">Contact</a>
            <a href="{{ route('frontend.staticpage', ['slug' => 'faq']) }}">FAQ</a>
            <a href="{{ route('frontend.staticpage', ['slug' => 'prix']) }}">Prix</a>
        </nav>
        <div>
            <a href="">Mon compte</a>
        </div>
    @endif
</div>
