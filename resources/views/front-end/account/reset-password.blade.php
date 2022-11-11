@extends('layout.base')

@section('main')
    <div class="w-full max-w-xl mx-auto py-12 md:py-16 px-6 md:px-9">
        <form
            action="{{ route('password.update') }}"
            method="post"
            class="grid grid-cols-1 gap-6 bg-white p-8 md:p-16 rounded-md shadow-xl shadow-gray-300/40"
        >
            @csrf
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
                @enderror
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
                @enderror
            </div>
            <div class="flex flex-col">
                <label
                    for="password_confirmation"
                    class="text-xs text-purple-700">Mot de passe</label>
                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    class="w-full border-b outline-none h-8 placeholder:text-purple-200 @error('password_confirmation') border-red-500 @else border-purple-100 @enderror"
                />
                @error('password_confirmation')
                    <div class="text-xs text-red-500 pt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="flex flex-col-reverse md:flex-row justify-start md:justify-end gap-2 items-end md:items-center">
                <button class="w-full md:w-auto bg-purple-700 border-b-4 border-purple-100 text-white h-12 px-6 rounded-sm flex items-center justify-center text-lg uppercase" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
@endsection
