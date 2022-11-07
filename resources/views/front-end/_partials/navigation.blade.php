<div class="w-full max-w-7xl mx-auto h-20 flex items-center justify-between gap-8 px-6 md:px-9">
    <div><a href="{{ route('frontend.homepage') }}">LOGO</a></div>
    @if(!in_array(request()->segment(2), ['rediger', 'importer', 'models', 'destinataire', 'expediteur']) || !request()->segments())
        <nav class="hidden md:flex gap-8">
            <a href="{{ route('frontend.homepage') }}">Accueil</a>
            @access(\App\Enums\AppType::TERMINATION_LETTER)
                <a href="{{ route('frontend.letter.brands-models') }}">Marques & modèles</a>
            @else
                <a href="{{ route('frontend.letter.brands-models') }}">Modèles de lettre</a>
                <a href="{{ route('frontend.staticpage', ['slug' => 'prix']) }}">Prix</a>
            @endaccess
            <a href="{{ route('frontend.contact') }}">Contact</a>
            <a href="{{ route('frontend.staticpage', ['slug' => 'faq']) }}">FAQ</a>
        </nav>
        <div class="hidden md:block">
            <a href="" class="bg-purple-700 text-white h-10 px-3 rounded-sm border-b-4 border-purple-100 flex items-center justify-center gap-3">
                Mon compte
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0.125 0.125 13.75 13.75" stroke-width="0.75" class="h-6 w-"><g><circle cx="7" cy="5.5" r="2.5" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></circle><path d="M2.73,11.9a5,5,0,0,1,8.54,0" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></path><circle cx="7" cy="7" r="6.5" fill="none" stroke="#FFFFFF" stroke-linecap="round" stroke-linejoin="round"></circle></g></svg>
            </a>
        </div>
    @endif
</div>
