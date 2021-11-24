<template>

    <div class="card m-1">       
        <div class=" row p-3">            
            <h1 class="col-sm-9 text-center" v-if="this.authRestaurant.restaurant_name">
              {{this.authRestaurant.restaurant_name}} Orders
            </h1>
            <h1 class="col-sm-9 text-center" v-else>
              Restaurant Orders
            </h1>
        </div>
        <div>

            <!-- audio player  -->
            <audio            
                ref="audio"
                src="/audio/beep-4.mp3">
            </audio>

        </div>
        
        <div class="d-flex justify-content-center">
                <a href="/dashboard" class="btn  btn-primary  m-2 "><i class="bi bi-chevron-left "></i> Dashboard</a> <br/>
              <a href="#" class="btn  btn-success m-2 " @click="refreshOrders()"> <i class="bi bi-arrow-repeat "></i>Refresh </a>           
            <a href="#" class="btn btn-primary m-2" @click="fetchOrders('today')">All Today</a>
            <a href="#" class="btn btn-success m-2" @click="fetchOrders('completed')">Completed</a>
            <a href="#" class="btn btn-danger m-2" @click="fetchOrders('canceled')">Canceled</a>
            
        </div>

        <div class="p-2 table-responsive" >        
            <table class="table table-dark table-xl table-hover p-2 align-middle" style="overflow:scroll">
                <thead class="lead p-2">
                    <tr class="p-2">
                        <th scope="col">#</th>
                        <th scope="col">Order no</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">Preparation time</th>
                        <th scope="col">Table</th>
                        <th scope="col">Take away</th>
                    <th scope="col">Action</th>                    </tr>
                </thead>
                <tbody v-for="(order, index) in this.current_orders.data" :key="order.id" >
                    <tr>
                        <th scope="row">{{index}}</th>
                        <td>{{order.order_number}}</td>
                        <td>{{order.menu_item_name}}</td>
                        <td>{{order.status}}</td>
                        <td>{{order.preparation_time}}</td>
                        <td v-if="order.table">{{order.table}}</td>
                        <td v-else>0</td>
                        <td>{{order.is_take_away}}</td>
                        <td class="dd-flex justify-content-center text-center m-1" v-if="order.status != 'canceled'">
                            <a href="#" class="badge badge-warning btn ml-3 mb-2" @click="markOrder(order.id, 'processing')">Processing</a> <br>
                            <a href="#" class="badge badge-success btn m-1" @click="markOrder(order.id, 'completed')">Complete</a>
                            <a href="#" class="badge badge-danger btn m-1" @click="cancelOrder(order.id, 'canceled')">Cancel</a>
                        </td> 
                        <td v-else>
                            <a href="#" class="badge badge-danger btn m-1 disabled" >Canceled</a>
                        </td>                       
                    </tr>                
                    
                </tbody>
            </table>
             <Pagination :data="this.current_orders" />
        </div>
    </div>



</template>
<script>
import Pagination from "../Pagination/Pagination.vue";


export default { 
    props:['orders', 'posts'],
    components:{Pagination},
   data(){
       return{
           page: 1,
            current_orders:'',
            counter:0,
            authRestaurant:{},
            refreshOrdersInterval:setInterval(this.refreshOrders, 10000), //refresh orders every 7 seconds on load
       }
   },
   methods:{
        increment(){
            this.counter = this.counter++;
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
                    // console.log(response.data);
                    } 
                })
                .catch( error => {
                    this.$swal('Error,  failed to update!');                
                    // console.log(error.response.data.errors);                    
                });
            }
        },
        fetchOrders(search_term){
            if(search_term == 'today') this.refreshOrdersInterval = clearInterval(this.refreshOrdersInterval);
            axios.get('/orders/'+ this.authRestaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                // console.log(response.data);
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to fetch orders!');                
                // console.log(error.response.data.errors);                    
            });
        },

        refreshOrders(){
            axios.get( '/' + this.authRestaurant.restaurant_name + '/orders/' + this.authRestaurant.id + '/refresh')
            .then( response => {
            if( response.status = 200){
                // console.log('refreshing orders');
                // console.log(response.data.data.data);

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
                // console.log(error.response.data.errors);                    
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
        // console.log(this.orders);
    }
}
</script>

<style lang="scss" scoped>

</style>