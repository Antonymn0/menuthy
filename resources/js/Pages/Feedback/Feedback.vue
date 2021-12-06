<template>


<div class="parent-nav " style="height:0;">
 
    <div>
        <span onclick="openFeedBack()"></span>
        <div id="feedBack1" class="sidenav">
            <a href="javascript:void(0)" class="closebtn" onclick="closeFeedBack()">&times;</a>
                <div class="d-flex justify-content-start pt-2 pb-0 px-5 border-bottom">
                   <h5 class="pr-4 orders mb-0" @click="fetchOrders('today')">Orders </h5> 
                    <h5 class="feedback" @click="fetchFeedback()"> Feedback</h5>
                </div>
                <div v-if="current_orders.length">
                    <div class="table-responsive px-4 py-4 text-muted">
                        <h6 class="text-muted py-2 d-flex"> <span> Recent orders today </span> <span> <a href="#" class="text-muted pr-1 float-right text-right" @click="fetchOrders('today')"  data-toggle="tooltip" data-placement="top-left" title="Refresh">  <i class="bi bi-arrow-repeat float-right"></i> </a>  </span></h6>
                        <table class="table table-sm table-hover text-muted">
                            <thead class="border-top-none">
                                <tr class="p-2"> 
                                    <td scope="col">  # </td>
                                    <td scope="col"> Order no </td>
                                    <td scope="col">  Name </td>
                                    <td scope="col">  Time </td>
                                    <td scope="col">  Table </td>
                                    <td scope="col">  Status </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(order, index) in this.current_orders" :key="order.id" class="py-3"> 
                                    <td> {{index}}</td>
                                    <td> {{order.order_number}}</td>
                                    <td> {{order.menu_item_name}} </td>
                                    <td> {{order.preparation_time}} </td>
                                    <td> {{order.table_number}} </td>
                                    <td v-if="order.status == 'recieved'" class="">{{order.status}}</td>
                                    <td v-if="order.status == 'canceled'" class="text-danger">{{order.status}}</td>
                                    <td v-if="order.status == 'processing'" class="text-warning">{{order.status}}</td>
                                    <td v-if="order.status == 'completed'" class="text-muted">{{order.status}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                       
                </div>
                <div v-else class="text-muted my-auto py-5 pt-5 text-center">
                   <b class="my-auto">  No items to show today</b>
                </div>
            </div>
        </div>
    </div>

   
    
</template>

<script>
import RestaurantName from "../HeaderComponents/RestaurantName";

export default {
    
    data(){
        return{
            authUser: window.authUser,     // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),    //csrf token
            restaurant: window.authRestaurant,
            current_orders:'',
        }
    },
    components:{
        RestaurantName,
    
    },
    methods:{
         fetchOrders(search_term){ 
             console.log(this.restaurant);
            axios.get('/orders/'+ this.restaurant.id + '/' + search_term)
            .then( response => {
            if( response.status = 200){
                
                this.current_orders = response.data.data.data;
                console.log(this.current_orders);
                } 
            })
            .catch( error => {
                this.$swal('Error,  failed to fetch orders!');                
                   
            });
        },
        fetchFeedback(){
            this.current_orders = '';
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";


h5{
    cursor:pointer;
}
.parent-nav{
    color:#9699a2 !important;
    font-family:poppins;
    font-weight:300;
}

table{
   color:#9699a2; 
}

.orders:hover, .feedback:hover{
    color:$primary-button;
    border-bottom: 3px solid $primary-button;
}


.logo img{
    width:40px;
    height:40px;
}
  

/* The side navigation menu */
.sidenav {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 10; /* Stay on top */
  top: 0; /* Stay at the top */
  right:0;
  right: -1rem;
  background-color: #fff;
  color:#1f2027; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  padding-right: 10px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidenav */
}

/* The navigation menu links */
.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover {
  color: #645d5d;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
  position: absolute;
  top: 0;
  left: -70px;
  font-size: 36px;
  margin-left: 50px;
}


//media querries
@media screen and (max-width: 950px) {
 
.logo img{
    width:40px;
    height:40px;
}
}
@media screen and (max-width: 450px) {
 
}
/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (min-height: 450px) {

}

</style>