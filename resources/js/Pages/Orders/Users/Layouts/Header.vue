<template>
     <header>
    <!-- --------- components ------ -->      
        <EmailNotConfirmedNotification />
        <Profile />

    <!-- --------------header---------------------------- -->
    <div class="parent-header  px-5">
        <div class="main-right "> 
            <a href="#" class="float-left" >
                <img :src="'/images/menuthy_logo_i_a.png'" class="mx-auto my-auto img-fluid " alt="image-logo" style="width:250px; height:auto; "> 
            </a>        
        <!-- ----------------------------middle---------------------------------------- -->
        <div class="float-left"> 
            <div class="middle-header float-left">
                <div class="res-name p-0"> 
                    <RestaurantName  />
                </div>
                <div class="other-icons pl-2">  
                  
                </div>
            </div>
        </div>
        </div>
        <!-- ----------------------------------------user--------------------------------------------- -->
        <div class=""> 
            <p class="d-flex justify-content-center align-items-center">            
             
                <a style="font-size: 1rem;font-weight: 300; text-decoration:none;" class="user-div  text-white pr-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">  
                    <span class=" mr-1">{{this.authUser.first_name}} </span>  
                    <img  v-if="this.authUser.image"  :src="this.authUser.image"  alt="profile-image" class="rounded-circle mr-5" style="width:50px; height:50px; object-fit:cover; ">
                    <span v-else class="rounded-circle ml-2 " ><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
                </a>             
            
            <ul class="dropdown-menu   pb-0 mb-0" aria-labelledby="navbarDropdown">
                <li data-toggle="modal" data-target="#profile"><a class="dropdown-item" href="#" >User Profile</a></li> 
                <li class="dropdown-item  border-top px-2">
                    <form action="/logout" method="POST" enctype="multipart/form-data">
                        <div class="ml-2">
                            <input type="hidden" name="_token" :value="this.csrf">    
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
import RestaurantName from "../../../HeaderComponents/RestaurantName";
import EmailNotConfirmedNotification from "../../../Notifications/EmailNotConfirmedNotification";
import Profile from "../../../Profile/Profile";
export default {
    components:{
        RestaurantName,
        EmailNotConfirmedNotification,
        Profile,
    },
    data(){
        return{
            authUser: window.authUser,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
        }
    },
}
</script>

<style lang='scss'>
@import "../../../../../sass/app.scss";
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
    
   
    .main-right img{
        max-width:150px; 
        height:auto;
    }
    .px-5{
        padding-left: 5px !important;
        padding-right: 5px !important;
    }
    .logo{
        padding-left:0;
        margin-left:0;
    }
 }
</style>