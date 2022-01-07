<template >

    <header>
        <!-- --------- components ------ -->  
            <TrialExpiryNotification /> 
            <SubscriptionExpiryNotification /> 
            <EmailNotConfirmedNotification />
            <RestaurantInformation />            
            <MobilePreview />
            <QrCode @passQrCodeToParent="passQrCodeToDashboard($event)"/>
            <MobileNav />
            <Feedback />       
            <Profile />
    
    <!-- --------------header---------------------------- -->
    <div class="parent-header  px-5">

        <div class="main-right "> 
            <a href="/dashboard" class="float-left" >
                <img :src="'/images/menuthy_logo_i_a.png'" class="mx-auto my-auto img-fluid " alt="image-logo" style="width:250px; height:auto; "> 
            </a>
        
        <!-- ----------------------------middle---------------------------------------- -->
        <div class="float-left"> 
            <div class="middle-header float-left">
                <div class="res-name p-0"> 
                    <RestaurantName  />
                </div>
                <div class="other-icons pl-2"> 
                    <a href="#" class="p-1" data-toggle="modal" data-target="#exampleModalEditRestaurant" >
                        <i class="bi bi-gear-fill text-white recent-link" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info">
                            <span class="hovercard">
                                <span class="tooltiptext">
                                Update restaurant information.
                                </span>
                            </span>
                        </i>
                    </a>
                
                    <a href="#" class="py-1 px-2 recent-link" data-toggle="modal" data-target="#exampleModalEditmobileMenu"> <i class="bi bi-eye text-white">
                            <span class="hovercard">
                                <span class="tooltiptext">
                                Preview your menu.
                                </span>
                            </span>
                        </i></a>
                    <a href="" class="p-1" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
                        <i class="bi bi-qr-code text-white recent-link">
                            <span class="hovercard">
                                <span class="tooltiptext">
                                Display QR code for logging in into mobile menu.
                                </span>
                            </span>
                        </i>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <!-- ----------------------------------------user--------------------------------------------- -->
        <div class=""> 
            <p class="d-flex justify-content-center align-items-center"> 
            
            <!-- tootip + tooltip -->
            <span class="float-left ">
                <a href="#" class="" onclick="openFeedBack()">
                <i class="bi bi-bell-fill text-white mr-5 recent-link" style="font-size: 1rem;font-weight: 300;">              
                    <span class="hovercard">
                        <span class="tooltiptext">
                        Track orders, requests and feedback.
                        </span>
                    </span></i>  
                </a> 
            </span>           
                <a style="font-size: 1rem;font-weight: 300; text-decoration:none;" class="user-div  text-white pr-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">  
                    <span class=" mr-3">{{authUser.first_name}} </span>  
                    <img  v-if="authUser.image"  :src="authUser.image"  alt="profile-image" class="rounded-circle mr-5" style="width:50px; height:50px; object-fit:cover; ">
                    <span v-else class="rounded-circle ml-2 " ><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
                </a>             
            
            <ul class="dropdown-menu   pb-0 mb-0" aria-labelledby="navbarDropdown">
                <li data-toggle="modal" data-target="#profile"><a class="dropdown-item" href="#" >User Profile</a></li>                
                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModalEditRestaurant" > Restaurant Info</a></li>
                <!-- <li><a class="dropdown-item" href="#">Settings</a></li> -->
                <li class="dropdown-item  border-top px-2">
                    <form action="/logout" method="POST" enctype="multipart/form-data">
                        <div class="ml-2">
                            <input type="hidden" name="_token" :value="csrf">    
                            <button type="submit" class="btn-danger mx-auto"> 
                            <i class="bi bi-box-arrow-left pr-1"></i> 
                                Logout
                        </button>
                        </div>                        
                    </form>                     
                </li>
            </ul> 
            </p>
        </div>
        <!-- -------------------------------------------------------------------------- -->
    </div>
</header> 
 
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import RestaurantInformation from "../HeaderComponents/RestaurantInformation";
import MobilePreview from "../HeaderComponents/MobilePreview";
import QrCode from "../HeaderComponents/QrCode";
import MobileNav from "../HeaderComponents/MobileNav";
import Profile from "../Profile/Profile";
import TrialExpiryNotification from "../Notifications/TrialExpiryNotification";
import SubscriptionExpiryNotification from "../Notifications/SubscriptionExpiryNotification";
import EmailNotConfirmedNotification from "../Notifications/EmailNotConfirmedNotification";
import Feedback from "../Feedback/Feedback";

export default {
    data(){
        return{
            authUser: window.authUser,  // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
        }
    },
    components:{
        RestaurantName,
        RestaurantInformation,
       SubscriptionExpiryNotification, 
        TrialExpiryNotification,
        EmailNotConfirmedNotification,
        MobilePreview,
        Profile,
        MobileNav,
        QrCode,
        Feedback,
    },
    created() {
        // console.log(this.authUser);
    },
    methods:{
        passQrCodeToDashboard(qrCode){
            this.$emit('passQrCode',qrCode);
        },
        logout(){
             this.$inertia.visit('/logout');
        }
    },
    mounted(){
        //
    }
}
</script>

<style lang='scss'>
@import "../../../sass/app.scss";
@import url('https://fonts.googleapis.com/css?family=Poppins');

.parent-header{
    font-family: Poppins !important;
    font-size: 1rem;
    background: #2c2d3a;
    height:120px;
    display:flex;
    align-items: center;
    justify-content:space-between;
    border-bottom: 1px solid rgba(39, 39, 39, 0.63);
}
  
.dropdown-menu:hover .dropdown-item:hover{
     display: block; 

     }
.main-right{
    width:65%;
    display: flex;
    align-items: center;
}
.middle-header{
    padding-top:.2rem;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content:flex-start;
}
.user-div{
    font-size: 1rem;
    display:flex; 
    align-items: center;
}

//tooltip
.recent-link {
  position: relative;

}
.hovercard { 
  position: absolute; 
  display:none;
  opacity: 0; 
  z-index: 5;
  left: 50%;
  top: 30px;
  transform: translateX(-50%);
}

.recent-link:hover .hovercard { 
    display:block;
  opacity: 1; 
  transition: 0.5s;  
  transition-delay: 0.1s;
}
.tooltiptext {
font-family: Poppins !important;
  display: flex; 
  flex-direction: column; 
  justify-content: flex-start; 
  background-color: #fff;
  padding: 13px; 
  text-align: center;
  font-weight: bold;
  font-style: normal;
  border-radius:35px;
  color: rgb(102, 100, 100); 
  line-height: 18px;
  transition: 1s;
  width: 180px;
}


    /* On smaller screens, where width is less than 950px, hide browser menu */
@media screen and (max-width: 950px) {
    
    .parent-header{
        display:none;
    }
    .logo{
        padding-left:0;
        margin-left:0;
    }
 }
</style>