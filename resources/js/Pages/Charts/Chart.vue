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
            type: 'line',
            data: this.data,
            options: {
                
            }
        },        
     }
    },
    mounted(){
        var el =document.getElementById('myChart').getContext('2d');
        var xValues = [50,60,70,80,90,100,110,120,130,140,150];
        var yValues = [7,8,8,9,9,9,10,11,14,14,15];
        new Chart(el, {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                backgroundColor: "rgba(0,0,0,1.0)",
                borderColor: "rgba(0,0,0,0.1)",
                data: yValues
                }]
            },
            options:{ }
            });
    }
  
}
</script>