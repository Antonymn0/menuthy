<template>
    <Header />
    <Topnavbar />  
        
        <div class="row pr-0 px-5 mx-2 main" >
             <div class="p-2 mt-5 ml-3">
                 <p class="text-right m-0 back-btn"> <a href="#" class="btn btn-danger" onclick="history.back()"><i class="bi bi-chevron-left"></i> Back</a></p>
           
                <h3> Main menu</h3>
                <p> A list of main menus in your restaurant</p>
            </div>
            
            <div class="menu-card p-0 px-2 p-1" v-for="(menu) in menus" :key="menu.id">  
                <div class="card p-0 pb-1 text-center fade-in borderless shadow" style="position: relative; border-radius:15px;overflow:hidden">
                    <div class=" cursor-pointer" style="background-color:#efeff3; cursor: pointer; background-size:cover">                       
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Add</a></li>
                            <li >
                                <a class="dropdown-item " href="#" data-toggle="modal" v-bind:data-target="'#updateModal' + menu.id" >                                
                                    Edit
                                </a>                           
                            </li>
                            <li><a class="dropdown-item" href="#" @click="duplicateMenu(menu.id)">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#" @click="deleteMenu(menu.id)">Delete</a></li>                   
                        </ul>
                             <!--   Edit modal form  -->
                                    <EditMenuForm :menu = menu /> 
                        <a :href="'/sub-menu/' + menu.id">
                             <img v-if = "menu.image != null " :src="menu.image"  class="img-fluid" style="height:200px; width:100%; background-size:cover" />                       
                             <i v-else class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:11rem; height:250px; color:#999; "></i>
                        </a>                       
                    </div>
                    <div class=" custom-control custom-switch" >
                        <label class="switch" data-toggle="tooltip" data-placement="left" title="Publish">
                            <input type="checkbox" class="" checked v-if="menu.published == 'true'" @click="togglePublish(menu.id, 'false')" >
                            <input type="checkbox" class=""  v-else  @click="togglePublish(menu.id, 'true')">
                            <span class="slider round"></span>
                        </label>
                    </div>
                    <div class="pb-1 pl-3 text-left"> 
                        <h4 class="p-0 m-0 " >
                            {{capitalize(menu.menu_name)}}
                        </h4>
                        <p class="py-1 m-0">{{menu.sub_menu.length }} items  </p> 
                        <p class="p-0 m-0">  {{  formatDate(menu.created_at)}}  </p>  
                    </div>
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
                <AddMenuForm    :restaurant_id="restaurant_id"/>
            </div>
        </div>

    <Footer />
</template>

<script>
import moment from 'moment';
import $ from "jquery";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import AddMenuForm from "../Menus/AddMenuForm";
import EditMenuForm from "../Menus/EditMenuForm";
import Footer from "../layouts/Footer";

export default {
 props:['menus','restaurant_id'],
 data(){
     return{
        user: window.User,
        success:'',
        pageErrors:'', 
        updateModal:20,

     }     
 },
  components: {
  Header,
  Topnavbar,
   Footer,
   AddMenuForm,
   EditMenuForm,

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
        deleteMenu( id){
             if (!confirm('Are you sure want to delete this menu?')) return;
            axios.delete('/api/menu/' + id)
            .then( response => {
            if( response.status = 200){
                this.$swal('Success, Menu deleted!');
                this.$inertia.reload();
                }                
            });
        },
        duplicateMenu(id){   
             Swal.showLoading();
            axios.get('/api/menu/duplicate/' + id )
            .then( response => {              
                this.$swal('Success!');
                this.$inertia.reload();
            })
            .catch(error=>{
                this.$swal('Error, Failed to duplicate!');
                console.log(error);
            });
        },
        openUpdateModal(event){               
                $('.modal').attr('id', newId);
                $('UpdateModal').modal('show');
                event.currentTarget.firstChild;
        } ,  
        togglePublish(id, state){
            axios.get('/api/menu/toggle-publish/' + id + '/' + state)
            .then( response => {  
                this.$inertia.reload();            
            })
            .catch(error=>{
                this.$swal('Error, Failed to publish!');
                console.log(error);
            });
        } ,         

  },
   mounted(){
       //
    },
   
   
};
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";
.primary-btn{
    background-color: $primary-button;
    color: #fff;
    }
    .btn:hover, .btn:active{
        background-color: $primary-button;
        color: #fff;
    }
.menu-card{
    width:24%;
    height:auto;
    max-width:98%;
    margin: .5rem .1rem;
    font-family: poppins;
    font-weight:400;
    color:#585858;
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
.switch {
  position: absolute;
  margin-top:1.1rem;
  margin-left:auto;
  margin-right:.3rem;
  right:0;
  top:0;
  z-index: 3;
  display: inline-block;
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
@media only screen and (max-width: 950px) {
  .menu-card{
      width:49%;
  }
}

@media only screen and (max-width: 600px) {
  .menu-card{
      width:100%;
  }
  .main{
      padding-left:0 !important;
      padding-right:0 !important;
  }
  .back-btn{
      margin-right:2rem !important;
  }
}

</style>
