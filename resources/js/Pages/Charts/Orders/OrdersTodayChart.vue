<template>
  <div>
      <p>
        Orders Today  <br>
        <span> <b>{{this.total_orders_today}} </b></span>
      </p>
    <canvas id="orders_today_chart"></canvas>
     <div class="pt-2 ">       
        <h6 class="pt-2  pb-0 mb-0 text-left">Today</h6>
        <ul class="small pl-3 p-0 mx-auto">
            <li class="p-0 text-left">  {{this.canceled}} Canceled orders  </li>
            <li class="p-0 text-left">Sold more  {{best_performing_orders}} orders   </li>
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
            chartBackgroundColor: [ '#97C63A', '#F37E31','#E8302E','#EA4E1A','#B5CE4D', '#129047' ],
            chartLabels: ["Dine In", "Pick Up",'Canceled', "Drive Through", "Home Delivery"],
            chartData: [ 25,  25, 10, 25, 25],
            dine_in:0,
            take_away:0,
            drive_through:0,
            home_delivery:0,
            canceled :0,
            total_orders_today:0,
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
            var date = new Date();
            var date_today = moment(String(date)).format('YYYY-MM-DD');
            
            this.current_orders.forEach((order)=>{
                if(moment(String(order.created_at)).format('YYYY-MM-DD') == date_today) {                    
                    this.total_orders_today += 1;
                    if(order.status == 'canceled') this.canceled +=1;
                    else{
                        if(order.order_type == 'Dine In') this.dine_in +=1;
                        if(order.order_type == 'Take Away') this.take_away +=1;
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
            this.findBest_performing();
            this.mountChartToDOM();
        }, 1500);       
       
  
    }
}
</script>