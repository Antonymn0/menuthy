<template>
<div class=" mb-0 border-bottom" >
  <div class="alert mx-auto px-5  mb-0 fade-in" v-if="this.emailverified == false">
    <span class="closebtn " onclick="this.parentElement.style.display='none';">&times;</span>
    <span class="mr-2 "> Your email is not verified. Please Click this button to: </span>
      <a href="#" class=" btn-danger  btn" @click.prevent="sendVerificationEmail(this.user.email)">Verify</a>
      <p class="text-dark mr-2 pl-4 mt-1">
         <small>{{message}} </small> 
      </p>
  </div>
</div>
</template>

<script>
import moment from 'moment';
export default {
    data(){
        return{
            emailverified:false,
            user:null,
            message:'',

        }
    },
    methods:{
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },

        sendVerificationEmail(email){
            axios.get('api/send-email-verification/' + email)
                .then( response => {
                if( response.status == 200){
                    this.message = 'We have sent a verification link to your email address. Please check your inbox and click the link to verify.'
                    } 
                })
                .catch( error => {
                    console.log(error);
                    this.$swal('Failed!');                
                 
                });
        },
    },
    mounted(){
      this.user = window.authUser;
      if(this.user.email_verified_at !== undefined && this.user.email_verified_at !== null ) this.emailverified = true;      

    }
}
</script>


<style lang="scss" scoped>
@import url('https://fonts.googleapis.com/css?family=Poppins');

/* The alert message box */
.alert {
  font-family: Poppins ;
  padding: 15px;
  background-color: #eee9e8; /* Red */
  color: rgb(223, 37, 37);
  width:100%;  
  position:sticky;
  top:0;
}

/* The close button */
.closebtn {
  margin-left: 15px;
  color: rgb(66, 64, 64);
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
  display:table;
}
/* When moving the mouse over the close button */
.closebtn:hover {
  color: black;
}

/* media queries */

@media only screen and (max-width: 600px) {
 .alert{
   width:100%;


 }
}
</style>