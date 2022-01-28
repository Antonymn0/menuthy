<template>

    <div id="parent" class="text-muted">
    <div>
        <Header />
        
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
                <button class="btn text-white px-2 mx-3 my-1" style="background-color: #36a3f7;" @click.prevent="this.printThisPage()"> <i class="fa fa-arrow-circle-o-up pr-2" ></i>Export Today's Report</button>
                <a href="#" class="btn btn-primary m-1" @click.prevent="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p> 
        </div>
             <div class="p-2 table-responsive" >        
            <table class="table table-light table-borderless bg-white table-hover table-striped align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Status</th>
                        <th scope="col">Customer name</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Delivery address</th>
                        <th scope="col">Cash collected</th>
                        <th scope="col">Paid</th>
                        <th scope="col">View details</th>                       
                     </tr>                   
                </thead>
                <tbody v-for="(order, index) in this.current_orders" :key="order.id">
                    <tr v-if=" order.status !== 'received' && order.order_type == 'Home Delivery'">
                        <td>{{index +1}}</td>
                        <td>{{order.order_number}}</td>
                        <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'transit'" class="text-primary">{{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'delivered'" class="text-muted">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{capitalize(order.status)}}</td>
                        <td  class="">{{order.customer_name}}</td>
                        <td  class="">{{order.customer_phone}}</td>
                        <td v-if="order.delivery_address" class="">
                            <span v-if="order.latitude && order.longitude" class=" btn badge btn-primary" @click.prevent="updateCurrentOrder(order)" data-bs-toggle="modal" data-bs-target="#staticBackdrop" >Location <i class="bi bi-geo-alt"></i></span> <br>
                        </td>
                        <td v-if="order.cash_collected =='true'" class="text-success">Yes</td>
                        <td v-else class="text-danger">No</td>
                        <td v-if="order.paid =='false'" class="text-danger">No</td>
                        <td v-if="order.paid =='true'" class="text-primary">Yes</td> 
                        <td>
                            <span class="badge btn btn-secondary p-1 m-1" data-bs-toggle="modal" @click.prevent="updateCurrentOrder(order)" data-bs-target="#detailsModal">Details <i class="bi bi-caret-up"></i></span>
                            <span class="badge btn btn-primary p-1 m-1"   @click.prevent="markTransit(order, 'transit')" >Pick order </span>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
            <p class="small text-muted text-center">Tip: A beep sound for Completed orders ready to pick. </p>
        </div>        
        </div>        
    </div>
    <div>
         <!------------ Order details popup modal Modal ---------------->
    <div class="modal fade " id="detailsModal"  data-bs-keyboard="false" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  mx-auto">
        <div class="modal-content p-3">
        <div class="px-3 py-2 text-muted">
            <button type="button" class="btn-close float-right" id="closeDeliver" data-bs-dismiss="modal" aria-label="Close"></button>
            <h3 class="modal-title pt-2 bold" id="staticBackdropLabel">Order details </h3>
            <div class="pt-2 border-top">
                <p>
                    <span class="bold"> Customer name: </span>
                    <span> {{this.current_order.customer_name}}</span> <br>
                    
                    <span class="bold"> Customer phone: </span>
                    <span> {{this.current_order.phone_number}}</span> <br>
                    <span class="bold"> Delivery address: </span>
                    <span> Geolocation: <span class="text-primary" v-if="this.current_order.latitude">Yes</span> <span v-else class="text-danger">No</span><br/> 
                    <span class="ml-5"> {{this.current_order.delivery_address}}</span> </span> <br>
                </p>
                <p>
                    <span class="bold"> Order number: </span>
                    <span> {{this.current_order.order_number}}</span> <br>
                    <span class="bold"> Order type: </span>
                    <span> {{this.current_order.order_type}}</span> <br>
                    <span class="bold"> Number of items: </span>
                    <span> {{this.current_order.number_of_items}}</span> <br>
                    <span class="bold"> Amount due: </span>
                    <span>{{this.authRestaurant.currency}} {{this.current_order.amount}}</span> <br>
                    <span class="bold "> Status: </span>
                    <span class="border-bottom" style="color:#6cb2eb"> {{this.capitalize(this.current_order.status)}}</span> <br>
                </p>
                <p>
                    <span class="bold"> Cash collected: </span>
                    <span v-if="this.current_order.cash_collected == 'true'" class="text-success"> Yes</span>
                    <span v-if="this.current_order.cash_collected == 'false'" class="text-danger"> No</span> <br>
                    <span class="bold"> Amount collected: </span>
                    <span v-if="this.current_order.amount_collected">{{this.authRestaurant.currency}} {{this.current_order.amount_collected}}</span> <br>
                    <span class="bold"> Cash collected at: </span>
                    <span>{{this.formatDate(this.current_orders.cash_collected_at)}}</span> <br>

                    <span class="bold"> Paid: </span>
                    <span v-if="this.current_order.paid == 'true'" class="text-success"> Yes</span> 
                    <span v-if="this.current_order.paid == 'false'" class="text-danger">No</span> <br>
                    <span class="bold"> Paid at: </span>
                    <span > {{this.formatDate(this.current_order.paid_at)}} </span>  <br>                               
                    <span class="bold"> Amount paid: </span>
                    <span > {{this.authRestaurant.currency}} {{this.current_order.amount_paid}}</span>    <br/>                              
                    <span class="bold"> Transaction id: </span>
                    <span > {{this.current_order.transaction_id}}</span>                                 
                </p>
                <p>
                    <span class="bold">Order received at: </span>
                    <span> {{this.formatDate(this.current_order.created_at)}}</span> <br>
                    <span class="bold">Order completed at: </span>
                    <span> {{this.formatDate(this.current_order.completed_at)}}</span> <br/>
                    <span class="bold">Order delivered at: </span>
                    <span> {{this.formatDate(this.current_order.delivered_at)}}</span> <br/>
                    <span class="bold">Order canceled at: </span>
                    <span> {{this.formatDate(this.current_order.canceled_at)}}</span> <br/>
                </p>
            </div> 
            <div class="table-responsive">
                <h5 class="bold">Items</h5>
                <table class="table-striped table-sm border p-3">
                    <thead>
                        <th>#</th>
                        <th>Order number</th>
                        <th>Item name</th>
                        <th>Qty</th>
                        <th>Status</th>
                    </thead>
                    <tbody v-for="(order, index) in this.current_order.order_item" :key="index">
                        <td>{{index +1}}</td>
                        <td>{{this.current_order.order_number}}</td>
                        <td>{{order.item_name}}</td>
                        <td>{{order.quantity}}</td>
                        <td>{{this.capitalize(this.current_order.status)}}</td>
                    </tbody>
                </table>
            </div>          

        </div>
        <div class="modal-footer px-1">
            <button type="button" class="btn btn-success" @click.prevent="collectCash(this.current_order)">Collect Cash</button>
            <button type="button" class="btn btn-primary" @click.prevent="markDelivered(this.current_order.id, 'delivered')">Mark Delivered</button>
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        </div>
        </div>
    <!-- ----------------------------------------------------------- -->
    </div>
    </div>
    </div>
    </div>
<!-- ---------------------------------------------------------------------------- -->
    <div class="px-3 pt-3 text-center hidden" id="download">
        <h3>{{this.capitalize(this.authRestaurant.restaurant_name)}} Delivery Orders</h3>
        <span class="pb-2">Date:  {{ this.formatDate(new Date())}}</span>
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
                        <th scope="col">Cash collected</th>
                        <th scope="col">Amount collected_at</th>
                        <th scope="col">Paid</th>
                        <th scope="col">Amount paid</th>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Paid at</th>
                        <th scope="col">Status</th>
                    <th scope="col">Action</th>                   
                     </tr>                 
                </thead>
                <tbody v-for="(order, index) in this.current_orders" :key="order.id">
                    <tr v-if=" order.status !== 'received' && order.order_type == 'Home Delivery'">
                        <td>{{index +1}}</td>
                        <td>{{order.created_at}}</td>
                        <td>{{order.completed_at}}</td>
                        <td>{{order.delivered_at}}</td>
                        <td>{{order.canceled_at}}</td>
                        <td>{{order.order_number}}</td>
                        <td>{{order.order_type}}</td>
                        <td>{{order.number_of_items}}</td>
                        <td>{{order.customer_name}}</td>
                        <td>{{order.customer_phone}}</td>
                        <td>{{order.delivery_address}}</td>
                        <td>{{order.amount}}</td>
                        <td>{{order.cash_collected}}</td>
                        <td>{{order.cash_collected_at}}</td>
                        <td>{{order.paid}}</td>
                        <td>{{order.transaction_id}}</td>
                        <td>{{order.paid_at}}</td>
                        <td>{{order.status}}</td>
                        
                    </tr>
                </tbody>
            </table>
            <h6> <span class="italic py-3">Date:&nbsp;&nbsp; {{new Date().toLocaleString()}} &nbsp;&nbsp;</span></h6>
    </div>
    <div id="footer">
        <!-- pagination------------------- -->
        <div class="container p-2 d-flex justify-content-center" >      
            <a :href="this.current_orders.prev_page_url" class=" p-2 btn-default" @click="this.paginationPrev(this.current_orders.prev_page_url)"> Previous page</a>
            <span class="p-2">  {{this.current_orders.current_page}} Of {{this.current_orders.last_page}} </span>
            <a :href="this.current_orders.next_page_url" class="p-2 btn-default " @click="this.paginationNext(this.current_orders.next_page_url)"> Next page</a>                        
        </div>
        <!-- ------------------------------------ -->

      <MapLocation :order='this.current_order'/>
    <Footer />  
    </div>
</template>

<script>
import moment from 'moment';

import Pagination from "../../../Pagination/Pagination";
import Header from '../Layouts/Header'
import Footer from "../../../layouts/Footer";
import MapLocation from "../../MapLocation";
export default {
    components:{
        Header,
        Pagination,
        Footer ,
        MapLocation
    },
    data(){
        return{
            authRestaurant: window.authRestaurant,
            authUser: window.authUser,
            current_order:{},
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
        updateCurrentOrder(order){
            this.current_order = order;
        },
        markDelivered(id, value){
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss");
            if(this.current_order.status == 'delivered'){
                alert("Order already delivered!");
                return;
            }
            if(this.current_order.status == 'received' || this.current_order.status == 'processing'){
                alert("Order not processed yet!");
                return;
            }
            if(!this.current_order.cash_collected ){
                alert("Cash not collected!");
                return;
            }
            if(confirm("Are you sure you want to mark this order delivered?"))
            {            
                axios.get('/api/order/mark/' + id + '/' + value + '/' + date)
                .then( response => {
                    console.log(response);
                    if( response.status == 200){
                        this.refreshOrders();
                    } 
                    new Swal({
                        title:'Order successfuly delivered!',
                        timer:1200
                    });
                    document.getElementById('closeDeliver').click();
                })
                .catch( error => {
                    this.$swal('Failed!'); 
                });
            }
        },
        markTransit(order, value){
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss");
            if(order.status == 'received' || order.status == 'processing'){
                alert('Order not ready for pick up!');
                return;
            }
            if(order.status == 'delivered' || order.status == 'canceled'){
                alert('Order already delivered or it has been canceled!');
                return;
            }
            if(!confirm("Pick this order and mark it as transit?")) return;                       
                axios.get('/api/order/mark/' + order.id + '/' + value + '/' + date)
                .then( response => {
                    console.log(response);
                    if( response.status == 200){
                        this.refreshOrders();
                    } 
                    new Swal({
                        title:'Success!',
                        timer:1200
                    });
                    document.getElementById('closeDeliver').click();
                })
                .catch( error => {
                    this.$swal('Failed!'); 
                });
            
        },
        collectCash(order){
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss");
            if(this.current_order.paid == 'true'){
                alert("Order already paid");
                return;
            }
           if(this.current_order.status == 'delivered' ){
                alert("Order already delivered !");
                return;
            }
           if(this.current_order.status == 'received' || this.current_order.status == 'processing'){
                alert("Order not processed yet!");
                return;
            }
            if(this.current_order.cash_collected == 'true' ){
                alert("Cash already collected!");
                return;
            }
            if(confirm("Collect " + this.authRestaurant.currency + ' ' + this.current_order.amount + " for this order?"))
            {            
                axios.get('/api/order/collect-cash/' + order.id + '/' + order.amount + '/' + date)
                .then( response => {
                    if( response.status == 200){
                        new Swal({
                            title:'Cash successfuly collected!',
                            timer:1200
                        }); 
                        this.refreshOrders();
                    } 
                })
                .catch( error => {
                    this.$swal('Failed!'); 
                });
            }
        },
        refreshOrders(){
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
        paginationPrev(url){
            if(!url) return;
             axios.get( url)
            .then( response => {
            if( response.status == 200){
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);                            
                this.current_orders = response.data.data;     
                } 
            })
            .catch( error => {
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                new Swal({
                    title:'Error,  failed to fetch previous page!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
        },
        paginationNext(url){
            if(!url) return;
             axios.get( url)
            .then( response => {
            if( response.status == 200){
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);                            
                this.current_orders = response.data.data;     
                } 
            })
            .catch( error => {
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                new Swal({
                    title:'Error,  failed to fetch next page!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
        },
        printThisPage(){
            console.log('Printing...')
            document.getElementById('download').classList.remove('hidden');
            document.getElementById('parent').classList.add('hidden');
            document.getElementById('footer').classList.add('hidden');
            window.print();
            setTimeout(() => {
                document.getElementById('parent').classList.remove('hidden');
                document.getElementById('footer').classList.remove('hidden');
                document.getElementById('download').classList.add('hidden');
            }, 1000);
            console.log('Printing...')
        },
    },
   
    mounted(){
        this.refreshOrders();
        setInterval(this.refreshOrders(), 30000);                 
    }
}
</script>

<style scoped>
.bold{
      font-weight:600;
  }
  .hidden{
    display:none;
}

    /* media queries */
@media only screen and (max-width: 750px) {
  .px-5{
      padding-right:1px !important;
      padding-left:1px !important
  }
  .px-3{
      padding-right:3px !important;
      padding-left:3px !important;
  }
  
}
</style>