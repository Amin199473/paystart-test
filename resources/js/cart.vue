<template>
    <div class="h-screen bg-gray-100">
        <h1 class="mb-10 text-center text-2xl font-bold">Cart Items</h1>
        <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
            <div class="rounded-lg md:w-2/3">
                <div v-for="item in cartItems" :key="item.id"
                    class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                    <img :src="randomImage()" alt="product-image" class="w-full rounded-lg sm:w-40" />
                    <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                        <div class="mt-5 sm:mt-0">
                            <h2 class="text-lg font-bold text-gray-900">{{ item.name }}</h2>
                            <p class="mt-1 text-base text-gray-700">{{ item.price }}.00</p>
                        </div>
                        <div class="mt-4 flex justify-between sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                            <div class="flex items-center border-gray-100">
                                <span @click="decrementCart(item.rowId)"
                                    class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                    - </span>
                                <input readonly class="h-8 w-12 border bg-white text-center text-xs outline-none"
                                    type="number" :value="item.qty" min="1" />
                                <span @click="incrementCart(item.rowId)"
                                    class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50">
                                    + </span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <p class="text-sm">{{ item.subtotal }}</p>
                                <svg @click="removeItemFromCart(item.rowId)" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sub total -->
            <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                <div class="mb-2 flex justify-between">
                    <p class="text-gray-700">Total</p>
                    <p class="text-gray-700">{{ cartTotal }}</p>
                </div>
                <hr class="my-4" />
                <div class="flex justify-between">
                    <p class="text-lg font-bold">Total</p>
                    <div class="">
                        <p class="mb-1 text-lg font-bold">{{ cartTotal }}D</p>
                        <p class="text-sm text-gray-700">including VAT</p>
                    </div>
                </div>
                <a href="/checkout" class="btn btn-primary mt-6 w-full rounded-md  py-1.5 font-medium text-blue-50 hover:bg-blue-600">
                    Check out
                </a>
            </div>
        </div>
    </div>
</template>


<script>
import alerts from './alerts';
export default {
    created() {
        this.cartContent();
        this.getCartTotal();
    },
    data() {
        return {
            cartItems: [],
            cartTotal: null
        }
    },
    methods: {
        cartContent() {
            axios.
                get(`/cartContent`)
                .then((response) => {
                    this.cartItems = response.data.cartContent;
                }).catch((err) => {

                });
        },
        getCartTotal() {
            axios.
                get(`/getCartTotal`)
                .then((response) => {
                    this.cartTotal = response.data.cartTotal;
                }).catch((err) => {

                });
        },
        randomImage() {
            let random = Math.floor(Math.random() * 2 + 1);
            let url = `/images/${random}.jpg`;
            return url;
        },
        removeItemFromCart(rowId) {
            axios.
                get(`/removeItemFromCart/${rowId}`)
                .then((response) => {
                    alerts.successAlert(response.data.message);
                    setInterval(() => {
                        window.location.href = 'http://127.0.0.1:8000/cart';
                    }, 2000);
                    ;
                }).catch((err) => {

                });
        },
        incrementCart(rowId) {

            axios.
                get(`/incrementCart/${rowId}`)
                .then((response) => {
                    alerts.successAlert(response.data.message);
                    setInterval(() => {
                        window.location.href = 'http://127.0.0.1:8000/cart';
                    }, 2000);
                    ;
                }).catch((err) => {

                });
        },
        decrementCart(rowId) {
            axios.
                get(`/decrementCart/${rowId}`)
                .then((response) => {
                    alerts.successAlert(response.data.message);
                    setInterval(() => {
                        window.location.href = 'http://127.0.0.1:8000/cart';
                    }, 2000)
                }).catch((err) => {

                });
        }
    },
}
</script>


<style scoped>
@layer utilities {

    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
}
</style>
