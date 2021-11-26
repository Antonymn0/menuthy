<template>
<div class="alert mx-auto ml-2 fade-in" v-if="this.trialExpiryDate !== null">
  <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Your Trial period will expire on <span class="h6"> {{  formatDate(this.trialExpiryDate)}}</span> Click this link to 
     <a href="#">Subscribe</a>
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
  margin-bottom: 15px;
  z-index: 5;
  position: absolute;
  top:1rem;
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