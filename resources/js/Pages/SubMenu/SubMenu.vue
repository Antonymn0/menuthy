<template>
    <Header />
    <Topnavbar />
    
    <div class="main-sub-menu p-5  mb-5">   
        <p class="mt-4 small">Menu <i class="bi bi-chevron-right p-0"></i> Sub menu</p>
        <h3 class="mt-4">Sub-menu name</h3>

        <div class="row pr-0 " >
            <div class="menu-card p-0  p-1" v-for="(subMenu) in subMenus.data" :key="subMenu.id">  
                <div class="card p-1  text-center fade-in ">
                    <div class="p-3 cursor-pointer" style="background-color:#efeff3; cursor: pointer;">                        
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Add</a></li>
                            <li><a class="dropdown-item" href="#">Edit</a></li>
                            <li><a class="dropdown-item" href="#" @click="duplicateSubMenu(subMenu.id)">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#" @click="deleteSubMenu(subMenu.id)">Delete</a></li>                   
                        </ul>                        
                         <a href="/menu-items">
                             <img v-if = "subMenu.avatar = 0 " src="subMenu.avatar"  class="img-fluid" />                       
                             <i v-else class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:6.5rem; color:#999; "></i>
                        </a>  
                    </div>
                    <div class="row m-1 p-1 w-100">
                        <h4 class="p-0" style="width:75%; float:left">
                            {{subMenu.sub_menu_name}}
                        </h4>
                        <div class=" custom-control custom-switch" style="width:25%; float:right">
                            <label class="switch">
                                <input type="checkbox" class="">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>                   
                    <p> 5 items  </p>
                    <p>  {{  formatDate(subMenu.created_at)}}   </p>                                       
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
            <AddSubMenuForm />
    </div>

    <Footer />
</template>

<script>
import moment from 'moment';

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";
import AddSubMenuForm from "./AddSubMenuForm";

export default {
 props:['subMenus'],
  components: {
  Header,
  Topnavbar,
   Footer,
   AddSubMenuForm,

  },
  methods:{
      deleteSubMenu( id){
            if (!confirm('Are you sure want to delete this section?')) return;
            axios.delete('/api/sub-menu/' + id)
            .then( response => {
            if( response.status = 200){
                this.$swal('Success, Section deleted!');
                this.$inertia.visit('/sub-menu');
                }                
            });
        },
        duplicateSubMenu(id){
            axios.get('/api/sub-menu/' + id)
            .then( response => {
                if( response.status = 200){   
                    var data =    response.data.data ;             
                    console.log(data);
                    // convert response to form data 
                    var form_data = new FormData();  
                    for (let item in data) {
                        console.log(item, data[item]);
                        if(item == 'sub_menu_name') form_data.append(item, data[item]);
                        if(item == 'restaurant_id') form_data.append(item, data[item]);
                        if(item == 'menu_id') form_data.append(item, data[item]);
                        }
                        // save data
                    axios.post('/api/sub-menu', form_data )
                    .then( response => {
                        this.$swal('Success, Section duplicated!');
                    })
                    .catch(error=>{
                        this.$swal('Error, Failed to duplicate!');
                        console.log(error);
                    });
                 }                
            })
            .catch( error => {
                this.pageErrors = "Failed to execute!";
                console.log(error);
            }); 

        },

      formatDate(date){
            if (date) {
                return moment(String(date)).format('ll');
            }
        },
  },
};
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";

.main-sub-menu{
    font-size:1.2rem;

    .primary-btn{
        background-color: $primary-button;
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
    background-color: $primary-button;
    }

    input:focus + .slider {
    box-shadow: 0 0 1px $primary-button;
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
}

</style>
