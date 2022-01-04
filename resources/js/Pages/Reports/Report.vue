<template>
    <Header />
    <Topnavbar /> 

    <div class="px-5 h-100 " >
        <div class="px-3 parent">
            Reports page
            <div class="cards text-center">
               
                <div class="cards-inner p-2">
                    <div class="single-card shadow ">
                        <p>Total orders today</p>
                        <p>56</p>
                        <Chart />
                    </div>
                </div>

                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total orders this week</p>
                        <p>500</p>
                    </div>
                </div>
                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total orders this month</p>
                        <p>5000</p>
                    </div>
                </div>
                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total orders this month chart</p>
                        <p>5000</p>
                    </div>
                </div>
                
            </div>
            <div class="cards text-center">
               
                <div class="cards-inner p-2">
                    <div class="single-card shadow ">
                        <p>Total revenue today</p>
                        <p>56</p>
                    </div>
                </div>

                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total revenue this week</p>
                        <p>500</p>
                    </div>
                </div>
                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total revenue this month</p>
                        <p>5000</p>
                    </div>
                </div>
                <div class="cards-inner p-2">
                    <div class="single-card shadow">
                        <p>Total revenue this month chart</p>
                        <p>5000</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <Footer /> 
 
    
</template>
<script>
import moment from 'moment';
import $ from "jquery";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import AddMenuForm from "../Menus/AddMenuForm";
import EditMenuForm from "../Menus/EditMenuForm";
import Footer from "../layouts/Footer";

import Chart from '../Charts/Chart.vue';

export default {
     components: {
       Header,
        Topnavbar,
        Footer,
        AddMenuForm,
        EditMenuForm,
        Chart,

        },
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
    float:left;
}

</style>