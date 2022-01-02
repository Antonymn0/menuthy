<template>
    <div>
             <!-- Button trigger modal -->
        <!-- <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">   <i class="bi bi-qr-code text-white"></i>   </a> -->

        <!-- Modal -->
        <div class="modal fade m-2" id="exampleModalqrCode" tabindex="-1" aria-labelledby="exampleModalqrCodeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header pb-1 m-0">
                <h4 class="modal-title pr-2" id="exampleModalqrCodeLabel">Conect your device  </h4>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body fade-in">
                <div class="container">
                     <ul class="nav nav-tabs float-center">
                        <li class="active " @click="generateQrCode(this.restaurant.id)" > <a data-toggle="tab" href="#mobile" class="btn card mr-1" >Mobile</a> </li>
                        <li > <a data-toggle="tab" href="#tables" class="btn card ml-1">Tables</a> </li>
                    </ul>
             
                    <div class="tab-content">
                        <!-- mobile qr code  -->
                        <div id="mobile" class="tab-pane  active pt-3">
                             <small> Mobile</small>
                             <div class="d-flex justify-content-center align-items-center fade-in"> 
                                <vue-qrcode :value="this.qrCode" :options="{ width: 200 }"></vue-qrcode>
                            </div>
                            <p class="text-center py-2">
                                <small class="text-muted"> Click the link to open</small> <br>
                              <a :href="this.qrCode" target="_blank" style="text-decoration:none; color:#e6034b"> menuthy/{{this.restaurant.restaurant_name}}</a> 
                            </p>
                            <p class="d-flex justify-content-center align-items-center p-2">                                
                                <button type="button" class="btn btn-success pr-3 pl-3 mr-2" @click.prevent="dowloadQrCode('mobile')">Download</button>
                                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">Cancel</button>
                            </p>
                        </div>
                        <!-- Tables qr code  -->
                        <div id="tables" class="tab-pane ">
                            <small> Tables</small>
                           <div class="">    
                                <p class="text-center m-0 p-t0 text-danger"> <small> Table {{this.qr_table_number}}</small></p>                                               
                            <div class="d-flex justify-content-center align-items-center fade-in">                                                   
                                    <vue-qrcode
                                        :value="this.tables_qr_code_link"
                                        :options="{
                                            width:250,
                                            color: {
                                                dark: '#000',
                                                light: '#fff',
                                            },
                                        }">
                                    </vue-qrcode>
                                    </div>
                                </div>
                                
                                <p class="text-center py-2">
                                    <small class="text-muted"> Click the link to open</small> <br>
                                     <a :href="this.tables_qr_code_link" target="_blank" style="text-decoration:none; color:#e6034b"> menuthy/{{this.restaurant.restaurant_name}}</a> 
                                </p> 
                                <div class="form-group" v-if="this.user.package_type !== null">
                                    <label for="exampleFormControlInput2">Enter table number <small class="text-muted">(max: {{this.max_package_tables}} tables )</small></label>
                                    <input type="number" min="1" max="50" v-model="this.table_number" class="form-control p-4"  id="exampleFormControlInput2" placeholder="Table no" @input.prevent="this.maxTableNumber">
                                    <small class="text-danger">{{this.errors.table_number}}</small>
                                </div> 
                                <div class="d-flex justify-content-center align-items-center  mx-auto my-2 p-2">
                                    <button type="button" class="btn btn-primary col-sm-3 m-1 row"  v-if="this.user.package_type !== null" @click="this.generateTablesQrCode(this.table_number)"> Generate</button>
                                    <button type="button"  class="btn btn-success col-sm-3 m-1 row" @click.prevent="dowloadQrCode('tables')" > Dowload </button>
                                    <button type="button"  class="btn btn-danger col-sm-3 m-1 row" data-bs-dismiss="modal"> Cancel</button>

                                </div>
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
            user: window.authUser,
            qrCode:null,
            table_number:1,
            qr_table_number:1,
            max_package_tables:1,
            tables_qr_code_link:null, 
            errors:{},       
        } 
    },
    methods:{
        // mobile qr code
        generateQrCode(restaurant_id){
            axios.get('/api/qrcode-generate/'+ restaurant_id)
            .then( response => {
            if( response.status == 200){
                this.qrCode = response.data;
                this.tables_qr_code_link = this.qrCode + '/1';
                this.$emit('passQrCodeToParent',this.qrCode);
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
            if(this.table_number > this.max_package_tables)  return;               
            this.tables_qr_code_link = this.qrCode + '/' + table_number;  
            this.qr_table_number =   table_number;       
        },

        dowloadQrCode(canvas_id){
            this.generateTablesQrCode(this.table_number);
            var el = document.getElementById(canvas_id);
            var canvas = el.getElementsByTagName('canvas')[0];
            let downloadLink = document.createElement('a');
            downloadLink.setAttribute('download', 'Table' + this.table_number + '.png');
            canvas.toBlob(function(blob) {
                let url = URL.createObjectURL(blob);
                downloadLink.setAttribute('href', url);
                downloadLink.click();
                });
        },
        maxTableNumber(){
            if(this.table_number > this.max_package_tables){
                this.table_number = this.max_package_tables
                this.errors.table_number = "Your package allows for only " +  this.max_package_tables + " tables max.";
            }
            else delete this.errors.table_number;
        }
    },

    mounted(){
        this.max_package_tables= window.authUser.tables;
        this.qrCode = this.generateQrCode(this.restaurant.id);
    }
    
}
</script>

<style lang="scss" scoped>
.modal, modal-dialogue, .modal-content {
    width:100%;
    margin-right:3rem;
}
</style>