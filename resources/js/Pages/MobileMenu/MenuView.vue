<template>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div class="parent-div mx-auto shadow px-1 ">
    <div :class="this.blur"> 
    <div class="header-div">
        <span class="arrow-left p-0 m-0 shadow rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">       
        <i class="bi bi-justify-left"></i>
        </span>
        <img :src=" this.restaurant.image"  v-if="this.restaurant.image"  alt="restaurant-logo" >
        <img src="/images/restaurant_logo_placeholder.png" v-else alt="" style="min-width:100px; height:100px">
        <p class="p-2 text-center">
               <span v-if="this.restaurant.restaurant_name !== null"> {{this.restaurant.restaurant_name}}</span>
               <span v-else> Hotel name</span> 
            </p>
    </div>


    <!-- ------------------------------------------------------------ -->

    <div class="slider-div" id="slider-div">
        <div v-if="this.subMenus.length" :class="blur" class="inner-shadow inner-right-shadow"> 
            <carousel :items-to-show="3.5">
                <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id"  style="display:table">
                        <div class="carausel-item mx-1 " v-if="sub_menu.published !== null" >                            
                            <div class="" v-if="sub_menu.image !== null" onclick="toggleActivemenuClass()">
                                <a href="#"> <img :src="sub_menu.image"  @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu)]" alt="" class="shadow"> </a> 
                            </div>
                            <div class=" " v-else onclick="toggleActivemenuClass()">
                                <a href="#"> <img :src="sub_menu.image" @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu)]" alt="" class="shadow"> </a> 
                            </div>

                            <h5 class="px-1 my-3 " >
                                <span class="h5">{{sub_menu.sub_menu_name}} </span>
                            </h5>                           
                        </div> 
                    </slide>
                    <template #addons>
                        <div class="">
                            <navigation />
                        </div>            
                </template>
            </carousel>
        </div>

        
    </div>


    <!-- ----------------------------------------------------------- -->
    <div class=" text-center align-items-center py-2">
        <h5> <b> {{this.menu_name}} </b> </h5>
        <p v-if="this.description"> {{this.description}} </p>
    </div>

 
    <!-- --------------------------------------------------- -->
    <div v-if="menu_items.length" class="m-1"> 
        
    <div class="items-div"  v-for="menu_item in menu_items" :key="menu_item.id">
        <div class="row items-div-inner my-2 shadow" >
            
            <div class="text-div">
                <div class="pl-3 pt-3 w-100 inner-items-div">
                    
                    <div class="title ">                        
                        <span class="price  pr-3  text-right"> <b> {{this.restaurant.currency}} {{menu_item.price}} </b> </span> 
                        <span class=""> <h5> {{menu_item.menu_item_name}} </h5> </span>            
                    </div>
                    <p v-if="menu_item.description !== 'null'" class="mb-1">{{menu_item.description}}</p>

                    <!-- radio buttons -->
                    <div class=" radio-btns mb-2"> 
                        <form action="#">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"   type="radio" :name="menu_item.id" :id=" 'r1' + menu_item.id " value="dine in">
                                <label class="form-check-label" :for=" 'r1' + menu_item.id "> Dine in</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  :name="menu_item.id" :id=" 'r2' +  menu_item.id" value="take away">
                                <label class="form-check-label" :for=" 'r2' +  menu_item.id">Take away</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio"  :name="menu_item.id" :id=" 'r3' + menu_item.id" value="pick up" >
                                <label class="form-check-label" :for=" 'r3' + menu_item.id">Pick up</label>
                            </div>
                            <small class="text-danger"> {{this.errors.order_type}}</small>
                        </form>
                    </div>
                    <p class="order-btn">
                        <span  v-if="this.User.package_type != null" class="button">                  
                            
                            <span  v-if="this.User.package_type != null"> <a href="#" class="py-2 mr-3 mt-3" @click="togglepopUp(menu_item)" data-bs-toggle="modal" data-bs-target="#popupModal"  data-backdrop="static" data-keyboard="false">Order</a></span> 
                           
                        </span> 

                        <span class="open pt-2">  <a href="#" class="py-2 pr-3 mr-3" @click="togglepopUp(menu_item)" >Oder</a></span>

                        <span class="time text-default float-right pr-3"><i class="bi bi-alarm pl-1 text-danger text-right"></i> <small>{{menu_item.preparation_time}} mins </small> </span>
                     </p>
                </div>    
            </div>  
                 <div class="img-div "> 
               <a href="#"> <img :src="menu_item.image" alt="menu-image" ></a> 
             </div>     
        </div>
        </div>        
    </div>
    <div v-else class="text-center py-5">
        No items listed in this category
    </div>
    <div class=" py-3 text-danger d-flex justify-content-center align-items-center">
        <p>
            Powered by: <b> Menuthy</b> 
        </p>
    </div>

<!-- ---------------------------------------------------------------- -->

           
 <!-- menu modal popup -->
 <div class="modal fade mx-auto text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  mx-auto" >
            <div class="modal-content shadow" style="">
            <div class="modal-header">
                <h4 class="modal-title col-xs-6 mx-auto" id="exampleModalLabel" style="color:rgb(241, 103, 48);">Main Menu</h4>
            </div>
            <div class="modal-body">
                <ul  v-for="(menu) in menus" :key="menu.id" class="list-unstyled px-5">
                     <li class="px-3 py-2 border-bottom"  data-bs-dismiss="modal" >  
                        <a class="dropdown-item p-2" href="#"   @click="fetchMenus( menu.id)"  > {{menu.menu_name}} </a> 
                    </li>
                </ul>
            </div>
            
            </div>
        </div>
    </div> 
</div>

 <!-- final pop up --> 
<!-- Modal -->
<div class="modal fade mx-auto text-center" id="popupModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="exampleModalLabel" data-bs-keyboard="false"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="width:auto;">

         <div class="pop-up  shadow p-1" >
                <div class="bg-white rounded" style="border-radius:15px; overflow:hidden">
                    <div class="pop-up-img">
                        <span class="p-2 shadow rounded back-btn" @click="togglepopUp()" data-bs-dismiss="modal" aria-label="Close" style="cursor:pointer;"> <i class="bi bi-arrow-left"  > </i></span>
                        <img :src="this.menu_item.image" alt="menu-image" >
                    </div>
                    <div class=" ribbon "> 
                        <span class="time bg-white  py-1 text-default px-3"><i class="bi bi-alarm pl-1 text-danger text-right"></i> <small>{{menu_item.preparation_time}} mins </small> </span>
                        <span class=" ribon-price float-right">{{this.restaurant.currency}} {{this.menu_item.price}} </span>
                    </div>
                    <div class="pop-up-text  py-2">
                        <h4 class="">
                            {{this.menu_item.menu_item_name}}   
                        </h4> 
                        <p class="description mb-0" v-if="menu_item.description !== 'null'">{{this.menu_item.description}}  </p>

                        <!-- radio buttons -->
                    <div class=" radio-btns-popup py-1"> 
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" checked v-model="this.order_type" type="radio" :name="menu_item.id" :id=" 'r1' + menu_item.id " value="dine in">
                            <label class="form-check-label" :for=" 'r1' + menu_item.id "> Dine in</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="this.order_type" :name="menu_item.id" :id=" 'r2' +  menu_item.id" value="take away">
                            <label class="form-check-label" :for=" 'r2' +  menu_item.id">Take away</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="this.order_type" :name="menu_item.id" :id=" 'r3' + menu_item.id" value="pick up" >
                            <label class="form-check-label" :for=" 'r3' + menu_item.id">Pick up</label>
                        </div>
                        <small class="text-danger"> {{this.errors.order_type}}</small>
                    </div>
                        <p class="order-btn mt-2 mx-auto">
                            <i class="bi bi-dash-circle" @click="orderFor(-1)"></i>
                            <span  v-if="this.User.package_type != null"> <a href="#" class="p-2 mx-3" @click="placeOrder(menu_item)">Order for {{order_amount}}</a></span> 
                            
                            <i class="bi bi-plus-circle" @click="orderFor(1)"></i>
                        </p>
                    </div>
                </div>
            </div>
         </div>
  </div>
</div>   
      
     
  

<!-- ---------------------------------- -->
</div>


</body>
</html>

</template>

<script> 

import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  name: 'App',

  props:['menus', 'subMenus', 'menuItems', 'user', 'restaurant'],

  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data(){
      return{
          blur:'',
          menu_item:'',
          order_amount:1,
          restaurant_name:'',
          menu_items:'',
          menu_name:'',
          description:'',
          single_menu_item:'',
          show_menus_list:true,
          show_single_menu_item:false,
          is_take_away:false,
          popupVisible:false,
          order_type:'dine in',
          errors:{},
          User:{},
      }
  },
  methods:{
     orderFor(number){
         this.order_amount += number;
         if(this.order_amount < 1)this.order_amount = 1;
     },
      togglepopUp(menu_item){        
         if(this.blur == '') this.blur = 'blur';
         if(this.blur == 'blur') this.blur = '';
         this.menu_item = menu_item;
         this.order_amount = 1;
      },
      updateMenuName(sub_menu){
            this.menu_name= sub_menu.sub_menu_name;
            this.description = sub_menu.description;
      },
      showMenuItem(menu_item){
          this.single_menu_item = menu_item;
          this.show_menus_list = !this.show_menus_list;
          this.show_single_menu_item = !this.show_single_menu_item;
          this.blur = this.blur == 'blur-background' ? '' : 'blur-background';
      },
      fetchMenus( menu_id){
          Swal.showLoading();
          this.$inertia.visit('/' + this.restaurant_name + '/main-menu/' + menu_id);
         Swal.close()
        
      },
      fetchMenuItems( sub_menu_id){
          Swal.showLoading();
          console.log('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id);
           axios.get('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id)
            .then( response => {
            if( response.status = 200){
                this.menu_items = response.data.data;
                Swal.close();
                } 
            })
            .catch( error => {
                this.$swal('Failed to fecth!');                
                console.log(error.response);                    
            });
      },
      placeOrder(menu_item){
          this.validateOrderType();
          if(Object.keys(this.errors).lenngth) return;

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
            form_data.append('order_type', this.order_type);
            form_data.append('order_for', this.order_amount);
            if(this.User.table_number) form_data.append('table_number', parseInt(this.User.table_number) );
            if(!this.User.table_number) form_data.append('table_number', 1);

            if(confirm("Place a " + this.order_type + " order for "+ this.order_amount + ' people?')){
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
            }
      },
      validateOrderType(){
          if(!this.order_type || this.order_type == '') this.errors.order_type =  'Please select an order type';
          else delete this.errors.order_type;

      },
  },
  mounted(){
        this.menu_items = this.menuItems;
        this.User= this.user;
         this.restaurant_name = this.restaurant.restaurant_name.replace(/\s+/g, '-').toLowerCase();        
  }
 
};
</script>


<style lang="scss" >
@import "../../../sass/app.scss"; 
@import url('https://fonts.googleapis.com/css?family=Poppins');

// parent div 
.parent-div{
    color: #585858;
    font-family: poppins !important;
    background-color: #fff !important;
    min-height:100vh;
    width:42rem;
    max-width:100%;
    overflow-y:scroll;
}

.header-div img{
    object-fit:cover;
    width:100px;
    height:100px;
    min-height:100px;
    min-width:100px;
    display: block;
    margin-left: auto;
    margin-right: auto;
}

.arrow-left{
    position:relative;
    left:1rem;
    top:4rem;
    font-size:2rem;
    padding-left:.7rem;
    padding-right:.7rem;
    cursor: pointer;
    transition: all .5s ease-in-out;
    width: 50px;
    height: 50px;
    text-align: center;
    
}
.arrow-left:hover{
    border: 3px solid rgb(236, 233, 233); 
    color:rgba(220, 20, 60, 0.205);
}


// slider div 
.carausel-item{
    display:table-cell;
    padding:.3rem;
    overflow:hidden;
    font-size:1rem;
   max-height: 80%;;
}
.carausel-item h5{
    font-size:.9rem; 
}
.slider-div img{
    object-fit:cover;
    width:180px;
    height:120px;
    max-width:100%;
    max-height:100%;
    border-radius: 5px;;
}
 .carousel__prev, .carousel__next {
    background-color: $orange !important;
    margin: .3rem;
    margin-right:.3rem;
    top:3.5rem;
}
.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color:#fff !important;
}

// items div
.items-div{
    margin-left: .5rem;
    padding-right: 10px;
}
.items-div-inner{
    border-radius:15px;
    overflow:hidden;
}
.img-div{
    object-fit:cover;
    width:30%;
    float:right;
    margin-top:auto;
    margin-bottom:auto;
}
.img-div img{
    object-fit: cover;
    width:150px;
    max-width:100%;
    height:140px;
    max-height:100%;
}
.text-div{
    width:70%;
    display: flex;
    align-items: center;
    padding-right:5px;
    
}
h5{
    // color:$orange;
    font-weight:500;
}
.description{
font-weight:300;
}
.title{
   min-width:100%;

}
 .price{
    
    float:right;
    color: $orange;
    font-weight:400;
}

// order btn
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
    background-color: rgb(255, 136, 0);
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 16px;
}
.order-btn a:active{
    background-color: rgb(255, 136, 0);
    border: none;
    color: white;
    padding: 4px 9px;
    border-radius: 10px;
    font-size: 16px;
}
.order-btn .button{
        display:inline-block;
    }
.order-btn .open{
        display:none;
    }
.order-btn i{
    font-size: 1.3rem;
    cursor:pointer;
}
.order-btn i:hover{
    font-size: 1.35rem;
    cursor:pointer;
}
.inner-shadow {
    box-shadow: inset -5rem 0 0 0 #fff;
}
.inner-right-shadow {
    box-shadow: inset 5rem 0 9px -7px #fff;   
}

.ribbon{
    position:absolute;
    width:100%;
    top:14rem;
    display:flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(212, 212, 212, 0.596);
}
.ribon-price{
    color:$orange;
    font-weight:400;
    background:white;
    padding-right:15px;
    padding-left:15px;
    border-radius:7px;
    font-size:1.2rem;
}


//radio btns
input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #e9e7e367;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid rgb(248, 211, 108);
    }

    input[type='radio']:checked:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -2px;
        left: 0;
        position: relative;
        background-color: $orange;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 3px solid $orange;
    }

.radio-btns{
    padding: 5px 0;
}
.radio-btns label{
    font-size:8pt;
}



.parent-popup{
    background:black;
    width:100vw;
    height:100vh;
    position:relative;
}
.pop-up{
    position:relative;
    height:auto;

    margin-right:auto;
    margin-left:auto;

    justify-content: center;
    align-items: center;
    margin-left:auto;
    margin-right:auto;
    max-height:500px;
    width:100%;
    max-width:350px;
    border-radius:15px;
    overflow:hidden;
    background:rgb(224, 222, 222);
    transition: transform .5s ease;
   

}
.pop-up-img img{
    object-fit: cover;
    min-width:350px;
    max-width:350px;
    max-height:250px;
    min-height:250px;
    object-fit: cover;
}
.back-btn{
    position:absolute;
    font-size:1.5rem;
    left:.5rem;
    top:.5rem;
    background:rgba(248, 143, 6, 0.808);
    color:rgb(224, 221, 221);
}
.back-btn:hover{
    background:rgba(248, 143, 6, 0.966);
}
.back-btn:active{
    border:1px solid rgba(206, 118, 4, 0.966);
    background:rgba(241, 138, 2, 0.993);
    color:#fff;
}
.pop-up-text{
   text-align: center;
}
.blur{
    filter: blur(12px);
}

.active{
    border-bottom: 4px solid $orange;
    width:auto;
    padding-bottom: 5px;
    border-radius:5px;
}


/* media quesries */
@media only screen and (max-width: 600px) {
  .img-div{
vertical-align:middle;
padding:.2rem;

}
  .img-div img{
      max-height:100px;
      width:200px;
     max-width:100%;

}
}

/* media quesries */
@media only screen and (max-width: 450px) {
    .parent-div{
   padding:1rem;
   overflow:hidden;
}
.carousel__prev, .carousel__next {
    background-color: $orange !important;
    margin: .3rem;
    margin-right:.3rem;
    top:2.3rem;
}
.slider-div img{
    width:150px;
    height:80px;
    max-width:100%;
    max-height:100%;
}
.items-div{
    width:100%;
    padding:0;
    margin:0;
}
.items-div-inner{
    width:100%;
    padding:.5rem;
    margin:0;
}
.text-div{
    padding-left:5px;
}
  .radio-btns{
    display:none;
    }
    .order-btn{
        padding-top:10px;
    }
    .order-btn .button{
        display:none;
    }
    .order-btn .open{
        display:inline-block;
    }
    .inner-items-div{
        padding-left: 0 !important;
    }

}







</style>