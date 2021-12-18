<template>
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Menuthy</title>
</head>
<body class=" " >
    <div class=" px-5 parent">
        <a class="p-3" href="/">
            <img src="/images/menuthy_logo.svg" class="p-3" style=" width:20%"  alt="menuthy-logo">
        </a>                  
    </div>
    <div class="login-block shadow">
        <form action="" class="" enctype="multipart/form-data" @submit.prevent="submitForm()">       
            <div>
                <h4 class="mt-5">Register admin</h4>
                <div class="pb-1">
                    <label for="full_name">Full name</label>
                    <input type="text"  placeholder="Full name" id="full_name" v-model="form.full_name" />
                    <small class="text-danger text-center">  {{this.errors.full_name}}</small>
                </div>
                <div class="pb-1">
                    <label for="email">Email</label>
                    <input type="email"  placeholder="Email" id="email" v-model="form.email" @input="this.validateEmail()"/>
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
                        <input type="password"  placeholder="Confirm password" id="confirm_password" v-model="form.confirm_password" @input="confirmPassword()" />
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
       
</body>
</html>
   
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
                full_name:'',
                email:'',
                passowrd:'',
                confirm_password:'',
                role:'admin',   
            },
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            errors:{},
            }
    },
    methods:{
        submitForm() {
            this.validateForm();
            console.log(this.errors);
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var user_data = new FormData();
                user_data.append('full_name', this.form.full_name);
                user_data.append('email', this.form.email);
                user_data.append('password', this.form.password);
                user_data.append('password_again', this.form.password_again);
                user_data.append('package_type', 'master');          
                user_data.append('role', this.form.role);          
                
                Swal.showLoading(),    

            axios.post('api/user', user_data)
            .then( response => {
                if( response.status == 201){  
                    window.location.href = '/login';
                } 
            })
            .catch( error => {  
                console.log(error.response.data); 
                Swal.close();
                 if(error.response.status == 422) {
                     if(error.response.data.errors.email){
                         this.errors.email = error.response.data.errors.email[0];
                         return;
                     } 
                    }
                console.log(error.response); 
                new Swal({ title: "Error", timer: 2000});                                                                                      
                                       
                });
        },

        validateEmail(){
            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email!' ;
             else delete this.errors.email;
        },
        confirmPassword(){
            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!' ;
                else delete this.errors.confirm_password; 
        },
        validateForm(){            
        
            if(!this.form.full_name) this.errors.full_name = 'This field is required!' ;
            else delete this.errors.full_name;  

            if(!this.form.email) this.errors.email = 'This field is required!' ;
            else delete this.errors.email;

            if(!this.regex.test(this.form.email)) this.errors.email = 'invalid email!' ;
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

@import url('https://fonts.googleapis.com/css?family=Poppins');

  .parent{
    font-family: Poppins !important;
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
    h4{
        color: rgb(228, 107, 107);
        text-align: center;
    }
    .login-block h1 {
    text-align: center;
    color: rgb(228, 107, 107);
    font-size: 28px;
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

    padding-left: .7rem;
    outline: none;
    }    

    .login-block input#password:focus {
        background: #fff 20px bottom no-repeat;
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
            width:97%;
            margin-right:auto;
            margin-left:auto;
        }
    }

</style>