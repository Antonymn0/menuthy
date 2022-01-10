<template>
    <div>
        <Header />
        <Topnavbar /> 
    </div> 
    <div>
        <!-- audio player  -->
        <audio            
            ref="audio"
            src="/audio/beep-4.mp3">
        </audio>
    </div>
    <div class="px-5">
        <div class="px-3 py-3">
            <div class=" row p-3">  
             <h2 class="col-md-6 float-left">
               Delivery Orders
            </h2>
            <p class="col-md-6 float-right text-right">
                <a href="#" class="btn btn-danger daily-report"> <i class="fa fa-arrow-circle-o-up pr-2 pl-2 m-1"></i> Export daily report</a>
                <a :href="'/' + this.authRestaurant.id + '/orders/print'" class="btn text-white px-2 mx-3 my-1" style="background-color: #36a3f7;" @click="this.showLoading()"> <i class="fa fa-arrow-circle-o-up pr-2" ></i>Export </a>
                <a href="#" class="btn btn-primary m-1" @click.prevent="fetchOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p> 
        </div>
             <div class="p-2 table-responsive" >        
            <table class="table table-light table-borderless bg-white table-hover table-striped align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Time received </th>
                        <th scope="col">Time completed </th>
                        <th scope="col">Time delivered </th>
                        <th scope="col">Time canceled </th>
                        <th scope="col">Order no</th>
                        <th scope="col">Type</th>
                        <th scope="col">No/Items</th>
                        <th scope="col">Customer name</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Delivery address</th>
                        <th scope="col">Amount due</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Amount paid</th>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Paid at</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>                   
                     </tr>                   
                </thead>
                 <tbody v-for="(order, index) in this.current_orders" :key="order.id">
                    <tr v-if=" order.status !== 'recieved' && order.order_type == 'Home Delivery'">
                        <td>{{index +1}}</td>
                        <td>{{formatDate(order.created_at)}}</td>
                        <td v-if="order.completed_at">{{formatDate(order.completed_at)}}</td>
                        <td v-else>-</td>
                        <td v-if="order.delivered_at">{{formatDate(order.delivered_at)}}</td>
                        <td v-else>-</td>
                        <td v-if="order.canceled_at">{{formatDate(order.canceled_at)}}</td>
                        <td v-else>-</td>
                        <td>{{order.order_number}}</td>
                        <td>{{capitalize(order.order_type)}}</td>
                        <td v-if="order.number_of_items" class="">{{order.number_of_items}}</td>
                        <td  class="">{{order.customer_name}}</td>
                        <td  class="">{{order.customer_phone}}</td>
                        <td v-if="order.delivery_address" class="">
                            <span v-if="order.latitude && order.longitude" class=" btn badge btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Geolocation</span> <br>
                            Address: {{order.delivery_address}} 
                            <MapLocation :order='order'/>
                        </td>
                        <td  v-else class="">-</td>
                        <td v-if="order.amount" class="">{{order.amount}}</td>
                        <td v-if="order.paid =='false'" class="text-danger">No</td>
                        <td v-if="order.paid =='true'" class="text-primary">Yes</td>
                        <td v-if="order.amount_paid" class="">{{order.amount_paid}}</td>
                        <td v-else>0</td>
                        <td v-if="order.transaction_id == 'cash' "> {{capitalize(order.transaction_id)}}</td>
                        <td v-if="!order.transaction_id  ">-</td>
                        <td v-else> {{order.transaction_id}}</td>
                        <td v-if="order.paid_at" class="">{{formatDate(order.paid_at)}}</td>
                        <td v-else>-</td> 
                        <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'delivered'" class="text-muted">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{capitalize(order.status)}}</td>
                        <td class=" mx-auto  m-1 ">
                            <a href="#" class="badge badge-success btn m-1" v-if="order.paid =='false' && order.status !== 'canceled' " @click.prevent="markAsPaid(order)">Pay</a>
                            <a href="#" class="badge badge-success btn m-1 disabled" v-else >Pay</a>
                            <a href="#" class="badge badge-primary btn m-1 " v-if="order.status !== 'delivered' && order.status !== 'canceled'"  @click.prevent="markDelivered(order.id, 'delivered')" >Delivered</a>
                            <a href="#" class="badge badge-primary btn m-1 disabled "  v-if="order.status == 'canceled' || order.status == 'delivered'"  >Delivered</a>
                            <!-- <a href="#" class="badge badge-danger btn m-1" @click.prevent="cancelOrder(order.id, 'canceled')">Cancel</a> -->
                        </td> 
                    </tr>
                </tbody>
            </table>
            <p class="small text-muted text-center">Tip: A beep sound for Completed orders. </p>
        </div>        
        </div>        
    </div>
    <Pagination :data="this.current_orders" />
    <Footer />
</template>

<script>
import moment from 'moment';

import Pagination from "../Pagination/Pagination.vue";
import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";
import MapLocation from "./MapLocation";

export default {
    components:{
        Pagination,
        Header,
        Topnavbar,
        Footer,
        MapLocation
    },
    data(){
        return{
            authRestaurant: window.authRestaurant,
            authUser: window.authUser,
            current_orders:{},

        }
    },
    methods:{
        formatDate(date){
            if (date) return moment(String(date)).format('L') + ' ' + moment(String(date)).format('LT');            
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },
        markDelivered(id, value){
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss");
            if(confirm("Are you sure you want to mark this order delivered?"))
            {            
                axios.get('/api/order/mark/' + id + '/' + value + '/' + date)
                .then( response => {
                    if( response.status == 200){
                        this.fetchOrders();
                    } 
                })
                .catch( error => {
                    this.$swal('Failed!'); 
                });
            }
        },
        fetchOrders(){
            axios.get( '/' + this.authRestaurant.restaurant_name + '/orders/' + this.authRestaurant.id + '/refresh')
            .then( response => {
            if( response.status == 200){                 
                // scan response for newly complted orders
                response.data.data.data.forEach(order => {
                    // play a beep sound for a new order 
                    if(order.status == 'completed' && order.order_type == 'Home Delivery'){                        
                        try {
                           this.$refs.audio.play();
                        return; 
                        } catch (error) {
                            console.log("Audio play failed...");
                        }                        
                    } 
                }); 
                this.current_orders = response.data.data.data; 
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
        setInterval(this.fetchOrders(), 30000);
        
                
    }
}
</script>

<style scoped>
    /* media queries */
@media only screen and (max-width: 750px) {
  .px-5{
      padding-right:5px !important;
      padding-left:5px !important
  }
  .px-3{
      padding-right:5px !important;
      padding-left:5px !important;
  }
}
</style>