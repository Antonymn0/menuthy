<template>

  <Header />
    <Topnavbar /> 

    <div class="parent-div m-1 pt-2 mx-auto">       
        <div class=" row p-3">            
            <h2 class="col-md-6 ">
               Orders
            </h2>
            <p class="col-md-6 text-right">
                <a href="#" class="btn btn-danger daily-report"> <i class="fa fa-arrow-circle-o-up pr-2 pl-2"></i> Export daily report</a>
                <a :href="'/' + this.authRestaurant.id + '/orders/print'" class="btn text-white px-2 mx-3" style="background-color: #36a3f7;" @click="this.showLoading()"> <i class="fa fa-arrow-circle-o-up pr-2" ></i>Export </a>
                <a href="#" class="btn btn-primary" @click="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Refresh</a>
            </p>
        </div>
        <div>
            <!-- audio player  -->
            <audio            
                ref="audio"
                src="/audio/beep-4.mp3">
            </audio>

        </div>

        <div class="filter-div row">
            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="status"> Status </label>
                     <select id="status" class="form-control" v-model="select_status" @change="fetchOrders(this.select_status)"> 
                        <option value="today"> All </option>
                        <option value="recieved"> Open </option>
                        <option value="completed"> Closed </option>
                        <option value="canceled"> Canceled </option>
                     </select>
                </div>
                 <div class="forn-group p-2">
                     <label for="mode"> Order type:</label>
                     <select id="mode" class="form-control"  v-model="select_status" @change="fetchOrderTypes(this.select_status)"> 
                        <option value="all"> All </option>
                        <option value="dine in"> Dine in </option>
                        <option value="take away"> Take away </option>
                        <option value="pick up"> Pick up </option>
                     </select>
                </div>
            </div>

            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="date"> Update time </label>
                    <input type="date" name="" id="date" class="form-control" v-model="this.date" @change="fetchOrderBydate(this.date)">
                </div>
                 <div class="forn-group p-2">
                     <label for="tables"> Tables</label>
                     <select id="tables" class="form-control" v-model="select_status" @change="fetchOrderTables(this.select_status)"> 
                        <option value="all"> All </option>
                        <option value="1"> Table 1 </option>
                        <option value="2"> Table 2 </option>
                        <option value="3"> Table 3 </option>
                        <option value="4"> Table 4 </option>
                        <option value="5"> Table 5 </option>
                        <option value="6"> Table 6 </option>
                        
                     </select>
                </div>
            </div>
            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="search"> Search </label>
                    <input type="text " placeholder="Search"  class="form-control">
                </div>
                 <div class="forn-group py-4">
                     <label for="hide"> Hide empty orders</label> <br />
                    <input type="checkbox" name="" id="hide" class="p-2">
                </div>
            </div>
           

        </div>


        <div class="p-2 table-responsive" >        
            <table class="table table-light table-borderless bg-white table-hover  align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Time</th>
                        <th scope="col">Table</th>
                        <th scope="col">Order for</th>
                        <th scope="col">Type</th>
                    <th scope="col">Action</th>                    </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr>
                        <th scope="row">{{index}}</th>
                        <td>{{order.order_number}}</td>
                        <td>{{capitalize(order.menu_item_name)}}</td>
                        <td v-if="order.status == 'recieved'" class="">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{ capitalize(order.status) }}</td>
                        <td v-if="order.status == 'processing'" class="text-warning">{{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{capitalize(order.status)}}</td>
                        <td>{{order.preparation_time}}</td>
                        <td v-if="order.table_number" class="lead">{{order.table_number}}</td>
                        <td v-else>1</td>
                        <td>{{order.order_for}}</td>
                        <td>{{capitalize(order.order_type)}}</td>
                        <td class=" mx-auto text-center m-1 border-bottom" v-if="order.status != 'canceled'">
                            <a href="#" class="badge badge-warning btn ml-3 mb-2" @click="markOrder(order.id, 'processing')">Processing</a> <br>
                            <a href="#" class="badge badge-success btn m-1" @click="markOrder(order.id, 'completed')">Complete</a>
                            <a href="#" class="badge badge-danger btn m-1" @click="cancelOrder(order.id, 'canceled')">Cancel</a>
                        </td> 
                        <td v-else class="text-center">
                            <a href="#" class="badge badge-danger btn m-1 text-center disabled" >Canceled</a>
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

 <Footer />

</template>
<script>
import Pagination from "../Pagination/Pagination.vue";
import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";

export default { 
    props:['orders', 'posts'],
    components:{
        Pagination,
         Header,
        Topnavbar,
        Footer,
    },
   data(){
       return{
           page: 1,
            current_orders:'',
            counter:0,
            authRestaurant:{},
            refreshOrdersInterval:'',
            select_status:'',
            date:''
       }
   },
   methods:{
        capitalize(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
        },
        markOrder(id, value){
             axios.get('/api/order/mark/' + id + '/' + value)
            .then( response => {
            if( response.status = 200){
                console.log(response.data);
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to update!');                
                console.log(error.response.data.errors);                    
            });
        },
        cancelOrder(id, value){
            if(confirm("Are you sure you want to cancel this order?"))
            {            
                axios.get('/api/order/mark/' + id + '/' + value)
                .then( response => {
                if( response.status = 200){

                    } 
                })
                .catch( error => {
                    this.$swal('Error,  failed to update!');                
                 
                });
            }
        },
        fetchOrders(search_term){
            axios.get('/orders/'+ this.authRestaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
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
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },
        fetchOrderTables(table_no){
            if(table_no == 'all'){ this.refreshOrders(); return;}
            axios.get('/orders/'+ this.authRestaurant.id + '/tables/' + table_no)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                console.log(response.data.data);
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
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
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                } 
            })
            .catch( error => {
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:2000
                });                
                   
            });
        },

        refreshOrders(){
            axios.get( '/' + this.authRestaurant.restaurant_name + '/orders/' + this.authRestaurant.id + '/refresh')
            .then( response => {
            if( response.status = 200){
            this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
             this.refreshOrdersInterval = setInterval(this.refreshOrders, 10000);
                // scan response for new orders
                response.data.data.data.forEach(order => {
                    // play a beep sound for a new order 
                    if(order.status == 'recieved'){
                        this.$refs.audio.play();
                        return;
                    } 
                });
                this.current_orders = response.data.data;                
                } 
            })
            .catch( error => {
                this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
                new Swal({
                    title:'Error,  failed to fetch orders!',
                    timer:1500,
                });              
                console.log(error.response.data.errors);                    
            });
        },
        muteAudio(){
            // this.$refs.audio.mute();
        },
        showLoading(){            
            Swal.showLoading();
        },        
   },

    mounted(){
        this.refreshOrdersInterval = setInterval(this.refreshOrders, 10000);  //refresh orders every 10 seconds on load
        this.authRestaurant = window.authRestaurant;
        this.current_orders = this.orders;
        console.log(this.orders);
    }
}
</script>

<style lang="scss" scoped>
.parent-div{
    font-family:poppins;
    font-weight:400;
    color:#9699a2;
    width:90%;
}
.daily-report{
    display:inline;
}

/* media quesries */
@media only screen and (max-width: 750px) {
  .daily-report{
    display:none;
}

}

</style>