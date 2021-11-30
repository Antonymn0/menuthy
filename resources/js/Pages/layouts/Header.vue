<template >
    <!-- --------- components ------ -->   
        <RestaurantInformation />            
        <MobilePreview />
        <QrCode />
        <MobileNav />
       
        <Profile />
   
<!-- --------------header---------------------------- -->
<div class="parent-header  px-5">

    <div class="main-right "> 
         <a href="/dashboard" class="float-left" >
            <img :src="'/images/menuthy_logo_i_a.png'" class="mx-auto my-auto img-fluid pl-4" alt="image-logo" style="width:250px; height:auto; "> 
        </a>
    
    <!-- ----------------------------middle---------------------------------------- -->
    <div class="float-left"> 
        <div class="middle-header float-left">
            <div class="res-name p-0"> 
                <RestaurantName  />
            </div>
            <div class="other-icons"> 
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
    <!-- ----------------------------------------user--------------------------------------------- -->
    <div class=""> 
         <a style="font-size: 1rem;font-weight: 300;" class=" user-div text-white pr-5" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span> <i class="bi bi-bell-fill text-white mr-3" style="font-size: 1rem;font-weight: 300;"></i></span>
            <span class=" pr-1">{{authUser.first_name}} {{authUser.last_name}}</span>  
            <img  v-if="authUser.image"  :src="authUser.image"  alt="profile-image" class="rounded-circle" style="width:50px; height:50px;">
            <span v-else class="rounded-circle ml-2 " ><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
        </a>
        <ul class="dropdown-menu pb-0 mb-0" aria-labelledby="navbarDropdown">
            <li data-toggle="modal" data-target="#profile"><a class="dropdown-item" href="#" >Profile</a></li>
                
            <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModalEditRestaurant" > Restaurant</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
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
    </div>

    <!-- -------------------------------------------------------------------------- -->
</div>


   
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import RestaurantInformation from "../HeaderComponents/RestaurantInformation";
import MobilePreview from "../HeaderComponents/MobilePreview";
import QrCode from "../HeaderComponents/QrCode";
import MobileNav from "../HeaderComponents/MobileNav";
import Profile from "../Profile/Profile";


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
       
        MobilePreview,
        Profile,
        MobileNav,
        QrCode,
    },
    created() {
        // console.log(this.authUser);
    },
    methods:{
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

.parent-header{
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
}
.middle-header{
    display:flex; 
    align-items: center;
    justify-content:flex-start;
}
.user-div{
    display:flex; 
    align-items: center;
}


    /* On smaller screens, where width is less than 950px, hide browser menu */
@media screen and (max-width: 950px) {
    .parent-header{
        display:none;
    }
 }
</style>