<template>
    <div class="p-0 m-0 col-sm-2">
        <div class="">
            <a href="#"  data-toggle="modal" data-target="#exampleModalEditRestaurant" > <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i></a>
            
            <!-- edit restaurant Information modal -->
        <div class="modal fade  " id="exampleModalEditRestaurant" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditRestaurantLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Update Restaurant Info</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" enctype="multipart/form-data" @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Restaurant  name</label>
                            <input type="text" class="form-control p-4"  v-bind="form.restaurant_name" id="exampleFormControlInput" placeholder="Restaurant name here...">
                            {{ errors.restaurant_name}}
                        </div>
                    
                        <div class="form-group">
                            <label for="maneu-name">Address</label>
                            <textarea  v-bind="form.address" class="form-control p-3" id="" cols="10" rows="5">Address here</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Country</label>
                                    <input type="text" v-bind="form.country"  class="form-control p-4" id="exampleFormControlInput2" placeholder="Country">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">State</label>
                                    <input type="text" class="form-control p-4" v-bind="form.state" id="exampleFormControlInput2" placeholder="State">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" v-bind="form.phone" class="form-control p-4" id="exampleFormControlInput2" placeholder="Phone number">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Email</label>
                                    <input type="email" v-bind="form.email" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com">
                                   <small class="p-1 text-danger">{{ errors.email}} </small>                                     
                                </div> 
                            </div>
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Website</label>
                                <input type="text" v-bind="form.website" class="form-control p-4" id="exampleFormControlInput2" placeholder="Website">
                            </div> 
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Timezone</label>
                                <input type="text" v-bind="form.time_zone" class="form-control p-4" id="exampleFormControlInput2" placeholder="Timezone">
                            </div> 
                        </div>
                         
                        <div class="">
                            <h3>Social accounts</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Facebook</label>
                                        <i class="bi bi-facebook"></i>
                                        <input type="text" v-bind="form.facebook" class="form-control p-4 " name="facebook" id="exampleFormControlInput2" placeholder="Facebook">
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Twitter</label>
                                        <i class="bi bi-twitter"></i>
                                        <input type="text" v-bind="form.twitter" class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Twitter">
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="exampleFormControlInput2">Youtube</label>
                                        <i class="bi bi-youtube"></i>
                                        <input type="text" v-bind="form.youtube" class="form-control p-4" name="youtube" id="exampleFormControlInput2" placeholder="Youtube">
                                    </div> 
                                    <div>
                                        <input type="hidden" v-bind="form.user_id" name="user_id">                                   
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Instagram</label>
                                        <i class="bi bi-instagram"></i>
                                        <input type="text" v-bind="form.instagram" class="form-control p-4" name="instagram" id="exampleFormControlInput2" placeholder="Instagram">
                                    </div> 
                                    
                                </div>
                            </div>
                        </div>                         
                        <div class=" w-50  mx-auto">
                          <button type="submit" class="btn primary-btn btn-lg m-1" @click="submitForm(2)">Update</button>
                          <button type="button" class="btn btn-default btn-lg m-1" data-dismiss="modal">Cancel</button>
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
import { defineComponent } from '@vue/runtime-core';
defineComponent
export default {
    data() {
        return{
            form:{
                restaurant_name: '',
                user_id:2,
                address:'',
                country:'',
                state:'',
                phone:'',
                email:'',
                website:'',
                timezone:'',
                facebook:'',
                instagram:'',
                facebook:'',
                twitter:'',
                youtube:'',
            },
            errors:{},
        }
    },
    methods:{
        submitForm (id) {
            this.validateForm();
            if(this.errors.length > 0) return;
            console.log('No errors in the form...');
            var form_data = new FormData();
                form_data.append('restaurant_name', 'this.form.restaurant_name');
                form_data.append('user_id', 'this.form.user_id');
                form_data.append('address', this.form.address);
                form_data.append('country', this.form.country);
                form_data.append('state', this.form.state);
                form_data.append('phone', this.form.phone);
                form_data.append('email', this.form.email);
                form_data.append('website', this.form.website);
                form_data.append('timezone', this.form.timezone);
                form_data.append('facebook', this.form.facebook);
                form_data.append('instagram', this.form.instagram);
                form_data.append('youtube', this.form.youtube);
                form_data.append('twitter', this.form.twitter); 
                console.log(...form_data);
            axios.put('/api/restaurant/'+ id, form_data)
            .then( response => {
            if( response.status = 201){
                this.$swal('Update successful!');
                // Inertia.reload();
                // this.$inertia.visit('/menu-items');
                } 
            })
            .catch( error => {
               this.$swal('Failed to update!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            console.log(this.form.restaurant_name);
            console.log(this.form.user_id);
            if(!this.form.restaurant_name) this.errors.restaurant_name = 'Item name field is required' ;
            else delete this.errors.restaurant_name;  

            if(this.form.email){
                let is_valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email);
                if(!is_valid){
                    this.errors.email = 'Enter a valid Email address' ;
                }else{
                   delete this.errors.email;  
                }
            }             
                  
        } 
    },
    
}
    
    

</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";

.main-sub-menu{
    font-size:1.2rem;
}
    .primary-btn{
        background-color: $primary-button;
        color: #fff;
    }
    .btn:hover, .btn:active{
        background-color: $primary-button;
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


</style>
