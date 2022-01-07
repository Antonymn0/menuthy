<template>
  <div>
      <p>
        This Week  <br>
        <span> {{this.restaurant.currency}} <b>{{this.total_revenue_this_week}} </b></span>
      </p>
  <canvas id="revenue_this_week_chart"></canvas>
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
            chartBackgroundColor: [  '#d33507', '#de4f00','#e86600', '#f07c00' ],
            chartLabels: ["Dine In", "Pick Up", "Drive Through", "Home Delivery"],
            chartData: [ 25,  25, 25, 25],
            total_revenue_this_week:0
        }
    },
    methods:{
        sortOrders(){           
            var dine_in=0;
            var take_away=0;
            var drive_through=0;
            var home_delivery=0;
            var today = moment();
            var start_of_week = today.startOf('isoweek').format('YYYY-MM-DD');
            var end_of_week = today.endOf('isoweek').format('YYYY-MM-DD');
            today= today.format('YYY-MM-DD');
            this.current_orders.forEach((order)=>{
                var order_date = moment(order.created_at).format('YYYY-MM-DD');
                if(moment(order_date).isSameOrAfter(start_of_week) && moment(order_date).isSameOrBefore(end_of_week)) {            
                    if(order.status !== 'canceled' && order.paid == 'true'){
                        this.total_revenue_this_week += order.amount;
                        if(order.order_type == 'Dine In') dine_in += order.amount;
                        if(order.order_type == 'Take Away') take_away += order.amount;
                        if(order.order_type == 'Drive Through') drive_through += order.amount;
                        if(order.order_type == 'Home Delivery') home_delivery += order.amount;
                    } 
                }                
            });
            this.chartData =[dine_in, take_away, drive_through, home_delivery];
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
            this.mountChartToDOM();
        }, 1500);       
       
  
    }
}
</script>