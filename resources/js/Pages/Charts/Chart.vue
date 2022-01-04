<template>
  <div>
  <canvas id="myChart"></canvas>
</div>  
</template>

<script>
import { Chart, registerables } from 'chart.js';
export default {
    data(){
        return{     
            labels : [
                'January',
                'February',
                'March',
                'April',
                'May',
                'June',
            ],

            data : {
                labels: this.labels,
                datasets: [{
                label: 'My First dataset',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [0, 10, 5, 2, 20, 30, 45],
                }]
        },

        config : {
            type: 'bar',
            data: this.data,
             options: {
                title: {
                    display: true,
                    text: 'Test Chart'
                }
            }
        },        
     }
    },
    mounted(){
     new Chart(
        document.getElementById('myChart').getContext('2d'),
        this.config
        );
    }
    
  
}
</script>