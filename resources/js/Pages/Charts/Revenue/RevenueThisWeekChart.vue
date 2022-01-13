<template>
  <div>
      <p>
        This Week  <br>
        <span> {{this.restaurant.currency}} <b>{{this.total_revenue_this_week}} </b></span>
      </p>
  <canvas id="revenue_this_week_chart"></canvas>
  <div class="pt-2 pb-3">       
        <h6 class="pt-2  pb-0 mb-0 text-left">This Week</h6>
        <ul class="small pl-3 p-0 mx-auto">
            <li class="p-0 text-left"> You earned more from {{best_performing_orders}} orders  </li>
        </ul>         
    </div>
</div>  
</template>

<script>
import moment from 'moment';

export default {
    props:['orders'],
    data(){
        return{  
            restaurant: window.authRestaurant,
            current_orders:this.orders, 
            chartBackgroundColor: [ '#97C63A', '#E8302E','#FFF134', '#04B0A8' ],
            chartLabels: ["Dine In", "Pick Up", "Drive Through", "Home Delivery"],
            chartData: [ 25,  25, 25, 25],
            dine_in:0,
            take_away:0,
            drive_through:0,
            home_delivery:0,
            canceled :0,
            total_revenue_this_week:0,
            best_performing_orders:'Empty'
        }
    },
    methods:{
         findBest_performing(){
           let highest = Math.max(this.dine_in, this.take_away, this.drive_through, this.home_delivery);
           // calculate best performing           
           if(highest == this.dine_in) this.best_performing_orders = 'Dine In';
           if(highest == this.take_away) this.best_performing_orders ='Take Away';
           if(highest == this.drive_through) this.best_performing_orders ='Drive Through';
           if(highest == this.home_delivery) this.best_performing_orders = 'Home Delivery';   
        },
        sortOrders(){           
            var today = moment();
            var start_of_week = today.startOf('isoweek').format('YYYY-MM-DD');
            var end_of_week = today.endOf('isoweek').format('YYYY-MM-DD');
            today= today.format('YYY-MM-DD');
            this.current_orders.forEach((order)=>{
                var order_date = moment(order.created_at).format('YYYY-MM-DD');
                if(moment(order_date).isSameOrAfter(start_of_week) && moment(order_date).isSameOrBefore(end_of_week)) {            
                    if(order.status !== 'canceled' && order.paid == 'true'){
                        this.total_revenue_this_week += order.amount;
                        if(order.order_type == 'Dine In') this.dine_in += order.amount;
                        if(order.order_type == 'Take Away') this.take_away += order.amount;
                        if(order.order_type == 'Drive Through') this.drive_through += order.amount;
                        if(order.order_type == 'Home Delivery') this.home_delivery += order.amount;
                    } 
                }                
            });
            this.chartData =[this.dine_in, this.take_away, this.drive_through, this.home_delivery];
        },

        mountChartToDOM(){
            var ctx =document.getElementById('revenue_this_week_chart').getContext('2d');
            new Chart(ctx, {
            type: 'bar',
            data: {
                labels: this.chartLabels,
                datasets: [{
                    label: "Revenue this week",
                    backgroundColor: this.chartBackgroundColor,
                    hoverOffset: 6,
                    borderColor: '#ffa600',
                    borderWidth:.5,
                    data: this.chartData,
                }]
            },

            // Configuration options go here
            options: {}
            });
        },
    },
    mounted(){
        setTimeout(() => {
            this.current_orders = this.orders;
            this.sortOrders();
            this.findBest_performing();
            this.mountChartToDOM();
        }, 1500);       
       
  
    }
}
</script>