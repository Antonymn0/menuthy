<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0 col-md-2">
                <Sidebar />
            </div>
            <div class="col-md-10 pt-5 pl-5">
                <button class="btn btn-success float-right" @click.prevent="this.getPayments()"> <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</button>
                <h3>Subscription Payments Reconciliation <small class="text-muted">(Incomplete)</small> </h3>
                <div>
                    <form class="py-3" @submit.prevent="searchPayment()">                        
                        <div class="form-group  mx-sm-3 mb-2">
                            <label for="email1" >Search Payment by Email: </label> <br>
                            <span class="form-inline">
                                <input type="email" class="form-control" id="email1" placeholder="Email" v-model="this.form.payment_email">  
                                <button type="submit" class="btn btn-primary ">Search</button>
                            </span> 
                            <small class="text-danger">{{this.errors.payment_email}}</small>                           
                        </div>
                       
                        </form>
                </div>
                <div class="table-responsive">
                    <table class="table-sm table-striped  table-hoverable p-2">
                        <thead class="border-bottom">
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
                            <th> Reconciled </th>
                            <th> Reconcile date </th>
                            <th> Reconciled to </th>
                            <th>Action </th>
                        </thead>
                        <tr v-for="(payment, index) in this.payments" :key="index" class="border-bottom">
                            <td>{{index +1}}</td>
                            <td>{{payment.email}}</td>
                            <td>{{payment.customer_name}}</td>
                            <td>{{capitalize(payment.package_type)}}</td>
                            <td>{{capitalize(payment.package_period)}}</td>
                            <td>{{capitalize(payment.currency)}}</td>
                            <td>{{payment.amount_paid}}</td>
                            <td>{{payment.created_at}}</td>
                            <td>{{payment.payment_intent}}</td>
                            <td><span v-if="payment.reciept_url"><a :href="payment.reciept_url" class="badge btn-secondary" target="black" >View payment</a></span></td>
                            <td v-if="payment.reconciled == 'true'" class="text-success">Yes</td>
                            <td v-if="! payment.reconciled " class="text-danger">No</td>
                            <td>{{formatDate(payment.reconciled_at)}}</td>
                            <td>{{payment.reconciled_to}}</td>
                            <td>
                                <span class="btn btn-success" data-toggle="modal" data-target="#reconciliationModal" @click.prevent="updateCurrentPayment(payment)">Reconcile</span>
                             </td>
                        </tr>
                    </table>
                </div>
                <!-- --------------------------------------------- -->               
                <!-- Modal -->
                <div class="modal fade" id="reconciliationModal" tabindex="-1" role="dialog" aria-labelledby="reconciliationModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Reconcile payment</h5>
                        <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            
                            <form action="#" @submit.prevent="this.ReconcilePayment()">
                                <div class="form-group">
                                    <label for="email">Enter claimant's registered menuthy account email</label>
                                    <input type="email" class="form-control p-4"  v-model="this.form.user_email" id="email"  placeholder="Email" required>
                                    <small class="text-danger">{{this.errors.user_email}}</small>
                                    <small class="text-danger">{{this.errors.userNotFound}}</small>
                                </div>
                            </form>
                        </div>
                        <div class="table-responsive text-muted py-2 " v-if="this.userAcc">
                            <h5>User Info</h5>
                            <table class="table-sm table-striped  table-hover p-2 table-bordered shadow">
                                <thead>
                                    <th> # </th>
                                    <th> Email </th>
                                    <th> Name </th>
                                    <th>Current Package </th>
                                    <th> Period </th> 
                                    <th> Status </th> 
                                </thead>
                                <tr  class="">
                                    <td>1</td>
                                    <td>{{this.userAcc.email}}</td>
                                    <td>{{this.userAcc.full_name}}</td>
                                    <td>{{capitalize(this.userAcc.package_type)}}</td>
                                    <td>{{capitalize(this.userAcc.package_period)}}</td>   
                                    <td v-if="this.subscription_status == 'Expried'" class="text-danger">{{this.subscription_status}}</td>                               
                                    <td v-if="this.subscription_status == 'Running'" class="text-success">{{this.subscription_status}}...</td>                               
                                    <td v-if="this.subscription_status == 'Unknown'" class="text-secondary">{{this.subscription_status}}</td>                               
                                   
                                </tr>
                            </table>
                            <p class=" mb-0 pb-0 pt-3 px-2 ">
                              <i>   
                                <span> Reconcile </span>
                                <span style="font-weight:600"> {{this.current_payment.email}} </span>
                                <span>  payment into </span>
                                <span style="font-weight:600"> {{this.userAcc.email}}</span>
                                <span>'s account? </span>
                                </i>
                            </p>
                        </div>
                    </div>
                    <div class="text-right py-2 border-top mr-3">
                        <div v-if="this.success !== '' "> 
                            <span class="text-success p-1">{{this.success}}</span>
                        </div>
                         <small class="text-danger pb-1">{{this.errors.payment_reconciled}}</small> <br>
                        <button type="button" class="btn btn-success m-1" @click.prevent="this.reconcilePayment()" v-if="this.userAcc">Reconcile</button>
                        <button type="button" class="btn btn-danger m-1" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-secondary m-1" @click.prevent="this.getUserAcc()" v-if="! this.userAcc">Search</button>
                        
                    </div>
                    </div>
                </div>
                </div>
                <!-- --------------------------------------------------------------------------------- -->
                
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
                form:{
                    user_email:'',
                    payment_email:'',
                },
                subscription_status:'',
                userAcc:null,
                payments:{},
                current_payment:{},
                errors:{},
                success:'',
                regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            }
        },
        methods:{
            capitalize(string) {
                if(string) return string.charAt(0).toUpperCase() + string.slice(1);
                else return;
            },
            formatDate(date){
                if (date) {
                    return moment(String(date)).format('L') + ' ' + moment(String(date)).format('LT');
                }
            },
            updateCurrentPayment(payment){
                this.current_payment = payment;
                this.userAcc = null;
            },
            getPayments(){
                axios.get('api/admin/fetch-reconciliations')
                .then( response => {
                    console.log(response.data.data);
                    this.payments = response.data.data.data;
                })
                .catch( error => {
                this.$swal('Failed!');
                    console.log(error.response.data.errors);                    
                });
            },
           getUserAcc(){
                this.errors = {};
                this. validateUserEmail();
                if(this.errors.user_email) return;

                axios.get('api/admin/find-user/' + this.form.user_email)
                .then( response => {  
                    if(response.data.data) {
                        this.userAcc = response.data.data; 
                        this.is_subscription_expired(this.userAcc) ; 
                    }
                    else this.errors.userNotFound = 'No account associated with that email address.' ; 
                             
                })
                .catch( error => {
                    this.$swal('Failed!');
                    console.log(error.response.data.errors);                    
                });                
            },
            reconcilePayment(){
                if(this.current_payment.reconciled){
                    this.errors.payment_reconciled = "This payment entry has already been reconciled!";
                    return;
                }
                if(! confirm('Reconcile this payment?')) return;
                axios.get('api/admin/reconcile-payment/' + this.userAcc.id + '/' + this.current_payment.id )
                .then( response => {  
                    this.success = 'Success. Payment reconciled!';
                    setTimeout(() => document.getElementById('close').click(), 3000);
                                           
                })
                .catch( error => {
                    this.$swal('Failed!');
                    console.log(error.response.data);                    
                });
            },
            searchPayment(){
                this.errors = {};
                this.validatePaymentEmail();
                if(this.errors.payment_email) return;
                axios.get('api/admin/search-payment/' + this.form.payment_email )
                .then( response => {  
                    if(!Object.keys(response.data.data).length) {
                        this.errors.payment_email = "No records found for that email address";
                        return;
                    }
                    this.payments = response.data.data
                    console.log(this.payments);                                      
                })
                .catch( error => {
                    this.$swal('Failed!');
                    console.log(error.response.data.errors);                    
                });
            },
            is_subscription_expired(user){
                var today = moment().format('YYY-MM-DD');
                var expiry_date = moment( user.registration_expiry).format('YYYY-MM-DD');
                if(moment(expiry_date).isAfter(today) ) this.subscription_status = 'Expired';
                else this.subscription_status = 'Running';
                if(!user.registration_expiry) this.subscription_status = 'Unknown';
            },
            validateUserEmail(){
                if(this.form.user_email == '') this.errors.user_email = 'Email field is required';
                else {
                    if(!this.regex.test(this.form.user_email)) this.errors.user_email = 'Invalid email!' ;
                    else delete this.errors.user_email;  
                }         
                              
            },
            validatePaymentEmail(){                             
                if(this.form.payment_email == '') this.errors.payment_email = 'Email field is required';
                else {
                    if(!this.regex.test(this.form.payment_email)) this.errors.payment_email = 'Invalid email!' ;
                    else delete this.errors.payment_email;  
                }                
            },
        },
        
        mounted(){
            this.getPayments();
        }

}
</script>