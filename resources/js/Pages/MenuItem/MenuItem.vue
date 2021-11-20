<template>
    <Header />
    <Topnavbar />
    
    <div class=" p-5  mb-5">   
        <div class="badge bg-success " v-if="success">
            {{success}}
        </div>
        <div class="badge bg-danger px-5 py-2   " v-if="pageErrors">
            {{pageErrors}}
        </div>
         <p class="mt-4 small">Menu <i class="bi bi-chevron-right p-0 m-0"></i> <i class="bi bi-chevron-right p-0 m-0"></i> {{menu.menu_name}}  </p>
        <h3 class="mt-4">Items  </h3>
        {{menu.menu_name.toUpperCase()}}
              
        <div class="row pr-0 " >
            <div class="menu-card p-0  p-1" v-for="(menuItem) in menuItems" :key="menuItem.id">  
                <div class="card p-1  text-center fade-in ">
                    <div class="p-3 cursor-pointer" style="background-color:#efeff3; cursor: pointer;">                       
                        <i class="bi bi bi-three-dots-vertical menu-dots rounded-circle bg-white py-0 px-2 " style="font-size: 1.5rem;"  id="navbarDropdown"  data-bs-toggle="dropdown" aria-expanded="false"></i>
                         <ul class="dropdown-menu rounded ">
                            <li><p class="text-center">  <b> Actions</b> </p></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">Add</a></li>
                            <li><a class="dropdown-item" href="#" data-toggle="modal" data-target="'#exampleModalUpdate'+ menu.id">Edit</a></li>
                            <li><a class="dropdown-item" href="#" @click="duplicateMenuItem(menuItem.id)">Duplicate</a></li>
                            <li><a class="dropdown-item" href="#" @click="deleteMenuItem(menuItem.id)">Delete</a></li> 

                            <li>    
                                
                            </li>                  
                        </ul>
                       
                         <UpdateMenuItem :menuItem = menuItem /> <!-- pass menuItem as prop to child -->
                        <p>
                             <img v-if = "menuItem.image != null "  :src="'storage/'+ menuItem.image"  class="img-fluid" />                       
                             <i v-else class="fa fa-cutlery text-center" aria-hidden="true" style="font-size:6.5rem; color:#999; "></i>
                        </p>                       
                    </div>
                    <div class="row m-1 p-1 w-100">
                        <h4 class="p-0 " style="width:70%; float:left">
                            {{menuItem.menu_item_name}}
                        </h4>
                        <!-- switch -->
                        <div class=" custom-control custom-switch" style="width:20%; float:right">
                            <label class="switch" data-toggle="tooltip" data-placement="left" title="Publish">
                               <input type="checkbox" class="" checked v-if="menuItem.publish == 'true'" @click="togglePublish(menuItem.id, 'false')" >
                                <input type="checkbox" class=""  v-else  @click="togglePublish(menuItem.id, 'true')">
                                <span class="slider round"></span>
                            </label>
                            
                        </div>
                    </div>                    
                    <p> Price:  {{menuItem.price}}  </p>
                    <p data-toggle="tooltip" data-placement="left" title="Preparation time">
                          <i class="bi bi-alarm text-danger" ></i> 
                        {{menuItem.preparation_time}}  mins 
                    </p>  
                                                       
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
                <AddMenuItemForm  :sub_menu="this.menu" :restaurant_id="this.menu"/>                    
                                  
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
        user: window.User,
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
                this.$swal('Success, Item deleted!');
                this.$inertia.reload();
                }                
            })
            .catch(error=>{
                this.$swal('Error, Failed to delete!');
                console.log(error);
            });
        },
        duplicateMenuItem(id){
            axios.get('/api/menu-item/' + id)
            .then( response => {
                if( response.status = 200){   
                    var data =    response.data.data ;             
                    console.log(data);
                    // convert response to form data 
                    var form_data = new FormData();  
                    for (let item in data) {
                        console.log(item, data[item]);
                        if(item == 'id') continue;
                        if(item == 'created_at') continue;
                        if(item == 'updated-at') continue;
                        if(item == 'deleted_at') continue;
                        if(item == 'menu_item_name') form_data.append(item, data[item]);
                        if(item == 'sub_menu_id') form_data.append(item, data[item]);
                        if(item == 'price') form_data.append(item, data[item]);
                        if(item == 'preparation_time') form_data.append(item, data[item]);
                        if(item == 'discount') form_data.append(item, data[item]);
                        if(item == 'description') form_data.append(item, data[item]);
                        if(item == 'avatar') form_data.append(item, data[item]);                        
                        }
                        // save data
                    axios.post('/api/menu-item', form_data )
                    .then( response => {
                        this.$swal('Success, Item duplicated!');
                        this.$inertia.reload();
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
        togglePublish(id, state){
            axios.get('/api/menu-item/toggle-publish/' + id + '/' + state)
            .then( response => {
                console.log(response);
            })
            .catch(error=>{
                this.$swal('Error, Failed to publish!');
                console.log(error);
            });
        } , 

  },
   mounted(){
        // console.log(this.menuItems);
        // console.log(this.menu);
        // for(var pair of this.menuItems) {
        // console.log(pair); 
        // }
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
