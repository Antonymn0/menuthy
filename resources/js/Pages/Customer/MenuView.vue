<template>
<div class="px-2">
   <div class="text-center">
       <p>
           <img :src="'/storage' + ff " alt="restaurant-logo">
       </p>

           
        <div class="nav text-center dropdown w-50 mx-auto">
            <h4 class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                Main Menu
            </h4>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" v-for="(menu) in this.menus" :key="menu.id">
                <li><a class="dropdown-item" :href="'/' + restaurant_name + '/menu/' + menu.id">{{menu.menu_name}}</a></li>
            </ul>
        </div>
   </div>
   
    <carousel :items-to-show="3">
           <slide v-for="menu in menus" :key="menu.id">
                <div class="img-fluid shadow panel rounded mt-2 fade-in" >   
                    <div class="pb-0">
                         <img :src="'/storage/' + menu.image" alt="food-image" class="img-fluid" v-if="menu.image">
                         <img src="/storage/placeholder.png" alt="food-image" class="img-fluid" v-else>

                    </div>          
                   
                   <p class="pt-3 mb-0 border-bottom">
                       {{menu.menu_name}}
                   </p>                   
                  
                </div>
             </slide>
            <template #addons>
                <div class="mx-2">
                    <navigation />
                </div>            
        </template>
    </carousel>
    <div class="py-4 mx-3  text-center">
        <p class="border-bottom p-2 d-inline menu-name">
            Menu name
        </p>
        
    </div>

    <div v-for="menu in menus" :key="menu.id">        
            <div class=" row menu-item p-2 m-2 shadow fade-in">
                <p class="description m-0">
                    {{menu.menu_name}}
                    {{menu.menu_name}}
                    {{menu.menu_name}}
                    {{menu.menu_name}}
                    {{menu.menu_name}}
                    {{menu.menu_name}}
                    {{menu.menu_name}}

                </p>
                <p class=" menu-image p-0 m-0">
                    <img :src="'/storage/' + menu.image" alt="menu-image" >
                </p>
            
                <p class="row price-time pb-0 mb-0 pt-1">
                    <span>
                    <i class="bi bi-tag pr-2 text-danger"></i>  spanrice:
                    </span>
                    <span>
                    <i class="bi bi-alarm pr-2 text-danger"></i> time
                    </span>
                </p>
            </div>
       
   </div>

</div>


</template>

<script>
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  name: 'App',

  props:['menus'],

  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data(){
      return{
          restaurant_name:'',
      }
  },
  mounted(){
         this.restaurant_name = window.authRestaurant.restaurant_name.replace(/\s+/g, '-').toLowerCase()
  }

};
</script>

<style scoped lang="scss"> 
@import "../../../sass/app.scss";  

    .panel{
        width:31.5vw;
        height: auto;
        margin:2px;
        }
       .panel  img{  
            min-height:50px;         
            width: 100%;
            max-width:100%;
            height:10vh;
            max-height:100%;
        }
        
        .description{
            float:left;
            width:79%;
            height:auto;
        }
        .menu-image{
            width:19%;
            height:auto;
            float:right;
        }
        .menu-item{
            border: 1px solid #eee;
            border-radius: 10px;
            img{
                width:100%;
                height:auto;
            }
        }
        .price-time span{
            width: 49%;
            text-align: center;
            font-size: 8pt;
            color: $primary-button;
        }
        .nav-link, .menu-name, .carousel__icon{
            color: $primary-button !important;
        }
    
</style>