<article class="w-full max-w-7xl mx-auto py-12 md:py-16 px-6 md:px-9 grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-9">
    <div class="bg-purple-700 text-white p-8 rounded-md shadow-xl shadow-gray-300/40 self-start flex flex-col gap-3">
        <h2 class="text-2xl text-center text-white">Importer vos documents</h2>
        <p class="pb-2">Envoyez un <strong>document pdf, .doc ou autre</strong> dont vous disposez déjà. <strong>C’est simple, rapide et efficace !</strong></p>
        <a href="{{ route('frontend.letter.import') }}"
           class="w-full md:w-auto bg-white border-b-4 border-purple-800 text-purple-700 h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            J'importe un fichier
        </a>
    </div>
    <div class="bg-white p-8 rounded-md shadow-xl shadow-gray-300/40 self-start flex flex-col gap-3">
        <h2 class="text-2xl text-center">Rédiger un courrier</h2>
        <p class="pb-2">Vous êtes maître de la situation, à <strong>vous d’écrire ce qui vous convient</strong>, sans sortir de chez vous !</p>
        <a href="{{ route('frontend.letter.edit') }}"
           class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            Je rédige
        </a>
    </div>
    <div class="bg-white p-8 rounded-md shadow-xl shadow-gray-300/40 self-start flex flex-col gap-3">
        <h2 class="text-2xl text-center">Utiliser un modèle</h2>
        <p class="pb-2">Pour vous simplifier la tâche, nous mettons à votre disposition <strong>plus de 700 modèles de documents</strong> prêt à l’emploi !</p>
        <a href="{{ route('frontend.letter.brands-models') }}"
           class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            Je choisis un modèle
        </a>
    </div>
</article>
