<template>
    <div>
        <div class="card_container container d-flex flex-wrap justify-content-center text-center">
            <div class="category_card m-2" v-for="category in categories" :key="category.id"  @click="filterRestaurants(category.id)" :class="clicked_categories.includes(category.id)? 'clicked' : ''">
                <p class="mb-0">{{category.name}}</p>
                <!-- <img :src="'http://127.0.0.1:8000/storage/' + category.img" alt=""> -->
                <!-- <h3 class="d-block">{{category.users.length}}</h3>  -->  
            </div>
        </div>

        <div class="card_container d-flex flex-wrap justify-content-center">
        <restaurant-section class="restaurant_card" v-for="restaurant in fill_restaurants" :key="restaurant.id" :restaurant="restaurant" :categories="restaurant.categories"  style="width: 20rem;" @click="restaurantPage(restaurant.id)"></restaurant-section>
        </div>

    <router-view />
    </div>
</template>

<script>
    export default {
        data(){
            return{

                categories : null,
                restaurants : null,
                restaurant_path:'restaurants/',
                single_restaurant:null,
                filtered: [],
                clicked_categories: [],
                fill_restaurants: [],
            }
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

        filterRestaurants(index){
            if (!this.clicked_categories.includes(index)) {
                this.clicked_categories.push(index);
            } else {

                this.removeCategory(this.clicked_categories, index);
            }

            this.fill_restaurants = [];
            this.restaurants.forEach(rest => {
            
                let categories_id = [];

                rest.categories.forEach(cat=>{
                    let cat_id = cat.id;
                    categories_id.push(cat_id);
                });

                let compare_cat =  this.findRestaurant(categories_id, this.clicked_categories);

                    if (compare_cat && !this.fill_restaurants.includes(rest)) {
                        this.fill_restaurants.push(rest); 
                    } 
            
            });
        },

        restaurantPage(index){
            console.log(index);
        }
    },

    mounted(){
        axios.get('/api/categories').then(resp => {
            this.categories = resp.data.data;
        }).catch(e => {
            console.error('API non caricata' + e);
        });

        axios.get('/api/restaurants').then(resp => {
            this.restaurants = resp.data.data;
            // console.log(this.restaurants);
        }).catch(e => {
            console.error('API non caricata' + e);
        });
    }
    }
    
</script>
