<template>
<div > 
  <div class="alert mx-auto px-5  mb-0 fade-in" v-if="this.registrationExpiryDate != null">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
   <span class="mr-2 pl-4">   Your Subscription will expire on <span class="h6"> {{  formatDate(this.registrationExpiryDate)}}.</span> Click here to:  <a href="#" class=" btn-danger ml-2 btn">extend your subscription</a>  . </span>
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
          this.registrationExpiryDate = window.authUser.registration_expiry;
                 
        },
    },
    mounted(){
        setTimeout(this.updateDate(), 10000);       
        
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