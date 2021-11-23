<template>

    <div>
        <div class=" d-flex justify-content-center p-2">
            <h1>
                Menuthy Restaurant
            </h1>
        </div>
        <div class="d-flex justify-content-center">
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
                <tbody v-for="(order) in this.current_orders.data" :key="order.id" >

                    <tr>
                        <th scope="row">{{this.counter}}</th>
                        <td>{{order.order_number}}</td>
                        <td>{{order.menu_item_name}}</td>
                        <td>{{order.status}}</td>
                        <td>{{order.preparation_time}}</td>
                        <td v-if="order.table">{{order.table}}</td>
                        <td v-else>0</td>
                        <td>{{order.is_take_away}}</td>
                        <td class="dd-flex justify-content-center text-center m-1">
                            <a href="#" class="badge badge-primary btn ml-3 mb-2" @click="markOrder(order.id, 'processing')">Processing</a> <br>
                            <a href="#" class="badge badge-success btn m-1" @click="markOrder(order.id, 'complete')">Complete</a>
                            <a href="#" class="badge badge-danger btn m-1" @click="markOrder(order.id, 'cancel')">Cancel</a>
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
       }
   },
   methods:{
        increment(){
            this.counter = this.counter++;
        },
        markOrder(id, value){
            var form_data= new FormData();
            form_data.append('status', value);
             axios.get('/api/order/mark/' + id + '/' + value, form_data)
            .then( response => {
            if( response.status = 200){
                this.$inertia.reload();
                console.log(response.data);
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to update!');                
                console.log(error.response.data.errors);                    
            });
        },
        fetchOrders(search_term){
            axios.get('/orders/'+ this.authRestaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                this.current_orders = response.data.data;
                this.$inertia.reload();
                console.log(response);
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to fetch orders!');                
                console.log(error.response.data.errors);                    
            });
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

</style>