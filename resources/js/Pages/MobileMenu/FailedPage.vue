<template>
    <div class="d-flex align-items-center justify-content-center vh-100 ">
        <div class="fade-in pl-3">
            <img src="/images/menuthy_logo.svg" class="" style="width:150px"  alt="menuthy-logo">
            <div class="mx-auto w-auto mt-3 ">
                    <h3>Failed!</h3>
                    <p> Your stripe payment request has failed to processed. </p>
                    <a class="btn btn-danger mt-3 px-3" onclick="history.back()"> Retry payment</a>
                    <span > <a href="#" class="btn btn-danger mt-3 ml-2" @click.prevent="forceStripeSessionExpire(this.current_order)"> Back to menu</a></span>
            </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props:['link', 'order'],
    data(){
        return{
            current_link: this.link,
            current_order: null,
        }
    },
    methods:{
        forceStripeSessionExpire(order){
            //stripe session force expire
             axios.get('/api/stripe-pay-order-checkout-expire-session/' + order.restaurant_id + '/'  + order.stripe_session_id )
                .then( response => {
                    if( response.status == 200){
                       this.deleteOrder(order);
                        this.$swal('Payment process canceled!');                       
                    } 
                })
                .catch( error => {
                    this.$swal('Failed!'); 
                });            
        },
   deleteOrder(order){
        // delete order if user cancled the process
        axios.delete('/api/order/' + order.id )
            .then( response => {
                if( response.status == 200){                                    
                    // redirect back to mobile menu                                
                    this.$inertia.visit(this.current_link);                                    
                } 
            })
            .catch( error => {
                this.$swal('Failed!'); 
            });
        }
         
    },
    mounted(){
        this.current_order = this.order
    }

    
}
</script>

<style>

</style>