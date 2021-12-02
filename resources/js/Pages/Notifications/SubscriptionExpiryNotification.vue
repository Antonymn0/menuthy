<template>
<div > 
  <div class="alert mx-auto bg-danger mb-0 ml-2 fade-in" v-if="this.registrationExpiryDate != null">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Your Subscription will expire on <span class="h6"> {{  formatDate(this.registrationExpiryDate)}}</span> Click this  <a href="#" class="btn btn-secondary">Button</a> to extend your subscription. 
  </div>
</div>
</template>


<script>
import moment from 'moment';

export default {
    data(){
        return{
            registrationExpiryDate:null,
        }
    },
    methods:{
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        updateDate(){
            let expDate = window.authUser.registration_expiry;
          this.registrationExpiryDate = window.authUser.registration_expiry;
                 
        },
    },
    mounted(){
        setTimeout(this.updateDate(), 10000);       
        
    }
}
</script>


<style lang="scss" scoped>
/* The alert message box */
.alert {
  padding: 15px;
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