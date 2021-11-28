<template>


<div>

    <Header />

<div class="row">
    <div class="col-md-3">
        <Sidebar />
    </div>

      <!-- ----------------------------------------- -->
    <div class="col-md-8 px-3 pt-3 web-dash">
        <div class=" row panel">
                <div class="col-md-3 p-1">
                    <div class="d-flex align-content-center align-items-center card shadow p-2 text-success">
                       <h5>
                           All clients
                       </h5>
                       <p>
                          {{Object.keys(this.users.data).length}}
                       </p>
                    </div>
                    </div>
                    <div class="col-md-3 p-1">
                    <div class="d-flex align-content-center align-items-center card shadow p-2 text-primary">
                       <h5>
                           Master clients
                       </h5>
                       <p>
                           {{this.getMasterClients(this.users.data)}}
                       </p>
                    </div>
                    </div>
                    <div class="col-md-3 p-1">
                    <div class="d-flex align-content-center align-items-center card shadow p-2 text-warning">
                       <h5>
                           On trial
                       </h5>
                       <p>
                           {{this.getOnTrialClients(this.users.data)}}
                       </p>
                    </div>
                    </div>
                    <div class="col-md-3 p-1">
                    <div class="d-flex align-content-center align-items-center card shadow p-2 text-muted">
                       <h5>
                           Inactive
                       </h5>
                       <p>
                           106
                       </p>
                    </div>
                </div>
        </div>
        <div>
            <div class="table-responsive pt-5">
                <h2> All clients </h2>
                <table class="table table-striped table-hover table-bordered p-2">
                     <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Client name</th>
                            <th scope="col"> Email</th>
                            <th scope="col">Business name</th>
                            <th scope="col">Business Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Package type</th>
                            <th scope="col">Expriry date</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.users != undefined">
                        <tr v-for="(user, index) in this.users.data" :key="index" >
                            <th scope="row"> {{index}} </th>
                                <td> {{user.first_name}} {{user.last_name}} </td>
                                <td> {{user.email}} </td>
                                <td> {{user.get_restaurant[0].restaurant_name}} </td>
                                <td> {{user.get_restaurant[0].restaurant_email}} </td>
                                <td> {{user.get_restaurant[0].address}} </td>
                                <td> {{user.package_type}} </td>
                                <td> {{user.registration_expiry}} </td>
                        </tr>                       
                    </tbody>
                    <tbody v-else>
                        <tr >
                                <th scope="row">1</th>
                                <th scope="row" colspan="8" class="lead text-muted text-center"> No items to show</th>
                               
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
import Header from './Layouts/Header';
import Sidebar from './Layouts/Sidebar';
import Footer from './Layouts/Footer';
export default {
    props:['users'],
    components:{
        Header,
        Sidebar,
        Footer,
    },
    methods:{
        getMasterClients(user){
            let master =0;
            if(user.pacakage_type == 'master')master++;
            return master;           
        },
        getOnTrialClients(user){
            let trial =0;
            if(user.registration_status == 'trial') trial ++;
            return trial;           
        },
    },
    mounted(){
        console.log(this.users.data);
    }
}
</script>

<style>
/* media queries */
@media only screen and (max-width: 900px) {
  .web-dash{
      display:none;
  }
}
</style>