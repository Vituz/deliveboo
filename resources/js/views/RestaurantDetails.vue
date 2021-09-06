<template>
  <div class="" v-if="restaurant" >
      <h2>{{restaurant.name}}</h2>
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