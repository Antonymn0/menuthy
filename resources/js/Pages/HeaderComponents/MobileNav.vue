<template>
    <div class="mobileNav border-bottom">
        <div class="row text-center ">
            <div class="logo p-2 img-fluid row justify-content-center">
                <img src="images/artboard.png" alt="menuthy-logo" class="img-fluid">
            </div>
            <div class="right-div p-2 row">
                <div class="resName"> 
                    <RestaurantName /> 
                </div>
                <div class=" row align-items-center justify-content-center burger-icon"> 
                 <div id="mySidenav" class="sidenav">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">Reports</a>
                            </li>
                           
                            <li class="nav-item">
                                <a class="nav-link" href="/menus">Menus</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Orders
                                 </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Orders</a></li>
                                <li><a class="dropdown-item" href="#">Tables</a></li>
                                <li><a class="dropdown-item" href="#">Waiters</a></li>
                                <li><a class="dropdown-item" href="#">Modifiers</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
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
                        </ul>
                    </div>

                    <!-- Use any element to open the sidenav -->
                    <span onclick="openNav()"><i class="bi bi-list text-white " style="font-size:1.5rem"></i></span>
                         
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";

export default {
    components:{
        RestaurantName,
    
    },
    methods:{

    }
}
</script>

<style lang="scss" scoped>

    .mobileNav{
        background-color:#2c2d3a;
        padding:5px;
        display:none;
        .logo{
            width:20%;
            padding:5px;
            img{
                max-width:80%;
                height:auto;
            }
        }
        .right-div{
            width:60%;
            float:right;

            .resName{
                width:80%;

            }
            .burger-icon{
                width:20%;
                float:right;
            }
        }
    }
   

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  right: -1rem;
  background-color: #fff;
  color:#1f2027; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
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


//media querries
@media screen and (max-width: 950px) {
  .mobileNav{
     display:block;
  } 
}
@media screen and (max-width: 450px) {
   .mobileNav .logo{
      width:30%;
      padding-left :20px;
       img{     
        max-width:100%;
        height:auto;  
    }
  }
}
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (min-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}

</style>