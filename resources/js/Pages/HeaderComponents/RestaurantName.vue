<template>
<div class="row restaurant p-0 m-0 justify-content-center">
    <div class="nav-item dropdown m-1">
        <a class="btn btn-lg btn-default restaurant-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
         <small> {{authRestaurant.restaurant_name}} &nbsp; <i class="bi bi-caret-down float-right pt-2 "></i>  </small> 
           
        </a>
        <div class="dropdown-menu rounded ribbon modal-lg" aria-labelledby="navbarDropdown" style="width:90%; margin:auto">                
            <div class="row  justify-content-center p-2 bg-danger rounded px-2 m-0 mb-3">  
                        <!-- toggle edit restaurant modal  -->
                <a href="#" class="res-top" data-toggle="modal" data-target="#exampleModalEditRestaurant" >
                    <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i>
                </a>
                 <!-- publish changes  -->
                <a href="" class="res-top"> <i class="bi bi-lightning-fill text-white"></i> </a>
                    <!-- toggle mobile menu  modal  -->
                <a href="#" class="res-top"  data-toggle="modal" data-target="#exampleModalEditmobileMenu"> <i class="bi bi-eye text-white"></i></a>
                
                 
                <!-- toggle qr code modal  -->
                <a href="" class="res-top" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
                    <i class="bi bi-qr-code text-white"></i>
                </a>
            </div> 
            <div class="p-2">              
                <p class="row justify-content-center p-" style="font-size:1.2rem; color:#e3342f;">
                <span class="col-sm-8"> <a href="#" class="text-decoration-none text-dark " > {{authRestaurant.restaurant_name}}</a> </span>
                <span class="col-sm-4"> <i class="bi bi-geo-alt-fill " ></i> </span> 
                </p>
                <div class="map text-center" id="map" style="min-width:5rem; min-height:10rem;"> map</div>
                <div class="row border-top p-1">               
                    <span class="col-sm-8">New venue  </span> 
                    <span class="col-sm-3"> <i class="bi bi-plus" style="font-size:15pt"></i></span>  
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
            authRestaurant: window.authRestaurant,
        }
    },
    mounted(){
        console.log("Restaurant is: ", authRestaurant);
    }

}
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";

 .restaurant{

     .restaurant-btn{
         color: $primary-button;        
     }
     .restaurant-btn:hover{
         background-color: $primary-button;  
         color:#fff;
         border-radius: 50px;      
     }
     .ribbon{
         .res-top{
             width:20%;
             
         }
     }
 }
</style>