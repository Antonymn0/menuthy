<template>
  <div>
      <p>
        This Month  <br>
        <span> <b>{{this.total_orders_this_month}} </b></span>
      </p>
  <canvas id="orders_this_month_chart"></canvas>
    <div class="pt-2 ">       
        <h6 class="pt-2  pb-0 mb-0 text-left">This Month</h6>
        <ul class="small pl-3 p-0 mx-auto">
            <li class="p-0 text-left">  {{this.best_performing_orders}} orders performed best </li>
            <li class="p-0 text-left">  </li>
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
            chartBackgroundColor: [ '#E8302E', '#F37E31','#04B0A8','#EA4E1A','#B5CE4D', '#FCBC36' ],
            chartLabels: ["Dine In", "Pick Up",'Canceled', "Drive Through", "Home Delivery"],
            chartData: [25,  25, 10, 25, 25],
            dine_in:0,
            take_away:0,
            drive_through:0,
            home_delivery:0,
            canceled :0,
            total_orders_this_month:0,
            best_performing_orders:'No'          
        }
    },
    methods:{
        findBest_performing(){
           let highest = Math.max(this.dine_in, this.take_away, this.drive_through, this.home_delivery);
           if(highest == this.dine_in) this.best_performing_orders = 'Dine In';
           if(highest == this.take_away) this.best_performing_orders ='Take Away';
           if(highest == this.drive_through) this.best_performing_orders ='Drive Through';
           if(highest == this.home_delivery) this.best_performing_orders = 'Home Delivery';           
        },
        sortOrders(){           
            var today = moment();
            var start_of_month = today.startOf('month').format('YYYY-MM-DD');
            var end_of_month = today.endOf('month').format('YYYY-MM-DD');
            today= today.format('YYY-MM-DD');
            this.current_orders.forEach((order)=>{
                var order_date = moment(order.created_at).format('YYYY-MM-DD');
                if(moment(order_date).isSameOrAfter(start_of_month) && moment(order_date).isSameOrBefore(end_of_month)) {            
                    this.total_orders_this_month += 1;
                    if(order.status == 'canceled') this.canceled +=1;
                    else{
                        if(order.order_type == 'Dine In') this.dine_in +=1;
                        if(order.order_type == 'Take Away') this.take_awa +=1;
                        if(order.order_type == 'Drive Through') this.drive_through +=1;
                        if(order.order_type == 'Home Delivery') this.home_delivery +=1;
                    }
                }
                
            });
            this.chartData =[this.dine_in, this.take_away, this.canceled,  this.drive_through, this.home_delivery];
        },

        mountChartToDOM(){
            var ctx =document.getElementById('orders_this_month_chart').getContext('2d');
            new Chart(ctx, {
            type: 'pie',
            data: {
                labels: this.chartLabels,
                datasets: [{
                    label: "Orders this Month",
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