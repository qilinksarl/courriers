<form wire:submit.prevent="save" class="grid grid-cols-2 gap-6 bg-white p-6 rounded-md shadow-xl shadow-gray-300/40">
    <div>
        @if($errors->any())
            @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
            @endforeach
        @else
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A alias aperiam architecto assumenda consequatur deleniti exercitationem iusto odio.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
        @endif
    </div>
    <div><x-files wire:model="files" /></div>
    <div class="col-span-2 flex justify-end">
        <button class="bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Suivant</button>
    </div>
</form>
