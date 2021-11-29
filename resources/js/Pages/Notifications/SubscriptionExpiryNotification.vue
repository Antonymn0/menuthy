<template>
<div style="position:relative"> 
  <div class="alert mx-auto ml-2 fade-in" v-if="this.registrationExpiryDate != null">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
      Your Subscription will expire on <span class="h6"> {{  formatDate(this.registrationExpiryDate)}}</span> Click this  <a href="#">Link</a> to extend your subscription  
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
  position: absolute;
  padding: 20px;
  background-color: #eee9e8; /* Red */
  color: rgb(97, 91, 91);
  margin-bottom: 15px;
  z-index: 5;
  top:-5rem;
  right:0;
  width:80%;
  
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

</style>