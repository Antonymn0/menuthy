<template>
    <div class="p-0 m-0 col-sm-2">
        <div class="m-3 pr-3">
            <a href="#"  data-toggle="modal" data-target="#exampleModalEditRestaurant" > <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i></a>
            
            <!-- edit restaurant Information modal -->
        <div class="modal fade " id="exampleModalEditRestaurant" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditRestaurantLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Update Restaurant Info</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-3">
                    <form action="#" enctype="multipart/form-data" @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Restaurant  name</label>
                            <input type="text" class="form-control p-4"  v-model="form.restaurant_name" id="exampleFormControlInput" placeholder="Restaurant name here...">
                           <small class="text-danger"> {{ errors.restaurant_name}}</small> 
                        </div>
                    
                        <div class="form-group">
                            <label for="maneu-name">Address</label>
                            <textarea  v-model="form.address" class="form-control p-3" id="" cols="10" rows="5">Address here</textarea>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Country</label>
                                    <input type="text" v-model="form.country"  class="form-control p-4" id="exampleFormControlInput2" placeholder="Country">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">State</label>
                                    <input type="text" class="form-control p-4" v-model="form.state" id="exampleFormControlInput2" placeholder="State">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" v-model="form.phone" class="form-control p-4" id="exampleFormControlInput2" placeholder="Phone number">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Email</label>
                                    <input type="email" v-model="form.email" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com">
                                   <small class="p-1 text-danger">{{ errors.email}} </small>                                     
                                </div> 
                            </div>
                        </div>
                        <div class="p-2">
                            <label for="file1">Image <small>(Optional)</small></label>
                            <input type="file"   class="form-control p-4" id="file1" name="file" placeholder="Image upload" @change="fileUpload">
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Website</label>
                                <input type="text" v-model="form.website" class="form-control p-4" id="exampleFormControlInput2" placeholder="Website">
                            </div> 
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Timezone</label>
                                <input type="text" v-model="form.time_zone" class="form-control p-4" id="exampleFormControlInput2" placeholder="Timezone">
                            </div> 
                        </div>
                         
                        <div class="pt-2">
                            <h4>Social accounts</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Facebook</label>
                                        <i class="bi bi-facebook p-2"></i>
                                        <input type="text" v-model="form.facebook" class="form-control p-4 " name="facebook" id="exampleFormControlInput2" placeholder="Facebook">
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Twitter</label>
                                        <i class="bi bi-twitter p-2"></i>
                                        <input type="text" v-model="form.twitter" class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Twitter">
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="exampleFormControlInput2">Youtube</label>
                                        <i class="bi bi-youtube p-2"></i>
                                        <input type="text" v-model="form.youtube" class="form-control p-4" name="youtube" id="exampleFormControlInput2" placeholder="Youtube">
                                    </div> 
                                    <div>
                                        <input type="hidden" v-model="form.user_id" name="user_id">                                   
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Instagram</label>
                                        <i class="bi bi-instagram p-2"></i>
                                        <input type="text" v-model="form.instagram" class="form-control p-4" name="instagram" id="exampleFormControlInput2" placeholder="Instagram">
                                    </div> 
                                    
                                </div>
                            </div>
                        </div>                         
                        <div class=" w-50 p-2 mx-auto">
                          <button type="submit" class="btn primary-btn btn-lg m-1" @click="submitForm(2)">Update</button>
                          <button type="button" class="btn btn-default btn-lg m-1" data-dismiss="modal">Cancel</button> <br>
                           <p v-if="Object.keys(this.errors).length" class="text-danger p-2"> Errors in the form! </p>
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
    props:['restaurant', 'user'],
    data() {
        return{
            // restaurant:window.authRestaurant,
            // user: window.authRestaurant,
            form:{
                restaurant_name: '',
               user_id:'' ,
               restaurant_id:'' ,
                address:'',
                country:'',
                state:'',
                phone:'',
                email:'',
                website:'',
                timezone:'',
                facebook:'',
                instagram:'',
                twitter:'',
                youtube:''
            },
            
            errors:{},
        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var form_data = new FormData();
                form_data.append('restaurant_name', this.form.restaurant_name);
                form_data.append('user_id', this.form.user_id);
                form_data.append('restaurant_id', this.form.restaurant_id);
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
                if(this.form.image) form_data.append('image', this.form.image);
                form_data.append('_method', 'PUT');
                for(var pair of form_data.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]); 
                    }
            axios.post('/api/restaurant/' + this.form.restaurant_id, form_data)
            .then( response => {
            if( response.status = 200){
                this.$swal('Update successful!');
                Inertia.reload();
                } 
            })
            .catch( error => {
               this.$swal('Failed to update!');
                console.log(error.response);                    
            });
        },
        fileUpload(event){
            this.form.image = event.target.files[0];
        },

        validateForm () {
            console.log(this.form.restaurant_name);
            console.log(this.form.user_id);
            if(!this.form.restaurant_name) this.errors.restaurant_name = 'Restaurant name field is required' ;
            else delete this.errors.restaurant_name;  

            if(this.form.email){
                var is_valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email);
                if(!is_valid){
                    this.errors.email = 'Enter a valid Email address' ;
                }else{
                   delete this.errors.email;  
                }
            }             
                  
        } 
        
    },
    mounted(){
        this.form.restaurant_name = window.authRestaurant.restaurant_name;
        this.form.user_id = window.authUser.id;
        this.form.restaurant_id = window.authRestaurant.id;
        this.form.address = window.authRestaurant.address;
        this.form.country = window.authRestaurant.country;
        this.form.state = window.authRestaurant.state;
        this.form.phone = window.authRestaurant.phone;
        this.form.email = window.authRestaurant.email;
        this.form.website = window.authRestaurant.website;
        this.form.timezone = window.authRestaurant.timezone;
        this.form.facebook = window.authRestaurant.facebook;
        this.form.twitter = window.authRestaurant.twitter;
        this.form.instagram = window.authRestaurant.instagram;
        this.form.youtube = window.authRestaurant.youtube;
    }
    
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

    h3{
        color: $primary-button;
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
