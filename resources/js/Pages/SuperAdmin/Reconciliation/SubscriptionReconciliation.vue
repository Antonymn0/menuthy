<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0 col-md-3">
                <Sidebar />
            </div>
            <div class="col-md-9 pt-5">
                <button class="btn btn-primary float-right" @click.prevent="this. getReconciliations()">Refresh</button>
                <h3> Reconciliation  </h3>
                <div class="table-responsive">
                    <table class="table-sm tables-striped  p-2">
                        <thead>
                            <th> # </th>
                            <th> Email </th>
                            <th> Name </th>
                            <th> Package type</th>
                            <th>Package  Period </th>
                            <th> Amount paid </th>
                            <th> Date paid </th>
                            <th> Date paid </th>
                            <th> Payment id </th>
                            <th> Reciept </th>
                            <th>Action </th>
                        </thead>
                        <tr v-for="(payment, index) in this.current_reconciliations" :key="index">
                            <td>{{index +1}}</td>
                            <td>{{payment.email}}</td>
                            <td>{{payment.customer_name}}</td>
                            <td>{{payment.package_type}}</td>
                            <td>{{payment.package_period}}</td>
                            <td>{{payment.amount_paid}}</td>
                            <td><span v-if="payment.reciept_url"><a :href="payment.reciept_url" target="black">View reciept</a></span></td>
                            <td>
                                <span class="btn btn-success">Reconcile</span>
                             </td>
                        </tr>
                    </table>

                </div>
                <Pagination :data="'this.users'"/> 
            </div>            
            <Footer />
        </div>
    </div>
</template>
<script>
import moment from 'moment';

import Header from '../Layouts/Header';
import Sidebar from '../Layouts/Sidebar';
import Footer from '../Layouts/Footer';
import Pagination from '../../Pagination/Pagination';
export default {
        components:{
            Header,
            Sidebar,
            Footer,
            Pagination
        },
        data(){
            return{
                current_reconciliations:{},
            }
        },
        methods:{
            getReconciliations(){
                 axios.get('api/admin/fetch-reconciliations')
                .then( response => {
                    this.current_reconciliations = response.data.data.data;
                    console.log(response.data.data.data);
                })
                .catch( error => {
                this.$swal('Failed!');
                    console.log(error.response.data.errors);                    
                });
            }
        },
        mounted(){
            this.getReconciliations();
        }

}
</script>