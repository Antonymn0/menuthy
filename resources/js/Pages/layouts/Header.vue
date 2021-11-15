<template >
    <div class="mobile-menu" id="mobile-menu">
        <MobileNav />
    </div>

    <div class="row  text-white page-header browser-menu" id="browser-menu">
        <div class=" col-md-10 row">
            <div class="row  ">
                <p class="col-md-4 ">
                     <img src="images/menuthy_logo_i.png" class="mx-auto my-auto img-fluid" alt="image-logo" style="width:100%; height:auto; margin:auto"> 
                </p>
                <div class="row col-sm-8 justify-content-center p-2">
                    <RestaurantName class="col-sm-5" />
                    <div class="col-md-4 p-0 m-0 justify-content-center pt-3"> 
                        <a href="#" class="p-1" data-toggle="modal" data-target="#exampleModalEditRestaurant" >
                            <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i>
                        </a>
                        <a href="#" class="p-1"> <i class="bi bi-lightning-fill text-white"></i></a> 
                        <a href="#" class="p-1" data-toggle="modal" data-target="#exampleModalEditmobileMenu"> <i class="bi bi-eye text-white"></i></a>
                         <a href="" class="p-1" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
                            <i class="bi bi-qr-code text-white"></i>
                        </a>
                    </div>
                </div>                
            </div>   
        </div>           
        <div class="col-md-2 float-right text-left">
            <span>Jon Doe </span>  
            <span class="rounded-circle ml-2 "><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
        </div>        
    </div>
    <div class="row d-none">        
        <div class="row col-sm-5 align-items-center">
            <RestaurantInformation class="col-sm-2"/>            
            <MobileMenu class="col-sm-2"/>
            <QrCode class="col-sm-2"/>
        </div>
    </div>
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import RestaurantInformation from "../HeaderComponents/RestaurantInformation";
import MobileMenu from "../HeaderComponents/MobileMenu";
import QrCode from "../HeaderComponents/QrCode";
import MobileNav from "../HeaderComponents/MobileNav";
export default {
    components:{
        RestaurantName,
        RestaurantInformation,
        MobileMenu,
        MobileNav,
        QrCode,
    }
}
</script>
<style lang='scss'>
@import "../../../sass/app.scss";



    /* On smaller screens, where width is less than 950px, hide browser menu */
@media screen and (max-width: 950px) {
    .browser-menu{
        display:none;
    }
 }
</style>