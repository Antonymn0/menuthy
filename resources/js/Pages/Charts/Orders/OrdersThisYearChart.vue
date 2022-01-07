<template>
  <div>
      <p>
        This Year  <br>
        <span> <b>{{this.total_orders_this_year}} </b></span>
      </p>
    <canvas id="orders_this_year_chart"></canvas>
    <div class="pt-2 ">       
            <h6 class="pt-2  pb-0 mb-0 text-left">This Year</h6>
            <ul class="small pl-3 p-0 mx-auto">
                <li class="p-0 text-left">  You performed best in {{this.best_performing_month}} </li>
                <li class="p-0 text-left">  You performed least in {{this.least_performing_month}} </li>
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
            current_orders:this.orders, 
            chartBackgroundColor: [ '#C83F91','#Ef3F32', '#F15A2D', '#F37E31','#FCBC36', '#FFF134', '#97C63A', '#129047', '#00A49E', '#0085B4', '#005399', '#53308E'],
            chartLabels: ["Jan ", "Feb ", "March", "April", 'May ', 'June', 'July', 'Aug ', 'Sept', 'Oct ', 'Nov ', 'Dec '],
            chartData: [ 10, 40, 30, 40, 50, 50, 70, 80, 90, 50, 110, 120 ],
            total_orders_this_year:0,
            best_performing_month:'No month',
            least_performing_month:'No month',
            months:{
                'January' : 0,
                'February' : 0,
                'March' : 0,
                'April' : 0,
                'May' : 0,
                'June' : 0,
                'July' : 0,
                'August' : 0,
                'September' : 0,
                'October' : 0,
                'November' : 0,
                'December' : 0
                },
        }
    },
    methods:{
        findBest_performing(){
           let highest = Math.max(this.months.January, this.months.February, this.months.March, this.months.April, this.months.May, this.months.June, this.months.July, this.months.August, this.months.September, this.months.October, this.months.November, this.months.December);
           let least = Math.min(this.months.January, this.months.February, this.months.March, this.months.April, this.months.May, this.months.June, this.months.July, this.months.August, this.months.September, this.months.October, this.months.November, this.months.December);
           // calculate best performing
           for(const[key, value] of Object.entries(this.months)) {
                if(value == highest) this.best_performing_month = key;
                if(value == least) this.least_performing_month = key; 
                           
            }                      
                      
        },
        sortOrders(){ 
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
                        if(order.status !== 'canceled' && order.status !== 'processing'){
                            this.total_orders_this_year += 1;
                            this.months[current_month_name] += 1;                            
                        } 
                    }                
                });               
            }
            this.chartData = [
                    this.months.January,
                    this.months.February,
                    this.months.March,
                    this.months.April,
                    this.months.May,
                    this.months.June,
                    this.months.July,
                    this.months.August,
                    this.months.September,
                    this.months.October,
                    this.months.November,
                    this.months.December
                ];
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
            this.findBest_performing();
            this.mountChartToDOM();
        }, 1500);       
       
  
    }
}
</script>