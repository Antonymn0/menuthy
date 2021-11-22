<template>
<div class="px-3 card shadow my-2 ml-1 mobile-menu mx-auto">
   <div class="text-center pt-2">
       <p>
           <img src="/storage/hotel_logo_placeholder.png" alt="restaurant-logo" style="width:10vw; height:10vw;">
       </p>           
        <div class=" text-center dropdown col-xs-6 mx-auto">
            <div class="arrow-left p-0 m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="bi bi-justify-left"></i>
            </div>
            <h4 class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">
                Main Menu
            </h4>
            <div v-if="this.menus.length">
               <ul class="dropdown-menu" aria-labelledby="navbarDropdown" v-for="(menu) in this.menus" :key="menu.id">
                    <li> <a class="dropdown-item" :href="'/' + restaurant_name + '/menu/' + menu.id"> {{menu.menu_name}} </a> </li>
                </ul>
            </div>
            <ul v-else>
                <li class="text-muted"> No items available</li>
            </ul>
            
        </div>
   </div>

   <div v-if="this.menus.length"> 
        <carousel :items-to-show="3">
            <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id">
                    <div class="img-fluid  panel rounded mt-2 fade-in shadow-right shadow-left" >   
                        <div class="pb-0 shadow">
                            <a href="#" @click="[fetchMenuItems(sub_menu.id), updateMenuName('sub_menu.sub_menu_name')]"> 
                                <img :src="'/storage/' + sub_menu.image" alt="food-image" class="img-fluid" v-if="sub_menu.image">
                                <img src="/storage/placeholder.png" alt="food-image" class="img-fluid" v-else>
                            </a>                 

                        </div>          
                    
                    <p class="pt-3 mb-0 ">
                        {{sub_menu.sub_menu_name}}
                    </p>                   
                    
                    </div>
                </slide>
                <template #addons>
                    <div class="mx-2">
                        <navigation />
                    </div>            
            </template>
        </carousel>
        
        <div v-if="this.menu_items.length " v-show="this.show_menus_list">
            <div class="py-4 mx-3  text-center">
                <p class="border-bottom p-2 d-inline menu-name">
                    {{menu_name}}
                </p>        
            </div> 
            <div v-for="menu_item in menu_items" :key="menu_item.id">  
                <div class="open-full-screen" @click="showMenuItem(menu_item)">                        
                    <div class=" row menu-item p-2 m-2 shadow fade-in open-full-screen">
                        <p class="description m-0">
                            {{menu_item.description}} 
                        </p>
                        <p class=" menu-image p-0 m-0">
                            <img :src="'/storage/' + menu_item.image" alt="menu-image" >
                        </p>
                    
                        <p class="row price-time pb-0 mb-0 pt-1">
                            <span>
                            <i class="bi bi-tag pr-2 text-danger text-left " style="font-size:10pt"></i>   ${{menu_item.price}}
                            </span>
                            <span> 
                                <a href="#" class="btn btn-sm btn-danger alert-danger"> Order</a>
                            </span>
                            <span>
                            <i class="bi bi-alarm pr-2 text-danger text-right"></i> {{menu_item.preparation_time}} mins
                            </span>
                        </p>
                    </div>      
                </div>      
            </div>
        </div>
        <div v-else> <p class="text-muted text-center pt-5">No items to show!</p></div>

        <!-- single menu item for full dissplay -->
         <div class="item-full-screen row" v-show="this.show_single_menu_item" >                        
                <div class=" row  p-2 m-2 shadow fade-in ">
                    <div class="row m-0">
                      <span class="arrow-left" style="top:0; padding:0; width:10%"  @click="showMenuItem([])"> <i class="bi bi-arrow-left"></i></span> 
                       <span class="order-image mx-auto rounded shadow " style="width:70%; height:150px"><img :src="'/storage/' + single_menu_item.image" alt="menu-image" class="rounded w-100"> </span>  
                    </div>
                    <p class="text-center p-2">
                        {{single_menu_item.menu_item_name}}
                    </p>
                    <p class="px-2">
                        <span class="badge bg-primary " v-if="single_menu_item.is_signiture">Signiture</span>
                        <span class="badge bg-warning text-dark m-1" v-if="single_menu_item.is_halal">Halal</span>
                       <span class="badge bg-success m-1" v-if="single_menu_item.is_veg">Veg</span>
                        <span class="badge bg-danger" v-if="single_menu_item.is_new">New</span>
                    </p>
                    <p class="row price-time pb-0 mb-0 px-2">
                        <span>
                        <i class="bi bi-tag pr-2 text-danger text-left " style="font-size:10pt"></i>   ${{single_menu_item.price}}
                        </span>
                       
                        <span>
                        <i class="bi bi-alarm pr-2 text-danger text-right"></i> {{single_menu_item.preparation_time}} mins
                        </span>
                    </p>
                    <p class="  p-2">
                        {{single_menu_item.description}}
                    </p>
                     <p class="text-cenetr"> 
                            <a href="#" class="btn  btn-danger alert-danger col-xs-8 mx-auto" @click="placeOrder(single_menu_item)"> Order now</a>
                        </p>
                </div>      
            </div>

        <div>
          <!--menu pop up Modal -->
        <div class="modal fade mx-auto text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg mx-5" style="align-items: flex-end; bottom:8rem;" >
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title col-xs-6 mx-auto" id="exampleModalLabel">Main Menu</h5>
            </div>
            <div class="modal-body">
                <ul v-for="menu in menus" :key="menu.id" class="list-unstyled px-5">
                    <li class="border-bottom"> <a class="dropdown-item" :href="'/' + restaurant_name + '/menu/' + menu.id"> {{menu.menu_name}} </a> </li>
                </ul>
            </div>
            
            </div>
        </div>
        </div>
        </div>
    </div>
     <div v-else> <p class="text-muted text-center pt-5">This restaurant has no items to show!</p></div>
</div>


</template>

<script>
// If you are using PurgeCSS, make sure to whitelist the carousel CSS classes
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  name: 'App',

  props:['menus', 'subMenus', 'menuItems'],

  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data(){
      return{
          restaurant_name:'',
          menu_items:'',
          menu_name:'',
          single_menu_item:'',
          show_menus_list:true,
          show_sinle_menu_item:false,
          is_take_away:false,
      }
  },
  methods:{
      updateMenuName(menu_name){
            this.menu_name= menu_name;
      },
      showMenuItem(menu_item){
          this.single_menu_item = menu_item;
          this.show_menus_list = !this.show_menus_list;
          this.show_single_menu_item = !this.show_single_menu_item;
      },
      fetchMenuItems( sub_menu_id){
          console.log('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id);
           axios.get('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id)
            .then( response => {
            if( response.status = 200){
                // console.log(response.data.data);
                this.menu_items = response.data.data;
                console.log(this.menu_items);
                } 
            })
            .catch( error => {
                this.$swal('Failed to fecth!');                
                console.log(error.response.data.errors);                    
            });
      },
      placeOrder(menu_item){
          var form_data = new FormData();
            form_data.append('menu_item_name', menu_item.item_name);
            form_data.append('is_take_away', this.is_take_away);
            form_data.append('order_number', Date.now());
            form_data.append('menu_item_id', menu_item.id);
            form_data.append('preparation_time', menu_item.preparation_time);
            form_data.append('price', menu_item.price);
            form_data.append('status', 'recieved');

          axios.post('/api/order', form_data)
            .then( response => {
            if( response.status = 200){
                console.log(response.data.data);
                

                } 
            })
            .catch( error => {
                this.$swal('Error, Order failed!');                
                console.log(error.response.data.errors);                    
            });
      },
  },
  mounted(){
        this.menu_items = this.menuItems;
         this.restaurant_name = window.authRestaurant.restaurant_name.replace(/\s+/g, '-').toLowerCase()
  }

};
</script>

<style scoped lang="scss"> 
@import "../../../sass/app.scss";  

    .mobile-menu{
        max-width:500px;
        min-height: 95vh;
        background-image: linear-gradient(rgba(255, 190, 155, 0.068), rgba(235, 217, 173, 0));
    }
    .panel{
        width:31.5vw;
        height: auto;
        margin:2px;
        }
       .panel  img{  
            min-height:50px;         
            width: 100%;
            max-width:100%;
            height:15vh;
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
            display: flex;
            width:30%;
            text-align: center;
            font-size: 8pt;
            color: $primary-button;
        }
        .nav-link, .menu-name, .carousel__icon{
            color: $primary-button !important;
        }
        .arrow-left {
            font-size:20pt;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            top:-5rem;
            cursor: pointer;
            transition: all .5s ease-in-out;
            border: 2px solid rgb(233, 230, 230); 
            border-radius: 10px;
            z-index: 5;
            }
        .arrow-left:hover{
                border: 3px solid rgb(236, 233, 233); 
                color:rgba(220, 20, 60, 0.205);
            }
        .arrow-left:active {
            padding: 0;
            margin: 0;
            opacity: 1;
            transition: 0s;
            color:#fff;
            background-color:rgba(194, 48, 48, 0.466);
            }
        order-image{
            width:80% !important;
            height:150px;
            align-content: center;
            align-items: center;

        }

            /* media quesries */
            @media only screen and (max-width: 700px) {
                .mobile-menu{
                   max-width:80%;
                    .arrow-left {
                        top:-2rem
                    }
                }
            }
           

            @media only screen and (max-width: 650px) {
                .mobile-menu{
                    max-width:100%;
                    
                }
            }
                
        
       
    
</style>