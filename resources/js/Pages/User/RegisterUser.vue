<template>
    <div class="d-flex justify-content-between align-items-center">
             <a class="p-3" href="/">
                <img src="/images/menuthy_logo_i.jpg" class="" width="200"  alt="menuthy-logo">
            </a>
            <button class="button mr-4" style="max-width:8rem;"><a href="/login" class="text-white "> Go to login</a></button>         
    </div>

    <div class="login-block shadow">
        <form action="" class="" enctype="multipart/form-data" @submit.prevent="submitForm()">        
            <h1 pt-1>Tell us about your business</h1>
            <div class="pb-1">
                <label for="restaurnat_name">Business name</label>
                <input type="text"  placeholder="Business name" id="resturant_nane" v-model="form.restaurant_name"/>
                <small class="text-danger text-center">  {{this.errors.restaurant_name}}</small>
            </div>
            <div class="row"> 
                <div class="col-sm-6">
                    <div class="fpb-1">
                        <label for="type">Restaurant type</label>
                        <input type="text" class=" "  placeholder="Restaurant type" id="type" v-model="form.type"/>
                        <small class="text-danger text-center">  {{this.errors.type}}</small>
                    </div>
                </div>
               
                    <div class="col-sm-6">    
                        <div class="fpb-1">
                            <label for="timezone">Timezone</label>
                            <select class="form-select" aria-label="Default select example" v-model="form.timezone" id="timezone">
                                <option  >Select time zone</option>
                                <option v-bind="this.item" v-for="item in timeZones" :key="item">{{item}}</option>
                                <small class="text-danger text-center">  {{this.errors.timezone}}</small>
                            </select>
                        </div>
                    </div>
                  
            </div>
            <div class="">            
                <div class="pb-1 " style="overflow:hidden">
                <label for="full_name">County & City</label> 
                    <vueCountriesCities @country='selectedCountry = $event' @city='selectedCity = $event'  style="max-height:20px; max-width:90% !important;"/>  
                  </div>  
                   <small class="text-danger text-center">  {{this.errors.selecteCountry}}</small> <small class="text-danger">  {{this.errors.selectedCity}}</small>
                
            </div>
            
<div>
    <country-select />
</div>
            <div>
                <h1 class="mt-5">A little info about yourself</h1>
                <div class="pb-1">
                    <label for="full_name">Full name</label>
                    <input type="text"  placeholder="Full name" id="full_name" v-model="form.full_name" />
                    <small class="text-danger text-center">  {{this.errors.full_name}}</small>
                </div>
                <div class="pb-1">
                    <label for="email">Email</label>
                    <input type="email"  placeholder="Email" id="email" v-model="form.email" />
                    <small class="text-danger text-center">  {{this.errors.email}}</small>
                </div>      
                
                
                <div class="row">
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="password">Password</label>
                        <input type="password"  placeholder="Password" id="password" v-model="form.password"/>
                        <small class="text-danger text-center">  {{this.errors.password}}</small>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password"  placeholder="Confirm password" id="confirm_password" v-model="form.confirm_password" />
                        <small class="text-danger text-center">  {{this.errors.confirm_password}}</small>  
                    </div>
                    </div>
                </div>            
            </div> 
              

            <div class="d-flex align-content-center justify-content-center pt-2">
               <button type="submit" class="m-2 button" style="max-width:8rem;">Register</button>
                <a href="/login" class="text-white button m-2 text-center pt-2" style="max-width:8rem;"> Cancel </a>
            </div> 
             </form>    
           </div>
        
   
</template>

<script>
import vueCountriesCities from "vue-countries-cities";

export default {
    components: {
            vueCountriesCities,
            },
    data(){
        return{
            form:{
                restaurant_name:'',
                type:'',
                timezone:'',
               full_name:'',
               email:'',
               passowrd:'',
               confirm_password:'',
                      
            },
            
             selectedCountry: '',
             selectedCity: '',
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
        submitForm() {
            this.validateForm();;
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var user_data = new FormData();
                user_data.append('full_name', this.form.full_name);
                user_data.append('email', this.form.email);
                user_data.append('password', this.form.password);
                user_data.append('password_again', this.form.password_again);
                user_data.append('package_type', 'master');

            axios.post('api/user', user_data)
            .then( response => {
                if( response.status = 201){                
                    this.storeRestaurant(response.data.data.id); // pass user id to restaurant
                    console.log(response.data);
                } 
            })
            .catch( error => {                 
                    this.errors.email = error.response.data.errors.email[0];
                    console.log(error.response.data.errors);                    
                });
        },

        storeRestaurant(user_id){
            var restaurant_data = new FormData();
                restaurant_data.append('restaurant_name', this.form.restaurant_name);
                restaurant_data.append('type', this.form.type);
                restaurant_data.append('timezone', this.form.timezone);
                restaurant_data.append('country', this.selectedCountry);
                restaurant_data.append('city', this.selectedCity);
                restaurant_data.append('user_id', user_id); // append user id to restaurant

            // register restaurant after user is successful
            axios.post('api/restaurant', restaurant_data)
            .then( response => {
                if(response.status == 201){
                    window.location.href = '/login';
                }
            })
            .catch( error => {
                this.$swal('Failed to create restaurant!');
                console.log(error.response);                    
            });
        },

        validateForm(){
            if(!this.form.restaurant_name) this.errors.restaurant_name = 'This field is required!' ;
                else delete this.errors.restaurant_name;  

            if(!this.form.type) this.errors.type = 'This field is required!' ;
                else delete this.errors.type;  

            if(!this.form.timezone) this.errors.timezone = 'This field is required!' ;
                else delete this.errors.timezone; 

            if(!this.selectedCountry) this.errors.selectedCountry = 'This field is required!' ;
                else delete this.errors.selectedCountry;  

            if(!this.selectedCity) this.errors.selectedCity = 'This field is required!' ;
                else delete this.errors.selectedCity;  

            if(!this.form.full_name) this.errors.full_name = 'This field is required!' ;
                else delete this.errors.full_name;  

            if(!this.form.email) this.errors.email = 'This field is required!' ;
                else delete this.errors.email;

            if(!this.form.password) this.errors.password = 'This field is required!' ;
                else delete this.errors.password;  

            if(!this.form.confirm_password) this.errors.confirm_password = 'This field is required!' ;
                else delete this.errors.confirm_password;  

            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!' ;
                else delete this.errors.confirm_password;  
        },
    },
}
</script>

<style scoped>
    body {
    font-family: Montserrat;
    }
    
.countries-cities{
    height:1rem !important;
    max-height:1rem !important;
    justify-content: space-between!important;
    padding:20px;
}
.countries-cities .select-box{
    border-radius: 15px;
    max-width:49%!important;
    min-width:100px!important;

}
.countries-cities .select-box select {
    border-radius: 15px;
    padding-right: 5px;
    padding-left: 5px;
    max-width: 49%;

}
    
    .login-block {
    width: 50%;
    padding: 20px;
    background: rgba(233, 233, 233, 0);
    border-radius: 5px;
    border-top: 5px solid #ff656c;
    margin: 0 auto;
    margin-bottom: 2rem;

    }
    
    .login-block h1 {
    text-align: center;
    color: rgb(228, 107, 107);
    font-size: 20px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
    }
    
    .login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 5px;
    font-size: 15px;
    font-family: Montserrat;
    padding-left: .7rem;
    outline: none;
    }
    

    .login-block input#password:focus {
    background: #fff url('http://i.imgur.com/Qf83FTt.png') 20px bottom no-repeat;
    background-size: 16px 80px;
    }
    
    .login-block input:active, .login-block input:focus .login-block select:focus{
    border: 1px solid #ff656c;
    }
    
    .login-block button, .button {
        width: 100%;
        height: 40px;
        background: #ff656c;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #e15960;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
        font-family: Montserrat;
        outline: none;
        cursor: pointer;
    }
    
    .login-block button:hover {
    background: #f5414a;
    }
/* media queries */
    @media only screen and (max-width: 900px) {
        .login-block{
            width:80%;
        }
    }
/* media queries */
    @media only screen and (max-width: 700px) {
        .login-block{
            width:98%;
        }
    }

</style>