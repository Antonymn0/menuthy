<template>

  <Header />
<div class="row parent-div">
    <div class="sidebar p-0 m-0">
        <Sidebar />
    </div>

    <div class=" pt-4 p-0 web-dash">     
        <div class=" row p-3">            
            <h2 class="col-md-6 ">
              Admin Orders
            </h2>
            <p class="col-md-6 text-right">
                <a href="/dashboard" class="btn btn-danger mr-2" >  <i class="bi bi-chevron-left  pr-1"></i> Dashboard</a>
                <a href="#" class="btn btn-primary" @click="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p>
        </div>

        <div class="filter-div ">
            <div class="row">
                 <div class="form-group col">
                    <label for="status"> Order no </labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="order_no">
                        <button  class=" rounded" @click="searchOrderNo(this.order_no)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.order_no}}</small>
                    </p>
                </div>
                  <div class="form-group col ">
                    <label for="status"> Transaction id </labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="transaction_id">
                        <button  class=" rounded" @click="searchTransactionId(this.transaction_id)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.transaction_id}}</small>
                    </p>
                </div>
                  <div class="form-group col ">
                    <label for="status"> Restaurant Email</labeL>
                    <p class="example  rounded" >
                        <input type="text" class=" " placeholder="Search.." v-model="this.email">
                        <button  class=" rounded" @click="searchOrdersByRestaurantEmail(this.email)"><i class="fa fa-search"></i></button>
                        <small class="text-center text-danger"> {{this.errors.email}}</small>
                    </p>
                </div>
            </div>        
        </div>

        <div class="p-2 table-responsive" >  
            <h4> {{this.title}}</h4>      
            <table class="table table-light table-borderless bg-white table-hover  align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Paid at</th>
                        <th scope="col">No/items</th>
                        <th scope="col">Status</th>
                        <th scope="col">Recieved at</th>
                        <th scope="col">Completed at</th>
                    <th scope="col">Action</th>  
               </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr>
                        <th scope="row">{{index}}</th>
                        <td>{{order.order_number}}</td>
                        <td> {{order.transaction_id}}</td>
                        <td> {{order.amount}}</td>
                        <td> {{order.paid_at}}</td>
                        <td>{{order.order_item.length}}</td>
                        <td v-if="order.status == 'recieved'" class="">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'processing'" class="text-warning">{{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                     
                        <td>{{formatDate(order.created_at)}}</td>
                        <td>{{formatDate(order.completed_at)}}</td>
                     
                        <td class="text-center">
                            <a href="#" class="badge badge-danger btn m-1 text-center " data-bs-toggle="modal" :data-bs-target="'#staticBackdrop' + order.id">View</a>
                        </td>                       
                    </tr>                
                     
                    <!--Order history  Modal -->
                        <div class="modal fade" :id="'staticBackdrop' + order.id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-xl">
                            <div class="modal-content  ">
                            <div class="modal-header">
                                <img :src="order.image" alt="" v-if="order.image" >
                                <h5 class="modal-title" id="staticBackdropLabel">{{}} Order deatails</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                               
                                <div class="table-responsive">
                                    <table>
                                            <tr class="p-2">
                                        <th scope="col">#</th>
                                        <th scope="col">Order no</th>
                                        <th scope="col">Transaction id</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Paid at</th>
                                        <th scope="col">No/items</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Recieved at</th>
                                        <th scope="col">Completed at</th>
                                    </tr>                                            
                                    <tbody >
                                        <tr>
                                            <th scope="row">{{index}}</th>
                                            <td>{{order.order_number}}</td>
                                            <td> {{order.transaction_id}}</td>
                                            <td> {{order.amount}}</td>
                                            <td> {{order.paid_at}}</td>
                                            <td>{{order.order_item.length}}</td>
                                            <td v-if="order.status == 'recieved'" class="">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                                            <td v-if="order.status == 'processing'" class="text-warning">{{capitalize(order.status)}}</td>
                                            <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                                        
                                            <td>{{formatDate(order.created_at)}}</td>
                                            <td>{{formatDate(order.completed_at)}}</td>
                                                                 
                                        </tr>  
                                    <tr class="panel border rounded " >
                                                <td> </td>
                                                <td> </td>
                                                <td colspan="5" class="">
                                                    <div class="table-responsive text-center mb-2" v-if="order.order_item">
                                                        <h5 class="">Order items</h5>
                                                        <table class="table-md border rounded p-3 mb-2 mx-auto">
                                                            <thead >
                                                                <th># </th>
                                                                <th>Order  no </th>
                                                                <th>Order name </th>
                                                                <th>Qty </th>
                                                                <th>Table no</th>
                                                                <th>Ready Time </th>
                                                                <th>status </th>
                                                            </thead>
                                                            <thead> 
                                                                <tr v-for="(item, index) in order.order_item" :key="index" class="border-bottom"> 
                                                                    <th> {{index}} </th>
                                                                    <td> {{item.order_number}} </td>
                                                                    <td> {{item.item_name}} </td>
                                                                    <td> {{item.quantity}} </td>
                                                                    <td> {{order.table_number}} </td>
                                                                    <td> {{item.preparation_time}} </td>
                                                                    <td v-if="order.status == 'recieved'" class="">{{ capitalize(order.status) }}</td>
                                                                    <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                                                                    <td v-if="order.status == 'processing'" class="text-primary">{{capitalize(order.status)}}</td>
                                                                    <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                                                            </tr>
                                                            </thead>
                                                        </table>
                                                    </div>
                                                    <div v-else>
                                                        <p class="text-muted py-3 text-center"> No records to show</p>
                                                    </div>
                                                </td>
                                                <td> </td>
                                            </tr> 
                                                </tbody>
                                            
                                            </table>
                                        </div>
                                    </div>
                                    <div class="modal-footer mx-5">
                                        <button type="button" class="btn btn-danger px-2" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success">Print</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </tbody>
                    <tbody>
                        <tr class="p-2 border-top">
                            <td colspan="7" class="text-right border-right">
                            <b> Total orders</b> 
                            </td>
                            <td class="text-center">
                                {{this.current_orders.total}}
                            </td>
                        </tr>
                    </tbody>
                </table>
             <Pagination :data="this.current_orders" />
        </div>
    </div>
    </div>

 <Footer />

</template>
<script>
import moment from 'moment';

import Header from '../Layouts/Header';
import Sidebar from '../Layouts/Sidebar';
import Footer from '../Layouts/Footer';
import Pagination from '../../Pagination/Pagination';

export default { 
    props:['orders', 'posts'],
    components:{
        Pagination,
        Header,
        Sidebar,
        Footer,
    },
   data(){
       return{
           page: 1,
            current_orders:[],
            counter:0,
            authRestaurant:{},
            select_status:'',
            date:'',
            title:'All orders',
            order_no:'',
            transaction_id:'',
            email:'',

            errors:{}
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
       
        fetchOrders(search_term){
            axios.get('/orders/'+ this.authRestaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                
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
             if(!order_no) return;
            this.errors = {};
            this.current_orders = [];
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
                } 
            })
            .catch( error => {
                this.errors.order_no = "No results found";
                console.log(error); 
                                            
            });
        },
        searchTransactionId(transaction_id){
            if(!transaction_id) return;
            this.errors = {};
            this.current_orders = [];
             axios.get('/search-orders/transaction/' + transaction_id)
            .then( response => {
            if( response.status == 200){
                 if(!response.data.data.length){
                    this.errors.transaction_id = "No results found";
                    return;
                }
                this.title = 'Results';
                this.current_orders = response.data;
                } 
            })
            .catch( error => {
                this.errors.transaction_id = "No results found";
                console.log(error); 
                                            
            });
        },
        searchOrdersByRestaurantEmail(email){
            this.validateEmail();
            if(Object.keys(this.errors).length) return;
            this.errors = {};
            this.current_orders = [];
             axios.get('/search-orders/email/' + email)
            .then( response => {
            if( response.status == 200){
                 if(!response.data.data.length){
                    this.errors.email = "No results found";
                    return;
                }
                this.title = 'Results';
                this.current_orders = response.data;
                } 
            })
            .catch( error => {
                this.errors.email = "No results found";
                console.log(error.response); 
                                            
            });
        },
        showLoading(){            
            Swal.showLoading();
        }, 

        refreshOrders(){
            axios.get( '/api/order')
            .then( response => {
            if( response.status == 200){
               this.current_orders = response.data.data; 
               console.log(response.data) ;              
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
        },  

        validateEmail(){
            if(!this.email) return;
            if(this.email){
                var is_valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email);
                if(!is_valid){
                    this.errors.email = 'Enter a valid Email address' ;
                }else{
                   delete this.errors.email;  
            }
            }
        }  
   },

    mounted(){
        this.authRestaurant = window.authRestaurant;
        this.current_orders = this.orders;
        console.log(this.orders);
    }
}
</script>

<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins');

.parent-div{
    font-family:poppins !important;
    font-weight:400;
    color:#9699a2;

}
.daily-report{
    display:inline;
}

.sidebar{
    width:20vw;
    float:left;
    
}
.web-dash{
    overflow: hidden;
      width:79vw;
      float:right;
      color:#9699a2;
      font-family: poppins;
  }
* {
  box-sizing: border-box;
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


/* media queries */
@media only screen and (max-width: 900px) {
 .sidebar{
    display:none;
}
.web-dash{
width:95vw;
margin-left:auto;
margin-right: auto;
  }
}

/* media quesries */
@media only screen and (max-width: 750px) {
  .daily-report{
    display:none;
}

}

</style>