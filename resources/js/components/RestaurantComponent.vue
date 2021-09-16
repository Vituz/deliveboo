<template>
<router-link class="rest_card pic col-md-4 p-0 m-3 ma b d-flex" :to="{ name: 'RestaurantDetails', params:{ id: restaurant.id}}"> 
    <div class="rest_img d-flex col-sm-5 pl-2" >
        
            <img :src="'http://127.0.0.1:8000/storage/' + restaurant.image" class="align-self-center" alt="">
        
    </div>

    <div class="rest_info col-sm-7 text-left p-3">
        <h4>{{restaurant.name}}</h4>
        <h6>{{restaurant.address}}</h6>
        <span v-for="category in restaurant.categories" :key="category.id">
            -{{category.name}}
        </span>
    </div>
</router-link>
</template>

<script>
export default {
    name:"RestaurantComponent",
    props:{
        category:{
            type: Array,
        },
        restaurant:{
            type: Object,
            required:true
        }
    }
}

// mounted(){
//     axios.get('/api/restaurants/' + this.id).then(resp => {
//                 this.restaurant=resp.data.data[0];
//                 // console.log(this.restaurant);
//             }).catch(e => {
//                 console.error('API non caricata ' + e);
//             })
//     console.log(this.id);
// }
</script>

<style lang="scss" scoped>
.rest_card{
    text-decoration: none;
}

</style>
