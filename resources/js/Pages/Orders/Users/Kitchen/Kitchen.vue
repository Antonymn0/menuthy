<template>
<Header />
     <div class="parent-div m-1 pt-2 mx-auto">       
        <div class=" row p-3">            
            <h2 class="col-md-6 float-left">
               Kitchen Orders
            </h2>
            <p class="col-md-6 text-right float-right">
                <a href="#" class="btn btn-danger daily-report"> <i class="fa fa-arrow-circle-o-up pr-2 pl-2"></i> Export daily report</a>
                <a :href="'/' + this.authRestaurant.id + '/orders/print'" class="btn text-white px-2 mx-3" style="background-color: #36a3f7;" @click="this.showLoading()"> <i class="fa fa-arrow-circle-o-up pr-2" ></i>Export </a>
                <a href="#" id="refresh" class="btn btn-primary" @click.prevent="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p>
        </div>
        <div>
            <!-- audio player  -->
            <audio            
                ref="audio"
                src="/audio/beep-4.mp3">
            </audio>
        </div>

        <div class="filter-div row">
            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="status"> Status </label>
                     <select id="status" class="form-control" v-model="select_status" @change="fetchOrders(this.select_status)"> 
                       <option value="today"> All </option>
                        <option value="recieved"> Open </option>
                        <option value="completed"> Completed </option>
                        <option value="transit"> Transit </option>
                        <option value="delivered"> Delivered </option>
                        <option value="canceled"> Canceled </option>
                     </select>
                </div>
                 <div class="forn-group p-2">
                     <label for="mode"> Order type:</label>
                     <select id="mode" class="form-control"  v-model="select_status" @change="fetchOrderTypes(this.select_status)"> 
                       <option value="all"> All </option>
                        <option value="Dine In"> Dine in </option>
                        <option value="Take Away"> Pick-Up </option>
                        <option value="Drive Through"> Drive-Thru </option>
                        <option value="Home Delivery"> Delivery </option>
                     </select>
                </div>
            </div>

            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="date"> Update time </label>
                    <input type="date" name="" id="date" class="form-control" v-model="this.date" @change="fetchOrderBydate(this.date)">
                </div>
                 <div class="forn-group p-2">
                     <label for="tables"> Tables</label>
                     <select id="tables" class="form-control" v-model="select_status" @change="fetchOrderTables(this.select_status)"> 
                        <option value="all"> All </option>
                        <option value="1"> Table 1 </option>
                        <option value="2"> Table 2 </option>
                        <option value="3"> Table 3 </option>
                        <option value="4"> Table 4 </option>
                        <option value="5"> Table 5 </option>
                        <option value="6"> Table 6 </option>
                        
                     </select>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="form-group col">
                    <label for="status"> Order no </labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="this.order_no">
                        <button  class=" rounded" @click="searchOrderNo(this.order_no)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.order_no}}</small>
                    </p> 
                </div>
                 <div class="forn-group py-4">
                     <label for="hide"> Hide empty orders</label> <br />
                    <input type="checkbox" name="" id="hide" class="p-2">
                </div>
            </div>
     </div>
  <div class="p-2 table-responsive" >        
            <table class="table table-light table-borderless bg-white table-hover table-striped align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Time received</th>
                        <th scope="col">Time completed</th>
                        <th scope="col">Time delivered</th>
                        <th scope="col">Time canceled</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Type</th>
                        <th scope="col">No of Items</th>
                        <th scope="col">Table</th>
                        <th scope="col">Customer name</th>
                        <th scope="col">Customer Phone</th>
                        <th scope="col">Delivery address</th>
                        <th scope="col">Car Reg</th>
                        <th scope="col">Status</th>
                        <th scope="col">View details</th> 
                    <th scope="col">Action</th>                   
                     </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr class="accordion border-bottom" onclick="toggleAccordion()" >
                        <th scope="row">{{index +1}}</th>
                        <td>{{formatDate(order.created_at)}}</td>
                         <td v-if="order.completed_at">{{formatDate(order.completed_at)}}</td>
                        <td v-else>-</td>
                        <td v-if="order.delivered_at">{{formatDate(order.delivered_at)}}</td>
                        <td v-else>-</td>
                        <td v-if="order.canceled_at">{{formatDate(order.canceled_at)}}</td>
                        <td v-else>-</td>
                        <td>{{order.order_number}}</td>
                       <td v-if="order.order_type == 'Dine In' ">Dine-In</td>
                        <td v-if="order.order_type == 'Drive Through' ">Drive-Thru</td>
                        <td v-if="order.order_type !== 'Drive Through' && order.order_type !== 'Dine In' ">{{capitalize(order.order_type)}}</td>
                        <td v-if="order.number_of_items" class="">{{order.number_of_items}}</td>
                        <td v-if="order.table_number >0" class="">{{order.table_number}}</td>
                        <td v-else>-</td>   
                        <td  class="" v-if="order.customer_name">{{order.customer_name}}</td>
                        <td v-else>-</td>
                        <td  class="" v-if="order.customer_pnone">{{order.customer_phone}}</td>
                        <td v-else>-</td>
                        <td  class="" v-if="order.delivery_address">{{order.delivery_address}}</td>
                        <td v-else>-</td>
                        <td  class="" v-if="order.car_registation_no">{{order.car_registration_no}}</td> 
                        <td v-else>-</td>                   
                        <td v-if="order.status == 'received'" class="text-success">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>                        
                        <td v-if="order.status == 'delivered'" class="text-muted">{{capitalize(order.status)}}</td> 
                        <td> <span class="badge btn-danger  p-1" @click="expandRow($event)"> Details <i class="bi bi-caret-down-fill"></i></span> </td>                      
                        <td class=" mx-auto  m-1 " v-if="order.status != 'canceled'">
                            <span v-if="order.mode_of_payment =='stripe' && order.paid == 'true'">
                                <a href="#" class="badge badge-primary btn ml-3 mb-2" @click.prevent="markOrder(order.id, 'processing')">Processing</a>
                                <a href="#" class="badge badge-success btn m-1" @click.prevent="markOrder(order.id, 'completed')">Complete</a>
                            </span>
                            <span v-if="order.mode_of_payment =='stripe' && order.paid == 'false'">
                                <button class="disabled p-2 btn-default badge text-dark">Payment pending...</button>
                            </span>
                            <span v-if="order.mode_of_payment !=='stripe'">
                                <a href="#" class="badge badge-primary btn ml-3 mb-2" @click.prevent="markOrder(order.id, 'processing')">Processing</a>
                                <a href="#" class="badge badge-success btn m-1" @click.prevent="markOrder(order.id, 'completed')">Complete</a>                               
                            </span>
                           
                        </td> 
                        <td v-else class="">
                            <a href="#" class="badge badge-danger btn ml-3  disabled" >Canceled</a>
                        </td>                                              
                    </tr>  
                    <tr class="panel alert-danger " style="display:none;" >
                        <td> </td>
                        <td> </td>
                        <td colspan="10" class="">
                            <div class="table-responsive text-center mb-2" v-if="order.order_item">

                                <h5 class="">Order items</h5>

                                <table class="table-md  table2 alert-danger rounded p-3 mb-2 mx-auto" v-if="order.mode_of_payment !== 'stripe'">
                                    <thead >
                                        <th># </th>
                                        <th>Order  no </th>
                                        <th>Order name </th>
                                        <th>Qty </th>
                                        <th>Table no</th>
                                        <th>Ready Time </th>
                                        <th>status </th>
                                    </thead>
                                    <tbody  > 
                                        <tr v-for="(item, index) in order.order_item" :key="index" class="border-bottom"> 
                                            <th> {{index +1}} </th>
                                            <td> {{item.order_number}} </td>
                                            <td> {{item.item_name}} </td>
                                            <td> {{item.quantity}} </td>
                                            <td v-if="order.table_number >0"> {{order.table_number}} </td>
                                            <td v-else>-</td>
                                            <td> {{item.preparation_time}} </td>
                                            <td v-if="order.status == 'received'" class="text-success">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                                            <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                                            <td v-if="order.status == 'delivered'" class="text-muted">{{capitalize(order.status)}}</td>
                                      </tr>
                                    </tbody>
                                 </table>

                                <table class="table-md  table2 alert-danger rounded p-3 mb-2 mx-auto" v-if="order.mode_of_payment == 'stripe' && order.paid=='true'">
                                    <thead >
                                        <th># </th>
                                        <th>Order  no </th>
                                        <th>Order name </th>
                                        <th>Qty </th>
                                        <th>Table no</th>
                                        <th>Ready Time </th>
                                        <th>status </th>
                                    </thead>
                                    <tbody  > 
                                        <tr v-for="(item, index) in order.order_item" :key="index" class="border-bottom"> 
                                            <th> {{index +1}} </th>
                                            <td> {{item.order_number}} </td>
                                            <td> {{item.item_name}} </td>
                                            <td> {{item.quantity}} </td>
                                            <td v-if="order.table_number >0"> {{order.table_number}} </td>
                                            <td v-else>-</td>
                                            <td> {{item.preparation_time}} </td>
                                            <td v-if="order.status == 'received'" class="text-success">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                                            <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                                            <td v-if="order.status == 'delivered'" class="text-muted">{{capitalize(order.status)}}</td>
                                      </tr>
                                    </tbody>
                                 </table> 
                                    <p  v-if="order.mode_of_payment == 'stripe' && order.paid =='false'" class="text-center"> <span class="text-default lead border p-2 my-3"> Payment Pending... </span> </p>
                             </div>
                             <div v-else>
                                 <p class="text-muted py-3 text-center"> No records to show</p>
                             </div>
                        </td>
                        <td> </td>
                    </tr>       
                
                </tbody>
                <tbody>
                    <tr class="p-2 border-top">
                        <td colspan="13" class="text-right border-right">
                           <b> Total orders</b> 
                        </td>
                        <td class="">
                            {{this.current_orders.total}}
                        </td>
                    </tr>
                </tbody>
               
            </table>
            <p class="small text-muted text-center">Tip: A beep sound for Received orders. </p>
             
        </div>
    </div>
    <!-- pagination------------------- -->
        <div class="container p-2 d-flex justify-content-center" >      
        <a :href="this.current_orders.prev_page_url" class=" p-2 btn-default" @click.prevent="this.paginationPrev(this.current_orders.prev_page_url)"> Previous page</a>
        <span class="p-2">  {{this.current_orders.current_page}} Of {{this.current_orders.last_page}} </span>
        <a :href="this.current_orders.next_page_url" class="p-2 btn-default " @click.prevent="this.paginationNext(this.current_orders.next_page_url)"> Next page</a>                        
    </div>
    <!-- ------------------------------------ -->
    <Footer />
</template>

<script>
import moment from 'moment';

import Pagination from "../../../Pagination/Pagination";
import Header from '../Layouts/Header'
export default {
    components:{
        Header,
    },
    data(){
       return{
           page: 1,
            current_orders:'',
            counter:0,
            authRestaurant:{},
            refreshOrdersInterval:'',
            select_status:'',
            date:'',
            order_no:'',
            errors:{},
       }
   },
   methods:{
       expandRow(event){
           event.target.parentElement.click();
       },
        formatDate(date){
            if (date) {
                return moment(String(date)).format('L') + ' ' + moment(String(date)).format('LT');
            }
        },
        capitalize(string) {
        if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        else return;
        },
        markOrder(id, value){
            if(!confirm("Update this order status?")) return;
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss"); 
            axios.get('/api/order/mark/' + id + '/' + value +'/' + date)
            .then( response => {
                if( response.status = 200){
                    this.refreshOrders();
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to update!');                
                console.log(error.response.data.errors);                    
            });
        },
        cancelOrder(id, value){
            var date= new Date();
            date = moment(date).format("YYYY-MM-DD HH:mm:ss");
            if(confirm("Are you sure you want to cancel this order?"))
            {            
                axios.get('/api/order/mark/' + id + '/' + value + '/' + date)
                .then( response => {
                if( response.status = 200){

                    } 
                })
                .catch( error => {
                    this.$swal('Error,  failed to update!');                
                 
                });
            }
        },
        fetchOrders(search_term){
            axios.get('/orders/'+ this.authRestaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },
      searchOrderNo(order_no){
            this.errors = {};
            this.current_orders = [];
            console.log(order_no);
             axios.get('/search-orders/' + order_no)
            .then( response => {
            if( response.status == 200){
                console.log(response.data.data);
                if(!response.data.data.length){
                    this.errors.order_no = "No results found";
                    return;
                }
                this.title = 'Results';
                this.current_orders=response.data;
               console.log(response.data);
               this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval)
                } 
            })
            .catch( error => {
                this.errors.order_no = "No results found";
                console.log(error); 
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                             
            });
        },
        fetchOrderBydate(date){
            console.log(this.date);
            axios.get('/orders/'+ this.authRestaurant.id + '/date/' + date)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                console.log(response.data.data);
                
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },
        fetchOrderTypes(order_type){
            if(order_type == 'all'){ this.refreshOrders(); return;}
            axios.get('/orders/'+ this.authRestaurant.id + '/type/' + order_type)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                console.log(response.data.data);
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });   
                   
            });
        },
        fetchOrderTables(table_no){
            if(table_no == 'all'){ this.refreshOrders(); return;}
            axios.get('/orders/'+ this.authRestaurant.id + '/tables/' + table_no)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                console.log(response.data.data);
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },
        fetchOrderBydate(date){
            console.log(this.date);
            axios.get('/orders/'+ this.authRestaurant.id + '/date/' + date)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                console.log(response.data.data);
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },
        refreshOrders(){
            axios.get( '/' + this.authRestaurant.restaurant_name + '/orders/' + this.authRestaurant.id + '/refresh')
            .then( response => {
            if( response.status = 200){
            this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
             this.refreshOrdersInterval = setInterval(this.refreshOrders, 10000);
                // scan response for new orders
                response.data.data.data.forEach(order => {
                    // play a beep sound for a new order 
                    if(order.status == 'received'){  
                        if(order.mode_of_payment == 'stripe' && order.paid == 'false') return; // dont play sound for unpaid stripe orders                    
                        try {
                           this.$refs.audio.play();
                        return; 
                        } catch (error) {
                            console.log("Audio play failed.");
                        }                        
                    } 
                });
                this.current_orders = response.data.data;                
                } 
            })
            .catch( error => {
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
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
        muteAudio(){
            // this.$refs.audio.mute();
        },
        showLoading(){            
            Swal.showLoading();
        },        
   },

    mounted(){
        this.refreshOrdersInterval = setInterval(this.refreshOrders, 10000);  //refresh orders every 10 seconds on load
        this.authRestaurant = window.authRestaurant;
        this.refreshOrders();
    }
}
</script>

<style lang="scss" scoped>
.parent-div{
    font-family:poppins;
    font-weight:400;
    color:#9699a2;
    width:90%;
}
.daily-report{
    display:inline;
}

/* Style the buttons that are used to open and close the accordion panel */
.accordion {
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  border: none;
  outline: none;
  transition: 1s;
}
.table2{
    border: 1px solid rgb(231, 133, 133);
}
/* Add a background color to the button if it is clicked on (add the .active class with JS), and when you move the mouse over it (hover) */
 .accordion:hover {
  background-color: #ccc;
}

/* Style the accordion panel. Note: hidden by default */
.panel {
  padding: 0 18px;
  background-color: white;
  overflow: hidden;
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

/* media quesries */
@media only screen and (max-width: 750px) {
  .daily-report{
    display:none;
}

}

</style>