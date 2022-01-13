<template>

<div class="parent-nav shadow " style="height:0;"> 
    <div>
        <span onclick="openFeedBack()"></span>
        <div id="feedBack1" class="sidenav shadow">
            <a href="javascript:void(0)" class="closebtn" onclick="closeFeedBack()">&times;</a>
                <div class="d-flex justify-content-start pt-2 pb-0 px-5 border-bottom" >
                   <h5 class="pr-4 orders f-back-links mb-0 active" @click="[fetchOrders('today'), toggleActive($event)]" v-if="this.authUser.package_type !== 'starter' && this.authUser.registration_status !== 'trial'">Orders </h5> 
                    <!-- <h5 class="feedback f-back-links pr-4 mb-0" @click="[fetchFeedback(), toggleActive($event)]"> Feedback</h5> -->
                    <h5 class="feedback f-back-links pr-4 mb-0" @click="[fetchQrScans(), toggleActive($event)]"> QR scans</h5>
                </div>
                <div v-if="current_orders.length">
                    <div class="table-responsive px-4 py-4 text-muted">
                        <h6 class="text-muted py-2 d-flex justify-content-between align-items-center"> <span> Recent orders today </span> <span> <a href="#" class="text-muted pr-1 float-right text-right" @click="fetchOrders('today')"  data-toggle="tooltip" data-placement="top-left" title="Refresh">  <i class="bi bi-arrow-repeat float-right" style="font-size:1rem"></i> </a>  </span></h6>
                        <table class="table table-sm table-hover text-muted">
                            <thead class="border-top-none">
                                <tr class="p-2"> 
                                    <td scope="col">  # </td>
                                    <td scope="col"> Order no </td>
                                    <td scope="col">  Recieved</td>
                                    <td scope="col">  Completed </td>
                                    <td scope="col">  Table </td>
                                    <td scope="col">  Paid</td>
                                    <td scope="col">  Status </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order, index) in this.current_orders" :key="order.id" class="py-3"> 
                                    <td> {{index}}</td>
                                    <td> {{order.order_number}}</td>
                                    <td> {{this.formatDate(order.created_at)}} </td>
                                    <td> {{this.formatDate(order.completed_at)}} </td>
                                    <td> {{order.table_number}} </td>
                                    <td v-if="order.paid =='false'" class="text-danger">No</td>
                                    <td v-if="order.paid =='true'" class="text-primary">Yes</td>
                                    <td v-if="order.status == 'recieved'" class="">{{order.status}}</td>
                                    <td v-if="order.status == 'canceled'" class="text-danger">{{order.status}}</td>
                                    <td v-if="order.status == 'processing'" class="text-primary">{{order.status}}</td>
                                    <td v-if="order.status == 'completed'" class="text-muted">{{order.status}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                       
                </div>
                <div v-if="qrscans !== '' " style="overflow:scroll;">
                    <div class="table-responsive px-4 py-4 text-muted">
                        <h6 class="text-muted py-2 d-flex justify-content-between align-items-center"> <span> QR scans  </span> <span> <a href="#" class="text-muted pr-1  float-right text-right"  @click="fetchQrScans()"  data-toggle="tooltip" data-placement="top-left" title="Refresh">  <i class="bi bi-arrow-repeat float-right" style="font-size:1rem"></i> </a>  </span></h6>
                        <table class="table table-sm table-hover text-muted">
                            <thead class="border-top-none">
                                <tr class="p-2"> 
                                    <th scope="col">  Period</th>
                                    <th scope="col"> No of  scans </th>                                
                                </tr>
                                <tr>
                                    <td> This week</td>
                                    <td> {{ this.getThisWeekScans(qrscans.qr_code_scans) }}</td>
                                </tr>
                                <tr>
                                    <td> Last 4 weeks</td>
                                    <td> {{ this.getLast4WeeksScans(qrscans.qr_code_scans) }}</td>
                                </tr>
                               <div class="pt-4 pb-1">
                                   <p class=" text-center mb-0 lead">Monthly scans </p>
                               </div>
                                <tr> 
                                    <td> January</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week1 + qrscans.qr_code_scans.week2 + qrscans.qr_code_scans.week3 + qrscans.qr_code_scans.week4 }}</td>
                                </tr>
                                <tr> 
                                    <td> Feburuary</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week5 + qrscans.qr_code_scans.week6 + qrscans.qr_code_scans.week7 + qrscans.qr_code_scans.week8 }}</td>
                                </tr>
                                <tr> 
                                    <td> March</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week9 + qrscans.qr_code_scans.week10 + qrscans.qr_code_scans.week11 + qrscans.qr_code_scans.week12 }}</td>
                                </tr>
                                <tr> 
                                    <td> April</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week13 + qrscans.qr_code_scans.week14 + qrscans.qr_code_scans.week15 + qrscans.qr_code_scans.week16 }}</td>
                                </tr>
                                <tr> 
                                    <td> May</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week17 + qrscans.qr_code_scans.week18 + qrscans.qr_code_scans.week19 + qrscans.qr_code_scans.week20 }}</td>
                                </tr>
                                <tr> 
                                    <td> June</td>
                                     <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week21 + qrscans.qr_code_scans.week22 + qrscans.qr_code_scans.week23 + qrscans.qr_code_scans.week24 }}</td>
                                </tr>
                                <tr> 
                                    <td> July</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week25 + qrscans.qr_code_scans.week26 + qrscans.qr_code_scans.week27 + qrscans.qr_code_scans.week28 }}</td>
                                </tr>
                                <tr> 
                                    <td> August</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week29 + qrscans.qr_code_scans.week30 + qrscans.qr_code_scans.week31 + qrscans.qr_code_scans.week32 }}</td>
                                </tr>
                                <tr> 
                                    <td> September</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week33 + qrscans.qr_code_scans.week34 + qrscans.qr_code_scans.week35 + qrscans.qr_code_scans.week36 }}</td>
                                </tr>
                                <tr> 
                                    <td> October</td>
                                     <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week37 + qrscans.qr_code_scans.week38 + qrscans.qr_code_scans.week39 + qrscans.qr_code_scans.week40 }}</td>
                                </tr>
                                <tr> 
                                    <td> November</td>
                                     <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week41 + qrscans.qr_code_scans.week42 + qrscans.qr_code_scans.week43 + qrscans.qr_code_scans.week44 + qrscans.qr_code_scans.week45 }}</td>
                                </tr>
                                <tr> 
                                    <td> December</td>
                                    <td v-if="qrscans.qr_code_scans">{{qrscans.qr_code_scans.week48 + qrscans.qr_code_scans.week49 + qrscans.qr_code_scans.week50 + qrscans.qr_code_scans.week51 + qrscans.qr_code_scans.week52 }}</td>
                                </tr>
                                    
                                <tr class="py-2">
                                    <th> Total scans</th>
                                    <th> {{ this.getTotalScans(qrscans.qr_code_scans) }}</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div v-else class="text-muted my-auto py-5  text-center">
                   <b class="my-auto">  No items to show today</b>
                </div>
             
            </div>
        </div>
    </div>

   
    
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";
import moment from 'moment';

export default {
    
    data(){
        return{
            authUser: window.authUser,     // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),    //csrf token
            restaurant: window.authRestaurant,
            current_orders:'',
            qrscans:'',
        }
    },
    components:{
        RestaurantName,    
    },
    methods:{
        formatDate(date){
            if (date) {
                return  moment(String(date)).format('LT');
            }
        },
         fetchOrders(search_term){ 
            this.qrscans='';
            if(this.authUser.package_type == 'starter' || this.authUser.package_type == 'lite') return;
            axios.get('/orders/'+ this.restaurant.id + '/' + search_term)
            .then( response => {
            if( response.status == 200){
                this.qrscans='';
                this.current_orders = response.data.data.data;
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to fetch orders!');                
                   
            });
        },
         fetchQrScans(){ 
            axios.get('/qr-scans-history/'+ this.restaurant.id )
            .then( response => {
            if( response.status == 200){  
                this.current_orders = '';             
                this.qrscans = response.data.data;
                } 
            })
            .catch( error => {
                console.log(error.response);
                this.$swal('Error,  failed to fetch scans!');                
                   
            });
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
         getTotalScans(scans){
            var total_scans = 0;
            if(Object.keys(scans).length){ 
                Object.entries(scans).forEach((scan)=>{
                if(scan[0] !== 'created_at' && scan[0] !== 'updated_at' && scan[0] !== 'restaurant_id' && scan[0] !== 'id' )  total_scans += scan[1];
                });                                          
            }
            return total_scans;
        },
        fetchFeedback(){
            this.current_orders = '';
        },
        toggleActive(event){
            var el = document.getElementsByClassName('f-back-links');
            Array.from(el).forEach((item)=>{
                    item.classList.remove('active');
                });
            event.target.classList.add('active');
        }
    },
    mounted(){
        this.fetchOrders('today');
        this.fetchQrScans();
    }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";


h5{
    cursor:pointer;
}
i {
    color:rgb(160, 64, 64);
    font-weight:500;
}
i:hover{
    color:rgb(201, 35, 35);
}
.active{
    color:$primary-button;
    border-bottom: 3px solid $primary-button;
}
i:active{
    color:red;
}
.parent-nav{
    color:#9699a2 !important;
    font-family:poppins;
    font-weight:300;
}

table{
   color:#9699a2; 
}

.orders:hover, .feedback:hover{
    color:$primary-button;
    border-bottom: 3px solid $primary-button;
}


.logo img{
    width:40px;
    height:40px;
}
  

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  max-width: 40%; 
  position: fixed; /* Stay in place */
  z-index: 10; /* Stay on top */
  top: 0; /* Stay at the top */
  right:0;
  right: -1rem;
  background-color: #fff;
  color:#1f2027; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  padding-right: 10px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #645d5d;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: -70px;
  font-size: 36px;
  margin-left: 50px;
}


//media querries
@media screen and (max-width: 950px) {
 .sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  max-width: 90%; 
 }
.logo img{
    width:40px;
    height:40px;
}
}
@media screen and (max-width: 450px) {
 
}
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (min-height: 450px) {

}

</style>