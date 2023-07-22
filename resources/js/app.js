import "./bootstrap";
import { createApp } from "vue";
import products from './products.vue';
import cart from './cart.vue';

const app = createApp({});

app.component("products", products);
app.component("cart", cart);
app.mount("#app");
