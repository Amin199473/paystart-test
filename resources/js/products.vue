<template>
    <div class="container mx-auto my-4">

        <div class="grid grid-cols-1 gap-3 md:grid-cols-3">

            <div class="card" v-for="product in products" :key="product.id">
                <div class="card-header">{{ product.name }}</div>
                <img class="card-image" :src="randomImage()" />
                <div class="card-body">{{ product.description }}</div>
                <div class="bg-white card-footer">
                    <a href="#" class="btn btn-success btn-sm" @click="addToCard(product.id)">Add To Card</a>
                    <a href="#" class="btn btn-light btn-sm">Price:{{ product.price }}</a>
                </div>
            </div>
        </div>


    </div>
</template>


<script>
import alerts from './alerts';
export default {
    created() {
        this.getProducts()
    },
    data() {
        return {
            products: []
        }
    },
    methods: {
        getProducts() {
            axios.
                get(`/getProducts`)
                .then((response) => {
                    this.products = response.data.products;
                }).catch((err) => {

                });
        },
        randomImage() {
            let random = Math.floor(Math.random() * 2 + 1);
            let url = `/images/${random}.jpg`;
            return url;
        },
        addToCard(product_id) {
            axios.
                get(`/addToCart/${product_id}`)
                .then((response) => {
                    alerts.successAlert(response.data.message);
                    setInterval(() => {
                        window.location.href = "http://127.0.0.1:8000/"
                    }, 2000);
                }).catch((err) => {
                    alerts.warningAlert('محصول قبلا در سبد خرید ذخیره شده')
                    setInterval(() => {
                        window.location.href = "http://127.0.0.1:8000/"
                    }, 2000);
                });
        }
    },
}
</script>

<style scoped></style>
