<template>
  <div>
      <p>
        Revenue today  <br>
        <span> {{this.restaurant.currency}} <b>{{this.total_revenue_today}} </b></span>
      </p>
  <canvas id="revenue_today_chart"></canvas>
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
            total_revenue_today:0
        }
    },
    methods:{
        sortOrders(){
            var date = new Date();
            var date_today = moment(String(date)).format('YYYY-MM-DD');
            var dine_in=0;
            var take_away=0;
            var drive_through=0;
            var home_delivery=0;
            this.current_orders.forEach((order)=>{
                if(moment(String(order.created_at)).format('YYYY-MM-DD') == date_today ) {
                    if(order.status !== 'canceled' && order.paid == 'true'){
                        this.total_revenue_today += order.amount;
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
            var ctx =document.getElementById('revenue_today_chart').getContext('2d');
            new Chart(ctx, {
            type: 'pie',
            data: {
                labels: this.chartLabels,
                datasets: [{
                    label: "Orders today",
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