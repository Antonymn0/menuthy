<template>
<header id="header">
    <Header />
    <Topnavbar /> 
</header>
    <div class="px-5   " >
        <div class="px-3 parent " id="downloadable">  
            <div class="" id="title1">
                <p class="">
                    <span class="float-right"> <button class="btn btn-danger" @click.prevent="printThisPage()">Dowload this report</button></span>
                </p>
               <h2 class="py-2 pl-1">Performance &amp;  Analysis report</h2>
            </div>          
              
            <div class="cards text-center pt-2 pb-2 text-muted" >
                <h3 class="text-left pl-1">Order Performance</h3>
                 <h2 class="text-center p-3 hide" id="title2">{{capitalize(this.restaurant.restaurant_name)}}  Analysis report for year {{new Date().getFullYear()}}</h2>
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
            <div class="cards text-center pt-2 text-muted">
               <h3 class="text-left pl-1 py-2">Revenue Analysis</h3>
                <div class="cards-inner ">
                    <div class="single-card shadow ">
                        <RevenueTodayChart :orders="this.orders"/>
                    </div>
                </div>

                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <RevenueThisWeekChart :orders="this.orders"/>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <RevenueThisMonthChart :orders="this.orders"/>
                    </div>
                </div>
                <div class="cards-inner ">
                    <div class="single-card shadow">
                        <RevenueThisYearChart :orders="this.orders"/>
                    </div>
                </div>
                
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
.hide{
    display:none;
}
.parent{
    min-height:60vh;
    height: auto;
    }
.cards{
    display: table;
    width:100%;
}
.cards-inner{
    display: table-cell;
    width:25%;
    padding:.4rem;
    float:left;
}
.single-card{
    padding:1rem;
    flex:1;
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