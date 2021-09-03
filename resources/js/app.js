/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

const { default: axios } = require('axios');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: {
        categories : null,
        restaurants : null,
        filtered: [],
        clicked_categories: [],
        fill_restaurants: [],

    },

    methods:{

        removeCategory(arr, value){
            let index = arr.indexOf(value);
            if (index > -1) {
                arr.splice(index, 1);
            }
            return arr;
        },

        findRestaurant(arr, target){

            let checker = target.every(v => arr.includes(v))
            return checker;
        },

        filter_restaurants(index){
            
            if (!this.clicked_categories.includes(index)) {
                this.clicked_categories.push(index);
            } else {

                this.removeCategory(this.clicked_categories, index);
            }

            this.restaurants.forEach(rest => {
            
                let categories_id = [];

            rest.categories.forEach(cat=>{
                let cat_id = cat.id;
                categories_id.push(cat_id);
            });

            let prova =  this.findRestaurant(categories_id, this.clicked_categories);
            
            if (prova) {
                
                this.fill_restaurants.push(rest) 
            }
            
            });
        },

    },

    mounted(){
        axios.get('/api/categories').then(resp => {
            this.categories = resp.data.data;
        }).catch(e => {
            console.error('API non caricata' + e);
        });

        axios.get('/api/restaurants').then(resp => {
            this.restaurants = resp.data.data;
        }).catch(e => {
            console.error('API non caricata' + e);
        });
    }
});
