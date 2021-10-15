require('./bootstrap');

import '@mdi/font/css/materialdesignicons.css' // Ensure you are using css-loader
import Vue from 'vue'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'


Vue.use(Vuetify)
Vue.use(VueRouter)




Vue.component('home-component', require('./components/pages/homeComponent.vue').default);


let home_component = {
    template: `<home-component></home-component>`
}
const router = new VueRouter({
    routes: [
        {
            path: '/',
            name: 'Busqueda Hotel Booking',
            component: home_component,
        }
    ],
    mode: 'history'
});

const app = new Vue({
    router,
    vuetify: new Vuetify({
        icons: {
            iconfont: 'mdi',
        },
        theme: {
            themes: {
                light: {
                    primary: '#EB8635',
                    secondary: '#363636',
                    accent: '#e3ecf5',
                    error: '#FF5252',
                    info: '#1963ad',
                    success: '#4CAF50',
                    warning: '#FFC107',
                }
            }
        },
    }),
    el: '#app',


    data: () => ({
        links: [
            {id: 1, name:'Dashboard', ruta:"/publicar"}, 
            {id: 2, name:'Messages', ruta:"/publicar"},
            {id: 3, name:'Profile', ruta:"/publicar"},
            {id: 4, name:'Updates', ruta:"/publicar"},
          ],
    }),

    methods: {

    },
});
