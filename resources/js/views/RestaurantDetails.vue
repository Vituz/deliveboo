<template>
  <div class="d-flex justify-content-around align-items-center" v-if="restaurant" >
    <div class="details">
        <h2>{{restaurant.name}}</h2>
        <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
        <img width="200" :src="restaurant.image" alt="">
    </div>
    <div class="dishes">
          <h3>Piatti d'asporto:</h3>
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