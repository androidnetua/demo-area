import {Collapse} from "bootstrap";

import {createApp} from "vue";

import store from "./store";
import router from "./router";
import toaster from "./plugins/Toaster/toaster";
import moduleToasts from "./plugins/Toaster/moduleToasts";

import Index from "./components/Index";

window.axios = require('axios')
axios.defaults.baseURL = '/area3/api';

const app = createApp(Index)
app.use(store)

store.registerModule('toasts', moduleToasts)
app.use(toaster, {
    timeout: 7000,
})

store.dispatch('getAuth').then(() => {
    app.use(router)
    app.mount('#app')
})

