<div
    x-data="setupEditor($wire.entangle('{{ $attributes->wire('model')->value }}').defer)"
    x-init="() => init($refs.editor)"
    wire:ignore
    {{ $attributes->whereDoesntStartWith('wire:model') }}
>
    <div class="bg-purple-100 divide divide-purple-100 flex justify-center">
        <div
            class="w-10 h-10 cursor-pointer flex items-center justify-center text-xs"
            x-on:click.prevent="Alpine.raw(editor).chain().focus().toggleBold().run()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 250 250" class="w-4 h-4"><g transform="matrix(17.857142857142858,0,0,17.857142857142858,0,0)"><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M3.5 1V6.5H6.75C8.26878 6.5 9.5 5.26878 9.5 3.75C9.5 2.23122 8.26878 1 6.75 1H3.5Z"></path><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M3.5 6.5V13H7.25C9.04493 13 10.5 11.5449 10.5 9.75C10.5 7.95507 9.04493 6.5 7.25 6.5H3.5Z"></path></g></svg>
        </div>
        <div
            class="w-10 h-10 cursor-pointer flex items-center justify-center text-xs"
            x-on:click.prevent="Alpine.raw(editor).chain().focus().toggleItalic().run()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 250 250" class="w-4 h-4"><g transform="matrix(17.857142857142858,0,0,17.857142857142858,0,0)"><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M4.72906 12.9044L9.27091 1.09558"></path><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M5.63745 1.09558H12.4502"></path><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M1.5498 12.9044H8.36257"></path></g></svg>
        </div>
        <div
            class="w-10 h-10 cursor-pointer flex items-center justify-center text-xs"
            x-on:click.prevent="Alpine.raw(editor).chain().focus().toggleUnderline().run()"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 250 250" class="w-4 h-4"><g transform="matrix(17.857142857142858,0,0,17.857142857142858,0,0)"><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M4 0.909485L4 7.17985C4 8.8367 5.34315 10.1799 7 10.1799V10.1799C8.65685 10.1799 10 8.8367 10 7.17985V0.909485"></path><path stroke="#4147D5" stroke-linecap="round" stroke-linejoin="round" d="M0.922424 13.0804C5.63123 13.3316 8.39319 13.2659 13.0776 13.0804"></path></g></svg>        </div>
    </div>
    <div x-ref="editor"></div>
</div>
