<template>
<header id="header">
    <Header />
    <Topnavbar /> 
</header>
    <div class="px-5  parent " >        
        <div class="px-3 parent-inner py-4">
            <h2>Custom reports</h2>
            <div>
                <div class="rounded  filters p-3 shadow" >
                    <div class="p-2 mr-3">
                        <h4 class="">Filters </h4>
                        <div class="mb-1 filter-panels p-1 mr-1 border-left">
                            <p class="mb-0">Order type</p>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="dine_in" value="Dine In"  v-model="this.order_type" name="order_type" type="radio" >
                                <label class="form-check-label" for="dine_in"> <small>Dine in </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="take_away" value="Take Away"   v-model="this.order_type" name="order_type" type="radio" >
                                <label class="form-check-label" for="take_away"> <small>Pick Up </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="drive_through" value="Drive Through"   v-model="this.order_type" name="order_type" type="radio" >
                                <label class="form-check-label" for="drive_through"> <small>Drive Through </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="home_delivery" value="Home Delivery"   v-model="this.order_type" name="order_type" type="radio" >
                                <label class="form-check-label" for="home_delivery"> <small>Home Delivery </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="all1" value="all"   v-model="this.order_type" name="order_type" type="radio" >
                                <label class="form-check-label" for="all1"> <small>All </small> </label>
                            </div>                        
                        </div>
                        <!-- ---------------------------- -->
                        <div class="mb-1 filter-panels p-2 border-left">
                            <p class="mb-0">Date range</p>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="today" value="today"  v-model="this.period" name="period" type="radio" >
                                <label class="form-check-label" for="today"> <small>Today </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="last_3_days" value="last 3 days"   v-model="this.period" name="period" type="radio" >
                                <label class="form-check-label" for="last_3_days"> <small>Last 3 days </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="last_7_days" value="last 7 days"   v-model="this.period" name="period" type="radio" >
                                <label class="form-check-label" for="last_7_days"> <small> Last 7 days</small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input p-2" id="last_30_days" value="last 30 days"   v-model="this.period" name="period" type="radio" >
                                <label class="form-check-label" for="last_30_days"> <small> Last 30 days </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input p-2" id="last_90_days" value="last 90 days"   v-model="this.period" name="period" type="radio" >
                                <label class="form-check-label" for="last_90_days"> <small> Last 90 days </small> </label>
                            </div>                        
                        </div>                    
                    </div>
                    <!-- ---------------------------- -->
                    <div class="p-2">
                    <div class="mb-1 filter-panels border-left p-2 mr-3">
                            <p class="mb-0">Order status</p>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="recieved" value="received"  v-model="this.order_status" name="order_status" type="radio" >
                                <label class="form-check-label" for="recieved"> <small>Recieved </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="processing" value="processing"   v-model="this.order_status" name="order_status" type="radio" >
                                <label class="form-check-label" for="processing"> <small>Processing </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="completed" value="completed"   v-model="this.order_status" name="order_status" type="radio" >
                                <label class="form-check-label" for="completed"> <small>Completed </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="canceled" value="canceled"   v-model="this.order_status" name="order_status" type="radio" >
                                <label class="form-check-label" for="canceled"> <small>Canceled </small> </label>
                            </div>
                            <div class="form-check form-check-inline" >
                                <input class="form-check-input" id="all2" value="all"   v-model="this.order_status" name="order_status" type="radio" >
                                <label class="form-check-label" for="all2"> <small>All </small> </label>
                            </div>                        
                        </div>
                        <!-- ---------------------------- -->
                        <div class="mb-1 filter-panels  border-left p-2">
                            <p class="mb-0">Table number</p>
                            <div class="form-check form-check-inline mr-3" >
                                <input type="number" id="tables1" v-model="this.table_number" min="1" max="50" @input.prevent="updateCheckbox()">
                                <label class="form-check-label p-2" for="tables1"> <small>Table number </small> </label>
                               </div>
                            <div class="form-check form-check-inline ml-2" >
                                <input type="checkbox" id='tables2'   :checked='this.check_box_checked'  value="all" class="p-1" @change.prevent="updateTables()">
                                <label class="form-check-label p-2" for="tables2" > <small>All tables </small> </label>
                            </div>

                        </div>
                    </div>
                    <p class="d-flex justify-content-between mb-0">
                        <span  class="text-left mr-4">
                            <button class="btn btn-primary text-left" @click.prevent="fetchOrders()"> Filter</button> 
                        </span>
                        <span class="">
                            <span class="float-left" :class="this.spinner"></span> 
                            <button class="btn btn-success mr-2 m-1 " @click.prevent="fetchOrders()"> <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</button> 
                            <button class="btn btn-secondary m-1 " @click.prevent="dowloadReport()"><i class="bi bi-download"></i> Download </button> 
                            <a href="/reports/summary" class="btn btn-danger"><i class="bi bi-file-earmark-text"></i> Summary report</a>
                        </span> 
                    </p>                  
                                    
                </div>
                <div class="text-right">               
                 </div>
            </div>            
            <div class="p-2 py-4 table-responsive" id="downloadable" > 
                <div class="text-center hide" id="hidden">
                    <h2>{{this.restaurant.restaurant_name}} </h2>
                    <p>{{capitalize(this.sort_term)}} order record</p>
                </div>
                <p class='text-center'>
                    <span> <b> Total orders: {{ this.total_orders}}</b> &nbsp; &nbsp; &nbsp;</span> 
                    <span>Received: {{ this.received}} &nbsp;&nbsp;</span> 
                    <span>Processing: {{ this.processing}} &nbsp;&nbsp;</span> 
                    <span>Completed: {{ this.completed}} &nbsp;</span> 
                    <span>Canceled: {{ this.canceled}} &nbsp;</span> 
                    <span> <b>  Revenue: {{ this.total_revenue}} &nbsp; </b> </span> 
                </p>       
                <table class="table table-light table-borderless bg-white table-hover table-sm  table-striped align-middle p-3" style="overflow:scroll">
                    <thead class="lead p-2">
                        <tr class="p-2">
                            <th scope="col">#</th>
                            <th scope="col">Order no</th>
                            <th scope="col">Type</th>
                            <th scope="col">No/Items</th>
                            <th scope="col">Table</th>
                            <th scope="col">Customer name</th>
                            <th scope="col">Customer Phone</th>
                            <th scope="col">Delivery address</th>
                            <th scope="col">Car Reg</th>
                            <th scope="col">Amount </th>
                            <th scope="col">Paid</th>
                            <th scope="col">Transaction id</th>
                            <th scope="col">Status</th>                                 
                            <th scope="col">Time received </th>
                            <th scope="col">Time completed </th>  
                        </tr>
                    </thead>                
                    <tbody v-for="(order, index) in this.current_orders" :key="order.id">
                        <tr >
                            <td> <b>{{index +1}} </b> </td>
                            <td>{{order.order_number}}</td>
                            <td>{{order.order_type}}</td>
                            <td>{{order.number_of_items}}</td>
                            <td>{{order.table_number}}</td>
                            <td>{{capitalize(order.customer_name)}}</td>
                            <td>{{order.customer_phone}}</td>
                            <td>{{order.delivery_address}}</td>
                            <td>{{order.car_registration_no}}</td>
                            <td>{{order.amount}}</td>
                            <td v-if="order.paid =='false'" class="text-danger">No</td>
                            <td v-if="order.paid =='true'" class="text-primary">Yes</td>
                            <td>{{capitalize(order.transaction_id)}}</td>
                            <td v-if="order.status == 'received'" class="text-success">{{ capitalize(order.status) }}</td>
                            <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                            <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}...</td>
                            <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                            <td>{{formatDate(order.created_at)}}</td>
                            <td>{{formatDate(order.completed_at)}}</td> 
                        </tr>                         
                                                          
                    </tbody> 
                    <tbody>
                         <tr  class="lead ">
                            <td colspan="13" class="text-right">Total Amount</td>
                            <td>{{this.total_revenue}}</td>
                        </tr> 
                    </tbody>                     
                    
                </table> 
                <p class="text-center"> <small>Tip: Revenue calculation does not include canceled and unpaid orders.</small> </p>
                <p class='text-center border-top mt-2 pt-1'>
                    <span> <b> Total orders: {{ this.total_orders}}</b> &nbsp; &nbsp; &nbsp;</span> 
                    <span>Received: {{ this.received}} &nbsp;&nbsp;</span> 
                    <span>Processing: {{ this.processing}} &nbsp;&nbsp;</span> 
                    <span>Completed: {{ this.completed}} &nbsp;</span> &nbsp;
                    <span>Canceled: {{ this.canceled}} &nbsp; &nbsp;&nbsp;</span>  
                    <span> <b>  Revenue: {{ this.total_revenue}} &nbsp; </b> </span>                    
                </p> 
                <p class="text-right text-muted">
                    <span class="italic ">Date:&nbsp;&nbsp; {{new Date().toLocaleString()}} &nbsp;&nbsp;</span>
                </p>
            </div>     
        </div>    
    </div>
<footer>
    <div class="">
        <div class=""></div>
        <div class="  p-3">
            <p class="text-center mt-2 text-muted b">Menuthy @{{new Date().getFullYear()}} All rights reserved</p>
        </div>
    </div>
</footer>

 
    
</template>
<script>
import moment from 'moment';
import $ from "jquery";
import html2pdf from "html2pdf.js";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import AddMenuForm from "../Menus/AddMenuForm";
import EditMenuForm from "../Menus/EditMenuForm";
import Footer from "../layouts/Footer";

import OrdersTodayChart from '../Charts/Orders/OrdersTodayChart';
import OrdersThisWeekChart from '../Charts/Orders/OrdersThisWeekChart';
import OrdersThisMonthChart from '../Charts/Orders/OrdersThisMonthChart';
import OrdersThisYearChart from '../Charts/Orders/OrdersThisYearChart';
import RevenueTodayChart from '../Charts/Revenue/RevenueTodayChart';
import RevenueThisWeekChart from '../Charts/Revenue/RevenueThisWeekChart';
import RevenueThisMonthChart from '../Charts/Revenue/RevenueThisMonthChart';
import RevenueThisYearChart from '../Charts/Revenue/RevenueThisYearChart';

export default {
     components: {
            Header,
            Topnavbar,
            Footer,
            AddMenuForm,
            EditMenuForm,
            OrdersTodayChart,
            OrdersThisWeekChart,
            OrdersThisMonthChart,
            OrdersThisYearChart,
            RevenueTodayChart,
            RevenueThisWeekChart,
            RevenueThisMonthChart,
            RevenueThisYearChart,
        },
        data(){
            return{
                restaurant: window.authRestaurant,
                year: new Date().getFullYear(),
                current_orders:[],
                total_orders:0,
                received:0,
                processing:0,
                completed:0,
                canceled:0,
                total_revenue:0,
                period:'today',
                order_type:'all',
                table_number:'all', 
                order_status:'all' ,
                spinner:'',
                check_box_checked:true
                }
        },
        methods:{
            updateCheckbox(){
                this.check_box_checked = false;
            },
            updateTables(){
                if(this.check_box_checked === true){
                    this.check_box_checked = false;
                    this.table_number = 1;                    
                }                
                else{
                    this.check_box_checked = true;
                    this.table_number = 'all';
                }
               console.log(this.table_number) ;
               console.log(this.check_box_checked) ;
            },
            capitalize(string) {
                if(string) return string.charAt(0).toUpperCase() + string.slice(1);
                else return; 
                },
            formatDate(date){
                if (date) return moment(String(date)).format('L') + ' ' + moment(String(date)).format('LT');            
            },    
            printThisPage(){
                document.getElementById('header').classList.add('hide');
                document.getElementById('title1').classList.add('hide');
                document.getElementById('title2').classList.remove('hide');
                window.print();
                setTimeout(() => {
                    document.getElementById('header').classList.remove('hide');
                    document.getElementById('title1').classList.remove('hide');
                    document.getElementById('title2').classList.add('hide');
                }, 1000); 
            },
            fetchOrders(sort_term){
                this.spinner = 'spinner-border spinner-border-sm';
                axios.get('/api/custom-reports/orders/' + this.restaurant.id + '/' + this.period + '/' + this.order_type + '/' + this.table_number + '/' + this.order_status)
                .then( response => {  
                    if(response.status == 200){
                        this.total_orders = 0;
                        this.received = 0;
                        this.processing = 0;
                        this.completed = 0;
                        this.canceled = 0;
                        this.total_revenue =0;
                        this.current_orders = response.data.data;
                        this.sortOrders();
                        this.spinner ='';
                    }                             
                })
                .catch(error=>{
                    this.spinner ='';
                    new Swal({   title:'Failed!', timer:1200 });
                    console.log(error);
                });
            },
            loadOrders(){                
                axios.get('/api/custom-reports/orders/' + this.restaurant.id + '/' + this.period + '/' + this.order_type + '/' + this.table_number + '/' + this.order_status)
                .then( response => {  
                    if(response.status == 200){
                        console.log(response.data);
                        this.current_orders = response.data.data;
                        this.sortOrders();
                    }                             
                })
                .catch(error=>{
                    new Swal({   title:'Failed!', timer:1200 });
                    console.log(error);
                });
            } ,
            sortOrders(){
                this.current_orders.forEach((order)=>{
                    this.total_orders +=1;
                    if(order.status == 'received') this.received +=1;
                    if(order.status == 'processing') this.processing +=1;
                    if(order.status == 'completed') this.completed +=1;
                    if(order.status == 'canceled') this.canceled +=1;
                    if(order.status !== 'canceled' && order.paid == 'true') this.total_revenue += order.amount
                });
            }, 
            dowloadReport(){
                this.sortOrders();
                document.getElementById('hidden').classList.remove('hide');
                let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

                mywindow.document.write(`<html><head><title>Download PDF</title>`);
                mywindow.document.write('</head><body >');
                mywindow.document.write(document.getElementById('downloadable').innerHTML);
                mywindow.document.write('</body></html>');

                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/
                mywindow.print();
                mywindow.close();

                document.getElementById('hidden').classList.add('hide');
                return true;

                // var invoice = document.getElementById('downloadable');
                // var opt = {
                //     margin: 1,
                   
                // };
                // html2pdf().from(invoice).set(opt).save();
            },     
        },
        
        mounted(){
            this.loadOrders();
            this.sortOrders();
        },
       
}
</script>

<style scoped lang="scss">
@import "../../../sass/app.scss"; 
@import url('https://fonts.googleapis.com/css?family=Poppins');

.hide{
    display:none;
}

/* radio btns */
// input[type='radio']:after {
//         width: 15px;
//         height: 15px;
//         border-radius: 15px;
//         top: -2px;
//         left: -1px;
//         position: relative;
//         background-color: #e9e7e367;
//         content: '';
//         display: inline-block;
//         visibility: visible;
//         border: 2px solid rgb(248, 211, 108);
//     }

//     input[type='radio']:checked:after {
//         width: 17px;
//         height: 17px;
//         border-radius: 15px;
//         top: -2px;
//         left: 0;
//         position: relative;
//         background-color: $orange;
//         content: '';
//         display: inline-block;
//         visibility: visible;
//         border: 3px solid $orange;
//     }
//     .filters{

//     }
    .filter-panels{
        width:auto;
        display: inline-block;
    }

/* media queries */
@media only screen and (max-width: 750px) {
  .parent{
      padding-right:5px !important;
      padding-left:5px !important
  }
  .parent-inner{
      padding-right:5px !important;
      padding-left:5px !important;
  }
}
/* media queries */
@media only screen and (max-width: 600px) {
    
}

</style>