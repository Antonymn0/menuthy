<template>
  <div>
      <p>
        Orders this Year  (incomplete)<br>
        <span> <b>{{this.total_orders_this_year}} </b></span>
      </p>
  <canvas id="orders_this_year_chart"></canvas>
</div>  
</template>

<script>
import moment from 'moment';

export default {
    props:['orders'],
    data(){
        return{  
            current_orders:this.orders, 
            chartBackgroundColor: [ '#d33507','#d33607', '#de4f00', '#de5f00','#e86600', '#e87700', '#f07c00', '#EA5C2B', '#FF7F3F', 'E5890A', '#EA6C2B', '#EA5C2B'],
            chartLabels: ["Jan", "Feb", "March", "April", 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            chartData: [ 10, 20, 30, 40, 50,60, 70, 80, 90, 100, 110, 120 ],
            total_orders_this_year:0
        }
    },
    methods:{
        sortOrders(){           
            var dine_in=0;
            var take_away=0;
            var drive_through=0;
            var home_delivery=0;
            var today = moment();
            var start_of_year = today.startOf('year').format('YYYY-MM-DD');
            var end_of_year = today.endOf('year').format('YYYY-MM-DD');
            today= today.format('YYY-MM-DD');
            this.current_orders.forEach((order)=>{
                var order_date = moment(order.created_at).format('YYYY-MM-DD');
                if(moment(order_date).isSameOrAfter(start_of_year) && moment(order_date).isSameOrBefore(end_of_year)) {            
                    this.total_orders_this_year += 1;
                    if(order.order_type == 'Dine In') dine_in +=1;
                    if(order.order_type == 'Take Away') dine_in +=1;
                    if(order.order_type == 'Drive Through') drive_through +=1;
                    if(order.order_type == 'Home Delivery') home_delivery +=1;
                }
                
            });
            //this.chartData =[dine_in, take_away, drive_through, home_delivery];
        },

        mountChartToDOM(){
            var ctx =document.getElementById('orders_this_year_chart').getContext('2d');
            new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: this.chartLabels,
                datasets: [{
                    label: "Orders this Year",
                    backgroundColor: this.chartBackgroundColor,
                    hoverOffset: 6,
                    borderColor: '#ffa600',
                    borderWidth:.5,
                    data: this.chartData,
                }],
                
            },

            // Configuration options go here
            options: {
                
            }
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