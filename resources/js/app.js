import "./bootstrap";
import "../css/app.css";
import "@protonemedia/laravel-splade/dist/style.css";

import { createApp } from "vue/dist/vue.esm-bundler.js";
import { renderSpladeApp, SpladePlugin } from "@protonemedia/laravel-splade";

const el = document.getElementById("app");

import './choices.scss';

import TomatoRepeater from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoRepeater.vue";
import TomatoColor from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoColor.vue";
import TomatoRich from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoRich.vue";
import TomatoTel from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoTel.vue";
import TomatoSelect from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoSelect.vue";
import TomatoArtisan from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoArtisan.vue";
import TomatoCode from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoCode.vue";
import TomatoDraggable from "../../vendor/tomatophp/tomato-admin/resources/js/components/TomatoDraggable.vue";

import store from "./store/store";

import ScheduleEvents from "../js/Components/ScheduleEvents.vue";
// import EventModal from "../js/Components/EventModal.vue";
import { createVfm } from 'vue-final-modal'
import 'vue-final-modal/style.css'

const vfm = createVfm();
createApp({
    render: renderSpladeApp({ el }),
    mounted() {
        document.querySelectorAll('input').forEach((input) => {
            input.attributes['autocomplete'] = 'off';
        });

        document.querySelectorAll('a').forEach((a) => {
            a.addEventListener('click', (e) => {
                a.classList.add('noClick');
                setTimeout(() => {
                    a.classList.remove('noClick');
                }, 5000)
            });
        });
    }
}).use(vfm).use(store)
    .use(SpladePlugin, {
        max_keep_alive: 10,
        transform_anchors: false,
        progress_bar: true,
    })
    .component("TomatoDraggable", TomatoDraggable)
    .component("TomatoRepeater", TomatoRepeater)
    .component("TomatoColor", TomatoColor)
    .component("TomatoTel", TomatoTel)
    .component("TomatoRich", TomatoRich)
    .component("TomatoSelect", TomatoSelect)
    .component("TomatoArtisan", TomatoArtisan)
    .component("TomatoCode", TomatoCode)
    .component("ScheduleEvents", ScheduleEvents)
    // .component("EventModal", EventModal)
    .mount(el);
