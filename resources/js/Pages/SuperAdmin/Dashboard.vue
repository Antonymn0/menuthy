<template>

<div>

    <Header />

<div class="row ">
<div class="sidebar p-0 m-0">
    <Sidebar />
</div>

    <!-- ----------------------------------------- -->
<div class=" pt-4 p-0 web-dash">
    <h3> Dashboard</h3>
    <div class=" row panel mx-2 ">
            <div class="col-md-2 p-1">
                <div class="d-flex align-content-center align-items-center card shadow p-2 text-success">
                    <h5>
                        All clients
                    </h5>
                    <p>
                        {{Object.keys(this.users.data).length}}
                    </p>
                    <button class="btn btn-success rounded" @click="viewAllClients"> View </button>
                </div>
                </div>
            <div class="col-md-5 p-1">
                <div class="rounded card shadow ">
                    <div class="text-center text-primary row pt-1 ">
                        <div class=" col-md-4 ">
                            <div class="shadow rounded p-1">
                                <h5>
                                  &nbsp;   Lite &nbsp; 
                                </h5>
                                <p class="text-muted">
                                    {{this.getLiteClients(this.users.data)}}
                                </p>
                                <button class="btn btn-primary btn-sm my-1 rounded" @click="viewLiteClients"> View </button>
                            </div>                           
                        </div>
                        <div class=" col-md-4 ">
                            <div class="shadow rounded p-1">
                                <h5>
                                    &nbsp; &nbsp;  Pro &nbsp; &nbsp;
                                </h5>
                                <p class="text-muted">
                                    {{this.getProClients(this.users.data)}}
                                </p>
                                <button class="btn btn-primary btn-sm my-1 rounded" @click="viewProClients"> View </button>
                            </div>                           
                        </div>
                        <div class=" col-md-4 ">
                            <div class="shadow rounded p-1">
                                <h5>
                                    Premium
                                </h5>
                                <p class="text-muted">
                                    {{this.getPremiumClients(this.users.data)}}
                                </p>
                                <button class="btn btn-primary btn-sm my-1 rounded" @click="viewPremiumClients"> View </button>
                            </div>                           
                        </div>
                       
                       
                    </div> 
                </div>
            </div>
            <div class="col-md-2 p-1">
                <div class="d-flex align-content-center align-items-center card shadow p-2 text-warning">
                    <h5>
                        On trial
                    </h5>
                    <p>
                        {{this.getOnTrialClients(this.users.data)}}
                    </p>
                    <button class="btn btn-warning rounded" @click="viewOnTrialClients"> View </button>
                </div>
            </div>
            <div class="col-md-2 p-1">
                <div class="d-flex align-content-center align-items-center card shadow p-2 text-muted">
                    <h5>
                        Suspended
                    </h5>
                    <p>
                        {{suspended_users}}
                    </p>
                    <button class="btn btn-secondary rounded" @click="viewSuspendedClients"> View </button>
                </div>
            </div>
    </div>
    <div>
        <div class="table-responsive pt-5">
            <h4> {{title}} </h4>
            <table class="table table-hover table-borderless p-2 text-muted">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Client name</th>
                        <th scope="col"> Email</th>
                        <th scope="col">Business name</th>
                        <th scope="col">Business Email</th>
                        <th scope="col">Country</th>
                        <th scope="col">City</th>
                        <th scope="col">Package </th>
                        <th scope="col">Expriry </th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody v-if="Object.keys(this.current_users).length  ">
                    <tr v-for="(user, index) in this.current_users" :key="index" class="border-bottom">
                            <th scope="row"> {{index}} </th>
                            <td> {{user.first_name}} {{user.last_name}} </td>
                            <td> {{user.email}} </td>
                            <td v-if=" user.role !=='admin'  && user.get_restaurant[0]  "> {{user.get_restaurant[0].restaurant_name}} </td>
                            <td v-else></td>
                            <td v-if=" user.role !=='admin' && user.get_restaurant[0]"> {{user.get_restaurant[0].restaurant_email}} </td>
                            <td v-else></td>
                            <td v-if=" user.role !=='admin' && user.get_restaurant[0]"> {{user.get_restaurant[0].country}} </td>
                            <td v-else></td>
                            <td v-if=" user.role !=='admin' && user.get_restaurant[0]"> {{user.get_restaurant[0].city}} </td>
                            <td v-else></td>
                            <td> {{user.package_type}} </td>
                            <td v-if="user.registration_status == 'master' "> {{user.registration_expiry}} </td>
                            <td v-if="user.registration_status == 'trial' "> {{user.trial_expiry}} </td>
                            <td v-else></td>
                            <td v-if="user.reason"> 
                                Reason suspended:
                                {{user.reason}} 
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
            current_users:[],
            title:'All clients',
            suspended_users:0
        }
    },
    methods:{
      
        getOnTrialClients(users){
            let trial =0;
            users.forEach((user) => { 
                if(user.registration_status == 'trial') trial +=1;
            });
            return trial;           
        },
        getLiteClients(users){
            let lite =0;
            users.forEach((user) => { 
                if(user.package_type == 'lite') lite +=1;
            });
            return lite;           
        },
        getProClients(users){
            let pro =0;
            users.forEach((user) => { 
                if(user.package_type == 'pro') pro +=1;
            });
            return pro;           
        },
        getPremiumClients(users){
            let premium =0;
            users.forEach((user) => { 
                if(user.package_type == 'premium') premium +=1;
            });
            return premium;           
        },
        getSuspendedClients(users){
            let suspended =0;
            users.forEach((user) => { 
                if(user.deleted_at !== null) suspended +=1;
            });
           this.suspended_users = suspended;           
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
        viewAllClients(){
            this.current_users = this.users.data;
            this.title = 'All clients' ;
        },
 
        viewOnTrialClients(){
            this.current_users = []; // unset current users
            this.users.data.forEach((user)=> {
                if(user.registration_status == 'trial') this.current_users.push(user);
                this.title = ' Clients on-trial' ;                
            });
        },
        viewLiteClients(){
            this.current_users = []; // unset current users
            this.users.data.forEach((user)=> {
                if(user.package_type == 'lite') this.current_users.push(user);
                this.title = ' Lite Clients ' ;                
            });
        },
        viewProClients(){
            this.current_users = []; // unset current users
            this.users.data.forEach((user)=> {
                if(user.package_type == 'pro') this.current_users.push(user);
                this.title = ' Pro Clients ' ;                
            });
        },
        viewPremiumClients(){
            this.current_users = []; // unset current users
            this.users.data.forEach((user)=> {
                if(user.package_type == 'premium') this.current_users.push(user);
                this.title = ' Premium Clients ' ;                
            });
        },
        viewSuspendedClients(){
            axios.get('/users/deleted')
            .then( response => {
                if( response.status == 200){
                    this.title = 'Suspended clients';
                    this.current_users = [];  // unset current users                    
                    var data =response.data.data.data;
                    this.current_users = data; 
                    this.suspended_users = Object.keys(this.current_users).length;  
                    } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },
        restoreUser(user_id){
            if(! confirm('Do you want to restore this user?')) return;
                 axios.get('api/user/restore/' + user_id)
            .then( response => {
                if( response.status == 200){
                     this.$inertia.reload();
                     this.$swal('Success!');
                    } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        }
        
    },
    mounted(){
        this.current_users = this.users.data;
        this.viewSuspendedClients();       
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