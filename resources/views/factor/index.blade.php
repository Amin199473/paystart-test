<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="https://core.paystar.ir/api/pardakht/payment" method="POST">
                    <input type="hidden" name="token" value="{{ $response['token'] }}">
                    <div class="grid grid-cols-1 ">
                        <div class="card">
                            <div class="card-header">Factor Payment</div>
                            <div class="card-body">
                                <p>Order Number: {{ $response['order_id'] }}</p>
                                <p>Track ID: {{ $response['ref_num'] }}</p>
                                <p>amount: {{ $response['payment_amount'] }} Rial</p>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
