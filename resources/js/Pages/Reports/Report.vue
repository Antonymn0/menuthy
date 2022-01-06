<template>
    <Header />
    <Topnavbar /> 

    <div class="px-5 pt-2 h-100 " >
        <div class="px-3 parent pt-5">
            <h2 class="py-2"> Reports and Analysis </h2>
            <div class="cards text-center">
               
                <div class="cards-inner ">
                    <div class="single-card shadow ">                        
                        <OrdersTodayChart :orders="this.orders"/>
                    </div>
                </div>

                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <OrdersThisWeekChart :orders="this.orders"/>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <OrdersThisMonthChart :orders="this.orders"/>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <OrdersThisYearChart :orders="this.orders"/>
                    </div>
                </div>
                
            </div>
            <div class="cards text-center">
               
                <div class="cards-inner ">
                    <div class="single-card shadow ">
                        <RevenueTodayChart :orders="this.orders"/>
                    </div>
                </div>

                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <p>Total revenue this week</p>
                        <p>500</p>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <p>Total revenue this month</p>
                        <p>5000</p>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <p>Total revenue this month chart</p>
                        <p>5000</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>


 
    
</template>
<script>
import moment from 'moment';
import $ from "jquery";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import AddMenuForm from "../Menus/AddMenuForm";
import EditMenuForm from "../Menus/EditMenuForm";
import Footer from "../layouts/Footer";

import OrdersTodayChart from '../Charts/OrdersTodayChart';
import OrdersThisWeekChart from '../Charts/OrdersThisWeekChart';
import OrdersThisMonthChart from '../Charts/OrdersThisMonthChart';
import OrdersThisYearChart from '../Charts/OrdersThisYearChart';
import RevenueTodayChart from '../Charts/RevenueTodayChart';

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
            RevenueTodayChart
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
            fetchOrders(){
                axios.get('api/reports/orders/' + this.restaurant.id + '/' + this.year)
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
.parent{
    min-height:60vh;
    }
.cards{
    width:100%;
}
.cards-inner{
    width:25%;
    padding:.4rem;
    float:left;
}
.single-card{
    padding:1rem;
}

/* media queries */
@media only screen and (max-width: 750px) {
    .h-100{
        padding-left:0 !important;
        padding-right:0 !important;
    }
    .cards-inner{
    width:49%;
    }
}
/* media queries */
@media only screen and (max-width: 600px) {
    .cards-inner{
        width:99%;
    }
}

</style>