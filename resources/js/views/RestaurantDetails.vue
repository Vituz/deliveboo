<template>
  <div class=" single_rest container" v-if="restaurant" >
    <div class="details d-flex flex-column col-md-12">
        <img class="align-self-center" :src="'http://127.0.0.1:8000/storage/' + restaurant.image" alt="">
        <div class="single_rest_info pt-5">
          <h2 class="mx-auto">{{restaurant.name}}</h2>
          <!-- <hr> -->
          <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
        </div>
    </div>
    <div class="d-flex flex-wrap">
      <div class="dishes d-flex flex-wrap mt-2 col-md-8">
            <div class="dish pl-0 dish_card d-flex " v-for="dish in restaurant.dishes" :key="dish.id">
              <div class="wrapper col-md-4 p-2 ">
                  <img :src="'http://127.0.0.1:8000/storage/' + dish.img" alt="">
              </div>
              <div class="right_card d-flex flex-column justify-content-center col-md-8 p-2">
                <h4 class="m-0">{{dish.name}}</h4>
                <p class="m-0">{{dish.description}}</p>
                <p class="m-0">Ingredienti: {{dish.ingredients}}</p>
                <p class="m-0">Prezzo: {{dish.price}} &euro;</p>
                <div class="mt-3  shop_btn d-flex justify-content-center align-items-center " @click="addItemToCart(dish.id, dish.name, dish.price)" type="button"><i class="fas fa-shopping-cart"></i></div>
                </div>
            </div>                
        </div>

        <div class="d-flex flex-column content-section col-md-4 cart p-3">
              <h2 class="section-header">Il tuo ordine</h2>
              <div class="d-flex flex-column cart-items border border-success p-2 mb-2">
                  <div class="cart-row" v-for="item in cart" :key="item.id">
                      <div class="cart-item cart-column mb-2">
                          <span class="cart-item-title text-uppercase">{{item.item_name}}</span>
                          <span class="cart-price cart-column text-align-right">{{item.item_price}} €</span>
                      </div>
                      <div class="cart-quantity cart-column d-flex align-items-center mb-2">
                        <button class="btn btn-warning btn-sm mr-3" @click="removeQuantity(item)">-</button>
                        <div class="quantity mr-3 bg-light py-1 px-2">{{item.quantity}}</div>
                        <button class="btn btn-success btn-sm mr-3" @click="addQuanity(item)">+</button>
                        <button class="btn btn-danger" @click="removeCartItem(item)" type="button"><i class="fas fa-trash-alt"></i></button>
                      </div>
                        <hr>
                  </div>
                  
                  <div class="cart-total align-self-end">
                      <strong class="cart-total-title text-success">Totale</strong>
                      <span class="cart-total-price">€ {{total}}</span>
                  </div>
              </div>
              <button class="btn btn-success btn-purchase text-uppercase" @click="purchaseClicked()" type="button"> <strong>Ordina</strong> </button>
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
            cart:[],
            total:0
          }
    },
    methods:{


      removeItemOnce(arr, value) {
        var index = arr.indexOf(value);
        if (index > -1) {
          arr.splice(index, 1);
        }
        return arr;
      },
      removeCartItem(item) {
        let arr = this.cart;
        this.removeItemOnce(arr, item)
        this.total-=item.item_price * item.quantity
       this.updateQuantity()
      },

      purchaseClicked() {
        if (this.cart.length !== 0) {
          alert('Grazie per aver effettuato l\'ordine')
          this.cart=[];
          this.total=0
          
        }else{
          alert('Non hai aggiunto nulla al tuo ordine')
        }
      },
     
      addItemToCart(id,title, price) {
        
        
       for (var i = 0; i < this.cart.length; i++) {
        let cart_item=this.cart[i];
        if (cart_item.item_id == id) {
            this.addQuanity(cart_item)
            return
        }
    }
            let item={
              item_id : "",
              item_name : "",
              item_price :"",
              quantity:1
    
            };
            item.item_id = id;
            item.item_name = title;
            item.item_price = price;
            this.cart.unshift(item);
            this.total+=item.item_price;
            this.updateQuantity() 
       
        
      },
      addQuanity(item){
        item.quantity++;
        this.total+=item.item_price;
        this.updateQuantity()
        /* console.log(item.item_price); */
        /* return quantity++ */
      },
      removeQuantity(item){
        if (item.quantity!=1) {
          item.quantity--;
          this.total-=item.item_price;
         this.updateQuantity()
        }else{
           this.removeCartItem(item);
        }
      },
      updateQuantity(){
        return this.total= Math.round(this.total * 100) / 100
      }
      
    },

    created(){
      
        axios.get('/api/restaurants/' + this.id).then(resp => {
              this.restaurant=resp.data.data[0]; 
              //console.log(resp.data.data[0].name);
            }).catch(e => {
                console.error('API non caricata' + e);
            })
    },
    mounted(){
          var quantityInputs = document.getElementsByClassName('cart-quantity-input')
          //console.log(quantityInputs);
          for (var i = 0; i < quantityInputs.length; i++) {
            var input = quantityInputs[i]
            input.addEventListener('change', this.quantityChanged())
          }
    }
}
</script>

<style>

</style>