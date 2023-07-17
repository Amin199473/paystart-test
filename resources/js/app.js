import "./bootstrap";
import { createApp } from "vue";
import TheExample from './example.vue';

const app = createApp({});

app.component("the-example", TheExample);
app.mount("#app");
