<template>
    <div class="d-flex align-items-center justify-content-center vh-100 ">
        <div class="fade-in px-3">
        <img src="/images/menuthy_logo.svg" class="" style="width:150px"  alt="menuthy-logo">
        <div class="mx-auto w-auto mt-3">
                <h3>Success!</h3>
                <p>Your order payment request has been recieved and is being processed. <br>
                    It will be completed shortly.
                </p>
                <a :href="this.current_link" class="btn btn-danger mt-3" > Back to menu </a>
        </div>
        </div>
        
    </div>
</template>

<script>
export default {
    props:['order', 'link'],
    data(){
        return{
            current_order:null,
            current_link:null
        }
    },
    mounted(){
        this.current_order = this.order;
        this.current_link = this.link;
        setTimeout(() => {
            var local_storage = JSON.parse(localStorage.getItem('menuthy_orders')) || [];
            this.local_storage.array.forEach(order => {
                if(order.order_number == this.current_order.order_number) return; // do not save order if already exists
            });
            local_storage.push(this.current_order);
            localStorage.setItem('menuthy_orders', JSON.stringify(local_storage));
        }, 50);
    }
    
}
</script>

<style>

</style>