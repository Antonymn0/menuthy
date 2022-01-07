<template>
<header id="header">
    <Header />
    <Topnavbar /> 
</header>
    <div class="px-5   " >
        <div class="px-3">
            <h2>Custom reports</h2>
            <div class="p-2 table-responsive" >        
            <table class="table table-light table-borderless bg-white table-hover table-striped align-middle" style="overflow:scroll">
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
                        <th scope="col">Paid at</th>
                        <th scope="col">Status</th>                                 
                        <th scope="col">Time received </th>
                        <th scope="col">Time completed </th>  
                     </tr>
               </thead>
               
            </table> 
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
                orders:[],
                total_orders:0
            }
        },
        methods:{
             capitalize(string) {
                if(string) return string.charAt(0).toUpperCase() + string.slice(1);
                else return; 
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
            fetchOrders(){
                axios.get('/api/reports/orders/' + this.restaurant.id + '/' + this.year)
                .then( response => {  
                    if(response.status == 200){
                        this.orders = response.data.data;
                    }                             
                })
                .catch(error=>{
                    new Swal({   title:'Failed!', timer:1200 });
                    console.log(error);
                });
            }
        },
        mounted(){
            this.fetchOrders();
        },
        created(){
            this.fetchOrders();
        }
}
</script>

<style scoped>
.hide{
    display:none;
}



/* media queries */
@media only screen and (max-width: 750px) {
  
}
/* media queries */
@media only screen and (max-width: 600px) {
    
}

</style>