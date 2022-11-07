<article class="grid grid-cols-1 md:grid-cols-3 gap-3 md:gap-9">
    <div class="self-stretch bg-white p-8 rounded-md shadow-xl shadow-gray-300/40 flex flex-col justify-between gap-3">
        <h2 class="text-2xl text-center">Lettre simple</h2>
        <p class="pb-2">Envoyez un courrier en lettre simple en ligne. <strong>Le plus économique !</strong></p>
        <button
            wire:click.prevent="setSimpleLetter"
            class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            Lettre simple
        </button>
    </div>
    <div class="self-stretch bg-white p-8 rounded-md shadow-xl shadow-gray-300/40 flex flex-col justify-between gap-3">
        <h2 class="text-2xl text-center">Lettre suivie</h2>
        <p class="pb-2">Solution idéale si vous avez besoin de <strong>suivre le courrier</strong> envoyé.</p>
        <button
            wire:click.prevent="setFollowedLetter"
            class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            Lettre suivie
        </button>
    </div>
    <div class="self-stretch bg-purple-700 text-white p-8 rounded-md shadow-xl shadow-gray-300/40 flex flex-col justify-between gap-3">
        <h2 class="text-2xl text-center text-white">Lettre recommandée</h2>
        <p class="pb-2">Si vous avez un <strong>courrier important</strong> à envoyer et vous assurer qu’il a bien été <strong>remis en main propre</strong>.</p>
        <button
            wire:click.prevent="setRegisteredLetter"
            class="w-full md:w-auto bg-white border-b-4 border-purple-800 text-purple-700 h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase">
            Lettre recommandée
        </button>
    </div>
</article>
