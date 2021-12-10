<template>

  <Header />
<div class="row parent-div">
    <div class="sidebar p-0 m-0">
        <Sidebar />
    </div>

    <div class=" pt-4 p-0 web-dash">     
        <div class=" row p-3">            
            <h2 class="col-md-6 ">
              Admin Qr code scans by restaurant
            </h2>
            <p class="col-md-6 text-right">
                <a href="/dashboard" class="btn btn-danger mr-2" >  <i class="bi bi-chevron-left  pr-1"></i> Dashboard</a>
                <a href="/admin-qr-code-scans" class="btn btn-primary" @click="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p>
        </div>

        <div class="filter-div ">
            <div class="row">
                 <div class="form-group col">
                    <label for="status"> Restaurant name </labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="restaurant_name">
                        <button  class=" rounded" @click="searchrestauranByname(this.restaurant_name)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.name}}</small>
                    </p>
                </div>
                  <div class="form-group col ">
                    <label for="status"> Restaurant Email</labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="restaurant_email">
                        <button  class=" rounded" @click="searchScansByEmail(this.restaurant_email)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.email}}</small>
                    </p>
                </div>
            </div>        
        </div>

        <div class="p-2 table-responsive" >  
            <h4> {{this.title}}</h4>      
            <table class="table table-light table-borderless bg-white table-hover  align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Restaurant name</th>
                        <th scope="col">Restaurant Email</th>
                        <th scope="col">Total scans</th>
                        <th scope="col">This week scans</th>
                        <th scope="col">This month</th>
                        <th scope="col">action</th>                    
                     </tr>
                </thead>
               <tbody>
                   <tr v-for="(restaurant, index) in this.current_restaurants.data" :key="index">
                        <td> {{index + 1}}</td>
                        <td> {{this.capitalize(restaurant.restaurant_name)}}</td>
                        <td> {{restaurant.restaurant_email}}</td>
                        <td v-if="restaurant.qr_code_scans"> {{this.getTotalScans(restaurant.qr_code_scans)}}</td>
                        <td v-else>0</td>
                        <td v-if="restaurant.qr_code_scans"> {{this.getThisWeekScans(restaurant.qr_code_scans)}}</td>
                        <td v-else>0</td>
                        <td v-if="restaurant.qr_code_scans"> {{this.getLast4WeeksScans(restaurant.qr_code_scans)}}</td>
                        <td v-else>0</td>
                        <th scope="col"><button class="btn btn-danger btn-sm" data-bs-toggle="modal" :data-bs-target="'#staticBackdrop' + restaurant.id">View</button></th> 
                       
                        <!--scan history  Modal -->
                            <div class="modal fade" :id="'staticBackdrop' + restaurant.id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                                <div class="modal-content text-muted ">
                                <div class="modal-header">
                                    <img :src="restaurant.image" alt="" v-if="restaurant.image" >
                                    <h5 class="modal-title" id="staticBackdropLabel">{{this.capitalize(restaurant.restaurant_name)}} scan history</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-5">
                                    <p>Monthly scan history for year  {{new Date().getFullYear()}}</p>
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <th>Month</th>
                                                <th>Scans</th>
                                            </thead>
                                            <tbody>
                                                <tr >
                                                    <td>January</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week1 + restaurant.qr_code_scans.week2 + restaurant.qr_code_scans.week3 + restaurant.qr_code_scans.week4 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>Feburuary</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week5 + restaurant.qr_code_scans.week6 + restaurant.qr_code_scans.week7 + restaurant.qr_code_scans.week8 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>March</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week9 + restaurant.qr_code_scans.week10 + restaurant.qr_code_scans.week11 + restaurant.qr_code_scans.week12 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>April</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week13 + restaurant.qr_code_scans.week14 + restaurant.qr_code_scans.week15 + restaurant.qr_code_scans.week16 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>May</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week17 + restaurant.qr_code_scans.week18 + restaurant.qr_code_scans.week19 + restaurant.qr_code_scans.week20 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>June</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week21 + restaurant.qr_code_scans.week22 + restaurant.qr_code_scans.week23 + restaurant.qr_code_scans.week24 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>July</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week25 + restaurant.qr_code_scans.week26 + restaurant.qr_code_scans.week27 + restaurant.qr_code_scans.week28 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>August</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week29 + restaurant.qr_code_scans.week30 + restaurant.qr_code_scans.week31 + restaurant.qr_code_scans.week32 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>September</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week33 + restaurant.qr_code_scans.week34 + restaurant.qr_code_scans.week35 + restaurant.qr_code_scans.week36 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>October</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week37 + restaurant.qr_code_scans.week38 + restaurant.qr_code_scans.week39 + restaurant.qr_code_scans.week40 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>November</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week41 + restaurant.qr_code_scans.week42 + restaurant.qr_code_scans.week43 + restaurant.qr_code_scans.week44 + restaurant.qr_code_scans.week45 }}</td>
                                                </tr>
                                                <tr >
                                                    <td>December</td>
                                                    <td v-if="restaurant.qr_code_scans">{{restaurant.qr_code_scans.week48 + restaurant.qr_code_scans.week49 + restaurant.qr_code_scans.week50 + restaurant.qr_code_scans.week51 + restaurant.qr_code_scans.week52 }}</td>
                                                </tr>
                                            </tbody>
                                           
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer mx-5">
                                    <button type="button" class="btn btn-danger px-2" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success">Print</button>
                                </div>
                                </div>
                            </div>
                            </div>
                   </tr>
               </tbody>
                <tbody>
                    <tr class="p-2 border-top">
                        <td colspan="5" class="text-right border-right">
                           <b> Number of restaurants</b> 
                        </td>
                        <td class="text-center">
                           {{this.current_restaurants.total}}
                        </td>
                    </tr>

                </tbody>
                 <tr>
                   
                </tr>
            </table>
             <!-- <Pagination  /> --> 
             <Pagination :data="this.current_restaurants" />
        </div>
    </div>
    </div>

 <Footer />

</template>
<script>
import moment from 'moment';

import Header from '../Layouts/Header';
import Sidebar from '../Layouts/Sidebar';
import Footer from '../Layouts/Footer';
import Pagination from '../../Pagination/Pagination';

export default { 
    props:['restaurants'],
    components:{
        Pagination,
        Header,
        Sidebar,
        Footer,
    },
   data(){
       return{
           page: 1,
            current_orders:[],
            counter:0,
            authRestaurant:{},
            current_restaurants:'',
            select_status:'',
            date:'',
            title:'All orders',
            order_no:'',
            transaction_id:'',
            restaurant_name:'',
            restaurant_email:'',
            title:'All scans',

            errors:{}
       }
   },
   methods:{
        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        formatDate(date){
            if (date) {
                return moment(String(date)).format('lll');
            }
        },
        getTotalScans(scans){
            var total_scans = 0;
            if(Object.keys(scans).length){ 
                Object.entries(scans).forEach((scan)=>{
                if(scan[0] !== 'created_at' && scan[0] !== 'updated_at' && scan[0] !== 'restaurant_id' && scan[0] !== 'id' )  total_scans += scan[1];
                });                                          
            }
            return total_scans;
        },
        getThisWeekScans(scans){
            var total_scans =0;
           var this_week = this.getCurrentWeekNumber();
            
            // find total weekly scans
            if(Object.keys(scans).length){ 
                Object.entries(scans).forEach((scan)=>{
                if( scan[0] == 'week' + this_week  )  total_scans += scan[1];                
                });                                          
            }
            return total_scans;

        },
        getLast4WeeksScans(scans){
            var total_scans =0;
           var current_week = this.getCurrentWeekNumber();
            // get previous weeks
            var this_week = 'week' + current_week;
            var prev_week ='week' + (current_week -1) ;
            var prev_prev_week = 'week' + (current_week - 2) ;
            var prev_prev_week = 'week' + (current_week -3);
            // find total monthly scans
            if(Object.keys(scans).length){ 
                Object.entries(scans).forEach((scan)=>{
                if( scan[0] == this_week )  total_scans += scan[1];
                if( scan[0] ==  prev_week )  total_scans += scan[1];
                if( scan[0] == prev_prev_week )  total_scans += scan[1];
                if( scan[0] ==  prev_prev_week )  total_scans += scan[1];
                });                                          
            }
            return total_scans;

        },
       getCurrentWeekNumber(){
            var currentdate = new Date();
            var oneJan = new Date(currentdate.getFullYear(),0,1);
            var numberOfDays = Math.floor((currentdate - oneJan) / (24 * 60 * 60 * 1000));
            var current_week = Math.ceil(( currentdate.getDay() + 1 + numberOfDays) / 7);
            return current_week;
       },        
       searchScansByEmail(restaurant_email){
           if(!restaurant_email.length) return;
             axios.get( '/admin-qr-scansearch-email/' + restaurant_email)
            .then( response => {
            if( response.status == 200){
                if(!response.data.data.length){
                    this.current_restaurants =[];
                    this.errors={};
                    this.errors.email = "No results found";
                    return;
                }
                this.title = 'Results';
               this.current_restaurants = response.data.data; 
               console.log(response.data) ;              
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch scans!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
       },
       searchrestauranByname(restaurant_name){
            if(!restaurant_name.length) return;
             axios.get( '/admin-qrscansearch/' + restaurant_name)
            .then( response => {
            if( response.status == 200){                
                if(!response.data.data.length){
                    this.errors={};
                    this.current_restaurants =[];
                    this.errors.name = "No results found";
                    return;
                }
                this.title = 'Results';
               this.current_restaurants = response.data.data; 
               console.log(response.data) ;              
                } 
            })
            .catch( error => {

                new Swal({
                    title:'Error,  failed to fetch scans!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
       },
        refreshOrders(){
            axios.get( '/api/order')
            .then( response => {
            if( response.status == 200){
               this.current_orders = response.data.data; 
               console.log(response.data) ;              
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
        },    
   },

    mounted(){
       this.current_restaurants = this.restaurants;
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins');

.parent-div{
    font-family:poppins !important;
    font-weight:400;
    color:#9699a2;

}
.daily-report{
    display:inline;
}

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
* {
  box-sizing: border-box;
}

/* Style the search field */
p.example input[type=text] {
  padding: 7px;
  font-size: 17px;
  border-right:none;
  border: 1px solid rgb(221, 217, 217);
  float: left;
  width: 80%;
  background: #fff;
  border-radius:7px 0 0 7px;
}
p.example input[type=text]:active {

  border-right:none;
  border: 1px solid rgb(253, 252, 252);

  width: 80%;
  background: #fff;

}

/* Style the submit button */
p.example button {
    border-radius:0 7px 7px 0 ;
  float: left;
  width: 20%;
  padding: 7px;
  background: #fff;
  color: rgb(160, 159, 159);
  font-size: 17px;
  border: 1px solid rgb(221, 217, 217);

  border-left: none; /* Prevent double borders */
  cursor: pointer;
}

p.example button:hover {
  background: #dd1d03;
  color:#fff;
}

/* Clear floats */
p.example::after {
  content: "";
  clear: both;
  display: table;
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

/* media quesries */
@media only screen and (max-width: 750px) {
  .daily-report{
    display:none;
}

}

</style>>
