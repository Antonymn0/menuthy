<template>
    <div class="">
        <div class="">           
            <!-- edit User ProfileInformation modal -->
        <div class="modal fade " id="profile" tabindex="-1" role="dialog" aria-labelledby="profileLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Update Profile Infomation</h3>
                    <button type="button" class="close" id="closeProfile" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-3">
                    <form action="#" enctype="multipart/form-data" ref="form" @submit.prevent="submitForm()">
                      
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">First name*</label>
                                    <input type="text" v-model="form.first_name"  class="form-control p-4" id="exampleFormControlInput2" placeholder="First name">
                                   <small class="text-danger">{{this.errors.first_name}} </small> 
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
                                   <small class="text-danger">{{this.errors.last_name}} </small> 
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Email*</label>
                                    <input type="email" v-model="form.email" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com" @input="this.validateEmail()">
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
                        <div class="mx-auto p-2">
                            <label for="exampleFormControlInputimage">Image*</label>
                            <div class="image-preview mx-auto p-0 m-0 text-center">
                                <img :src="form.img_preview" alt="" >  <br>
                                <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="exampleFormControlInputimage"  placeholder="Preparation time"  @change="fileUpload">
                            </div>    
                            <small class="text-danger"> {{this.errors.image }} </small>              
                        </div>
                                       
                        <div class=" d-flex justify-content-center align-items-ceneter p-3">
                          <button type="submit" class="btn primary-btn btn-lg m-1"  >Update</button>
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
                email: '',
                role: '',
                phone:'',
                country:'',
                timezone:'',
                city:'',
                address:'',
                image:'',
                img_preview:''
            }, 
                regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,       
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
                form_data.append('role', this.form.role);
               
                if(this.form.image) form_data.append('image', this.form.image);
                form_data.append('_method', 'PUT');
               
                Swal.showLoading();
            axios.post('/api/user/' + this.form.user_id, form_data)
            .then( response => {
            if( response.status == 200){
                document.getElementById('closeProfile').click();
                new Swal({ title: "Success!",timer: 1800  });                   
                } 
            })
            .catch( error => {
               this.$swal('Failed to update!');
                console.log(error.response);                    
            });
        },
        fileUpload(event){
            this.form.image = event.target.files[0]; 
            if(this.form.image.size > 2048 * 1024){
              this.errors.image = "Image too big. Select an image less than 2mb."; 
              return;
           } 
           if(this.form.image['type'] === 'image/jpeg' || this.form.image['type'] === 'image/jpg' || this.form.image['type'] === 'image/png' || this.form.image['type'] === 'image/gif'){
              this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
              delete this.errors.image
              return;
           } 
           else {
               this.errors.image = " Allowed types jpg/png/jpeg/gif";
               this.form.img_preview = '';
           }
        }, 
        validateEmail(){
            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email!' ;
             else delete this.errors.email;
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

        if( window.authUser.first_name !== 'null') this.form.first_name = window.authUser.first_name;
        if(window.authUser.middle_name !== 'null')this.form.middle_name = window.authUser.middle_name;
        if(window.authUser.last_name !== 'null') this.form.last_name = window.authUser.last_name;
        if(window.authUser.email !== 'null') this.form.email = window.authUser.email;
        if(window.authUser.phone !== 'null') this.form.phone = window.authUser.phone;
        if(window.authUser.address !== 'null') this.form.address = window.authUser.address;
        if(window.authUser.country !== 'null') this.form.country = window.authUser.country;
        if(window.authUser.timezone !== 'null') this.form.timezone = window.authUser.timezone;
        if(window.authUser.city !== 'null') this.form.city = window.authUser.city;
        if(window.authUser.image !== 'null') this.form.img_preview = window.authUser.image;
        this.form.role = window.authUser.role;
       
        
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
     .image-preview{
        border-radius: 15px;
        border: 1px dashed gainsboro;
        min-height:8rem;
        padding-top:1rem;
    }
    .image-preview img{
        margin-top: 5px;
        min-height:7rem; 
        max-height: 10rem;
        min-width:7rem;
        max-width:10rem;
        border-radius:15px;
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
