<template>
  <div>
      <p>
        This Year   <br>
        <span> {{this.restaurant.currency}} <b>{{this.total_revenue_this_year}} </b></span>
      </p>
  <canvas id="revenue_this_year_chart"></canvas>
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
            chartBackgroundColor: [  '#04B0A8', '#EA5C2B'],
            chartLabels: ["Jan", "Feb", "March", "April", 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'],
            chartData: [ 10, 40, 30, 40, 50, 50, 70, 80, 90, 50, 110, 120 ],
            total_revenue_this_year:0
        }
    },
    methods:{
        sortOrders(){          
            var months=[];
                months['January'] = 0;
                months['February'] = 0;
                months['March'] =  0;
                months['April'] =  0;
                months['May'] = 0;
                months['June'] =  0; 
                months['July'] =  0;
                months['August'] =  0;
                months['September'] =  0;
                months['October']= 0;
                months['November'] = 0;
                months['December'] = 0;
            
            var add_months = 0;
            var start_of_year = null;
            var start_of_current_month = null;
            var end_of_current_month = null;
            var current_month_name = null;

            // determine months, dates and begining and end dates
            for(let i=0; i < 12; i++){
                add_months = i;
                start_of_current_month = moment().startOf('year').add(add_months,'months').format('YYYY-MM-DD');
                end_of_current_month = moment().startOf('year').add(add_months,'months').endOf('month').format('YYYY-MM-DD');
                current_month_name = moment().startOf('year').add(add_months,'months').format('MMMM');

                // loop through the orders 
                this.current_orders.forEach((order)=>{
                    var order_date = moment(order.created_at).format('YYYY-MM-DD');
                    if(moment(order_date).isSameOrAfter(start_of_current_month) && moment(order_date).isSameOrBefore(end_of_current_month)) {            
                        if(order.status !== 'canceled' && order.paid == 'true'){
                            this.total_revenue_this_year += order.amount;
                            months[current_month_name] += order.amount;                            
                        } 
                    }
                
                });
               
            }
            this.chartData = [
                    months['January'],
                    months['February'],
                    months['March'],
                    months['April'],
                    months['May'],
                    months['June'],
                    months['July'],
                    months['August'],
                    months['September'],
                    months['October'],
                    months['November'],
                    months['December']
                ]
            console.log(this.chartData);
        },

        mountChartToDOM(){
            var ctx =document.getElementById('revenue_this_year_chart').getContext('2d');
            new Chart(ctx, {
            type: 'line',
            data: {
                labels: this.chartLabels,
                datasets: [{
                    label: "Revenue this Year",
                    backgroundColor: this.chartBackgroundColor,
                    hoverOffset: 2,
                    borderColor: '#04B0A8',
                    borderWidth:.5,
                    fill: false,
                    tension: 0.1,
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