@extends('layout.base')

@section('main')
    <div class="w-full max-w-xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <form
            action="{{ route('logout') }}"
            method="post"
            class="grid grid-cols-1 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40"
        >
            @csrf
            <div class="flex justify-end">
                <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Connexion</button>
            </div>
        </form>
    </div>
@endsection
