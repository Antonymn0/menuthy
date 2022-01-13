<template>
    <!--Map location order Modal -->
    <div class="modal fade " id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl mx-auto">
        <div class="modal-content p-0">
        <div class="px-3 py-2 text-muted">
            <button type="button" class="btn-close float-right" data-bs-dismiss="modal" aria-label="Close"></button>
            <h5 class="modal-title pt-2 bold" id="staticBackdropLabel">Customer location on map </h5>
            <p class="mb-0 mt-1 "> <span class="bold"> Customer Name: </span>  <span> {{this.customer_name}} </span>   <br>          
            <span class="bold"> Order Number: </span> <span> {{this.order_no}} </span> </p>  
            <p class="mb-0">
                <span class="bold">Distance: </span> <span id="distance"></span> <br>
                <span class="bold">Duration: </span> <span id="duration"></span>
            </p>          
        </div>
        <div class="p-1">

            <div id="googleMap" style="width:100%; min-height:500px"></div>

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
            customer_name:this.order.customer_name,
            order_no:this.order.order_number,
            current_position: {}, 
            destination:{
                lat: 0,
                lng: 0
                },
            distance:'0 M',
            duration:'0 min'
        }
    },
    methods:{
        getCurrentUserPosition(){
            navigator.geolocation.getCurrentPosition( (position) => { 
                    this.current_position.lat = position.coords.latitude; 
                    this.current_position.lng = position.coords.longitude;
                    this.renderGoogleMap();
                },                
                error => {   
                    alert('Cannot access your position. Please make sure location access is enabled.');   
                    console.log(error.message);
                },               
            );
        },
        renderGoogleMap(){ 
            const map = new google.maps.Map(document.getElementById("googleMap"),{
                zoom:10,
                center:this.current_position
            }); 
           // current user position marker
            new google.maps.Marker({
                position: this.current_position,
                map: map,
                title:"Your position",
                animation:google.maps.Animation.DROP
            });
            // customer location position marker
            new google.maps.Marker({
                position: this.destination,
                map: map,
                title:"Customer location",
                animation:google.maps.Animation.BOUNCE
            });
            // ---------------- Get directions-----------------------
            // var line = new google.maps.Polyline({path: [this.current_position, this.destination], map: map})
            let directionsService = new google.maps.DirectionsService();
            let directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);         // Existing map object displays directions
            // Create route from existing points used for markers
            const route = {
                origin: this.current_position,
                destination: this.destination,
                travelMode: 'DRIVING'
            }

            directionsService.route(route,
                function(response, status) { // anonymous function to capture directions
                if (status !== 'OK') {
                    window.alert('Directions request failed due to ' + status);
                    return;
                } else {
                    directionsRenderer.setDirections(response); // Add route to the map
                    var directionsData = response.routes[0].legs[0]; // Get data about the mapped route
                    if (!directionsData) {
                    window.alert('Directions request failed');
                    return;
                    }
                    else {
                    document.getElementById('distance').innerHTML = directionsData.distance.text ;
                    document.getElementById('duration').innerHTML = directionsData.duration.text ;
                    }
                }
                });
    // ------------------------------------------------
        }
    },
    watch:{
        // re-render map on data change 
        order: function(){
            this.current_latitude = parseInt(this.order.latitude);
            this.current_longitude = parseInt(this.order.longitude);
            this.customer_name = this.order.customer_name;
            this.order_no = this.order.order_number;
            this.current_position =  {}; 
            this.destination = {
                lat: parseFloat(this.order.latitude),
                lng: parseFloat(this.order.longitude)
                }
            this.getCurrentUserPosition();
        }
    },
    mounted(){
        setTimeout(this.getCurrentUserPosition(), 5000); 
    }
}
</script>
<style scoped>
.modal-dialogue, .modal-content{
    width:82rem !important;
    height:auto !important;
    max-width:100% !important;
    }
.bold{
    font-weight:600;
}
</style>