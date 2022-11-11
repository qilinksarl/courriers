@extends('layout.base')

@section('main')
    <div class="w-full max-w-xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <form
            method="post"
            class="grid grid-cols-1 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40"
        >
            @csrf
            <div class="h4 pb-4 md:pb-8 text-center">Connectez-vous à votre compte</div>
            <div class="flex flex-col">
                <label
                    for="email"
                    class="text-xs text-purple-700">Email</label>
                <input
                    type="text"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email"
                    id="email"
                    class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('email') border-red-500 @else border-purple-100 @enderror"
                />
                @error('email')
                    <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                @endif
            </div>
            <div class="flex flex-col">
                <label
                    for="password"
                    class="text-xs text-purple-700">Mot de passe</label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('password') border-red-500 @else border-purple-100 @enderror"
                />
                @error('password')
                    <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                @endif
            </div>
            <div class="flex flex-col-reverse md:flex-row justify-start md:justify-between gap-2 items-end md:items-center">
                <a href="{{ route('password.request') }}" class="underline text-purple-700 text-sm">Mot de passe oublié</a>
                <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Connexion</button>
            </div>
        </form>
    </div>
@endsection
