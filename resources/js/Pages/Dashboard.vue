<template>
<div class=""> 
    <Header @passQrCode="updateQrCode($event)"/>
    <Topnavbar />

</div>
    <div class="  mb-1  mx-auto slide-down">
        <div class="row top-cards mx-auto shadow mt-5 pt-4">
            <div class=" col-md-3 fade-in ">
                <div class="card-body border-right edit-menu">
                    <h3 style="">
                        Edit your menu
                    </h3>
                    <p>
                        Create new menus, add or edit your items and sections in your menus
                    </p>
                    <a href="/menus" class="btn btn-lg  mx-auto text-center"> Menus</a>
                </div>
            </div>
            <div class=" col-md-3 fade-in">
                <div class="card-body border-right change-theme">
                    <h3 >
                        Change  theme
                    </h3>
                    <p>
                        Design your menu to reflect your business and your brand colors
                    </p>
                    <a href="#" class="btn btn-lg disabled ">Design</a>
                </div>
            </div> 

        
            <div class="  col-md-3 fade-in ">
                <div class="card-body border-right settings">
                    <h3 >
                        Menu settings
                    </h3>
                    <p>
                        Set up all the details of your menu to fit it in your business
                    </p>
                    <a href="#" class="btn btn-lg btn-danger disabled"> Settings</a>
                </div>
            </div> 
            <div class=" col-md-3 fade-in ">
                <div class="card-body  integrations">
                    <h3 >
                        Integrations
                    </h3>
                    <p>
                        Connect with online Payment services, POS or Printer systems 
                    </p>
                    <a href="#" class="btn btn-lg btn-success disabled"> Integrate</a>
                </div>
            </div>          
        </div>
        <!-- banner section -->
        <div class=" banner row justify-content-center px-3 py-5 " >
            <div class=" row page-banner px-3 pt-2 text-white fade-in ">            
                <div class="col-md-8 float-left my-auto py-4">          
                    <h1  style="font-size: 2.5rem;">
                        Try our contactless online ordering solution!
                    </h1>
                    <p style=" max-width: 470px;">
                        Get started with Menuthy Delivery & Pick-up Menu for online ordering with no excessive commission or use 
                        QR Menu for a contactless dine-in experience.                          
                    </p>
                   <p class="p-2 btn btn-lg bg-white ">
                       <span>menuthy/{{this.restaurant.restaurant_name}} </span> 
                       <span class="btn btn-sm border rounded" @click.prevent="copyToClipboard(this.qr_code)">Copy link</span> 
                        <span class="text-success" v-if="this.link_copied"> <small> Copied!</small> </span> 
                    </p>

                </div>
                <div class="col-sm-4 float-right d-flex">
                    <img src="/images/banner.png" alt="" class="float-right img-fluid">
                </div>
            </div>
        </div>

    </div>

<Footer />

</template>

<script>

import Header from "./layouts/Header";
import Topnavbar from "./layouts/Topnavbar";
import Footer from "./layouts/Footer";
import TrialExpiryNotification from "./Notifications/TrialExpiryNotification";
import SubscriptionExpiryNotification from "./Notifications/SubscriptionExpiryNotification";


export default {
    props: {
    //

    },
    components: {
    Header,
    Topnavbar,
    Footer,
    SubscriptionExpiryNotification, 
    TrialExpiryNotification,
    },

    data(){
        return{
            qr_code:'qrCode',
            link_copied:false,
            restaurant: window.authRestaurant,
        }
    },
    methods:{
       updateQrCode(qrcode) {
           this.qr_code = qrcode;
       },
       copyToClipboard(text){
           navigator.clipboard.writeText(text);
           this.link_copied = true;
           setTimeout(() => {
               this.link_copied = false;
           }, 5000);
       }
       
    }


};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

h3{
    font-family:poppins;
    font-weight:500;
    color: #575962;
    font-size: 1.1rem;
}

.slide-down{
    width:90%;
    margin-left:auto;
    margin-right:auto;
    
}

.top-cards {
    color: #9699a2;
    flex-direction: row;
    width:100%;
}
.top-cards p {
    font-size: 1rem;
    font-weight: 300;
}
.top-cards h2{
        font-weight: 600;
}
.top-cards .fade-in{
    float:left;
}
.feedback .card{
    width:49%;
}

.edit-menu h3{
    color:#d1120c;
}
.edit-menu a{  
    background: #d1120c;   
    color: #ffffff;    
}
.top-cards p{
    padding-bottom:2.5rem;
    
}
.top-cards a{
    font-family: Poppins;
    font-style: normal;
    font-weight: 600;
    font-size: 13px;
    line-height: 19px;
     border: none;
    border-radius: 4px;
      min-width: 100px;
    padding: 10px;
    height: 40px;
  
}
.edit-menu a:hover{
    background: #ffffff;
    border: 1px solid #d1120c;
    color: #d1120c;
}
.change-theme a{
    min-width: 100px;
    padding: 10px;
    height: 40px;
    background: #2f4d6e;
    border: none;
    border-radius: 4px;
    color: #ffffff;
    font-family: Poppins;
    font-style: normal;
    font-weight: 600;
    font-size: 13px;
    line-height: 19px;
}
.change-theme a:hover{
    background: #ffffff;
    border: 1px solid #2f4d6e;
    color: #2f4d6e;;
}
.change-theme h3{
    color: #2f4d6e;;
}

.settings a:hover{
    background: #ffffff;
    border: 1px solid #f3950e;
    color: #f3950e;
}
.settings h3{
    color: #f3950e;
}

.settings a{  
    background: #f3950e;  
    color: #ffffff;    
}
.integrations a{  
    background: #43ab92; 
    color: #ffffff;    
}

.integrations a:hover{
    background: #ffffff;
    border: 1px solid #43ab92; 
    color: #43ab92; 
}
.integrations h3{
    color: #43ab92; 
}

.feedback-recent h4{
    font-size: 1.1rem;
}
.feedback-recent .btn{
    color: #fff;
    background-color: #d1120c;
    border-color: #d1120c;
    border-radius: 60px;
}
.feedback-recent .btn:hover{
    color: #fff;
    background-color: #ff0800;
    border-color: #ff0800;
}
.page-banner img{
    align-self: flex-end;
  min-width:100%;
}


/* media queries */
@media only screen and (max-width: 950px) {
  .top-cards .card-body{
      border-right:none !important;
      border-bottom: 1px solid rgb(228, 227, 227);
      padding:0;
      padding:1rem;
      padding-left:0;
      padding-right:0;
      width:100%;
      height:100%;
    }
    .feedback .card{
        width:98%;
    }
}

@media only screen and (max-width: 750px) {
 .top-cards .card-body{
        border-bottom: 1px solid rgb(228, 227, 227);
    }
    .banner .float-right{
        display:none;
    }
    .banner .float-left{
        width:100% ;
        padding:0;
    }
}

@media only screen and (max-width: 600px) {
     .slide-down{
         width:95%;
     }
      .top-cards .card{
            display: block;
            width: 95%;
                         
}
      .top-cards .card-body{
           padding-left: 1rem;
                         
}
      .top-cards .col-md-3{
            display: block;
             width: 100%; 
             margin:0;
             padding:0;
                    
}

}

</style>

