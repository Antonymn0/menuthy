<template>

  <Header />
    <Topnavbar /> 

    <div class="parent-div m-1  mx-auto">       
        <div class=" row p-3">            
            <h2 class="col-md-6 ">
               Orders
            </h2>
            <p class="col-md-6 text-right">
                <a href="#" class="btn btn-danger"> <i class="fa fa-arrow-circle-o-up pr-2 pl-2"></i> Export daily report</a>
                <a href="#" class="btn text-white px-2 mx-3" style="background-color: #36a3f7;"> <i class="fa fa-arrow-circle-o-up pr-2"></i>Export </a>
                <a href="#" class="btn btn-primary" @click="refreshOrders()">  <i class="bi bi-arrow-repeat  pr-1"></i> Reload</a>
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
                        <option value="complete"> Closed </option>
                     </select>
                </div>
                 <div class="forn-group p-2">
                     <label for="mode"> Order mode:</label>
                     <select id="mode" class="form-control"  v-model="select_status" @change="fetchOrders(this.select_status)"> 
                        <option value="today"> All </option>
                        <option value="dine-in"> Dine in </option>
                        <option value="is_take_away"> Take away </option>
                        <option value="pick_up"> Pick up </option>
                     </select>
                </div>
            </div>

            <div class="col-md-4">
                 <div class="forn-group p-2">
                     <label for="date"> Update time </label>
                    <input type="date" name="" id="date" class="form-control">
                </div>
                 <div class="forn-group p-2">
                     <label for="tables"> Tables</label>
                     <select id="tables" class="form-control" v-model="select_status" @change="fetchOrders(this.select_status)"> 
                        <option value="today"> All </option>
                        
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
        
        <!-- <div class="d-flex justify-content-center table-responsive">
                <a href="/dashboard" class="btn  btn-primary  m-2 "><i class="bi bi-chevron-left "></i> Dashboard</a> <br/>
              <a href="#" class="btn  btn-success m-2 " @click="refreshOrders()"> <i class="bi bi-arrow-repeat "></i>Refresh </a>           
            <a href="#" class="btn btn-primary m-2" @click="fetchOrders('today')">All Today</a>
            <a href="#" class="btn btn-success m-2" @click="fetchOrders('completed')">Completed</a>
            <a href="#" class="btn btn-danger m-2" @click="fetchOrders('canceled')">Canceled</a>
            
        </div> -->

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
                        <th scope="col">Take away</th>
                    <th scope="col">Action</th>                    </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr>
                        <th scope="row">{{index}}</th>
                        <td>{{order.order_number}}</td>
                        <td>{{order.menu_item_name}}</td>
                        <td v-if="order.status == 'recieved'" class="">{{order.status}}</td>
                        <td v-if="order.status == 'canceled'" class="text-danger">{{order.status}}</td>
                        <td v-if="order.status == 'processing'" class="text-warning">{{order.status}}</td>
                        <td v-if="order.status == 'completed'" class="text-muted">{{order.status}}</td>
                        <td>{{order.preparation_time}}</td>
                        <td v-if="order.table_number" class="lead">{{order.table_number}}</td>
                        <td v-else>1</td>
                        <td>{{order.is_take_away}}</td>
                        <td class=" mx-auto text-center m-1" v-if="order.status != 'canceled'">
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
            refreshOrdersInterval:setInterval(this.refreshOrders, 10000), //refresh orders every 7 seconds on load
            select_status:'',
       }
   },
   methods:{

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

                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to fetch orders!');                
                   
            });
        },

        refreshOrders(){
            axios.get( '/' + this.authRestaurant.restaurant_name + '/orders/' + this.authRestaurant.id + '/refresh')
            .then( response => {
            if( response.status = 200){
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
                this.$swal('Error,  failed to refresh orders!');                
                console.log(error.response.data.errors);                    
            });
        },
        muteAudio(){
            // this.$refs.audio.mute();
        }
   },

    mounted(){
        // this.refreshOrdersInterval = setInterval(this.refreshOrders, 1000);  //refresh orders every 7 seconds on load
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

</style>