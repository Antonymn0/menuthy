<template>
    <Header />
    <Topnavbar />    
    <div class=" p-5 parent-container mx-auto mb-5">   
        <div class="badge bg-success " v-if="success">
            {{success}}
        </div>
        <div class="badge bg-danger px-5 py-2   " v-if="pageErrors">
            {{pageErrors}}
        </div>
        <p class="text-right m-0"> <a href="#" class="btn btn-danger" onclick="history.back()"><i class="bi bi-chevron-left"></i> Back</a></p>
           
         <p class="mt-4 small"> <a href="/menus">Menu </a>  <i class="bi bi-chevron-right p-0 m-0"></i> <a href="#" onclick="history.back()"> Section </a> <i class="bi bi-chevron-right p-0 m-0"></i> <a href="#"> Items</a> </p>
        <h3 class="mt-4"> Items  </h3>
        {{menu.sub_menu_name.toUpperCase()}}
              
        <div class="row pr-0 " >
            <div class="menu-card p-0  p-1" v-for="(menuItem) in menuItems" :key="menuItem.id">  
                  <div class="card p-0 text-center shadow fade-in borderless " style="border-radius:15px;overflow:hidden">
                     <div class=" cursor-pointer" style="background-color:#efeff3; cursor: pointer; background-size:cover">                          
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Add</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" v-bind:data-target="'#updateModal' + menuItem.id">Edit</a></li>
                            <li><a class="dropdown-item" href="#" @click="duplicateMenuItem(menuItem.id)">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#" @click="deleteMenuItem(menuItem.id)">Delete</a></li>                 
                        </ul>
                       
                        <p class="m-0 p-0">
                             <img v-if = "menuItem.image != null "  :src="menuItem.image"  class="img-fluid" style="height:25vh; width:100%; background-size:cover"/>                       
                             <i v-else class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:11rem; color:#999; "></i>
                        </p>                       
                    </div>
                    <div class="pl-3 pt-2">                    
                       <div class="d-flex align-items-center">
                            <p class="p-0 text-left m-0 lead" style="width:80%">
                                {{capitalize( menuItem.menu_item_name)}}
                            </p>

                             <!-- switch -->
                        <div class=" custom-control custom-switch"  >
                            <label class="switch" data-toggle="tooltip" data-placement="left" title="Publish">
                               <input type="checkbox" class="" checked v-if="menuItem.publish == 'true'" @click="togglePublish(menuItem.id, 'false')" >
                                <input type="checkbox" class=""  v-else  @click="togglePublish(menuItem.id, 'true')">
                                <span class="slider round"></span>
                            </label>                            
                        </div>
                       </div>  
                       <p class="text-left py-2 mb-0" v-if="menuItem.description">
                           {{capitalize(menuItem.description)}}
                        </p>       
                    <p class="text-left pt-0 mb-0"> Price: {{this.restaurant.currency}} {{menuItem.price}}  </p>
                    <p class="text-left" data-toggle="tooltip" data-placement="left" title="Preparation time">
                        <i class="bi bi-alarm text-danger" ></i> 
                        {{menuItem.preparation_time}}  mins 
                    </p>  
                    </div>
                        <!-- pass menuItem as prop to child --> 
                      <UpdateMenuItem :menuItem = 'menuItem' />                             
                </div>  
            </div>  
                <!-- add new menu box  -->
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

            <!-- add new Menu modal -->
            <div>
                <AddMenuItemForm  :sub_menu='this.menu' />                    
                                  
            </div>                   
                     
        </div>
    </div>

    <Footer />
</template>

<script>
import moment from 'moment';
import $ from "jquery";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import AddMenuItemForm from "../MenuItem/AddMenuItemForm";
import UpdateMenuItem from "../MenuItem/UpdateMenuItem";
import Footer from "../layouts/Footer";


export default {
   
 props:['menuItems', 'menu'],
 data(){
     return{
        user: '',
        restaurant: '',
        success:'',
        pageErrors:'', 
     }     
 },
  components: {
  Header,
  Topnavbar,
   Footer,
   AddMenuItemForm,
   UpdateMenuItem,

  },
  methods:{
      capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
        },
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        deleteMenuItem( id){
             if (!confirm('Are you sure want to delete this item?')) return;
            axios.delete('/api/menu-item/' + id)
            .then( response => {
            if( response.status = 200){
                 new Swal({ title: "Success!",timer: 1800  });
                this.$inertia.reload();
                }                
            })
            .catch(error=>{
                this.$swal('Error, Failed to delete!');
                console.log(error);
            });
        },
        duplicateMenuItem(id){
            Swal.showLoading();
            axios.get('/api/menu-item/duplicate/' + id )
            .then( response => {
                 new Swal({ title: "Success!",timer: 1800  });
                this.$inertia.reload();
            })
            .catch(error=>{
                this.$swal('Error, Failed to duplicate!');
                console.log(error);
            });                
        },
        togglePublish(id, state){
            axios.get('/api/menu-item/toggle-publish/' + id + '/' + state)
            .then( response => {
               
            })
            .catch(error=>{
                this.$swal('Error, Failed to publish!');
                console.log(error);
            });
        } , 

  },
   mounted(){
        this.user = window.authUser;
        this.restaurant = window.authRestaurant;

    },
   
   
};
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";

.parent-container{
        width:85%;
        font-family: poppins;
        font-weight:400;
        color:#585858;
}

.primary-btn{
    background-color: #e6034b;
    color: #fff;
}

.btn:hover, .btn:active{
    background-color: #e6034b;
   color: #fff;
}
.menu-card{
    position:relative;
    width:24%;
    height:auto;
    max-width:98%;
    margin: .5rem .1rem;
}
.menu-card img{
    object-fit:cover;
    width:200px;
    height:200px;
    max-height:100%;
    max-width:100%;
}
.menu-dots{
   position: absolute;
    top:.5rem;
    right: 5px;
    padding: 5px;
}

/* The switch - the box around the slider */
.custom-switch{
    width:2rem;
    float:right;
}
.switch {
  position: absolute;
  right:0;
  top:0;
  margin-right:auto;
  margin-left:auto;
  width: 36px;
  height: 22px;
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
  height: 19px;
  width: 16px;
  left: 2px;
  bottom: 2px;
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
  -webkit-transform: translateX(16px);
  -ms-transform: translateX(16px);
  transform: translateX(16px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 30px;
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
