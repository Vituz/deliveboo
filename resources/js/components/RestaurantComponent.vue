<template>
<!-- <router-link> -->
    <div class="card">
            <img class="card-img-top" data-src="holder.js/100x180/" alt="Card image cap">
            <div class="card-body">
                <h4 class="card-title">{{restaurant.name}}</h4>
                <p class="card-text">garcia</p>
            </div>
    </div>
<!-- </router-link> -->
</template>

<script>
export default {
    props:{
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

<style>

</style>