<template>
    <div>

    <Header />

    <div class="row">
    <div class="col-md-3">
        <Sidebar />
    </div>
<!-- --------------------------------------------------- -->
 <div class="col-md-8 px-3 pt-3 pl-2">

    <h2>
        Clients Portal
    </h2>
</div>
      


    <!-- ------------------------------------- -->
</div>

    <Footer />
</div> 
</template>
<script>
import Header from "../Layouts/Header";
import Sidebar from "../Layouts/Sidebar";
import Footer from "../Layouts/Footer";

export default {
    props:['users'],

        components:{
            Header,
            Sidebar,
            Footer,
        }, 
}
</script>