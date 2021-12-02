<template>
<div class="text-center mb-0" >
  <div class="alert mx-auto bg-danger mb-0 fade-in" v-if="this.trialExpiryDate !== null">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    <span class="text-white">   Your Trial period will expire on <span class="h6"> {{  formatDate(this.trialExpiryDate)}}</span> Click this link to </span>
      <a href="#" class=" btn-secondary btn ml-2">Subscribe</a>
  </div>
</div>
</template>

<script>
import moment from 'moment';
export default {
    data(){
        return{
            trialExpiryDate:null,
        }
    },
    methods:{
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        updateDate(){
            this.trialExpiryDate = window.authUser.trial_expiry;
        },
    },
    mounted(){
      setTimeout(this.updateDate(),5000);

       

    }
}
</script>


<style lang="scss" scoped>
/* The alert message box */
.alert {
  padding: 20px;
  background-color: #eee9e8; /* Red */
  color: rgb(97, 91, 91);
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