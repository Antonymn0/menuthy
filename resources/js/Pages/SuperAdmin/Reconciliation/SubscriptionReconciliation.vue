<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0">
                <Sidebar />
            </div>
            Reconciliation <Header />
            <Pagination :data="'this.users'"/>
            <Footer />
        </div>
    </div>
</template>

<script>
import moment from 'moment';

// import Header from '../Layouts/Header';
// import Sidebar from '../Layouts/Sidebar';
// import Footer from '../Layouts/Footer';
// import Pagination from '../../Pagination/Pagination';
export default {
        props:{
            Header,
            Sidebar,
            Footer,
            Pagination
        },
}
</script>