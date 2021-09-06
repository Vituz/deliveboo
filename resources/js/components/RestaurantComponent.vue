<template>
<router-link class="rest_card p-3 m-2 ma border border-primary rounded" :to="{ name: 'RestaurantDetails', params:{ id: restaurant.id}}"> 
   <div  >
            <h2>{{restaurant.name}}</h2>
            <h2>{{restaurant.email}}</h2>
            <h3 v-for="category in restaurant.categories" :key="category.id">
                {{category.name}}
            </h3>
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
