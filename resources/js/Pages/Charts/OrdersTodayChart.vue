<template>
  <div>
  <canvas id="myChart"></canvas>
</div>  
</template>

<script>

export default {
    props:['orders'],
    data(){
        return{  
            current_orders:this.orders, 
            chartBackgroundColor: [  '#d33507', '#de4f00','#e86600', '#f07c00' ],
            chartLabels: ["Dine In", "Pich Up", "Drive Through", "Home Delivery"],
            chartData: [ 10,  20, 30, 55],
        }
    },
    methods:{
        sortOrders(){
            var dine_in=0;
            var take_away=0;
            var drive_through=0;
            var home_delivery=0;
            this.orders.foreach((order)=>{
                if(order.order_type == 'Dine In') dine_in +=1;
                if(order.order_type == 'Take Away') dine_in +=1;
            });
        },

        mountChartToDOM(){
            var ctx =document.getElementById('myChart').getContext('2d');
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
            this.mountChartToDOM();
        }, 1500);       
       
  
    }
}
</script>