<template>

<div>

    <Header />

<div class="row ">
    <div class="sidebar p-0 m-0">
        <Sidebar />
    </div>

      <!-- ----------------------------------------- -->
    <div class=" pt-5 p-0 web-dash">
        <h3> <span>Admins </span>  <span class="float-right mr-5"><a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#newAdmin"><i class="bi bi-plus-lg"></i> Add</a></span></h3>
    
        <div>
            <div class="table-responsive pt-5">
                <h4> {{title}} </h4>
                <table class="table table-hover table-borderless p-2 text-muted">
                     <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Admin name</th>
                            <th scope="col"> Email</th>
                            <th scope="col"> Role</th>
                            <th scope="col"> Date added</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.current_users">
                        <tr v-for="(user, index) in this.current_users" :key="index" class="border-bottom">
                            <th scope="row"> {{index +1}} </th>
                                <td> {{user.first_name}} {{user.last_name}} </td>
                                <td> {{user.email}} </td>
                                <td> {{capitalize(user.role)}} </td>                             
                                <td >                                    
                                    {{ formatDate(user.created_at) }} 
                                    </td>
                                <td >  
                                    <a href="#" class="btn btn-danger btn-sm m-1" data-bs-toggle="tooltip" data-bs-placement="left" title="Suspend" @click="suspendUser(user.id)" v-if="user.deleted_at == null"> <i class="bi bi-x-circle"></i></a>
                                    <a href="#" class="btn btn-success btn-sm m-1"  data-bs-toggle="tooltip" data-bs-placement="left" title="Restore" @click="restoreUser(user.id)" v-if="user.deleted_at !== null"> <i class="bi bi-arrow-counterclockwise"></i> </a>
                                </td>
                        </tr>                       
                    </tbody>
                    <tbody v-else>
                        <tr class="py-5">
                            <th scope="row">1</th>
                            <th scope="row" colspan="8" class="lead text-muted text-center py-5"> No records to show</th>
                               
                        </tr>                       
                    </tbody>
                    <tbody>
                        <tr>
                            <td colspan="9">
                                <Pagination :data="this.users"/>
                            </td>                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


    </div>
    <!-- ------------------------------------- -->
    <!--add new modal popup -->
 <div class="modal fade mx-auto text-center" id="newAdmin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered shadow mx-auto" >
            <div class="modal-content shadow" style="width:auto">
            <div class="modal-body shadow">
                <div class="login-block shadow text-left">
               <form action="" class="" enctype="multipart/form-data" @submit.prevent="submitForm()">       
            <div>
                <h3 class="my-2 text-center">Register new admin</h3>
                <div class="pb-1">
                    <label for="full_name">Full name</label>
                    <input type="text"  placeholder="Full name" id="full_name" v-model="form.full_name" />
                    <small class="text-danger text-center">  {{this.errors.full_name}}</small>
                </div>
                <div class="pb-1">
                    <label for="email">Email</label>
                    <input type="email"  placeholder="Email" id="email" v-model="form.email" @input="this.validateEmail()"/>
                    <small class="text-danger text-center">  {{this.errors.email}}</small>
                </div>                              
                <div class="row">
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="password">Password</label>
                        <input type="password"  placeholder="Password" id="password" v-model="form.password"/>
                        <small class="text-danger text-center">  {{this.errors.password}}</small>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password"  placeholder="Confirm password" id="confirm_password" v-model="form.confirm_password" @input="confirmPassword()" />
                        <small class="text-danger text-center">  {{this.errors.confirm_password}}</small>  
                    </div>
                    </div>
                </div>            
            </div>               
            <div class="d-flex align-content-center justify-content-center pt-2">
               <button type="submit" class="m-2 button" style="max-width:8rem;">Submit</button>
                <a href="#" class="text-white button m-2 text-center pt-2" style="max-width:8rem;" data-dismiss="modal"> Cancel </a>
            </div> 
             </form>    
            </div>
            </div>
            
            </div>
        </div>
    </div> 
</div>


    <Footer />
</div>
   
</template>

<script>
import moment from 'moment';

import Header from './Layouts/Header';
import Sidebar from './Layouts/Sidebar';
import Footer from './Layouts/Footer';
import Pagination from '../Pagination/Pagination';
export default {
    props:['users'],
    components:{
        Header,
        Sidebar,
        Footer,
        Pagination
    },
    data(){
        return{
            form:{
                full_name:'',
                email:'',
                passowrd:'',
                confirm_password:'',
                role:'admin',   
            },
            current_users:null,
            title:'All admins',
             errors:{},
             regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
           
        }
    },
    methods:{
        capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
        },
         formatDate(date){
            if (date) {
                return moment(String(date)).format('lll ');
            }
        },
        submitForm() {
            this.validateForm();
            console.log(this.errors);
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var user_data = new FormData();
                user_data.append('full_name', this.form.full_name);
                user_data.append('email', this.form.email);
                user_data.append('password', this.form.password);
                user_data.append('password_again', this.form.password_again);
                user_data.append('package_type', 'master');          
                user_data.append('role', this.form.role);          
                
                Swal.showLoading(),    

            axios.post('api/user', user_data)
            .then( response => {
                if( response.status == 201){  
                     this.$swal('Success, Admin created');
                } 
            })
            .catch( error => {  
                console.log(error.response.data); 
                Swal.close();
                 if(error.response.status == 422) {
                     if(error.response.data.errors.email){
                         this.errors.email = error.response.data.errors.email[0];
                         return;
                     } 
                    }
                console.log(error.response); 
                new Swal({ title: "Error", timer: 2000});                                                                                      
                                       
                });
        },
        suspendUser(user_id){
            if(!confirm("Are you sure you want to suspend this user?")) return;
            axios.delete('/api/user/'+ user_id)
            .then( response => {
                if( response.status == 200){
                    this.$inertia.reload();
                    new Swal({ title: "Success!",timer: 1800  });                    
                    } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },
        validateForm(){         
            if(!this.form.full_name) this.errors.full_name = 'This field is required!' ;
            else delete this.errors.full_name;  

            if(!this.form.email) this.errors.email = 'This field is required!' ;
            else delete this.errors.email;

            if(!this.regex.test(this.form.email)) this.errors.email = 'invalid email!' ;
            else delete this.errors.email;

            if(!this.form.password) this.errors.password = 'This field is required!' ;
                else delete this.errors.password;  

            if(!this.form.confirm_password) this.errors.confirm_password = 'This field is required!' ;
                else delete this.errors.confirm_password;  

            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!' ;
                else delete this.errors.confirm_password;  
        },
    },
    mounted(){
        this.current_users = this.users.data;
        console.log('users ', this.current_users);
    }
}
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";
@import url('https://fonts.googleapis.com/css?family=Poppins');

.sidebar{
    width:20vw;
    float:left;
    
}
.web-dash{
    overflow: hidden;
      width:79vw;
      float:right;
      color:#9699a2;
      font-family: poppins;
  }

  .panel .card:hover{
      border:1px solid ;
  }



/* media queries */

 .login-block {
    width: 100%;
    padding: 20px;
    background: rgba(233, 233, 233, 0);
    border-radius: 5px;
    border-top: 5px solid #ff656c;
    margin: 0 auto;
    margin-bottom: 2rem;

    }
  
    .login-block h1 {
    text-align: center;
    color: rgb(228, 107, 107);
    font-size: 28px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
    }
    
    .login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 5px;
    font-size: 15px;

    padding-left: .7rem;
    outline: none;
    }    

    .login-block input#password:focus {
        background: #fff 20px bottom no-repeat;
        background-size: 16px 80px;
    }
    
    .login-block input:active, .login-block input:focus .login-block select:focus{
    border: 1px solid #ff656c;
    }
    
    .login-block button, .button {
        width: 98%;
        height: 40px;
        background: #ff656c;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #e15960;
        color: #fff;
        font-weight: bold;
        font-size: 14px;

        outline: none;
        cursor: pointer;
    }
    
    .login-block button:hover {
    background: #f5414a;
    }

/* media queries */
    @media only screen and (max-width: 900px) {
        .login-block{
            width:80%;
        }
    }
/* media queries */
    @media only screen and (max-width: 700px) {
        .login-block{
            width:97%;
            margin-right:auto;
            margin-left:auto;
        }
    }
    @media only screen and (max-width: 900px) {
 .sidebar{
    display:none;
}
.web-dash{
width:95vw;
margin-left:auto;
margin-right: auto;
  }
}
</style>