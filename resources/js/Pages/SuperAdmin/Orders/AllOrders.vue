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
            </div>        
        </div>

        <div class="p-2 table-responsive" >  
            <h4> {{this.title}}</h4>      
            <table class="table table-light table-borderless bg-white table-hover  align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Transaction id</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                        <th scope="col">No/pcs</th>
                    <th scope="col">Action</th>  
               </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr>
                        <th scope="row">{{index}}</th>
                        <td>{{order.order_number}}</td>
                        <td>{{capitalize(order.menu_item_name)}}</td>
                        <td> {{order.transaction_id}}</td>
                        <td v-if="order.status == 'recieved'" class="">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'processing'" class="text-warning">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                     
                        <td>{{formatDate(order.created_at)}}</td>
                        <td>{{order.order_for}}</td>
                     
                        <td class="text-center">
                            <a href="#" class="badge badge-danger btn m-1 text-center disabled" >Ation</a>
                        </td>                       
                    </tr>                
                    
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

            errors:{}
       }
   },
   methods:{
        capitalize(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        },
        formatDate(date){
            if (date) {
                return moment(String(date)).format('lll');
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
            this.errors = {};
            this.current_orders = [];
            console.log(order_no);
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
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                             
            });
        },
        searchTransactionId(transaction_id){
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
               console.log(response.data)
                } 
            })
            .catch( error => {
                this.errors.transaction_id = "No results found";
                console.log(error); 
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                             
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