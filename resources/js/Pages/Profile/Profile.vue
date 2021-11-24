<template>
    <div class="p-0 m-0 col-sm-2">
        <div class="m-3 pr-3">
           
            <!-- edit User ProfileInformation modal -->
        <div class="modal fade " id="profile" tabindex="-1" role="dialog" aria-labelledby="profileLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Update Profile Info</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-3">
                    <form action="#" enctype="multipart/form-data" @submit.prevent="submitForm(2)">
                      
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">First name*</label>
                                    <input type="text" v-model="form.first_name"  class="form-control p-4" id="exampleFormControlInput2" placeholder="First name">
                                    {{this.errors.first_name}}
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Middle name</label>
                                    <input type="text" class="form-control p-4" v-model="form.middle_name" id="exampleFormControlInput2" placeholder="Middle name">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Last name*</label>
                                    <input type="text" v-model="form.last_name" class="form-control p-4" id="exampleFormControlInput2" placeholder="Last name">
                                    {{this.errors.last_name}}
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Email</label>
                                    <input type="email" v-model="form.email" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com">
                                   <small class="p-1 text-danger">{{ errors.email}} </small>                                     
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" v-model="form.phone" class="form-control p-4" id="exampleFormControlInput2" placeholder="Phone number">
                                   <small class="p-1 text-danger">{{ errors.phone}} </small>                                     
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Address</label>
                                    <input type="text" v-model="form.address" class="form-control p-4" id="exampleFormControlInput2" placeholder="address">
                                   <small class="p-1 text-danger">{{ errors.address}} </small>                                     
                                </div> 
                            </div>
                        </div>
                        <div class="p-2">
                            <label for="file1">Image <small>(Optional)</small></label>
                            <input type="file"   class="form-control p-4" id="file1" name="file" placeholder="Image upload" @change="fileUpload">
                        </div>
                                       
                        <div class=" d-flex justify content-center">
                          <button type="submit" class="btn primary-btn btn-lg m-1" >Update</button>
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
                user_id:'',
                full_name:'',
                first_name:'',
                middle_name:'',
                last_name:'',
                email: null,
                phone:'',
                country:'',
                timezone:'',
                city:'',
                address:'',
                image:'',
            },            
            errors:{},
             timeZones:[
                  'GMT	Greenwich Mean Time	GMT',
                  'UTC	Universal Coordinated Time	GMT',
                  'ECT	European Central Time	GMT+1:00',
                  'EET	Eastern European Time	GMT+2:00',
                  'ART	(Arabic) Egypt Standard Time	GMT+2:00',
                  'EAT	Eastern African Time	GMT+3:00',
                  'MET	Middle East Time	GMT+3:30',
                  'NET	Near East Time	GMT+4:00',
                  'PLT	Pakistan Lahore Time	GMT+5:00',
                  'IST	India Standard Time	GMT+5:30',
                  'BST	Bangladesh Standard Time	GMT+6:00',
                  'VST	Vietnam Standard Time	GMT+7:00',
                  'CTT	China Taiwan Time	GMT+8:00',
                  'JST	Japan Standard Time	GMT+9:00',
                  'ACT	Australia Central Time	GMT+9:30',
                  'AET	Australia Eastern Time	GMT+10:00',
                  'SST	Solomon Standard Time	GMT+11:00',
                  'NST	New Zealand Standard Time	GMT+12:00',
                  'MIT	Midway Islands Time	GMT-11:00',
                  'HST	Hawaii Standard Time	GMT-10:00',
                  'AST	Alaska Standard Time	GMT-9:00',
                  'PST	Pacific Standard Time	GMT-8:00',
                  'PNT	Phoenix Standard Time	GMT-7:00',
                  'MST	Mountain Standard Time	GMT-7:00',
                  'CST	Central Standard Time	GMT-6:00',
                  'EST	Eastern Standard Time	GMT-5:00',
                  'IET	Indiana Eastern Standard Time	GMT-5:00',
                  'PRT	Puerto Rico and US Virgin Islands Time	GMT-4:00',
                  'CNT	Canada Newfoundland Time	GMT-3:30',
                  'AGT	Argentina Standard Time	GMT-3:00',
                  'BET	Brazil Eastern Time	GMT-3:00',
                  'CAT	Central African Time	GMT-1:00',
                  ],
        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            // recreate full name
            this.full_name= this.form.first_name + ' ' + this.form.middle_name + ' ' + this.form.last_name;
            var form_data = new FormData();
                form_data.append('full_name', this.full_name);
                form_data.append('first_name', this.form.first_name);
                form_data.append('middle_name', this.form.middle_name);
                form_data.append('last_name', this.form.last_name);
                form_data.append('email', this.form.email);
                form_data.append('address', this.form.address);
                form_data.append('country', this.form.country);
                form_data.append('city', this.form.city);
                form_data.append('timezone', this.form.timezone);
                form_data.append('phone', this.form.phone);
               
                if(this.form.image) form_data.append('image', this.form.image);
                form_data.append('_method', 'PUT');
                for(var pair of form_data.entries()) {
                    // console.log(pair[0]+ ', '+ pair[1]); 
                    }
            axios.post('/api/user/' + this.form.user_id, form_data)
            .then( response => {
            if( response.status = 200){
                this.$swal('Update successful!');
                // console.log(response);
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

            if(!this.form.first_name) this.errors.first_name = 'First name field is required' ;
            else delete this.errors.first_name;  

            if(!this.form.last_name) this.errors.last_name = 'Last name field is required' ;
            else delete this.errors.last_name;  

            if(!this.form.email) this.errors.email = 'Email field is required' ;
            else delete this.errors.email;  

            if(this.form.email){
                var is_valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.email);
                if(!is_valid){
                    this.errors.email = 'Enter a valid Email address' ;
                }else{
                   delete this.errors.email;  
                }
            }             
                  
        }, 
        
    },
    mounted(){
        this.form.user_id = window.authUser.id;
        this.form.first_name = window.authUser.first_name;
        this.form.middle_name = window.authUser.middle_name;
        this.form.last_name = window.authUser.last_name;
        this.form.email = window.authUser.email;
        this.form.phone = window.authUser.phone;
        this.form.address = window.authUser.address;
        this.form.country = window.authUser.country;
        this.form.timezone = window.authUser.timezone;
        this.form.city = window.authUser.city;
        
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
