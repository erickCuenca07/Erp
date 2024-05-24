import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import Vue3Toastify from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import jQuery from 'jquery';
import VueSelect  from "vue-select";
import "vue-select/dist/vue-select.css";
//PLUGINS
import Permissions from './Plugins/Permissions';
import Alerts from './Plugins/SweetAlertAndToastify.js';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(Permissions)
            .use(Alerts)
            .use(Vue3Toastify,{autoClose:3000})
            .use(VueSweetalert2)
            .use(jQuery)
            .component("v-select", VueSelect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
