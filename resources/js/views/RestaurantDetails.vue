<template>
  <div class=" single_rest container " v-if="restaurant" >
    <div class="details col-md-12">
        <img  :src="'http://127.0.0.1:8000/storage/' + restaurant.image" alt="">
        <h2>{{restaurant.name}}</h2>
        <h4><strong>Indirizzo:</strong> {{restaurant.address}}</h4>
    </div>
    <div class="d-flex">
      <div class="dishes d-flex flex-wrap mt-0 col-md-8">
            <div class="dish pl-0 dish_card  d-flex flex-start" v-for="dish in restaurant.dishes" :key="dish.id">
              <div class="wrapper col-md-4 pl-0">
                  <img :src="'http://127.0.0.1:8000/storage/' + dish.img" alt="">
              </div>
              <div class="pt-2 col-md-8 right_card ">
                <h4>{{dish.name}}</h4>
                <p >{{dish.description}}</p>
                <p>{{dish.price}} &euro;</p>
              <!-- <button class=" p-0 m-3  shop_btn " @click="addItemToCart(dish.name, dish.price)" type="button"><i class="fas fa-shopping-cart"></i></button> -->
                <div class="mt-3  shop_btn d-flex justify-content-center align-items-center " @click="addItemToCart(dish.user_id, dish.id, dish.name, dish.price)" type="button"><i class="fas fa-shopping-cart"></i></div>
              </div>
              
            </div>
      </div>

      <section class="content-section col-md-4 cart p-3">
        <div class="">

              <h2 class="section-header">Il tuo ordine</h2>
              <div class="cart-items">
                  <div class="cart-row" v-for="item in cart" :key="item.id">
                      <div class="cart-item cart-column">

                          <span class="cart-item-title">{{item.item_name}}</span>
                      </div>
                      <span class="cart-price cart-column">{{item.item_price}} €</span>
                      <div class="cart-quantity cart-column">
                        <button class="btn btn-warning" @click="removeQuantity(item)">-</button><div class="quantity">{{item.quantity}}</div> <button class="btn btn-success" @click="addQuanity(item)">+</button>
                          <button class="btn btn-danger" @click="removeCartItem(item)" type="button">Rimuovi</button>
                      </div>
                  </div>
                  
              </div>
              <div class="cart-total">
                  <strong class="cart-total-title">Totale</strong>
                  <span class="cart-total-price">€ {{total}}</span>
              </div>
              <button class="btn btn-primary btn-purchase" @click="purchaseClicked()" type="button">Ordina</button>
        </div>
      </section>
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
            total:0,
            myStorage:window.localStorage,
            contenutoArchiviato:JSON.parse(localStorage.getItem("cartStored"))
          }
    },
    methods:{

      

      addItemToCart(restaurant, id,title, price) {
        
          
          console.log(this.contenutoArchiviato);
           
            if(this.contenutoArchiviato.length != 0 && this.contenutoArchiviato[0].user_id != restaurant) {
            alert('concludi l\'ordine dal ristorante precedente o svuota il carrello prima di procedere a un nuovo ordine');
              
              
            }else {
          
            for (var i = 0; i < this.cart.length; i++) {
            let cart_item=this.cart[i];
            if (cart_item.item_id == id) {
              alert('questo piatto è già presente nel carrello');               
              return
            }
            }         
                let item={
                  item_id : "",
                  user_id:"",
                  item_name : "",
                  item_price :"",
                  quantity:1
        
                };
               item.item_id = id;
               item.user_id=restaurant;
                item.item_name = title;
                item.item_price = price;
                this.cart.unshift(item);
                localStorage.setItem("cartStored", JSON.stringify(this.cart));              
                this.total+=item.item_price;
                this.updateQuantity() 
          
            } 
            
          
      },

      removeItemOnce(arr, value) {
        var index = arr.indexOf(value);
        if (index > -1) {
          arr.splice(index, 1);
          
        }
        return arr;
      },
      removeCartItem(item) {
        
        this.removeItemOnce(this.cart, item)
        this.total-=item.item_price * item.quantity;
        let cartStored = JSON.parse(localStorage.getItem("cartStored"));
        this.removeCartItemStored(item,cartStored)
        localStorage.setItem("cartStored", JSON.stringify(cartStored));
       this.updateQuantity()
      },
       removeCartItemStored(item,cartStored) {
        
        for(var i =0; i< cartStored.length; i++) {
          let el=cartStored[i];
          if(el.item_id == item.item_id){
            let index = cartStored.indexOf(el);
              if (index > -1) {
                cartStored.splice(index, 1);
              }
              if (cartStored.lenght == 0) {
               
                this.contenutoArchiviato = null;
                return
              }
              return cartStored;
          }
                
        }
       
      },

        addQuanity(item){
          item.quantity++;
          this.total+=item.item_price;
          this.updateQuantity();

           let cartStored = JSON.parse(localStorage.getItem("cartStored"));
                cartStored.forEach(element => {
                  if(element.item_id == item.item_id){
                    element.quantity++
                    
                    localStorage.setItem("cartStored", JSON.stringify(cartStored));
                   
                  }
                });
         
        },
        removeQuantity(item){
          //console.log(item);
          if (item.quantity!=1) {

            //rimuovo dal carrello
            item.quantity--;
            this.total-=item.item_price;
           this.updateQuantity();
          //rimuovo dallo storage
          let cartStored = JSON.parse(localStorage.getItem("cartStored"));
                cartStored.forEach(element => {
                  if(element.item_id == item.item_id){
                    element.quantity--
                   
                    localStorage.setItem("cartStored", JSON.stringify(cartStored));
                    
                  }
                });

          }else{
             this.removeCartItem(item,this.cart);
              let cartStored = JSON.parse(localStorage.getItem("cartStored"));
              this.removeCartItemStored(item,cartStored)
              localStorage.setItem("cartStored", JSON.stringify(cartStored));
              console.log(this.myStorage);
              
          }
        },
      purchaseClicked() {
        if (this.cart.length !== 0) {
          alert('Grazie per aver effettuato l\'ordine')
          this.cart=[];
          this.total=0
          localStorage.clear()
          this.contenutoArchiviato = [];
        }else{
          alert('Non hai aggiunto nulla al tuo ordine')
        }
      },
     
    
      updateQuantity(){
        this.total= Math.round(this.total * 100) / 100;
        localStorage.setItem("sumStored", JSON.stringify(this.total));
        //console.log(this.myStorage);
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
      if(this.contenutoArchiviato == null){
        this.contenutoArchiviato = [];
      }
      const sommaArchiviata = JSON.parse(localStorage.getItem("sumStored"));
      
         if (this.contenutoArchiviato) {
           this.contenutoArchiviato.forEach(elem => {
             this.cart.unshift(elem);
           });

           this.total = sommaArchiviata
         }
    }
}
</script>

<style>

</style>