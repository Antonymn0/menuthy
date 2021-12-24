<template>
<div > 
  <div class=" mb-0 border-bottom" >
  <div class="alert mx-auto px-5  mb-0 fade-in" v-if="this.expired == true">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
   <span class="mr-2 pl-4">   Your Subscription will expire on <span class="h6"> {{  formatDate(this.registrationExpiryDate)}}.</span> Click here to:
     <a href="/subscription" class=" btn-danger ml-2 btn">extend your subscription</a>  . </span>
  </div>
</div>
</div>
</template>


<script>
import moment from 'moment';

export default {
    data(){
        return{
            expired:false,
            registrationExpiryDate:'',
        }
    },
    methods:{
        formatDate(date){
            if (date) {
                return moment(String(date)).format('ll ');
            }
        },
        updateDate(){
          this.registrationExpiryDate = window.authUser.registration_expiry;
                 
        },
        checkIfSubscriptionIsExpired(){
            var date = moment(this.registrationExpiryDate).format("YYYY-MM-DD HH:mm:ss");
            var today = moment(new Date()).format("YYYY-MM-DD HH:mm:ss");
            if( date - today < 25) this.expired = true;
        }
    },
    mounted(){
        setTimeout(this.updateDate(), 10000);       
        setTimeout(this.checkIfSubscriptionIsExpired(), 10000);       
        
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