<template>
<header id="header">
    <Header />
    <Topnavbar /> 
</header>
    <div class="px-5  parent " >
        <div class="px-3 parent-inner " id="downloadable">  
            <div class="" id="title1">
                <p class="text-right">
                    <span class=""> <button class="btn btn-secondary m-1" @click.prevent="printThisPage()"><i class="bi bi-download"></i> Dowload </button></span>
                    <span><a href="/reports/custom" class="btn btn-danger m-1 "><i class="bi bi-file-earmark-text"></i> Custom report</a></span>
                </p>
               <h2 class="py-2 pl-1">Performance &amp;  Analysis report</h2>
            </div>          
              
            <div class="cards text-center pt-2 pb-2 text-muted" >
                 <h2 class="text-center p-3 hide" id="title2">{{capitalize(this.restaurant.restaurant_name)}}  Analysis report for year {{new Date().getFullYear()}}</h2>
                <h3 class="text-left pl-1">Order Performance</h3>
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
         <p class="text-center text-muted pt-3">
            <span class="italic ">Date:&nbsp;&nbsp; {{new Date().toLocaleString()}} &nbsp;&nbsp;</span>
        </p>
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
                document.getElementsByClassName('parent-inner')[0].classList.remove('px-3');
                document.getElementsByClassName('parent')[0].classList.remove('px-5');
                window.print();
                setTimeout(() => {
                    document.getElementById('header').classList.remove('hide');
                    document.getElementById('title1').classList.remove('hide');
                    document.getElementById('title2').classList.add('hide');
                    document.getElementsByClassName('parent-inner')[0].classList.add('px-3');
                    document.getElementsByClassName('parent')[0].classList.add('px-5');
                }, 1000); 
            },
            fetchOrders(){
                axios.get('/api/summary-reports/orders/' + this.restaurant.id )
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
@media only screen and (max-width: 950px) {
    .h-100{
        padding-left:0 !important;
        padding-right:0 !important;
    }
    .cards-inner{
    width:49%;
    }
    .parent{
        padding-left:0 !important;
        padding-right:0 !important;
    }
    .parent-inner{
        padding-left:5px !important;
        padding-right:5px !important;
    }
}
/* media queries */
@media only screen and (max-width: 600px) {
    .cards-inner{
        width:99%;
    }
}

</style>