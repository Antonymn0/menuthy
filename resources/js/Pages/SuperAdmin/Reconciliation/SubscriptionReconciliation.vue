<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0 col-md-3">
                <Sidebar />
            </div>
            <div class="col-md-9">
                <h3>
                   Reconciliation
                </h3>
                <div class="table-responsive">
                    

                </div>
                <Pagination :data="'this.users'"/> 
            </div>            
            <Footer />
        </div>
    </div>
</template>
<script>
import moment from 'moment';

import Header from '../Layouts/Header';
import Sidebar from '../Layouts/Sidebar';
import Footer from '../Layouts/Footer';
import Pagination from '../../Pagination/Pagination';
export default {
        components:{
            Header,
            Sidebar,
            Footer,
            Pagination
        },
}
</script>