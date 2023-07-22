<x-app-layout>
    <div id="app">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="container mx-auto">
            <div class="grid grid-cols-2 items-start gap-4">
                <div>
                    <h1 class="text-xl mx-4">Checkout Form</h1>

                    <x-input-error :messages="Session::get('message')" class="mt-2" />

                    <form method="POST" action="{{ route('orderDone') }}" class="w-full  mx-auto py-10">
                        @csrf
                        @method('POST')
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm mb-1" for="name">Your Name</label>
                                <input class="form-input" placeholder="Your Name" id="name" value="{{ Auth::user()->name }}">
                            </div>

                            <div>
                                <label class="block text-sm mb-1" for="email">Your email</label>
                                <input class="form-input" type="email" placeholder="Your email" id="email" value="{{ Auth::user()->email }}">
                            </div>

                            <div>
                                <label class="block text-sm mb-1" for="mobile">Your mobile</label>
                                <input class="form-input" placeholder="Your mobile" id="mobile" name="mobile">
                            </div>

                            <div>
                                <label class="block text-sm mb-1" for="address">Your address</label>
                                <input class="form-input" placeholder="Your address" id="address" name="address">
                            </div>

                            <div>
                                <label class="block text-sm mb-1" for="city">Your city</label>
                                <input class="form-input" placeholder="Your city" id="city" name="city">
                            </div>
                            <div>
                                <label class="block text-sm mb-1" for="province">Your province</label>
                                <input class="form-input" placeholder="Your province" id="province" name="province">
                            </div>
                            <div>
                                <label class="block text-sm mb-1" for="country">Your country</label>
                                <input class="form-input" placeholder="Your country" id="country" name="country">
                            </div>
                            <div>
                                <label class="block text-sm mb-1" for="zipcode">Your zipcode</label>
                                <input class="form-input" placeholder="Your zipcode" id="zipcode" name="zipcode">
                            </div>


                            <div>
                                <label class="block text-sm mb-1" for="credit_card">Your credit card</label>
                                <input class="form-input" placeholder="Your credit card" id="credit_card" name="credit_card">
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary w-full mt-4" value="Payment" />
                    </form>
                </div>
                <div>
                    <cart></cart>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
