<x-app-layout>
    <div id="app">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>
        <products></products>
    </div>
</x-app-layout>
