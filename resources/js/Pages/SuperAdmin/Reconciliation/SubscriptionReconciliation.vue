<template>
    <div> 
        <Header />
        <div class="row ">
            <div class="sidebar p-0 m-0 col-md-3">
                <Sidebar />
            </div>
            <div class="col-md-9 pt-3">
                <h3>
                   Reconciliation
                </h3>
                <div class="table-responsive">
                    <table class="table-sm tables-striped  p-2">
                        <thead>
                            <th> # </th>
                            <th> Email </th>
                            <th> Package type</th>
                            <th>Package  Period </th>
                            <th> Amount paid </th>
                            <th> Date paid </th>
                            <th> Date paid </th>
                            <th> Payment id </th>
                            <th> Reciept </th>
                            <th>Action </th>
                        </thead>
                        <tr>
                            <td>1</td>
                        </tr>
                    </table>

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
        data(){
            return{
                current_reconciliations:{},
            }
        },
}
</script>