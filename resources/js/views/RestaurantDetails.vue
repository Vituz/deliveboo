<template>
  <div class=" single_rest container d-flex justify-content-around align-items-center" v-if="restaurant" >
    <div class="details ">
        <h2>{{restaurant.name}}</h2>
        <img  :src="'http://127.0.0.1:8000/storage/' + restaurant.image" alt="">
        <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
    </div>
    <div class="dishes text-right">
          <h3>Piatti da asporto:</h3>
          <div class="dish" v-for="dish in restaurant.dishes" :key="dish.id">{{dish.name}}</div>
    </div>
  </div>
</template>

<script>
export default {
    props: ['id'],
    data(){
        return {
            restaurant: null,
          }
    },

    mounted(){
      
        axios.get('/api/restaurants/' + this.id).then(resp => {
              this.restaurant=resp.data.data[0]; 
              console.log(resp.data.data[0].name);
            }).catch(e => {
                console.error('API non caricata' + e);
            })
    }
}
</script>

<style>

</style>