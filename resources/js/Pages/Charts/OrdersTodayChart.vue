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
        }
    },
    mounted(){
        console.log(this.orders);
        var ctx =document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["0:00", "06:00", "12:00", "16:00", "20:00", "23:00"],
            datasets: [{
                label: "Orders today",
                backgroundColor: [
                    '#d33507',
                    '#de4f00',
                    '#e86600',
                    '#f07c00',
                    '#f89100',
                    '#ffa600',
                ],
                hoverOffset: 6,
                borderColor: '#ffa600',
                borderWidth:.5,
                data: [ 10, 5, 2, 20, 30, 55],
            }]
        },

        // Configuration options go here
        options: {}
        });
    },
 
  
}
</script>