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
                    primary: '#022F95',
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
        accountSession: null,
        session: [
            {
                id: 1,
                name: 'Leandro Roberto',
                username: 'zeldant',
                img: 'https://scontent-bog1-1.xx.fbcdn.net/v/t1.6435-9/132643020_3498895473511893_9122167535447528552_n.jpg?_nc_cat=108&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeE-vMxwOV-FQs1Bea8l69v_sXs3fZQ6ouixezd9lDqi6AwPN3G6PDSnp1PrXWvjCp0&_nc_ohc=9jN_5eIqGkcAX83oT5x&_nc_ht=scontent-bog1-1.xx&oh=4759ce7528d7194e141233a42b54b474&oe=618F6717',
                info: null,
                email: 'leandro@leandro.com',
                status: 1
            },
            {
                id: 2,
                name: 'Estiven León',
                username: 'estiven',
                img: 'https://scontent-bog1-1.xx.fbcdn.net/v/t39.30808-6/243028378_1964494693714832_330270903006006381_n.jpg?_nc_cat=111&ccb=1-5&_nc_sid=e3f864&_nc_eui2=AeFbU7XFUhRMJaJlNyFfPdZ9vhUxWcGTXCG-FTFZwZNcIZZFAKfdr-KbzRJ4nDnxmc0&_nc_ohc=6MWNkcEIVeUAX9SSoFE&_nc_ht=scontent-bog1-1.xx&oh=b1d74c1a1117f42799f934bf8d1729a0&oe=616D776D',
                info: null,
                email: 'estiven@estiven.com',
                status: 1
            },
            {
                id: 3,
                name: 'Carlos Hueso',
                username: 'hueso',
                img: 'https://scontent-bog1-1.xx.fbcdn.net/v/t1.18169-9/11947406_10208193656585992_8261194682884251902_n.jpg?_nc_cat=102&ccb=1-5&_nc_sid=09cbfe&_nc_eui2=AeFxwt2SQGFtFfsf_PKGhcxEvQlQcbg--L69CVBxuD74vmpY7x6NfmuZYwSf73dCsZmh5MZhiiDiUunns6xkWM6m&_nc_ohc=3XpAM3zWpk8AX94Mriz&_nc_ht=scontent-bog1-1.xx&oh=8ab6ff99a13c79e06fed96c9fa2b5b0e&oe=618CD87A',
                info: null,
                email: 'hueso@hueso.com',
                status: 1
            },
            // {
            //     id: 4,
            //     name: null,
            //     username: null,
            //     img: null,
            //     info: null,
            //     email: null,
            //     status: null
            // },
            // {
            //     id: 5,
            //     name: null,
            //     username: null,
            //     img: null,
            //     info: null,
            //     email: null,
            //     status: null
            // },
            // {
            //     id: 6,
            //     name: null,
            //     username: null,
            //     img: null,
            //     info: null,
            //     email: null,
            //     status: null
            // },
            // {
            //     id: 7,
            //     name: null,
            //     username: null,
            //     img: null,
            //     info: null,
            //     email: null,
            //     status: null
            // },
        ],
        links: [
            { id: 1, icon: "mdi-home-variant-outline", name: 'Inicio', ruta: "/" },
            { id: 2, icon: "mdi-account-group-outline", name: 'Personas', ruta: "/2" },
            { id: 3, icon: "mdi-chat-outline", name: 'Mensajes', ruta: "/3" },
            { id: 4, icon: "mdi-clock-outline", name: 'Recientes', ruta: "/4" },
            { id: 5, icon: "mdi-flag-outline", name: 'Fijados', ruta: "/5" },
            { id: 6, icon: "mdi-cog-outline", name: 'Configuración', ruta: "/6" },
        ],
        menuSelectAccount: false,
    }),
    created() {
        // alert()
        var account = JSON.parse(localStorage.getItem("usuarioSession"));
        if(account && account != null){
            this.accountSession = account;
        }
    },

    methods: {
        selectAccount(account){
            localStorage.setItem("usuarioSession", JSON.stringify(account));
            this.accountSession = account;
        }
    },
});
