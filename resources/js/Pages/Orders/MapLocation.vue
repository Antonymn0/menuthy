<template>
    <!--Map location order Modal -->
    <div class="modal fade h-100" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl h-100">
        <div class="modal-content">
        <div class="px-3 py-2">
            <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="modal-title pt-2" id="staticBackdropLabel">Geolocation (incomplete)</h5>
            <p>Name: {{this.customer_name}}</p>            
        </div>
        <div class="p-1">

            <div id="googleMap" style="width:100%; height:500px"></div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
export default {
    props:['order'],
    data(){
        return{
            current_latitude: parseInt(this.order.latitude),
            current_longitude: parseInt(this.order.longitude),
            customer_name:this.order.customer_name
        }
    },
    methods:{
        renderGoogleMap(){
            var coordinates ={
                center:new google.maps.LatLng(37.773972,-122.431297),
                zoom:5,
            }   
            new google.maps.Map(document.getElementById("googleMap"),coordinates); 
        }
    },
    mounted(){
        setTimeout(this.renderGoogleMap(), 1000); 
    }
}
</script>
<style scoped>
.modal-dialogue, .modal-content{
    width:70rem !important;
    height:75rem !important;
    max-width:100% !important;
    max-height:100% !important;
}
</style>