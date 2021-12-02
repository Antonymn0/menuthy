<template >
    <div class="top-navbar browser-menu ">
        <p>
            <nav class="navbar navbar-expand-lg py-0  ">
                <div class="container-fluid">
                    <button class="navbar-toggler pull-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                 
                    <div class="collapse navbar-collapse p-1" id="navbarSupportedContent">                    
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">                           
                            <li class="nav-item">
                               <a class="nav-link" href="/admin">Super admin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="/dashboard">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/menus">Menus</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Orders
                                 </a>
                            <ul class="dropdown-menu pr-3 ml-0 pl-0" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" :href=" '/' + this.restaurant_name + '/orders/' + this.restaurant_id"> <i class="bi bi-cart-check pr-1"></i> Orders</a></li>
                                <!-- <li><a class="dropdown-item" href="#"><i class="bi bi-record-circle pr-1"></i>Tables</a></li>
                                <li><a class="dropdown-item" href="#"> <i class="bi bi-people pr-1"></i>Waiters</a></li> -->
                               
                            </ul>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">Design</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">Reports</a>
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
                                <a class="nav-link  p-0 m-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="bi bi-three-dots" style="font-size: 1.5rem;"></i>
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
                        <!-- <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-danger text-white" type="submit">Search</button>
                        </form> -->
                    </div>
                </div>
            </nav>
        </p>
    </div>
</template>

<script>
export default {
    data(){
        return{
                restaurant_name: window.authRestaurant.restaurant_name.toLowerCase().replace(/ /g,"-"),
                restaurant_id: window.authRestaurant.id,
        }
    },
}
</script>

<style scoped lang="scss">
.browser-menu{
    background: #262734;

}

.browser-menu a{
    text-decoration:none;
    color: #9699a2;
}
.browser-menu .navbar{
    padding-left:2.3rem;
    width:80%;
    text-decoration:none;
    color: #9699a2;
}

.navbar .nav-item:hover .dropdown-menu{
     display: block; 

     }

.active{
    color:#fff !important;
}


    ul li{
        padding:.8rem;
        font-size: 14pt;
    }
    ul li a:hover{
        color:#fff;
    }
    
    .dropdown li a:hover{
      color:#d1120c;
      background: none;
    }


// media queries
@media only screen and (max-width: 990px) {
    .browser-menu{
        display:none;
    }
}


</style>