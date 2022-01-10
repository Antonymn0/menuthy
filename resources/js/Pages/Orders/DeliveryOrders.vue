<template>
    <div>
        <Header />
        <Topnavbar /> 
    </div> 

    <div class="px-5">
        <div class="px-3 py-3">
            <h1>Delivery Orders</h1>
        </div>        
    </div>

    <Footer />
</template>

<script>
import Pagination from "../Pagination/Pagination.vue";
import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";

export default {
    components:{
        Pagination,
        Header,
        Topnavbar,
        Footer,
    },
}
</script>