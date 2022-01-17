<template>
<div>
    <Header />
    <Topnavbar />  
</div>
    <div class="px-5 py-3">
         <h1 class="py-2">Update Your Banking Information</h1> 
        <div>           

            <form action="#" class="card shadow p-3 " ref="form" @submit.prevent="submitForm()"> 
                <h4 class="py-2">Stripe Information</h4>   
                <div class="form-group">
                    <label for="exampleFormControlInput1" >Publishable key</label>
                    <input type="text"  v-model="form.stripe_publishable_key" class="form-control p-4" id="exampleFormControlInput1"  placeholder="Publishable key">
                    <small class="text-danger"> {{ errors.stripe_publishable_key}} </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1" >Sectret  key</label>
                    <input type="text"  v-model="form.stripe_secret_key" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Secret key ">
                    <small class="text-danger"> {{ errors.stripe_secret_key}} </small>
                </div>         
                <div class="form-group">
                    <label for="exampleFormControlInput1" >Your registered Menuthy email</label>
                    <input type="text"  v-model="form.email" class="form-control p-4" id="exampleFormControlInput1"  placeholder="Email">
                    <small class="text-danger"> {{ errors.email}} </small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1" >Menuthy password</label>
                    <input type="password"  v-model="form.password" class="form-control p-4" id="exampleFormControlInput1"  placeholder="Password">
                    <small class="text-danger"> {{ errors.password}} </small>
                </div>
             
                <div class=" text-center mx-auto">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <span :class="this.form.spinner" class="" role="status" aria-hidden="true"> </span> &nbsp;
                        <span class="text-primary small ">{{this.form.stripe_status}}</span>  
                    </div>
                   
                    <button type="submit" class="btn btn-primary mr-2"  >Update </button>
                    <button type="button" class="btn btn-danger"    >Close</button>
                </div>
                <p class="text-muted pt-2">
                   <span style="font-weight:600"> Important note</span>  <br>
                    <i class="bi bi-dot"></i> We do not handle our clients money. <br>
                    <i class="bi bi-dot"></i> We use this information to help process payments from your customers direct into your account. <br>
                    <i class="bi bi-dot"></i> Make sure this Stripe account is dedicated to Menuthy payments only. <br>
                    <i class="bi bi-dot"></i> Your information is save, we do not share it with third parties. <br>
                    <i class="bi bi-dot"></i> Stripe credentials are available on you <a href='https://dashboard.stripe.com/dashboard'> Stripe dashboard </a> <br>
                    <i class="bi bi-dot"></i> For any questions  regarding paymnents, please do not hesistate to contact us.

                </p>
            </form>
        </div>
    </div>
    <Footer />
</template>
<script>
import moment from 'moment';
import $ from "jquery";

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";
export default {
    components: {
        Header,
        Topnavbar,
        Footer,
       
    },
    data(){
        return{
            form:{
                stripe_publishable_key:null,
                stripe_secret_key:null,
                email:null,
                password:null,
                stripe_status:null,
                spinner:null,
                is_public_key_valid:false,
            },
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
            errors:{}
        }
    },

    methods:{
       submitForm(){            
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            this.validateStripePublicKey();
        },

        validateStripePublicKey(){
            this.form.spinner= 'spinner-border spinner-border-sm';
            if(Object.keys(this.errors).length) return;
            this.form.stripe_status = 'Validating public key...';

            let stripe = Stripe( this.form.stripe_publishable_key );
            setTimeout( ()=>{
                stripe.createToken('pii', {personal_id_number: 'test'})
                    .then( response =>{                       
                        if( response.token ){
                            console.log('Public key Validated!');
                            this.form.stripe_status = 'Public key Validated!';
                            this.form.spinner= null;
                            delete this.errors.stripe_publishable_key;
                            this.is_public_key_valid = true;
                            this.sendRequest();
                        }                        
                        else {
                            this.form.spinner= null;
                            this.form.stripe_status = null
                            this.errors.stripe_publishable_key  = "Invalid Public Key!"
                           console.log('error! Invalid key');
                           this.is_public_key_valid = false
                           return ;
                        }                        
                    })
            }, 300 );
            
        },

        sendRequest(){
            this.form.spinner= 'spinner-border spinner-border-sm';
            var form_data = new FormData();
            form_data.append('stripe_publishable_key', this.form.stripe_publishable_key);
            form_data.append('stripe_secret_key', this.form.stripe_secret_key);
            form_data.append('email', this.form.email);
            form_data.append('password', this.form.password);

            this.form.stripe_status = 'Validating secret key...';      

            axios.post('api/banking/update-stripe-info', form_data)
            .then( response => {
                this.form.stripe_status = 'Secret key Validated';
                console.log(response);
                if( response.status == 200){ 
                    this.form.spinner= null;
                    this.form.stripe_status = '.' ;
                    this.is_public_key_valid = false
                    this.$inertia.reload();                                        
                    new Swal({   title:'Success', timer:1200 });   
                    // this.$refs.form.reset();  
                    } 
                })
            .catch( error => {
                console.log(error)
                this.form.stripe_status = null;
                this.errors ={};
                this.form.spinner= null;
                if(error.response.status == 500) this.form.stripe_status = 'Secret key not validated!' ;
                if(error.response.status == 500) this.errors.stripe_secret_key = 'Invalid secret key!' ;
                if(error.response.status == 404){this.errors.email = 'No account associated with this email!' ;}
                if(error.response.status == 403){this.errors.password = 'Wrong password!' ;}
                this.$swal('Failed!');
                console.log(error.response);                    
            });
        },

        validateForm(){
            this.errors = {};
            
            if(!this.form.stripe_publishable_key) this.errors.stripe_publishable_key = 'Public key field is required!' ;
            else delete this.errors.stripe_publishable_key;

            if(!this.form.stripe_secret_key) this.errors.stripe_secret_key = 'Secret key field is required!' ;
            else delete this.errors.stripe_secret_key;

            if(!this.form.password) this.errors.password = 'Password field is required!' ;
            else delete this.errors.password;

            if(!this.form.email) this.errors.email = 'Email field is required!' ;
            else delete this.errors.email;

            if(!this.regex.test(this.form.email)) this.errors.email = 'Invalid email!' ;
            else delete this.errors.email;
        }
    },
    


}
</script>
<style scoped>
form{
    width:100%;
    max-width:45rem;
}
</style>