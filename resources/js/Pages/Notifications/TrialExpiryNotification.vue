<template>
<div class=" mb-0 border-bottom" >
  <div class="alert mx-auto px-5  mb-0 fade-in" v-if="this.trialExpired == false">
    <span class="closebtn " onclick="this.parentElement.style.display='none';">&times;</span>
    <span class="mr-2 ">   Your Trial period will expire on: <span class="h6"> {{  formatDate(this.trialExpiryDate)}}</span> Click this button to: </span>
      <a href="/subscription" class=" btn-danger  btn">Subscribe</a>
  </div>
  <div class="alert mx-auto px-5  mb-0 fade-in" v-if="this.trialExpired == true">
    <span class="closebtn " onclick="this.parentElement.style.display='none';">&times;</span>
    <span class="mr-2 ">   Your Trial period period EXPIRED on: <span class="h6"> {{  formatDate(this.trialExpiryDate)}}</span> Please click this button to: </span>
      <a href="/subscription" class=" btn-danger  btn"> Buy a Subscription</a>
  </div>
</div>
</template>

<script>
import moment from 'moment';

export default {
    data(){
        return{
            trialExpiryDate:null,
            trialExpired:null,
        }
    },
    methods:{
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        updateDate(){
            this.trialExpiryDate = window.authUser.trial_expiry ;
        },
        checkIfTrialIsExpired(){
          if(this.trialExpiryDate == null) return;
            var expiry_date = moment(this.trialExpiryDate).format("YYYY-MM-DD");
            var today = moment(new Date()).format("YYYY-MM-DD");
            if( moment(today).isBefore(expiry_date) && window.authUser.registration_status == 'trial') this.trialExpired = false;
            if(moment(today).isAfter(expiry_date) &&  window.authUser.registration_status == 'trial') this.trialExpired = true;
        }
    },
    mounted(){
      setTimeout(this.updateDate(),5000);
      setTimeout(this.checkIfTrialIsExpired(),5000);      

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