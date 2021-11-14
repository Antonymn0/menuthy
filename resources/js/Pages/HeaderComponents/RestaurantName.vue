<template>
<div class="row restaurant p-0 m-0 justify-content-center">
    <div class="nav-item dropdown m-1">
        <a class="btn btn-lg btn-default restaurant-btn" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Restaurant name  
          <i class="bi bi-caret-down float-right"></i> 
        </a>
        <div class="dropdown-menu rounded p-3 " aria-labelledby="navbarDropdown" style="width:50%;">
            <p class="row justify-content-center" style="font-size:1.2rem; color:#e3342f;">
              <span class="col-sm-8"> <a href="#" class="text-decoration-none text-dark " > Jon Doe Restaurant</a> </span>
              <span class="col-sm-4"> <i class="bi bi-geo-alt-fill " ></i> </span> 
            </p>
            <div class="map" id="map" style="min-width:5rem; min-height:10rem;"> map</div>
            <div class="row border-top p-1">               
                 <span class="col-sm-8">New venue  </span> 
                 <span class="col-sm-3"> <i class="bi bi-plus" style="font-size:15pt"></i></span>  
           </div>
        </div>
     </div>
</div>
     
</template>
<script>
export default {
    
}
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";

 .restaurant{

     .restaurant-btn{
         color: $primary-button;        
     }
     .restaurant-btn:hover{
         background-color: $primary-button;  
         color:#fff;
         border-radius: 50px;      
     }
 }
</style>