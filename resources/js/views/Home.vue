<template>
  <div class=" ">
    <div
      class="card_container d-flex flex-wrap justify-content-center text-center py-4"
    >
      <div
        class="category_card border border-primary rounded m-2"
        v-for="category in categories"
        :key="category.id"
        style="width: 10rem"
        @click="filterRestaurants(category.id)"
        :class="clicked_categories.includes(category.id) ? 'clicked' : ''"
      >
        <!-- <input type="hidden" name="pass_data">     -->
        <h2>{{ category.name }}</h2>
      </div>
    </div>

    <div class="card_container d-flex flex-wrap justify-content-center py-4">
      <restaurant-section
        class="restaurant_card"
        v-for="restaurant in fill_restaurants"
        :key="restaurant.id"
        :restaurant="restaurant"
        :categories="restaurant.categories"
        style="width: 20rem"
        @click="restaurantPage(restaurant.id)"
      ></restaurant-section>
    </div>

    <!-- Pagination buttons -->
    <nav
      v-if="fill_restaurants.length != 0"
      class="text-center d-flex justify-content-center pb-3"
    >
      <div class="first">
        <!-- First Page -->
        <button
          v-if="first_page != '/?page=' + current_page"
          @click="pagination(first_page)"
        >
          <i class="fas fa-chevron-left"></i><i class="fas fa-chevron-left"></i>
        </button>
        <!-- Prev Page -->
        <button v-if="prev_page != null" @click="pagination(prev_page)">
          <i class="fas fa-chevron-left"></i>
        </button>
      </div>

      <!-- Page Numbers -->
      <div class="number">
        <button
          :class="page == current_page ? 'active' : 'no_active'"
          v-for="page in total_page"
          :key="page"
          @click="singlePage(page)"
        >
          {{ page }}
        </button>
      </div>

      <div class="last">
        <!-- Next Page -->
        <button v-if="next_page != null" @click="pagination(next_page)">
          <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Last Page -->
        <button
          v-if="last_page != '/?page=' + current_page"
          @click="pagination(last_page)"
        >
          <i class="fas fa-chevron-right"></i
          ><i class="fas fa-chevron-right"></i>
        </button>
      </div>
    </nav>

    <router-view />
    <section class="contenuti_random py-4">
      <div class="container">
        <h2 class=" font-weight-bold mb-3">I tuoi piatti preferiti, consegnati da noi.</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 py-3">
            <div class="col card-custom">
              <img class="top_img" src="images/steak.jpg" alt="">
              <div class="details mt-2">
                <h3>Roadhouse</h3>
                <p>Ordina il tuo piatto preferito a casa tua da Roadhouse grazie alla consegna a domicilio di Delivebooh.</p>
              </div>
            </div>
            <div class="col card-custom"> <img class="top_img" src="images/images.jpg" alt="">
              <div class="details mt-2">
                <h3>Daruma Sushi</h3>
                <p>Ordina il tuo sushi preferito a casa tua da Daruma Sushi grazie alla consegna a domicilio di Delivebooh.</p>
              </div></div>
            <div class="col card-custom"> <img class="top_img" src="images/hamburger.jpg" alt="">
              <div class="details mt-2">
                <h3>Old Wild West</h3>
                <p>Il menù potrebbe temporaneamente subire alcune variazioni di ingredienti. Per maggiori informazioni contattare il punto vendita o consultare la sezione “lista ingredienti ed allergeni”</p>
              </div></div>
            <div class="col card-custom"> <img class="top_img" src="images/gelato.jpg" alt="">
              <div class="details mt-2">
                <h3>Grom</h3>
                <p>Tutti i prodotti sono senza glutine. Sono realizzati senza aggiunta di aromi, coloranti o emulsionanti e creati scegliendo solo il meglio della natura. Innamorati del nostro gelato e gusta anche i nostri biscotti, le creme spalmabili e il nostro cioccolato</p>
              </div>
            </div>
             <div class="col card-custom"> <img class="top_img" src="images/KFC.jpg" alt="">
              <div class="details mt-2">
                <h3>KFC</h3>
                <p></p>
              </div>
            </div>
             <div class="col card-custom"> <img class="top_img" src="images/ramen.jpg" alt="">
              <div class="details mt-2">
                <h3>Chashu Ramen</h3>
                <p>Prepariamo esclusivamente pasta fatta in casa con farina apposita per la creazione dello “Iekei Ramen” così da creare un connubio perfetto tra pasta e zuppa.</p>
              </div>
            </div>

        </div>
      </div>
    </section>
  </div>
  
</template>

<script>
export default {
  data() {
    return {
      categories: null,
      // restaurants: null,
      restaurant_path: "restaurants/",
      single_restaurant: null,
      filtered: [],
      clicked_categories: [],
      fill_restaurants: [],

      current_page: "",
      first_page: "",
      last_page: "",
      next_page: "",
      prev_page: "",

      total_page: [],
    };
  },
  methods: {
    restCall() {
      let clicked = this.clicked_categories;
      axios
        .get("/api/restaurants?categories=" + clicked)
        .then((resp) => {
          this.fill_restaurants = resp.data[0].data;
          this.current_page = resp.data[0].current_page;
          this.first_page = resp.data[0].first_page_url;
          this.last_page = resp.data[0].last_page_url;
          this.next_page = resp.data[0].next_page_url;
          this.prev_page = resp.data[0].prev_page_url;

          // numero di record per pagina
          let pagination = resp.data[0].per_page;

          this.total_page = [];
          // numero di record caricati
          let total_record = resp.data[0].total;

          let n_page = Math.ceil(total_record / pagination);

          for (let i = 0; i < n_page; i++) {
            this.total_page.push(i + 1);
          }
          // console.log(this.total_page);
        })
        .catch((e) => {
          console.error("API non caricata" + e);
        });
    },

    pagination(page) {
      let clicked = this.clicked_categories;
      axios
        .get("/api/restaurants" + page + "&categories=" + clicked)
        .then((resp) => {
          this.fill_restaurants = resp.data[0].data;
          this.current_page = resp.data[0].current_page;
          this.first_page = resp.data[0].first_page_url;
          this.last_page = resp.data[0].last_page_url;
          this.next_page = resp.data[0].next_page_url;
          this.prev_page = resp.data[0].prev_page_url;
        });
    },

    singlePage(number) {
      let clicked = this.clicked_categories;
      axios
        .get("/api/restaurants/?page=" + number + "&categories=" + clicked)
        .then((resp) => {
          this.fill_restaurants = resp.data[0].data;
          this.current_page = resp.data[0].current_page;
          this.first_page = resp.data[0].first_page_url;
          this.last_page = resp.data[0].last_page_url;
          this.next_page = resp.data[0].next_page_url;
          this.prev_page = resp.data[0].prev_page_url;
        });
    },

    removeCategory(arr, value) {
      let index = arr.indexOf(value);
      if (index > -1) {
        arr.splice(index, 1);
      }
      return arr;
    },

    findRestaurant(arr, target) {
      let checker = target.every((v) => arr.includes(v));
      return checker;
    },

    filterRestaurants(index) {
      if (!this.clicked_categories.includes(index)) {
        this.clicked_categories.push(index);
      } else {
        this.removeCategory(this.clicked_categories, index);
      }

      this.fill_restaurants = [];

      if (this.clicked_categories.length != 0) {
        this.restCall();
      }

    },

    restaurantPage(index) {
      console.log(index);
    },
  },

  mounted() {
    axios
      .get("/api/categories")
      .then((resp) => {
        this.categories = resp.data.data;
      })
      .catch((e) => {
        console.error("API non caricata" + e);
      });

  },
};
</script>

<style lang="scss" scoped>
nav {
  .first {
    text-align: end;

    button:first-child {
      border-radius: 1rem 0 0 1rem;
      padding: 0.2rem 0.8rem;
      height: 2rem;
      margin-right: 0.1rem;
    }
    button:last-child {
      padding: 0.2rem 0.8rem;
      height: 2rem;
    }
  }

  .number {
    text-align: center;
    > button {
      border: 1px solid cadetblue;
      height: 2rem;

      padding: 0.2rem 0.8rem;
    }
  }

  .last {
    text-align: start;
    button:last-child {
      border-radius: 0 1rem 1rem 0;
      height: 2rem;
      padding: 0.2rem 0.8rem;
      margin-left: 0.1rem;
    }
    button:first-child {
      height: 2rem;

      padding: 0.2rem 0.8rem;
    }
  }

  .first,
  .last {
    > button {
      background-color: transparent;
      border: 1px solid grey;
    }
  }

  .active {
    background-color: orange;
    color: black;
  }

  .no_active {
    background-color: transparent;
  }

  .first,
  .number,
  .last {
    width: auto;
  }
}
.contenuti_random{
      background-color: #ffeae4;
    padding: 50px 0 80px;
    .card-custom{

      .top_img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      }
    }
}
</style>