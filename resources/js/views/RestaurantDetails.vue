<template>
  <div class=" single_rest container d-flex  align-items-center" v-if="restaurant" >
    <div class="details col-md-4  ">
        <img  :src="'http://127.0.0.1:8000/storage/' + restaurant.image" alt="">
        <h2>{{restaurant.name}}</h2>
        <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
    </div>
    <div class="dishes d-flex flex-wrap mt-2 col-md-8">
          <div class="dish pl-0 dish_card col-md-5 d-flex " v-for="dish in restaurant.dishes" :key="dish.id">
            <div class="col-md-6 p-2 justify-content-center ">
              <img :src="'http://127.0.0.1:8000/storage/' + dish.img" alt="">
              <div class="overflo overflow-auto">   
                <p >{{dish.description}}</p>
              </div>

             
            </div>
            <div class="col-md-6 align-items-center">
              <h4>{{dish.name}}</h4>
              <p>{{dish.price}} &euro;</p>
            <!-- <button class=" p-0 m-3  shop_btn " @click="addItemToCart(dish.name, dish.price)" type="button"><i class="fas fa-shopping-cart"></i></button> -->
               <div class=" p-0 mt-3  shop_btn d-flex justify-content-center align-items-center " @click="addItemToCart(dish.name, dish.price)" type="button"><i class="fas fa-shopping-cart"></i></div>
            </div>
            
          </div>
          
    </div>
    <section class="container content-section col-md-5">
            <h2 class="section-header">CART</h2>
            <div class="cart-row">
                <span class="cart-item cart-header cart-column">ITEM</span>
                <span class="cart-price cart-header cart-column">PRICE</span>
                <span class="cart-quantity cart-header cart-column">QUANTITY</span>
            </div>
            <div class="cart-items">
                <div class="cart-row" v-for="item in cart" :key="item.id">
                    <div class="cart-item cart-column">
                        
                        <span class="cart-item-title">{{item.item_name}}</span>
                    </div>
                    <span class="cart-price cart-column">{{item.item_price}}</span>
                    <div class="cart-quantity cart-column">
                       <button class="btn btn-warning" @click="removeQuantity(item)">-</button><div class="quantity">{{item.quantity}}</div> <button class="btn btn-success" @click="addQuanity(item)">+</button>
                        <button class="btn btn-danger" @click="removeCartItem(item)" type="button">REMOVE</button>
                    </div>
                </div>
                
            </div>
            <div class="cart-total">
                <strong class="cart-total-title">Total</strong>
                <span class="cart-total-price">€{{total}}</span>
            </div>
            <button class="btn btn-primary btn-purchase" @click="purchaseClicked()" type="button">PURCHASE</button>
        </section>
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
        this.total-=item.item_price;
       this.updateQuantity()
      },

      purchaseClicked() {
        if (this.cart.length !== 0) {
          alert('Thank you for your purchase')
          this.cart=[];
          this.total=0
          
        }else{
          alert('non hai aggiunto nulla al tuo ordine')
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