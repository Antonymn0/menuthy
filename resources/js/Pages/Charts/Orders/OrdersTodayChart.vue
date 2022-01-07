<template>
  <div>
      <p>
        Orders Today  <br>
        <span> <b>{{this.total_orders_today}} </b></span>
      </p>
  <canvas id="orders_today_chart"></canvas>
  <p class="py-1 mb-0">{{this.canceled}} Canceled orders today</p>
</div>  
</template>

<script>
import moment from 'moment';

export default {
    props:['orders'],
    data(){
        return{  
            current_orders:this.orders, 
            chartBackgroundColor: [  '#d33507', '#de4f00','#d33333','#e86600', '#f07c00' ],
            chartLabels: ["Dine In", "Pick Up",'Canceled', "Drive Through", "Home Delivery"],
            chartData: [ 25,  25, 10, 25, 25],
            total_orders_today:0,
            dine_in:0,
            take_away:0,
            drive_through:0,
            home_delivery:0,
            canceled :0
        }
    },
    methods:{
        sortOrders(){
            var date = new Date();
            var date_today = moment(String(date)).format('YYYY-MM-DD');
            
            this.current_orders.forEach((order)=>{
                if(moment(String(order.created_at)).format('YYYY-MM-DD') == date_today) {                    
                    this.total_orders_today += 1;
                    if(order.status == 'canceled') this.canceled +=1;
                    else{
                        if(order.order_type == 'Dine In') this.dine_in +=1;
                        if(order.order_type == 'Take Away') this.dine_in +=1;
                        if(order.order_type == 'Drive Through') this.drive_through +=1;
                        if(order.order_type == 'Home Delivery') this.home_delivery +=1;
                    }
                   
                }                
            });
            this.chartData =[this.dine_in, this.take_away, this.canceled,  this.drive_through, this.home_delivery];
        },

        mountChartToDOM(){
            var ctx =document.getElementById('orders_today_chart').getContext('2d');
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