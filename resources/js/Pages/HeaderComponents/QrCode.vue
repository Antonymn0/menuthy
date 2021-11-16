<template>
    <div>
             <!-- Button trigger modal -->
        <a href="" class="" data-bs-toggle="modal" data-bs-target="#exampleModalqrCode">
            <i class="bi bi-qr-code text-white"></i>
        </a>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalqrCode" tabindex="-1" aria-labelledby="exampleModalqrCodeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header pb-1 m-0">
                <h4 class="modal-title pr-2" id="exampleModalqrCodeLabel">Conect your device  </h4>
                <ul class="nav nav-tabs ">
                        <li class="active " > <a data-toggle="tab" href="#mobile" class="btn card">Mobile</a> </li>
                        <li > <a data-toggle="tab" href="#tablet" class="btn card">Tablet</a> </li>
                    </ul>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container">
             
                    <div class="tab-content">
                        <!-- mobile qr code  -->
                        <div id="mobile" class="tab-pane fade in active py-3">
                             <div class="qrcode container">
                                <img src="images/qrcodes/qr1.png" class="mx-auto my-auto img-fluid pl-4" alt="image-logo" style="width:70%; height:auto; margin:auto"> 
                                </div>
                                <p>
                                    Qr code link here
                                </p>
                            <p class="w-50 mx-auto my-2 p-3">
                                <button type="button" class="btn btn-danger float-right" data-bs-dismiss="modal">Cancel</button>
                            </p>
                        </div>
                        <div id="tablet" class="tab-pane fade">
                           <div class="qrcode container">
                                <img src="images/qrcodes/qr1.png" class="mx-auto my-auto img-fluid pl-4 text-danger" alt="image-logo" style="width:70%; height:auto; margin:auto"> 
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Venue ID</label>
                                    <input type="text" disabled class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Venue ID">
                                </div> 
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">pin code</label>
                                    <input type="text"  class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Pin code">
                                </div> 
                                
                            <p class="row align-items-center w-80 mx-auto my-2 p-2">
                                <button type="button" class="btn btn-primary col-sm-2 m-1" data-bs-dismiss="modal">Save</button>
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
    
}
</script>

<style lang="scss" scoped>

</style>