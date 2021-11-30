<template>

    <Header />
    <Topnavbar />
    <TrialExpiryNotification /> 
    <SubscriptionExpiryNotification /> 

    <div class="  mb-3  mx-auto slide-down">
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
                        Design your menu to reflect your business and your brand
                    </p>
                    <a href="" class="btn btn-lg ">Design</a>
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
                    <a href="" class="btn btn-lg btn-danger"> Settings</a>
                </div>
            </div> 
            <div class=" col-md-3 fade-in ">
                <div class="card-body  integrations">
                    <h3 >
                        Integrations
                    </h3>
                    <p>
                        Connect with the Payment, POS or Printer systems 
                    </p>
                    <a href="" class="btn btn-lg btn-success"> Integrate</a>
                </div>
            </div>          
        </div>

        <!-- banner section -->
        <div class=" banner row justify-content-center mx-1 py-5 " >
            <div class="card  page-banner px-3 py-5 text-white fade-in">            
                <div class="col-xs-8 ">          
                    <h2>
                        Try our contactless online ordering solution!
                    </h2>
                    <p>
                        Get started with FineDine Delivery & Pick-up Menu for online ordering with no excessive commission or use 
                        QR Menu for a contactless dine-in experience.
                          
                    </p>
                   <a href="#" class="p-2 btn btn-lg bg-white "> https://fndn.mn/antony-restaurant <span class="btn btn-sm border rounded">Copy link</span> </a>
               
                </div>
                <div class="col-xs-4">
                    <img src="" alt="">
                </div>
            </div>
        </div>

        <!-- feedback and recent orders section  -->
        <div class="row feedback px-2 py-3 feedback-recent my-2">
            <div class=" shadow col-md-6 p-3 mt-2 fade-in">
               <div class=" ">
                <h4>   Recent orders <span class="float-right btn small primary-btn-color border "> <a :href=" '/' + this.restaurant_name + '/orders/' + this.restaurant_id" class="text-white"> All oders</a> </span>        </h4>
                <div class="table-responsive">
                
                </div>
                </div>
            </div>

            <div class="  shadow col-md-6 p-3 mt-2 ">
                <div class="  ">
                    <h4> Feedback  <span class="float-right small btn primary-btn-color">All feedback</span>        </h4>
                    <div class="table-responsive">
                     
                    </div>
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
};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

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


/* media queries */
@media only screen and (max-width: 900px) {
  .top-cards .card-body{
      border-right:none !important;
}
.feedback .card{
    width:98%;
}
}

@media only screen and (max-width: 750px) {
//
}

@media only screen and (max-width: 650px) {
      .top-cards .card{
            display: block;
             width: 95%;
             
}
}

</style>

