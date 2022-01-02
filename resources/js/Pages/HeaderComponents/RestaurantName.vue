<template>

    <a class="btn desktop restaurant-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <small class="d-flex align-items-center  " > 
            <span v-if="authRestaurant"> {{authRestaurant.restaurant_name}}</span>
            &nbsp; <i class="bi bi-caret-down float-right  mt-1 mr-1"></i> 
        </small>            
    </a>
    <div class="row restaurant p-0 m-0 justify-content-center">
    <div class="nav-item dropdown m-1">        
       <a class="btn mobile restaurant-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <small class="d-flex align-items-center  " > 
            <span v-if="authRestaurant"> {{authRestaurant.restaurant_name}}</span>
            &nbsp; <i class="bi bi-caret-down float-right  mt-1 mr-1"></i> 
        </small>            
    </a>
        <div class="dropdown-menu rounded ribbon shadow mx-auto bg-white" aria-labelledby="navbarDropdown" > 
            <div class="ribbon-outer shadow bg-white">                
            <div class="row  justify-content-center p-2 bg-danger menu-bar rounded px-2 m-0 mb-3">  
                        <!-- toggle edit restaurant modal  -->
                <a href="#" class="res-top" data-toggle="modal" data-target="#exampleModalEditRestaurant" >
                    <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i>
                </a>
                 
                    <!-- toggle mobile menu  modal  -->
                <a href="#" class="res-top mobile-prev"  data-toggle="modal" data-target="#exampleModalEditmobileMenu"> <i class="bi bi-eye text-white"></i></a>
                
                 
                <!-- toggle qr code modal  -->
                <a href="#" class="res-top" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
                    <i class="bi bi-qr-code text-white"></i>
                </a>
                <!-- recent orders bell toggle  -->
                <a href="#" class="res-top" onclick="openFeedBack()">
                    <i class="bi bi-bell-fill text-white  recent-link" style="font-size: 1rem;font-weight: 300;">              
                        <span class="hovercard">
                            <span class="tooltiptext">
                            Track orders, requests and feedback.
                            </span>
                    </span></i>  
                </a>
            </div> 
            <div class="p-2">              
                <p class="d-flex justify-content-between px-2 " style="font-size:.9rem; color:#e3342f;">
                    <span class=""> <a href="#" class="text-decoration-none text-dark " > {{this.authRestaurant.restaurant_name}}</a> </span>
                    <span class=" mr-1"> <i class="bi bi-geo-alt-fill " ></i> </span> 
                </p>
                <!-- <div class="map text-center" id="map" style="min-width:5rem; min-height:10rem;"> map</div>
                <div class="row border-top p-1">               
                    <span class="col-sm-8">New venue  </span> 
                    <span class="col-sm-3"> <i class="bi bi-plus" style="font-size:15pt"></i></span>  
            </div> -->
           </div>
        </div>
        </div>
       
     </div>
</div>
     
</template>
<script>
import MobilePreview from './MobilePreview'
import RestaurantInformation from "./RestaurantInformation"
import QrCode from './QrCode'
export default {
    components:{
        RestaurantInformation,
        MobilePreview,
        QrCode,
        
    },
    data(){
        return{
            authRestaurant: '',
        }
    },
    mounted(){
        this.authRestaurant  = window.authRestaurant;
        // console.log("Restaurant is: ", authRestaurant);
    }

}
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";


     .restaurant-btn:hover, .restaurant-btn:hover:active {
        color: #fcfcfc;
        background-color:  #e91912; 
     }
     

     .restaurant-btn{
         background-color:  #c40a04;
         color:#fff;
         font-size: 1rem;
         border-radius: 50px;      
     }
 
    .res-top{
        width:20%;
        
    }
    .mobile{
    display:none;
    }

   .ribbon-outer{
                display:none;
            }
    .ribbon{
        width:300px;
        height:0px;

        }
      
        .desktop{
            display: inline-block;
        }

    @media only screen and (max-width: 950px) {
          .desktop{
            display:none
        }
        .mobile{
            display: inline-block;
        }
        .mobile-prev{
            display:none;
        }
            .ribbon-outer{
                display:block;
            }
            .ribbon{
                width:300px;
                height:0px;
                }
        }
    @media only screen and (max-width: 600px) {
      
        .restaurant-btn{
        width:100%;
         background-color:  #c40a04;
         color:#fff;
         font-size: .7rem;
         border-radius: 17px; 
         padding:5px !important;   
          
     }
        .restaurant-btn:hover, .restaurant-btn:hover:active{
         background-color:  #e60800;
         border: 1px solid  #ff0800;
         color:#fff;
         font-size: .75rem;
         border-radius: 20px; 
         padding:5px !important;   
          
     }
        }
     
 
</style>