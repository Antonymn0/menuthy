<template>


<div class="parent-nav bg-dark  py-2">
    <div class="logo">
        <img src="/images/white_logo.svg" alt="menuthy-logo" class="img-fluid" >
    </div>
    <div>
        <RestaurantName />         
    </div>
    <div>
        <span onclick="openNav()"><i class="bi bi-list text-white " style="font-size:1.5rem; margin-right:1rem"></i></span>
        <div id="mySidenav" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link "  href="/dashboard">Dashboard</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="/menus">Menus</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Orders
                            </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" :href=" '/' + this.restaurant_name + '/orders/cashier/' + this.restaurant.id"> <i class="bi bi-cart-check pr-1"></i> Cashier</a></li>
                        <li><a class="dropdown-item" :href=" '/' + this.restaurant_name + '/orders/kitchen/' + this.restaurant.id"> <i class="bi bi-cart-check pr-1"></i> Kitchen</a></li>
                                
                                
                    </ul>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Design</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Feedback
                            </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Survey forms</a></li>
                        <li><a class="dropdown-item" href="#">Survey results</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Reports</a>
                    </li>
                        <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="#">Settings</a>
                    </li>
                    <li class="nav-item dropdown m-1">
                        <a class="nav-link  p-0 m-0 " href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots pl-2" style="font-size: 1.5rem; "></i>
                            </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Campaigns</a></li>
                            <li><a class="dropdown-item" href="#">Info page</a></li>
                            <li><a class="dropdown-item" href="#">Devices</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Integrations</a></li>
                        </ul>
                    </li>  
                    <li class="dropdown-item  pt-2">
                        <form action="/logout" method="POST" enctype="multipart/form-data">
                            <div class="ml-2 border-top pt-2">
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
        </div>
    </div>

   
    
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";

export default {
    props:[],
    data(){
        return{
            authUser: window.authUser,  // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
            restaurant: window.authRestaurant,
            restaurant_name:   window.authRestaurant.restaurant_name.toLowerCase().replace(/ /g,"-"),
        }
    },
    components:{
        RestaurantName,
    
    },
    methods:{

    }, 
    mounted(){
        //
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins');

 .parent-nav{
     display:none;
     padding-left: 3%;
     padding-right:3%;
 }
  

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 10; /* Stay on top */
  top: 0; /* Stay at the top */
  right:0;
  right: -1rem;
  background-color: #fff;
  color:#1f2027; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  padding-right: 10px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 18px;
  color: #818181;
  display: block;
  transition: 0.3s;
  font-family: Poppins ;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #645d5d;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: -70px;
  font-size: 36px;
  margin-left: 50px;
}
i{
    margin-right: 3rem;
}

//media querries
@media screen and (max-width: 950px) {
 .parent-nav{
     font-family:Poppins;
     color:#9699a2;
    display:flex;
    align-items: center;
    justify-content:space-between;

}

    .logo img{
        padding-left: .5rem;
        width:120px;
        height:70px;
    }
}


</style>