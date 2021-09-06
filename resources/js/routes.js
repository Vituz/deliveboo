import { createRouter, createWebHistory } from "vue-router";
import ExampleComponent from "./components/ExampleComponent.vue";

const routes = [
    { path: '/', 
      name:'example-component', 
    component:ExampleComponent
    },
    { path: '/restaurant/:id',
      name: 'RestaurantDetails',
      props:true,
      /* component: require('./views/RestaurantDetails.vue').default */
      component: () => import('./views/RestaurantDetails.vue').default
      
    }
  ];
  const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
  });
  
  export default router;