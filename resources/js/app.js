require("./bootstrap");
window.Vue = require("vue");

// Import modules...
import { createApp, h } from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin,
} from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import moment from "moment";
import VueQrcode from "@chenfengyuan/vue-qrcode";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";
import $ from "jquery";
import BootstrapVue3 from "bootstrap-vue-3";
import "bootstrap/dist/css/bootstrap.css";
import "bootstrap-vue-3/dist/bootstrap-vue-3.css";
// in your entrypoint


const el = document.getElementById("app");


createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(VueSweetalert2)
    .use(BootstrapVue3)
    .component(VueQrcode.name, VueQrcode)
    .mount(el);

InertiaProgress.init({ color: "#4B5563" });
