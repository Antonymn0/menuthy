<template>
<div class="row"> 
<div class="px-3 card shadow my-2 ml-2  mobile-menu ">
    
   <div class="text-center pt-2 fixed">
       <div :class="blur"> 
        <p> 
            <img :src="'/images/' + this.restaurant.image" v-if="this.restaurant.image" class="border-bottom mx-auto rounded"  alt="restaurant-logo" style="width:10vw; height:10vw;">
            <img src="/images/hotel_logo_placeholder.png" v-else alt="restaurant-logo" style="width:10vw; height:10vw;">
            <h4 styele="color:#eee;"> {{this.restaurant.restaurant_name}} </h4>
        </p>    

        <!-- main menu dropdown         -->
            <div class=" text-center dropdown col-xs-6 mx-auto pb-2 pt-0">
                <div class="arrow-left p-0 m-0" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <i class="bi bi-justify-left"></i>
                </div>
                <button class="text-danger btn p-1 bg-white mb-1 dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="lead"> Main Menu </span>  
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown"> 
                    <li v-if="this.menus.length" > 
                        <ul v-for="(menu) in this.menus" :key="menu.id" class="list-unstyled">
                            <li class="px-3 py-2 border-bottom" v-if="menu.published == 'true'"> 
                                <a class="dropdown-item p-2" :href="'/' + restaurant_name + '/menu/' + restaurant.id + '/' + menu.id + '/' + table_number" > {{menu.menu_name}} </a> 
                            </li>
                        </ul>
                    </li>
                    <li v-else> 
                        <ul class="list-unstyled">
                            <li class="text-muted  p-5"> Menu empty</li>
                        </ul>
                    </li>
                </ul>
            
            </div>
        </div>
   </div>

        <!-- imge slider -->
   <div v-if="this.menus.length" :class="blur"> 
        <carousel :items-to-show="3">
            <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id">
                    <div class="img-fluid  panel rounded mt-2 fade-in shadow-right shadow-left" v-if="sub_menu.publish == 'true'">   
                        <div class="pb-0 shadow">
                            <a href="#" class="rounded shadow" @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu.sub_menu_name)]"> 
                                <img :src="'/images/' + sub_menu.image" alt="food-image" class="img-fluid" v-if="sub_menu.image">
                                <img src="/images/placeholder.png" alt="food-image" class="img-fluid rounded shadow" v-else>
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
        
        <!-- menu items -->
        <!-- <div v-if="this.menu_items.length " v-show="this.show_menus_list">
            <div class="py-4 mx-3  text-center">
                <p class="border-bottom p-2 d-inline menu-name">
                    {{menu_name}}
                </p>        
            </div> 
            <div v-for="menu_item in menu_items" :key="menu_item.id">  
                <div class="open-full-screen" @click="showMenuItem(menu_item)" v-if="menu_item.publish== 'true'">                        
                    <div class=" row menu-item p-2 m-2 shadow fade-in open-full-screen">

                        <p class="description m-0 text-center">
                            {{menu_item.menu_item_name}} 
                        </p>
                        <p class="description m-0">
                            {{menu_item.description}} 
                        </p>
                        <p class=" menu-image p-0 m-0">
                            <img :src="'/images/' + menu_item.image" alt="menu-image" >
                        </p>
                    
                        <p class="row price-time pb-0 mb-0 pt-1">
                            <span>
                            <i class="bi bi-tag pr-2 text-danger text-left " style="font-size:10pt"></i>   ${{menu_item.price}}
                            </span>
                            <span v-if="this.User.package_type != null"> 
                                <a href="#" class="btn btn-sm btn-danger alert-danger" @click="placeOrder(menu_item)"> Order</a>
                            </span>s
                            <span>
                            <i class="bi bi-alarm pr-2 text-danger text-right"></i> {{menu_item.preparation_time}} mins
                            </span>
                        </p>
                    </div>      
                </div>      
            </div>
        </div>
        <div v-else> <p class="text-muted text-center pt-5 border-top px-3">No items to show!</p> 
    </div>-->




    <div class="border shadow  mx-2 row" style="border-radius:15px;">
        <div class="pt-3 pr-1 text-muted" style="width:70%;">            
            <h3 class="w-100"> <span class="">Chicken skewers </span>  <span class="float-right" style="color:#ff656c;"> $10 </span>  </h3>
            <p class="py-2">
                A delicious bow of soup with rice. 
            </p>
            <p class="">
                <span class="lead"> <a href="#" class="btn lead  btn-danger" style="background-color:#ff656c; hover:#ff7300; border-radius:10px;"> Order</a> </span>
                <span class=""><i class="bi bi-alarm pl-5 text-danger text-right"></i> 10min </span>
            </p>
        </div >
        <div class="image p-0 m-0 float-right " style="width:30%; overflow:hidden">
            <img src="/storage/hotel_logo_placeholder.png" alt="" style="width:215px; max-width:100%; height:160px; max-height:100%;">
        </div>
        
    </div>









</div>
    <div v-else> <p class="text-muted text-center pt-5 border-top px-3">This restaurant has no items to show!</p></div>

        <!-- single menu item for full screen display -->
         <div class="mb-3 " v-show="this.show_single_menu_item" v-if="single_menu_item.publish" >                        
                <div class="   p-2 m-2 shadow border-top fade-in ">
                    <div class="row m-0  pt-2">
                      <span class="arrow-left" style="top:0; padding:0; width:12%; z-index:5;"  @click="showMenuItem([])"> <i class="bi bi-arrow-left"></i></span> 
                       <span class="order-image mx-auto rounded shadow " style="width:70%; max-height:100%">
                           <img :src="'/images/' + single_menu_item.image" alt="menu-image" class="rounded w-100 " v-if="single_menu_item.image"> 
                           <img src="/images/placeholder.png" alt="food-image" class="img-fluid" v-else>
                        </span>  
                    </div>
                    <br>
                    <div class=""> 
                        <p class="text-center ">
                            {{single_menu_item.menu_item_name}}
                        </p>
                        <p class=" d-flex justify-content-center">
                            <span class="badge bg-primary m-1" v-if="single_menu_item.is_signiture">Signiture</span>
                            <span class="badge bg-warning text-dark m-1" v-if="single_menu_item.is_halal">Halal</span>
                            <span class="badge bg-success m-1" v-if="single_menu_item.is_veg">Veg</span>
                            <span class="badge bg-danger m-1" v-if="single_menu_item.is_new">New</span>                             
                        </p>
                        <h5 class="pl-5">Description</h5>
                        <p class=" d-flex justify-content-center  p-2">
                            {{single_menu_item.description}}
                        </p> 
                        <p class=" d-flex justify-content-center"> 
                            <span class="mr-5">
                                <i class="bi bi-tag pr-2 text-danger  " style="font-size:10pt"></i>   ${{single_menu_item.price}}
                            </span>  
                            <span> </span>                      
                            <span class="ml-3">
                                <i class="bi bi-alarm pr-2 text-danger "></i> {{single_menu_item.preparation_time}} mins
                            </span> <br>
                        </p> 
                        <p class=" d-flex justify-content-center" v-if="this.User.package_type != null">
                          <a href="#" class="btn  btn-danger pt-2 alert-danger col-xs-8 mx-auto" @click="placeOrder(single_menu_item)"> Order now</a>
                        </p>                       
                             
                    </div>      
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
                     <li class="px-3 py-2 border-bottom" v-if="menu.published == 'true'"> 
                        <a class="dropdown-item p-2" :href="'/' + restaurant_name + '/menu/' + restaurant.id + '/' + menu.id + '/' + table_number" > {{menu.menu_name}} </a> 
                    </li>
                </ul>
            </div>
            
            </div>
        </div>
        </div>
        </div>
    </div>

<div class="d-flex  align-items-center mx-auto space-filler-logo text-center "  >
    <div class="inner-div"> 
        <img :src="'/images/' + this.restaurant.image" v-if="this.restaurant.image" class="border-bottom mx-auto rounded"  alt="restaurant-logo" style="width:10vw; height:10vw;">
        <img src="/storage/hotel_logo_placeholder.png" v-else class="border-bottom mx-auto"  alt="restaurant-logo" style="width:10vw; height:10vw;">
     <div class="border my-2 card lead"></div>
       <h2 styele="color:#eee;"> {{this.restaurant.restaurant_name}} </h2> 
    </div>        
</div>
</div>


</template>

<script> 

import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  name: 'App',

  props:['menus', 'subMenus', 'menuItems', 'user'],

  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data(){
      return{
          blur:'',
          restaurant_name:'',
          restaurant:'',
          menu_items:'',
          menu_name:'',
          single_menu_item:'',
          show_menus_list:true,
          show_single_menu_item:false,
          is_take_away:false,
          User:{},    
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
          this.blur = this.blur == 'blur-background' ? '' : 'blur-background';
      },
      fetchMenuItems( sub_menu_id){
          console.log('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id);
           axios.get('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id)
            .then( response => {
            if( response.status = 200){
                // console.log(response.data.data);
                this.menu_items = response.data.data;
                // console.log(this.menu_items);
                } 
            })
            .catch( error => {
                this.$swal('Failed to fecth!');                
                console.log(error.response.data.errors);                    
            });
      },
      placeOrder(menu_item){
          var form_data = new FormData();
            form_data.append('menu_item_name', menu_item.menu_item_name);
            form_data.append('menu_item_type', menu_item.menu_item_name);
            form_data.append('is_take_away', this.is_take_away);
            form_data.append('order_number', Date.now());
            form_data.append('menu_item_id', menu_item.id);
            form_data.append('restaurant_id', window.authRestaurant.id);
            form_data.append('preparation_time', menu_item.preparation_time);
            form_data.append('price', menu_item.price);
            form_data.append('status', 'recieved');
            if(this.User.table_number) form_data.append('table_number', parseInt(this.User.table_number) );
            console.log(...form_data);
            // console.log(typeof(menu_item.price));

          axios.post('/api/order', form_data)
            .then( response => {
                if( response.status = 201){
                    this.$swal( 'Order placed!'); 
                    // console.log(response.data);
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
        this.User= this.user;
         this.restaurant_name = window.authRestaurant.restaurant_name.replace(/\s+/g, '-').toLowerCase();
         this.restaurant= window.authRestaurant;
         console.log(this.user);
  }
 
};
</script>

<style lang="scss"> 
@import "../../../sass/app.scss"; 

.carousel__prev, .carousel__next {
    background-color: rgb(241, 103, 48) !important;;
}
.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color: rgb(253, 253, 253) !important;;
}
    .mobile-menu{
        width:40%;
        max-width:500px;
        min-height: 95vh;
        height:auto;
        background-image: linear-gradient(rgba(255, 190, 155, 0.068), rgba(235, 217, 173, 0));
    }
    .space-filler-logo{
        float:right;
        width:20px;
        min-height:95vh;
    }
    .inner-div{
        margin-top:50%;
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
            img{
                min-height:100%;
            }
        }
        .menu-item{
            border: 1px solid #eee;
            border-radius: 10px;
            img{
                width:100%;
                height:100%;
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
            width:80% ;
            align-content: center;
            align-items: center;

        }
        .blur-background{
            filter: blur(5px);
            -webkit-filter: blur(5px);
        }
            /* media queries */
            @media only screen and (max-width: 700px) {
                .mobile-menu{
                   width:99%;
                    max-width:100%;
                    .arrow-left {
                        top:-2rem;
                       
                    }
                }
                .space-filler-logo{
                    display: none !important;
                }
            }
           

            @media only screen and (max-width: 650px) {
                .mobile-menu{
                    width:99%;
                    max-width:100%;
 
                }
            }
                
        
       
    
</style>