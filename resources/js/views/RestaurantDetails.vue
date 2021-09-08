<template>
  <div class=" single_rest container d-flex  align-items-center" v-if="restaurant" >
    <div class="details col-md-4  ">
        <img  :src="'http://127.0.0.1:8000/storage/' + restaurant.image" alt="">
        <h2>{{restaurant.name}}</h2>
        <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
    </div>
    <div class="dishes d-flex flex-wrap mt-2 col-md-8">
          <div class="dish pl-0 dish_card col-md-5 d-flex " v-for="dish in restaurant.dishes" :key="dish.id">
            <div class="col-md-6 p-0 justify-content-center align-items-center d-flex">
              <img :src="'http://127.0.0.1:8000/storage/' + dish.img" alt="">
            </div>
            <div class="col-md-8">
              <h4>{{dish.name}}</h4>
              <p>{{dish.description}}</p>
              <p>{{dish.price}} &euro;</p>
            </div>
          </div>
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