<template>


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
    <div class="slider-div">
        <div v-if="this.subMenus.length" :class="blur" class="inner-shadow inner-right-shadow"> 
            <carousel :items-to-show="3.5">
                <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id"  style="display:table">
                        <div class="carausel-item " v-if="sub_menu.published !== null">                            
                            <div class="" v-if="sub_menu.image !== null">
                                <a href="#"> <img :src="sub_menu.image"  @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu)]" alt="" class="shadow"> </a> 
                            </div>
                            <div class=" " v-else>
                                <a href="#"> <img :src="sub_menu.image" @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu.sub_menu_name)]" alt="" class="shadow"> </a> 
                            </div>
                            
                            <h5 class="p-2" >
                                {{sub_menu.sub_menu_name}}
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
        <h4> <b> {{this.menu_name}} </b> </h4>
        <p v-if="this.description"> {{this.description}} </p>
    </div>

 
    <!-- --------------------------------------------------- -->
    <div v-if="menu_items.length"> 
        
    <div class="items-div"  v-for="menu_item in menu_items" :key="menu_item.id">
        <div class=" items-div-inner my-2 shadow" >
            <div class="img-div "> 
               <a href="#" @click="togglepopUp(menu_item)"> <img :src="menu_item.image" alt="menu-image" ></a> 
             </div>
            <div class="text-div">
                <div class="pl-3 py-3 w-100">
                    
                    <div class="title ">                        
                        <span class="price w-50 pr-3 py-2 text-right"> <b> {{this.restaurant.currency}} {{menu_item.price}} </b> </span> 
                        <span class="w-50"> <h4> {{menu_item.menu_item_name}} </h4> </span>            
                    </div>
                    <p v-if="menu_item.description !== 'null'">{{menu_item.description}}</p>

                    <!-- radio buttons -->
                    <div class="py-4"> 
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" checked v-model="this.order_type" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="dine in">
                            <label class="form-check-label" for="inlineRadio1">Dine in</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="this.order_type" name="inlineRadioOptions" id="inlineRadio2" value="take away">
                            <label class="form-check-label" for="inlineRadio2">Take away</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" v-model="this.order_type" name="inlineRadioOptions" id="inlineRadio3" value="pick up" >
                            <label class="form-check-label" for="inlineRadio3">Pick up</label>
                        </div>
                        <small class="text-danger"> {{this.errors.order_type}}</small>
                    </div>
                    <p class="order-btn">
                        <span  v-if="this.User.package_type != null"> <a href="#" class="p-2" @click="placeOrder(menu_item)">Order</a></span> 
                        <span class="time text-default pl-3"><i class="bi bi-alarm pl-1 text-danger text-right"></i> <small>{{menu_item.preparation_time}} mins </small> </span>
                     </p>
                </div>    
            </div>            
        </div>


        </div>
        
    </div>
    <div v-else class="text-center py-5">
        No items listed in this menu
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
                <ul  v-for="(sub_menu) in subMenus" :key="sub_menu.id" class="list-unstyled px-5">
                     <li class="px-3 py-2 border-bottom"  data-bs-dismiss="modal" @click="fetchMenuItems(sub_menu.id)" >  
                        <a class="dropdown-item p-2" href="#"    > {{sub_menu.sub_menu_name}} </a> 
                    </li>
                </ul>
            </div>
            
            </div>
        </div>
    </div> 
</div>

 <!-- final pop up -->
      
            <div class="pop-up  shadow p-1" v-if="popupVisible">
                <div class="bg-white rounded" style="border-radius:15px; overflow:hidden">
                    <div class="pop-up-img">
                        <span class="p-2 shadow rounded back-btn" @click="togglepopUp"> <i class="bi bi-arrow-left"> </i></span>
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
                        <p class="" v-if="menu_item.description !== 'null'">{{this.menu_item.description}}  </p>
                       <!-- radio buttons -->
                        <div class="pt-1 pb-3"> 
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" checked v-model="this.order_type" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="dine in">
                                <label class="form-check-label" for="inlineRadio1">Dine in</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" v-model="this.order_type" name="inlineRadioOptions" id="inlineRadio2" value="take away">
                                <label class="form-check-label" for="inlineRadio2">Take away</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" v-model="this.order_type" name="inlineRadioOptions" id="inlineRadio3" value="pick up" >
                                <label class="form-check-label" for="inlineRadio3">Pick up</label>
                            </div>
                            <small class="text-danger"> {{this.errors.order_type}}</small>
                        </div>
                        <p class="order-btn mx-auto">
                            <span  v-if="this.User.package_type != null"> <a href="#" class="p-2" @click="placeOrder(menu_item)">Order now</a></span> 
                            
                        </p>
                    </div>
                </div>
            </div>
           

<!-- ---------------------------------- -->
</div>



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
      togglepopUp(menu_item){
          this.popupVisible = !this.popupVisible;
         if(this.blur == '') this.blur = 'blur';
         else this.blur = '';
         this.menu_item = menu_item;
         console.log(this.blur);
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
      fetchMenuItems( sub_menu_id){
          Swal.showLoading();
          console.log('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id);
           axios.get('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id)
            .then( response => {
            if( response.status = 200){
                console.log(response);
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
            if(this.User.table_number) form_data.append('table_number', parseInt(this.User.table_number) );
            if(!this.User.table_number) form_data.append('table_number', 1);
            console.log(...form_data);
            if(confirm("Place order?")){
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

          console.log(this.order_type);

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


// parent div 
.parent-div{
    color: #585858;
    font-family: poppins;
    background-color: #fff;
    min-height:100vh;
    width:42rem;
    max-width:100%;
    overflow-y:scroll;
}

.header-div img{
    width:100px;
    height:100px;
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

h4{
    color:$orange;
}
// slider div 
.slider-div{
    margin-left:.5rem;
    margin-right:.5rem;
}

.carausel-item{
    display:table-cell;
    margin-left:5px;
    margin-right:5px;
    overflow:hidden;
}
.slider-div img{
    width:120px;
    height:120px;
    border-radius: 10px;;
}
 .carousel__prev, .carousel__next {
    background-color: $orange !important;
    margin: .3rem;
    margin-right:.3rem;
    top:4rem;
}
.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color:#fff !important;
}

// items div
.items-div{
    padding-left: 10px;
    padding-right: 10px;
}
.items-div-inner{
    border-radius:15px;
    overflow:hidden;
}
.img-div{
    width:30%;
    float:right;
    margin-top:auto;
    margin-bottom:auto;
}
.img-div img{

    width:100%;
    height:150px;
}
.text-div{
    width:70%;
    display: flex;
    align-items: center;
    padding-right:5px;
    
}
.title{
   min-width:100%;

}
 .price{
    
    float:right;
    color: $orange;
    font-weight:400;


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





.parent-popup{
    background:#fff;
}
.pop-up{
    position:absolute;
    height:auto;
    top:20%;
     display: flex;
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
    width:350px;
    max-width:350px;
    max-height:250px;
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





























// .parent-div{
//     width:45rem;
//     height:100vh;
//     margin:auto;
//     overflow-y:scroll;
//     padding-left:1rem ;
//     padding-right:.5rem ;
//     padding-top: 0;
//     display:table;
//     font-size: 10pt;
//     font-weight: 600;
// }

//  .logo img,  .logo p {
//     justify-content: center;
// }
// .logo-part{
//     top:-1rem;
// }

// .carousel-div{
//     padding-bottom:1rem;
// }
// .carousel__prev, .carousel__next {
//     background-color: $orange !important;
//     margin: .3rem;
//     margin-right:.3rem;
//     top:4rem;
// }


// .carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
//     color:#fff !important;
// }

// .inner-carousel-div {
//  width:100%;
//  padding: .2rem;
// }
// .img-div  {
//  border-radius: 20px;
//  overflow: hidden;
// }
// .img-div img {
//     object-fit: cover;
//     height: 150px;
//     max-height: 100%;
//     width:100%;
// }

// .title-part h3, .title-part p{
//     display: flex;
//     justify-content: center;
//     font-size:.10pt;
// }

// .title-part p, .title{
//     font-size:12pt;
// }
// .parent-container{
//     width:90%;
//     margin: auto;

// }

// .elements-div{
//     width:25%;
//     float:left;
//     text-align: center;
//     border-radius: 15px;
// }
// .inner-elements-div{
//     border-radius: 15px;
// }
// .image-div{
//     width:100%;
//     min-height: 100%;
//     overflow:hidden;
//     border-radius: 15px 15px 0 0;
// }
// .image-div2{
//     object-fit: cover;
//    display:none;
// }
// .image-div img{
//     min-height:50px;         
//     width: 100%;
//     max-width:100%;
//     height:25vh;
//     max-height:100%;
//     object-fit: cover;
// }
// .text-div{
//     position:relative;
//     padding-bottom: .2rem;;
//     padding-top: .2rem;;
// }

// .ribbon{
//     width:100%;
//     position: absolute;
//     margin-left: auto;
//     margin-right: auto;
//     top:-1.2rem;
//     z-index: 2;
//     background-color: rgba(255, 255, 255, 0.459);
//     margin-bottom: 0;
// }
// .ribbon .price{
//     background-color: white;
//     padding:3px;
//     padding-left:8px;
//     padding-right:8px;
//     color:$orange; 
// }
// .ribbon .time{
//     padding:3px;
//     padding-left:8px;
//     padding-right:8px;

// }
// .title{
//     padding-top:.5rem;
// }
// .title .price{
//     display:none;
// }
// .description{
//     display: none;
// }
// .order-btn a{
//     background-color: $orange;
//     border: none;
//     color: white;
//     padding: 5px 10px;
//     border-radius: 7px;;
//     text-align: center;
//     text-decoration: none;
//     font-size: 16px;
// }
// .order-btn a:hover{
//       background-color: #ff2b0698; 
// }
// .order-btn .time{
//     display:none;
// }

// .arrow-left {
//     font-size:20pt;
//     position: relative;
//     display: flex;
//     justify-content: center;
//     align-items: center;
//     width: 50px;
//     height: 50px;
//     top:5rem;
//     cursor: pointer;
//     transition: all .5s ease-in-out;
//     border: 2px solid rgb(231, 223, 223); 
//     border-radius: 10px;
//     z-index: 5;
//     }
// .arrow-left:hover{
//         border: 3px solid rgb(236, 233, 233); 
//         color:rgba(220, 20, 60, 0.205);
//     }
// .arrow-left:active {
//     padding: 0;
//     margin: 0;
//     opacity: 1;
//     transition: 0s;
//     color:#fff;
//     background-color:rgba(194, 48, 48, 0.466);
//     }
// .modal-content{
//     width:50%;
//     margin-left:auto;
//     margin-right:auto; 
//     align-content:middle;
// }


// /* media queries */
// @media only screen and (max-width: 900px) {
//    .parent-div{
//     width:100vw;
//     height:auto;
//     max-height: 100px;
//      border-right: none;
//      padding-left:.5rem;
//      padding-right:.5rem;
//     }
//     .inner-carousel-div {
//         width:100%;
//         padding: .1rem;

//     }
//  .arrow-left {
//      left:.2rem;
//  }
//     .img-div  {
//     height:100px;
//     max-height:100%;
//     }

//     .elements-div{
//         width:99%;       
//         text-align: center;
//         margin-bottom: .5rem;
//         border-radius: 15px;
//         display: flex;
//         align-items: center;
//         display:table-cell;
//     }
//      .inner-elements-div{
//         width:100%;
        
//     }
//     .image-div{
//        display: none;
//     }
   
//     .ribbon{
//         display:none !important;
//     }
//     .title .price{
//     display:block;
//     font-size:10pt;
//     float:right;
//     color: $orange;
//     }
//     .description{
//         display:block;
//         font-size:9pt;
//     }
//      .image-div2{
//          background-size:cover;
//         width:30%;
//         max-height:100%;
//         display:block;
//         overflow:hidden;
//         border-radius: 0 15px 15px 0;
//     }
//     .image-div2 img{
//         object-fit: cover;
//         height:120px;       
//         width: 100%;
//         max-height:100%;
//     }
//     .text-div{
//         width:70%;
//         float:left;
//         margin-top:2%;
//         margin-bottom:auto;
//         padding-left:1rem;
//         text-align: left;
//         display: flex;
//         flex-direction: column;
//         justify-content: center;
//     }

//     .order-btn {

//         float:left;
//     }
//     .order-btn .time{
//         display:inline-block;

//     }
//     .modal-content{
//         top:1rem;
//         width:100%;
//         margin-left:auto;
//         margin-right:auto; 
//         align-content:middle;
//     }
// }

// /* media queries */
// @media only screen and (max-width: 300px) {
//     .carousel__prev, .carousel__next {
//         background-color: $orange !important;
//         margin: .3rem;
//         top:2.5rem;
//     }
//    .elements-div{
//         width:95%;
//         float:left;
//         padding: .5rem;
//         text-align: center;
//         border-radius: 15px;
//         font-size:10pt;
//     }
//     .image-div{
//         display:block;
//         width:100%;
//         height:30vh;
//         overflow:hidden;
//         border-radius: 15px 15px 0 0;
//     }
//     .image-div2{
//         display:none;
//     }
//     .text-div{
//         width:100%;
//     }
//     .image-div img{
//         min-height:100px;         
//         width: 100%;
//         max-width:100%;
//         height:30vh;
//         // max-height:100%;
//     }
//     .description{
//         display: block;
//     }
//     .order-btn{
//         text-align:center;
//     }
// }

// </style>