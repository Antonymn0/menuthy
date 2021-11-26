<template>
<div class=" parent-div px-2 shadow">
    <div class="arrow-left p-0 m-0 shadow" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="bi bi-justify-left"></i>
    </div>
    <div class=" logo-part">
        <div class="logo text-center pt-5">
             <img :src="'/images/' + this.restaurant.image" v-if="this.restaurant.image" class=""  alt="restaurant-logo" style="width:100px; height:100px;">
            <img src="/storage/hotel_logo_placeholder.png" v-else alt="" style="width:100px; height:100px">
            <p class="p-2">
               <span v-if="this.restaurant.description !== null"> {{this.restaurant.description}}</span>
               <span v-else> Hotel description</span> 
            </p>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------- -->

    <!-- image slider -->
    <div class=" carousel-div">
    <div v-if="this.menus.length" :class="blur"> 
            <carousel :items-to-show="3">
                <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id">
                        <div class="inner-carousel-div" v-if="sub_menu.published !== null">                            
                            <div class=" img-div" v-if="sub_menu.image !== null">
                               <a href="#"> <img :src="'/images/' + sub_menu.image"  @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu.sub_menu_name)]" alt="" class="shadow"> </a> 
                            </div>
                            <div class=" img-div" v-else>
                               <a href="#"> <img :src="'/images/' + sub_menu.image" @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu.sub_menu_name)]" alt="" class="shadow"> </a> 
                            </div>
                            <h5 class="pt-1">
                                {{sub_menu.sub_menu_name}}
                            </h5>
                        </div>
                    </slide>
                    <template #addons>
                        <div class="mx-2">
                            <navigation />
                        </div>            
                </template>
            </carousel>
        </div>
    </div>

    <!-- ---------------------------------------------------------- -->
    
    <div class=" title-part mx-auto title">
        <h3>
            {{menu_name}}
        </h3>
        <p v-if="menu_name.description">
            {{menu_name}}
        </p>
    </div>

    <!-- -------------------------------------- -->
        <!-- menu items / dishes -->
    <div class="parent-conatiner  text-muted" v-if="this.menu_items.length "> 
        <div class="" v-for="menu_item in menu_items" :key="menu_item.id" >
        <div class="elements-div" v-if="menu_item.publish== 'true'">
            <div class="shadow inner-elements-div ">
                <div class="image-div">
                    <img :src="'/images/' + menu_item.image" alt="menu-image" >
                </div>

                <div class="text-div">
                    <p class="ribbon d-flex justify-content-between ">
                        <span class="time text-white pl-2"> <i class="bi bi-alarm pr-2 text-white "></i>  <small>{{menu_item.preparation_time}} mins </small> </span>
                        <span class="price bold"> <b> ${{menu_item.price}}</b> </span>
                    </p>
                    <h4 class="title">
                    <span>  {{menu_item.menu_item_name}} </span> 
                    <span class="price float-right pr-3"> ${{menu_item.price}}</span>
                    </h4>
                    <p class="description">
                       {{menu_item.description}}
                    </p>
                        <p class="order-btn">
                        <span  v-if="this.User.package_type != null"> <a href="#" @click="placeOrder(menu_item)">Order</a></span> 
                        <span class="time text-default pl-3"><i class="bi bi-alarm pl-1 text-danger text-right"></i> <small>{{menu_item.preparation_time}} mins </small> </span>
                        </p>
                </div>

                <div class="image-div2">
                   <img :src="'/images/' + menu_item.image" alt="menu-image" >
                </div>
            </div>
        </div>
        </div>
    </div>
    <div v-else>
        <p class="text-muted text-center pt-5 mt-2"> Menu empty</p>
    </div>

<!-- ---------------------------------------------- -->
  <!--menu pop up Modal -->
        <div class="modal fade mx-auto text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg mx-5" style="align-items: flex-end; bottom:8rem;" >
            <div class="modal-content shadow" style="">
            <div class="modal-header">
                <h4 class="modal-title col-xs-6 mx-auto" id="exampleModalLabel" style="color:rgb(241, 103, 48);">Main Menu</h4>
            </div>
            <div class="modal-body">
                <ul  v-for="(sub_menu) in subMenus" :key="sub_menu.id" class="list-unstyled px-5">
                     <li class="px-3 py-2 border-bottom" > 
                        <a class="dropdown-item p-2" :href="'/' + restaurant_name + '/menu/' + restaurant.id + '/' + sub_menu.id + '/' + table_number" > {{sub_menu.sub_menu_name}} </a> 
                    </li>
                </ul>
            </div>
            
            </div>
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
            if(!this.User.table_number) form_data.append('table_number', 1);
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


<style lang="scss" >
@import "../../../sass/app.scss"; +



 .logo img,  .logo p {
    justify-content: center;
}


.parent-div{
    width:45rem;
    height:100vh;
    margin:auto;
    border-right: 1px solid grey;
    overflow-y:scroll;
}

.carousel-div{
    padding-bottom:1rem;
}
.carousel__prev, .carousel__next {
    background-color: $orange !important;
}

.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color:#fff !important;
}

.inner-carousel-div {
 width:100%;
 padding: .2rem;
}
.img-div  {
 border-radius: 20px;
 overflow: hidden;
}
.img-div img {
 height: 130px;
 max-height: 100%;
 width:100%;
}

.title-part h3, .title-part p{
    display: flex;
    justify-content: center;
}
.parent-container{
    width:90%;
    margin: auto;
}

.elements-div{
    width:24%;
    float:left;
    padding: .2rem;
    text-align: center;
    border-radius: 15px;
}
.inner-elements-div{
    border-radius: 15px;
}
.image-div{
    width:100%;
    height: auto;
    overflow:hidden;
    border-radius: 15px 15px 0 0;
}
.image-div2{
   display:none;
}
.image-div img{
    min-height:50px;         
    width: 100%;
    max-width:100%;
    height:20vh;
    max-height:100%;
}
.text-div{
    position:relative;
    padding-bottom: .2rem;;
    padding-top: .2rem;;
}

.ribbon{
    width:100%;
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    top:-1.2rem;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.459);
    margin-bottom: 0;
}
.ribbon .price{
    background-color: white;
    padding-left:8px;
    padding-right:8px;
    color:$orange; 
}
.title{
    padding-top:.5rem;
}
.title .price{
    display:none;
}
.description{
    display: none;
}
.order-btn a{
    background-color: $orange;
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 7px;;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
}
.order-btn a:hover{
      background-color: #ff2b0698; 
}
.order-btn .time{
    display:none;
}

.arrow-left {
    font-size:20pt;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    top:5rem;
    cursor: pointer;
    transition: all .5s ease-in-out;
    border: 2px solid rgb(231, 223, 223); 
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
.modal-content{
    width:50%;
    margin-left:auto;
    margin-right:auto; 
    align-content:middle;
}


/* media queries */
@media only screen and (max-width: 900px) {
   .parent-div{
    width:100vw;
     border-right: none;
    }
    .inner-carousel-div {
        width:100%;
        padding: .1rem;
    }
 .arrow-left {
     left:1rem;
 }
    

    .elements-div{
        width:99%;       
        text-align: center;
        margin-bottom: .5rem;
        border-radius: 15px;
        display: flex;
        align-items: center;
    }
     .inner-elements-div{
        width:100%;
        
    }
    .image-div{
       display: none;
    }
   
    .ribbon{
        display:none !important;
    }
    .title .price{
    display:block;
    float:right;
    color: $orange;
    }
    .description{
        display:block;
    }
     .image-div2{
         display:block;
        width:30%;
        height:100%;
        float:right;
        overflow:hidden;
        border-radius: 0 15px 15px 0;
    }
    .image-div2 img{
        min-height:50px;         
        width: 100%;
        max-width:100%;
        height:150px;
        max-height:100%;
    }
    .text-div{
        width:70%;
        float:left;
        margin-top:2%;
        margin-bottom:auto;
        padding-left:1rem;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .order-btn {

        float:left;
    }
    .order-btn .time{
        display:inline-block;

    }
    .modal-content{
        top:10rem;
        width:100%;
        margin-left:auto;
        margin-right:auto; 
        align-content:middle;
    }
}

/* media queries */
@media only screen and (max-width: 500px) {
   .elements-div{
        width:95%;
        float:left;
        padding: .5rem;
        text-align: center;
        border-radius: 15px;
    }
    .image-div{
        display:block;
        width:100%;
        height:30vh;
        overflow:hidden;
        border-radius: 15px 15px 0 0;
    }
    .image-div2{
        display:none;
    }
    .text-div{
        width:100%;
    }
    .image-div img{
        min-height:100px;         
        width: 100%;
        max-width:100%;
        height:30vh;
        // max-height:100%;
    }
    .description{
        display: block;
    }
    .order-btn{
        text-align:center;
    }
}

</style>