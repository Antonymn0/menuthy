<template >
    <div class=" py-3 text-white page-header">
        <div class="row ml-1">
            <div class="row col-sm-9 p-1">
                <h3 class="col-sm-4">
                    <!-- <img src="{{ dynamic_asset('images/menuthy_logo_i.jpg') }}" alt=""> -->
                    Menuthy
                </h3>
                <div class="row col-sm-8 justify-content-center p-2">
                    <RestaurantName class="col-sm-4" />
                    <div class="row col-sm-5 align-items-center">
                        <RestaurantInformation class="col-sm-2"/>
                        <div class="col-sm-2 p-0 m-0"> <i class="bi bi-lightning-fill text-white"></i> </div>
                        <MobileMenu class="col-sm-2"/>
                        <QrCode class="col-sm-2"/>
                    </div>
                   
                </div>               
               
            </div>           
           <div class="col-sm-3 float-right text-left">
              <span>Jon Doe </span>  
               <span class="rounded-circle ml-2 "><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
           </div>
        </div>
    </div>
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import RestaurantInformation from "../HeaderComponents/RestaurantInformation";
import MobileMenu from "../HeaderComponents/MobileMenu";
import QrCode from "../HeaderComponents/QrCode";
export default {
    components:{
        RestaurantName,
        RestaurantInformation,
        MobileMenu,
        QrCode,
    }
}
</script>
<style lang='scss'>
@import "../../../sass/app.scss";

</style>