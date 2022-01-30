<template >

    <header>
    <!-- --------- components ------ -->  
        <TrialExpiryNotification /> 
        <SubscriptionExpiryNotification /> 
        <EmailNotConfirmedNotification />
        <RestaurantInformation />            
        <MobilePreview />
        <QrCode @passQrCodeToParent="passQrCodeToDashboard($event)"/>
        <MobileNav />
        <Feedback />       
        <Profile />
    
    <!-- --------------header---------------------------- -->
    <div class="parent-header  px-5">

        <div class="main-right "> 
            <a href="/dashboard" class="float-left" >
                <img :src="'/images/menuthy_logo_i_a.png'" class="mx-auto my-auto img-fluid " alt="image-logo" style="width:250px; height:auto; "> 
            </a>
        
        <!-- ----------------------------middle---------------------------------------- -->
        <div class="float-left"> 
            <div class="middle-header float-left">
                <div class="res-name p-0"> 
                    <RestaurantName  />
                </div>
                <div class="other-icons pl-2"> 
                    <a href="#" class="p-1" data-toggle="modal" data-target="#exampleModalEditRestaurant" >
                        <i class="bi bi-gear-fill text-white recent-link" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info">
                            <span class="hovercard">
                                <span class="tooltiptext border">
                                Update restaurant information.
                                </span>
                            </span>
                        </i>
                    </a>
                
                    <a href="#" class="py-1 px-2 recent-link" data-toggle="modal" data-target="#exampleModalEditmobileMenu"> <i class="bi bi-eye text-white">
                            <span class="hovercard">
                                <span class="tooltiptext border">
                                Preview your menu.
                                </span>
                            </span>
                        </i></a>
                    <a href="" class="p-1" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
                        <i class="bi bi-qr-code text-white recent-link">
                            <span class="hovercard">
                                <span class="tooltiptext">
                                Display QR code for logging in into mobile menu.
                                </span>
                            </span>
                        </i>
                    </a>
                </div>
            </div>
        </div>
        </div>
        <!-- ----------------------------------------user--------------------------------------------- -->
        <div class=""> 
            <p class="d-flex justify-content-center align-items-center"> 
            
            <!-- tootip + tooltip -->
            <span class="float-left ">
                <a href="#" class="" onclick="openFeedBack()">
                <i class="bi bi-bell-fill text-white mr-4 recent-link" style="font-size: 1rem;font-weight: 300;">              
                    <span class="hovercard">
                        <span class="tooltiptext border">
                        Track orders, requests and feedback.
                        </span>
                    </span></i>  
                </a> 
            </span>           
                <a style="font-size: 1rem;font-weight: 300; text-decoration:none;" class="user-div  text-white pr-2" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">  
                    <span class=" mr-3">{{this.authUser.first_name}} </span>  
                    <img  v-if="this.authUser.image"  :src="this.authUser.image"  alt="profile-image" class="rounded-circle mr-5" style="width:50px; height:50px; object-fit:cover; ">
                    <span v-else class="rounded-circle ml-2 " ><i class="bi bi-person-circle p-1" style="font-size:2.5rem;"></i></span>
                </a>             
            
            <ul class="dropdown-menu   pb-0 mb-0" aria-labelledby="navbarDropdown">
                <li data-toggle="modal" data-target="#profile"><a class="dropdown-item" href="#" >User Profile</a></li>                
                <li><a href="#" class="dropdown-item" data-toggle="modal" data-target="#exampleModalEditRestaurant" > Restaurant Info</a></li>
                <li><a class="dropdown-item" href="/subscription">Subscriptions</a></li>
                <li> <a class="dropdown-item" href="#" onclick="event.preventDefault();" data-toggle="modal" data-target="#exampleModalAddUsers">User accounts</a> </li>
                <li class="dropdown-item  border-top px-2">
                    <form action="/logout" method="POST" enctype="multipart/form-data">
                        <div class="ml-2">
                            <input type="hidden" name="_token" :value="this.csrf">    
                            <button type="submit" class="btn-danger mx-auto"> 
                            <i class="bi bi-box-arrow-left pr-1"></i> 
                                Logout
                        </button>
                        </div>                        
                    </form>                     
                </li>
            </ul> 
            </p>
        </div>
        <!-- -------------------------------------------------------------------------- -->
         <!-- Modal -->
                <div class="modal fade text-muted" id="exampleModalAddUsers" tabindex="-1" role="dialog" aria-labelledby="exampleModalAddUsersTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalLongTitle"> Accounts</h4>
                        <button type="button" class="close" id="closeuser" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-muted">
                        <ul class="nav nav-tabs float-center border-bottom-none">
                            <li class="active ml-1"> <a data-toggle="tab" href="#currentusers" class="btn card ml-1">User accounts</a> </li>
                            <li class=" ml-1"  > <a data-toggle="tab" href="#addUser" class="btn card mr-1" >Add user</a> </li>
                        </ul>
                        <div class="tab-content">
                        <div id="currentusers" class="tab-pane   pt-3 active">
                            <div class="table-responsive">
                                <span class="text-success small  float-right"  v-if="this.success !=='' "> {{this.success}} <br> </span>                          
                                <span class="text-danger small float-right"  v-if="this.errors.user  "> {{this.errors.user}} <br> </span>                          
                                <h5>Active accounts</h5>
                                <table class="table table-sm  ">
                                    <thead class="text-muted">
                                        <th> # </th>
                                        <th> Name </th>
                                        <th> Email </th>
                                        <th> Role </th>
                                        <th> Action </th>
                                    </thead>
                                    <tbody class='text-muted'>
                                        <tr>
                                            <td>1</td>
                                            <td>{{this.authUser.full_name}}</td>
                                            <td>{{this.authUser.email}}</td>
                                            <td>Admin</td>
                                             <td> <span class="badge btn-danger p-2 disabled" @click.prevent="this.deleteUser(this.authUser)"><i class="bi bi-trash"></i></span> </td>
                                        </tr>
                                    </tbody>
                                    <tbody v-for="(user, index) in this.restaurant.role_users" :key="index" class="border-none">
                                        <tr class="text-muted border-none">
                                            <td>{{index+2}}</td>
                                            <td>{{user.full_name}}</td>
                                            <td>{{user.email}}</td>
                                            <td>{{this.capitalize(user.role)}}</td>
                                            <td> <span class="badge btn-danger p-2" @click.prevent="this.deleteUser(user)"><i class="bi bi-trash"></i></span> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div id="addUser" class="tab-pane  pt-3">
                            <h5>Add User</h5>
                            <form action="#" enctype="multipart/form-data" ref="formUser" @submit.prevent="createNewUser()">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Full name* </label>
                                    <input type="text" class="form-control p-4"   v-model="form.full_name" id="exampleFormControlInput1"  placeholder="Full name " required>
                                    <small class="text-danger">{{this.errors.full_name}}</small>
                                </div>                        
                                <div class="form-group">
                                    <label for="exampleFormControlemail">Email* </label>
                                    <input type="email" inputmode="email" class="form-control p-4"   v-model="form.email" id="exampleFormControlemail"  placeholder="Email" required>
                                    <small class="text-danger">{{this.errors.email}}</small>
                                </div>                        
                                <div class="form-group">
                                    <label for="exampleFormControlpassword">Password* </label>
                                    <input type="password"  class="form-control p-4"   v-model="form.password" id="exampleFormControlpassword"  placeholder="Password" required>
                                    <small class="text-danger">{{this.errors.password}}</small>
                                </div>                        
                                <div class="form-group">
                                    <label for="exampleFormControlpasswordagain">Confirm Password* </label>
                                    <input type="password"  class="form-control p-4"   v-model="form.confirm_password" id="exampleFormControlpasswordagain"  placeholder="Confirm Password" required>
                                    <small class="text-danger">{{this.errors.confirm_password}}</small>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlrole">Role:</label>
                                <select id="" class="w-100  p-2 rounded border bg-white text-muted" v-model="form.role">
                                    <option value="" selected>- Role -</option>
                                    <option value="cashier" >Cashier</option>
                                    <option value="kitchen" >Kitchen</option>
                                    <option value="delivery" >Delivery</option>
                                </select>
                                <small class="text-danger">{{this.errors.role}}</small>
                                </div>

                                <div class="text-center border-top px-3 pt-1">                                
                                    <span class="spinner-border " role="status" v-if="this.spinner"></span>                                
                                    <span class="text-success small pb-2"  v-if="this.success !=='' "> {{this.success}} </span>                                
                                    <button type="button" class="btn btn-danger m-1" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary m-1" >Create</button>                            
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    </div>
</header> 
 
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import RestaurantInformation from "../HeaderComponents/RestaurantInformation";
import MobilePreview from "../HeaderComponents/MobilePreview";
import QrCode from "../HeaderComponents/QrCode";
import MobileNav from "../HeaderComponents/MobileNav";
import Profile from "../Profile/Profile";
import TrialExpiryNotification from "../Notifications/TrialExpiryNotification";
import SubscriptionExpiryNotification from "../Notifications/SubscriptionExpiryNotification";
import EmailNotConfirmedNotification from "../Notifications/EmailNotConfirmedNotification";
import Feedback from "../Feedback/Feedback";

export default {
    data(){
        return{
            authUser: window.authUser,  // Authenticated user Imported from laravel main blade file
            restaurant: window.authRestaurant,  // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
        }
    },
    components:{
        RestaurantName,
        RestaurantInformation,
        SubscriptionExpiryNotification, 
        TrialExpiryNotification,
        EmailNotConfirmedNotification,
        MobilePreview,
        Profile,
        MobileNav,
        QrCode,
        Feedback,
        success:''
    },
    data(){
        return{
            Qr_code_link:'',
            errors:{},
            success:'',
            restaurant: window.authRestaurant,
            form:{
                full_name:'',
                email:'',
                password:'',
                confirm_password:'',
                role:'',
                created_by:null
            },
            spinner:false,
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            
        }
    },
  
    methods:{
        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        passQrCodeToDashboard(qrCode){
            this.$emit('passQrCode',qrCode);
        },
        logout(){
            this.$inertia.visit('/logout');
        },
        createNewUser(){
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            var user_data = new FormData();
                user_data.append('full_name', this.form.full_name);
                user_data.append('email', this.form.email);
                user_data.append('password', this.form.password);
                user_data.append('password_again', this.form.password_again);
                user_data.append('role', this.form.role);
                user_data.append('created_by', this.form.created_by);
                this.spinner = true;

            axios.post('api/user', user_data)
            .then( response => {
                if( response.status == 201){ 
                    this.spinner = false;  
                    this.success= 'Success, User created!'  ;                     
                    setTimeout(() =>{
                        this.form.full_name='';
                        this.form.email='';
                        this.form.password='';
                        this.form.confirm_password='';
                        this.form.role='';
                        this.$refs.formUser.reset();
                       document.getElementById('closeuser').click() ;
                       this.success = '';
                    } , 2000);                   
                } 
            })
            .catch( error => {  
                this.spinner = false;           
                if(error.response.status == 422) {
                    if(error.response.data.errors.email){
                        this.errors.email = error.response.data.errors.email[0];                       
                        return;
                    } 
                    if(error.response.data.errors.password){
                        this.errors.password = error.response.data.errors.password[0];
                        return;
                    } 
                }
                console.log(error.response); 
                new Swal({ title: "Error", timer: 2000});                                                                                      
                                       
                });

        },
        deleteUser(user){
            if(user.role == 'user'){
                alert('Cannot delete an admin user!');
                return;
            }
            if(! confirm('Do you want to delete this user? This action cannot be undone.')) return;
            axios.delete('/api/user/'+ user.id)
            .then( response => {
                if( response.status == 200){
                    console.log(response);
                    this.success="Success, user deleted!";
                    setTimeout(() => { this.success =''; }, 3000);  
                    return;                 
                } 
            })
            .catch( error => {
                if(error.response.status == 404){
                    this.errors.user = 'Error, user not found!';
                    setTimeout(() => { delete this.errors.user }, 3000);
                    return;
                } 
                this.$swal('Failed to delete user!');
                console.log(error.response);
                
                return;                    
            });
        },
        validateForm(){
            this.errors={};            
            if(this.form.full_name == '') this.errors.full_name = 'Name field is required!';
            if(this.form.email == '') this.errors.email = 'Email field is required!';
            if(this.form.password == '') this.errors.password = 'Password field is required!';
            if(this.form.password == '') this.errors.password = 'Password field is required!';
            if(this.form.confirm_password == '') this.errors.confirm_password = 'Confirm password field is required!';
            if(this.form.role == '') this.errors.role= 'Role is required!';
            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email!' ;
            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!';
            if(this.form.created_by== null){
                this.errors.user = 'Cannot determine user';
               new Swal({ title: "Error, Cannot determine curent user!", timer: 2000}); 
               
            }
           
        }
    },
    created() {
        this.authUser = window.authUser;
        this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); //csrf token
    },
    mounted(){
        this.authUser = window.authUser;
        this.form.created_by = window.authUser.id;
        this.csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); //csrf token
   
    }
}
</script>

<style lang='scss'>
@import "../../../sass/app.scss";
@import url('https://fonts.googleapis.com/css?family=Poppins');

.parent-header{
    font-family: Poppins !important;
    font-size: 1rem;
    background: #2c2d3a;
    height:120px;
    display:flex;
    align-items: center;
    justify-content:space-between;
    border-bottom: 1px solid rgba(39, 39, 39, 0.63);
}
  
.dropdown-menu:hover .dropdown-item:hover{
     display: block; 

     }
.main-right{
    width:65%;
    display: flex;
    align-items: center;
}
.middle-header{
    padding-top:.2rem;
    font-size: 1rem;
    display: flex;
    align-items: center;
    justify-content:flex-start;
}
.user-div{
    font-size: 1rem;
    display:flex; 
    align-items: center;
}

//tooltip
.recent-link {
  position: relative;

}
.hovercard { 
  position: absolute; 
  display:none;
  opacity: 0; 
  z-index: 5;
  left: 50%;
  top: 30px;
  transform: translateX(-50%);
}

.recent-link:hover .hovercard { 
    display:block;
  opacity: 1; 
  transition: 0.5s;  
  transition-delay: 0.1s;
}
.tooltiptext {
font-family: Poppins !important;
  display: flex; 
  flex-direction: column; 
  justify-content: flex-start; 
  background-color: #fff;
  padding: 13px; 
  text-align: center;
  font-weight: bold;
  font-style: normal;
  border-radius:35px;
  color: rgb(102, 100, 100); 
  line-height: 18px;
  transition: 1s;
  width: 180px;
}


    /* On smaller screens, where width is less than 950px, hide browser menu */
@media screen and (max-width: 950px) {
    
    .parent-header{
        display:none;
    }
    .logo{
        padding-left:0;
        margin-left:0;
    }
 }
</style>