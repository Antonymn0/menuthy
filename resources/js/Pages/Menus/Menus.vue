<template>
    <Header />
    <Topnavbar />
    
    <div class=" p-5  mb-5">   
        <h3 class="mt-4">Menus</h3>
        <div class="row pr-0 ">
            <div class="menu-card p-0  p-1">  
                <div class="card p-1  text-center">
                    <div class="p-3 cursor-pointer" style="background-color:#efeff3; cursor: pointer;">                        
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#">Add</a></li>
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#">Delete</a></li>                   
                        </ul>
                        <!-- <img src="" alt="menu-image"> -->
                        <a href="/sub-menu">
                             <i class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:6.5rem; color:#999; "></i>
                        </a>
                       
                    </div>
                    <div class="row m-1 p-1 w-100">
                        <h4 class="p-0" style="width:75%; float:left">
                            Breakfast menu
                        </h4>
                        <div class=" custom-control custom-switch" style="width:25%; float:right">
                            <label class="switch">
                                <input type="checkbox" class="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                    
                    <p> 5 items  </p>
                    <p>  Nov 9, 2021  </p>  
                                     
                </div>
            </div>      
           
                <!-- add menu box  -->
            <div class="menu-card p-0  p-1  align-middle rounded">  
                <div class=" p-2  text-center " style="border: 2px dashed #999; ">
                   <div class=" m-0">
                       <a href="" data-toggle="modal" data-target="#exampleModal">
                           <i class="bi bi-plus p-0 m-0 " style="font-size:6rem; color:#999;" ></i>
                        </a> 
                    </div>
                    <a href="" class="btn btn-default" data-toggle="modal" data-target="#exampleModal">Add menu </a>                    
                </div>
            </div>
            

            <!-- add Menu modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="exampleModalLabel">Add new menu</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Menu name</label>
                                <input type="text" class="form-control p-4" id="exampleFormControlInput1" placeholder="menu name here...">
                            </div>
                        
                            <div class="form-group">
                                <label for="maneu-name">Description</label>
                                <textarea name="description" class="form-control p-3" id="" cols="10" rows="5">Describe the menu</textarea>
                            </div>
                            <div class="modal-footer text-center mx-auto">
                                <button type="button" class="btn primary-btn ">Save changes</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                    
                    </div>
                </div>
            </div>     
                     
        </div>
    </div>

    <Footer />
</template>

<script>

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";

export default {
  props: {
    //
  
  },
  components: {
  Header,
  Topnavbar,
   Footer

  },
};
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";
.primary-btn{
    background-color: #e6034b;
    color: #fff;
}

.btn:hover, .btn:active{
    background-color: #e6034b;
   color: #fff;
}
.menu-card{
    width:24%;
    height:auto;
    max-width:98%;
    margin: .5rem .1rem;
}
.menu-dots{
    position: absolute;
    right: 5px;
    padding: 5px;
}

/* The switch - the box around the slider */
.switch {
  position: absolute;
  right:0;
  top:0;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: $red;
}

input:focus + .slider {
  box-shadow: 0 0 1px $red;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

/* media quesries */
@media only screen and (max-width: 900px) {
  .menu-card{
      width:30%;
  }
}
@media only screen and (max-width: 750px) {
  .menu-card{
      width:50%;
  }
}
@media only screen and (max-width: 600px) {
  .menu-card{
      width:100%;
  }
}

</style>
