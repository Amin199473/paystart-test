<x-app-layout>
    <div id="app">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <cart></cart>
    </div>
</x-app-layout>
