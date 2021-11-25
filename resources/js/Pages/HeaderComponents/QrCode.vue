<template>
    <div>
             <!-- Button trigger modal -->
        <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
            <i class="bi bi-qr-code text-white"></i>
        </a>

        <!-- Modal -->
        <div class="modal fade m-2" id="exampleModalqrCode" tabindex="-1" aria-labelledby="exampleModalqrCodeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header pb-1 m-0">
                <h4 class="modal-title pr-2" id="exampleModalqrCodeLabel">Conect your device  </h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                     <ul class="nav nav-tabs float-center">
                        <li class="active " @click="generateQrCode(this.restaurant.id)"> <a data-toggle="tab" href="#mobile" class="btn card m-1" >Mobile</a> </li>
                        <li > <a data-toggle="tab" href="#tables" class="btn card m-1">Tables</a> </li>
                    </ul>
             
                    <div class="tab-content">
                        <!-- mobile qr code  -->
                        <div id="mobile" class="tab-pane fade in active py-3">
                             <small> Mobile</small>
                             <div class="qrcode container"> 
                                <vue-qrcode :value="this.qrCode" :options="{ width: 150 }"></vue-qrcode>
                            </div>
                            <p>
                                Link: {{this.qrCode}}
                            </p>
                            <p class="w-50 mx-auto my-2 p-3">
                                <button type="button" class="btn btn-danger float-right" data-bs-dismiss="modal">Cancel</button>
                            </p>
                        </div>
                        <!-- tables qr code  -->
                        <div id="tables" class="tab-pane fade">
                            <small> Tables</small>
                           <div class="qrcode container">                               
                                <vue-qrcode
                                    :value="this.tables_qr_code_link"
                                    :options="{
                                        width:200,
                                        color: {
                                            dark: '#e3342f',
                                            light: '#fff',
                                        },
                                    }">
                                </vue-qrcode>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Link</label>
                                    <input type="text" disabled class="form-control p-4" v-model="this.tables_qr_code_link" id="exampleFormControlInput2" placeholder="Link">
                                </div> 
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Table number</label>
                                    <input type="number" min="1" max="50" v-model="this.table_number" class="form-control p-4"  id="exampleFormControlInput2" placeholder="Table no">
                                </div> 
                                
                            <p class="row align-items-center  mx-auto my-2 p-2">
                                <button type="button" class="btn btn-primary col-sm-2 m-1" @click="this.generateTablesQrCode(this.table_number)" >Generate</button>
                                <button type="button" class="btn btn-success col-sm-3 m-1 row" data-bs-dismiss="modal"> <i class="bi bi-printer"></i> Print</button>
                                <button type="button" class="btn btn-danger col-sm-2 m-1" data-bs-dismiss="modal">Cancel</button>
                            </p>
                        </div>
                    </div>
                </div>      
                
            </div>
            
            </div>
        </div>
        </div>
    </div>

</template>

<script>
export default {
    data(){
        return{
            restaurant: window.authRestaurant,
            qrCode:'null',
            table_number:1,
            tables_qr_code_link:'null',           
        } 
    },
    methods:{
        // mobile qr code
        generateQrCode(restaurant_id){
            console.log('Generating qr code...');
            axios.get('/api/qrcode-generate/'+ restaurant_id)
            .then( response => {
            if( response.status = 200){
                this.qrCode = response.data;
                console.log(this.qrCode);
                } 
            })
            .catch( error => {
               this.$swal('Failed to generate Qr code!');
                console.log(error.response.data.errors);
                return;                    
            });
        },
            // tables qr code
        generateTablesQrCode(table_number){
            if(table_number > 50) table_number = 50; //max table number is 50
            axios.get('/api/qrcode-generate/' + this.restaurant.id + '/' + table_number)
            .then( response => {
            if( response.status = 200){
                this.tables_qr_code_link = response.data;
                console.log(this.tables_qr_code_link);
                } 
            })
            .catch( error => {
               this.$swal('Failed to generate Qr code!');
                console.log(error.response.data.errors);
                return;                    
            });
        },
    }
    
}
</script>

<style lang="scss" scoped>

</style>