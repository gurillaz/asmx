/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { App, plugin } from '@inertiajs/inertia-vue'
import Vue from 'vue'

import { InertiaProgress } from '@inertiajs/progress'

import vuetify from '@/plugins/vuetify'

Vue.use(plugin)

import moment from 'moment';

Vue.prototype.moment = moment;



const el = document.getElementById('app')

new Vue({
    vuetify,
    render: h => h(App, {
        props: {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: name => require(`./Pages/${name}`).default,
        },
    }),
}).$mount(el)


InertiaProgress.init()
