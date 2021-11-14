<template>
    <div class="p-0 m-0 col-sm-2">
        <div class="">
            <a href="#"  data-toggle="modal" data-target="#exampleModalEditRestaurant" > <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i></a>
            
            <!-- edit restaurant Information modal -->
        <div class="modal fade  " id="exampleModalEditRestaurant" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditRestaurantLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Edit Restaurant Info</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Restaurant  name</label>
                            <input type="text" class="form-control p-4" id="exampleFormControlInput" placeholder="menu name here...">
                        </div>
                    
                        <div class="form-group">
                            <label for="maneu-name">Address</label>
                            <textarea name="description" class="form-control p-3" id="" cols="10" rows="5">Address here</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Country</label>
                                    <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="Country">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">State</label>
                                    <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="State">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="Phone number">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Email</label>
                                    <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com">
                                </div> 
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Website</label>
                                <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="Website">
                            </div> 
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Timezone</label>
                                <input type="text" class="form-control p-4" id="exampleFormControlInput2" placeholder="Timezone">
                            </div> 
                        </div>
                         
                        <div class="">
                            <h3>Social accounts</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Facebook</label>
                                        <i class="bi bi-facebook"></i>
                                        <input type="text" class="form-control p-4 " name="facebook" id="exampleFormControlInput2" placeholder="Facebook">
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Twitter</label>
                                        <i class="bi bi-twitter"></i>
                                        <input type="text" class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Twitter">
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="exampleFormControlInput2">Youtube</label>
                                        <i class="bi bi-youtube"></i>
                                        <input type="text" class="form-control p-4" name="youtube" id="exampleFormControlInput2" placeholder="Youtube">
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Instagram</label>
                                        <i class="bi bi-instagram"></i>
                                        <input type="text" class="form-control p-4" name="instagram" id="exampleFormControlInput2" placeholder="Instagram">
                                    </div> 
                                    
                                </div>
                            </div>
                        </div>                         
                        <div class=" w-50  mx-auto">
                          <button type="button" class="btn primary-btn btn-lg ">Save</button>
                          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Close</button>
                      </div>
                    </form>
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

<style scoped lang="scss">
@import "../../../sass/app.scss";

.main-sub-menu{
    font-size:1.2rem;

    .primary-btn{
        background-color: $primary-button;
        color: #fff;
    }
    .btn:hover, .btn:active{
        background-color: #e6034b;
    color: #fff;
    }
    .menu-card{
        width:24%;
        height:auto;
        max-width:98%;
        margin: .5rem .1rem;
    }



    
    /* media quesries */
    @media only screen and (max-width: 900px) {
    .menu-card{
        width:30%;
    }
    }
    @media only screen and (max-width: 750px) {
    .menu-card{
        width:50%;
    }
    }
    @media only screen and (max-width: 600px) {
    .menu-card{
        width:100%;
    }
    }
}

</style>
