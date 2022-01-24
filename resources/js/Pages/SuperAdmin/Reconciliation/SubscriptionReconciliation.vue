<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0 col-md-3">
                <Sidebar />
            </div>
            <div class="col-md-9 pt-5">
                <button class="btn btn-success float-right" @click.prevent="this. getReconciliations()">Refresh</button>
                <h4>Subscription Payments Reconciliation <small class="text-muted">(Incomplete)</small> </h4>
                <div>
                    <form class="form-inline">
                        
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="email" class="sr-only">Search by Email</label>
                            <input type="email" class="form-control" id="iemail" placeholder="Email">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                        </form>
                </div>
                <div class="table-responsive">
                    <table class="table-sm table-striped  p-2">
                        <thead>
                            <th> # </th>
                            <th> Email </th>
                            <th> Name </th>
                            <th> Package type</th>
                            <th>Package  Period </th>
                            <th>Currency </th>
                            <th> Amount paid </th>
                            <th> Date paid </th>
                            <th> Payment id </th>
                            <th> Reciept </th>
                            <th>Action </th>
                        </thead>
                        <tr v-for="(payment, index) in this.current_reconciliations" :key="index" class="border-bottom">
                            <td>{{index +1}}</td>
                            <td>{{payment.email}}</td>
                            <td>{{payment.customer_name}}</td>
                            <td>{{payment.package_type}}</td>
                            <td>{{payment.package_period}}</td>
                            <td>{{payment.currency}}</td>
                            <td>{{payment.amount_paid}}</td>
                            <td>{{payment.created_at}}</td>
                            <td>{{payment.payment_intent}}</td>
                            <td><span v-if="payment.reciept_url"><a :href="payment.reciept_url" class="btn badge-primary" target="black">View reciept</a></span></td>
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