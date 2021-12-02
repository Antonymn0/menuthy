<template>
    <Header />
    <Topnavbar />
    <div class="parent-div mx-auto">

    
    <div class="main-sub-menu  mb-5" v-if="this.subMenus">   
         <p class="mt-4 small d-flex justify-content-between"> 
            <span>
                <small><a href="/menus">Menu </a>  <i class="bi bi-chevron-right p-0 m-0"></i> 
                <a href="#"> Section</a>  </small>
            </span> 
            <span> <a href="/menus" class="btn btn-danger"><i class="bi bi-chevron-left"></i> Back</a></span>
         </p>
        <h3> Sections</h3>
        <p class="mt-4"> A list of sections under {{this.menu.menu_name.toUpperCase()}} menu</p>  

        <div class="row pr-0 " >
            <div class="menu-card p-0  p-1" v-for="(subMenu) in this.subMenus" :key="subMenu.id">  
               
                 <div class="card p-0 text-center fade-in borderless " style="border-radius:15px;overflow:hidden">
                     <div class=" cursor-pointer" style="background-color:#efeff3; cursor: pointer; background-size:cover">                     
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Add</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" v-bind:data-target="'#updateModal' + subMenu.id">Edit</a></li>
                            <li><a class="dropdown-item" href="#" @click="duplicateSubMenu(subMenu.id)">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#" @click="deleteSubMenu(subMenu.id)">Delete</a></li>                   
                        </ul>                        
                        <a :href="'/menu-items/' + subMenu.id">
                             <img v-if = "subMenu.image  " :src="subMenu.image"  class="img-fluid" style="height:27vh; width:100%; object-fit: cover;"/>                       
                             <i v-else class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:12rem; color:#999; "></i>
                        </a>
                        <editSubMenuForm :menu_id = "this.form.menu_id" :restaurant_id="this.form.restaurant_id" :subMenu="subMenu"/> 
                    </div>
                    <div class="pl-3 pt-2">
                        <div class="d-flex align-items-center pb-0 mb-0  justify-content-between">
                             <p class="m-0 text-left w-80 float-left" style=""> {{subMenu.sub_menu_name}} </p>                               
                            
                            <div class=" custom-control custom-switch " >
                                <label class="switch" data-toggle="tooltip" data-placement="left" title="Publish">
                                    <input type="checkbox" class="" checked v-if="subMenu.publish == 'true'" @click="togglePublish(subMenu.id, 'false')" >
                                    <input type="checkbox" class=""  v-else  @click="togglePublish(subMenu.id, 'true')">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>                                                                   
                        <p class="text-left ">  
                            <span class="small text-center"> {{  formatDate(subMenu.created_at)}} </span>  
                        </p> 
                    </div>                      
                                                        
                </div>
                    
            </div>     
        
            <div class="menu-card p-0  p-1  align-middle">  
                <div class=" p-2  text-center " style="border: 2px dashed #999; ">
                   <div class=" m-0">
                      <a href=""  data-toggle="modal" data-target="#exampleModal">
                          <i class="bi bi-plus p-0 m-0 " style="font-size:6rem; color:#999;"></i>
                        </a>  
                    </div>
                    <a href="" class="btn btn-default"  data-toggle="modal" data-target="#exampleModal">Add menu </a>                    
                </div>
            </div>                     
        </div>
            <AddSubMenuForm :menu_id = "this.form.menu_id" :restaurant_id="this.form.restaurant_id"/>
    </div>
    <div v-else>
        empty
    </div>
</div>
    <Footer />
</template>

<script>
import moment from 'moment';

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";
import AddSubMenuForm from "./AddSubMenuForm";
import editSubMenuForm from "./editSubMenuForm";

export default {
 props:['menu','subMenus',  'restaurant_id'],
  components: {
  Header,
  Topnavbar,
   Footer,
   AddSubMenuForm,
   editSubMenuForm,

  },
  data(){
      return{
          form:{
            menu_id: this.menu.id,
            restaurant_id: this.restaurant_id,
          },
          
      }
  },
  methods:{
      deleteSubMenu( id){
            if (!confirm('Are you sure want to delete this section?')) return;
            axios.delete('/api/sub-menu/' + id)
            .then( response => {
            if( response.status = 200){
                this.$swal('Success, Section deleted!');
                this.$inertia.reload();
                }                
            });
        },
        duplicateSubMenu(id){
            Swal.showLoading();
              axios.get('/api/sub-menu/duplicate/' + id )
            .then( response => {
                Swal.close();
                this.$inertia.reload();
            })
            .catch(error=>{
                this.$swal('Error, Failed to duplicate!');
                console.log(error);
            });
        },

        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll');
            }
        },
        togglePublish(id, state){
            axios.get('/api/sub-menu/toggle-publish/' + id + '/' + state)
            .then( response => {
                // console.log(response);
            })
            .catch(error=>{
                this.$swal('Error, Failed to publish!');
                console.log(error);
            });
        } , 
  },
  mounted(){
   
      for(var pair of this.subMenus) {
        console.log(pair); 
        }
  },
};
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";

.parent-div{
    font-size:1.2rem;
    width:80%;
    font-family:poppins;
    font-weight:400;
    color:#585858;
}
    .primary-btn{
        background-color: $primary-button;
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
  margin-top:.3rem;
  margin-bottom:.2rem;
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
