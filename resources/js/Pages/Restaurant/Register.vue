<template>
<div class="p-1 " style="height:50vh">
  <form action="" @submit.prevent="submitForm" class="rounded shadow">
        <h2> Tell us about your business </h2>
    <label>
        <p class="label-txt">BUSINESS NAME*</p>
        <input type="text" class="input" v-model="form.restaurant_name">
        <div class="line-box">
           <small class="text-danger"> {{errors.restaurant_name}}</small>
        <div class="line"></div>
        </div>
    </label>
    <label>
        <p class="label-txt">RESTAURANT TYPE (optional) </p>
        <input type="text" class="input" v-model="form.type">
        <div class="line-box">
        <div class="line"></div>
        </div>
    </label>
    <label>
      
        <p class="label-txt">TIME ZONE* </p>
        <input type="text" class="input" >
        <select class="form-select" aria-label="Default select example" v-model="form.time_zone" >
        <option selected >Select time zone</option>
        <option v-bind="this.item" v-for="item in timeZones" :key="item">{{item}}</option>
        
      </select>
        <div class="line-box">
        <div class="line"></div>
        <small class="text-danger"> {{errors.time_zone}}</small>
        </div>
    </label>
    <label>
        <p class="label-txt">CITY* </p>
        <div style="overflow:hidden; margin:0;">
          <vueCountriesCities @country='selectedCountry = $event' @city='selectedCity = $event'  style="max-width:100%;"/>  
          </div>         
        
        <small class="text-danger"> {{errors.selectedCity}}</small>
        
    </label>

    <button type="submit" class="m-1" @click="submitForm">Submit</button>
    <button type="" class="m-1"><a href="">Cancel</a></button>
    </form>
    </div>
</template>


<script>
import vueCountriesCities from "vue-countries-cities";
export default {
  props:['user_id'],
  components: {
  vueCountriesCities,
},
  data(){
    return{
      form:{
        restaurant_name:'Menuthy Cafeteria',
        type:'Cafeteria',
        time_zone:'',
        city:'',
        user_id:'', 
        regestration_status:'trial',      
        tables:1,      
      },
       selectedCountry: '',
        selectedCity: '',
      errors:{},
      timeZones:[
                  'GMT	Greenwich Mean Time	GMT',
                  'UTC	Universal Coordinated Time	GMT',
                  'ECT	European Central Time	GMT+1:00',
                  'EET	Eastern European Time	GMT+2:00',
                  'ART	(Arabic) Egypt Standard Time	GMT+2:00',
                  'EAT	Eastern African Time	GMT+3:00',
                  'MET	Middle East Time	GMT+3:30',
                  'NET	Near East Time	GMT+4:00',
                  'PLT	Pakistan Lahore Time	GMT+5:00',
                  'IST	India Standard Time	GMT+5:30',
                  'BST	Bangladesh Standard Time	GMT+6:00',
                  'VST	Vietnam Standard Time	GMT+7:00',
                  'CTT	China Taiwan Time	GMT+8:00',
                  'JST	Japan Standard Time	GMT+9:00',
                  'ACT	Australia Central Time	GMT+9:30',
                  'AET	Australia Eastern Time	GMT+10:00',
                  'SST	Solomon Standard Time	GMT+11:00',
                  'NST	New Zealand Standard Time	GMT+12:00',
                  'MIT	Midway Islands Time	GMT-11:00',
                  'HST	Hawaii Standard Time	GMT-10:00',
                  'AST	Alaska Standard Time	GMT-9:00',
                  'PST	Pacific Standard Time	GMT-8:00',
                  'PNT	Phoenix Standard Time	GMT-7:00',
                  'MST	Mountain Standard Time	GMT-7:00',
                  'CST	Central Standard Time	GMT-6:00',
                  'EST	Eastern Standard Time	GMT-5:00',
                  'IET	Indiana Eastern Standard Time	GMT-5:00',
                  'PRT	Puerto Rico and US Virgin Islands Time	GMT-4:00',
                  'CNT	Canada Newfoundland Time	GMT-3:30',
                  'AGT	Argentina Standard Time	GMT-3:00',
                  'BET	Brazil Eastern Time	GMT-3:00',
                  'CAT	Central African Time	GMT-1:00',
                  ],     
    }
  },
    methods:{
        submitForm(){
            this.validateForm();
            if(this.errors.length > 0) return;
            console.log('no errors...');
            console.log(this.form);
            let form_data = new FormData();
                form_data.append('restaurant_name', this.form.restaurant_name);
                form_data.append('user_id', this.form.user_id);
                form_data.append('type', this.form.type);
                form_data.append('time_zone', this.form.time_zone);
                form_data.append('type', this.form.type);
                form_data.append('tables', this.form.tables);
                form_data.append('registration_status', this.form.registration_status);
                form_data.append('city', this.selectedCity);
                form_data.append('country', this.selectedCountry);
                for(var pair of form_data.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]); 
                    }
            axios.post('/api/restaurant', form_data)
            .then( response => {
            if( response.status = 201){
                console.log('responce: ',response);
                this.$inertia.visit('/redirect/user');
                } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },
      validateForm () {
          if(!this.form.restaurant_name) this.errors.restaurant_name = 'Restaurant name is required' ;
          else delete this.errors.restaurant_name;

          if(!this.form.user_id) this.errors.user_id = 'User id field is required' ;
          else  delete this.errors.user_id; 

          if(!this.selectedCity) this.errors.selectedCity = 'City field is required' ;
          else  delete this.errors.selectedCity;
          console.log(this.errors); 

          if(!this.time_zone) this.errors.time_zone = 'Timezone field is required' ;
          else  delete this.errors.time_zone;
          console.log(this.errors); 
        }, 
      },

      mounted(){
        this.form.user_id = this.user_id;
        console.log(this.form.user_id);
      }
  
}
</script>
<style>


h2{
  color:#f58b00a1;
}
form {
  width: 50%;
  margin: 60px auto;
  height:auto;
  background: #eed8b6;
  padding: 30px;
  text-align: center;
  -webkit-box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
  box-shadow: 2px 2px 3px rgba(0,0,0,0.1);
}
label {
  display: block;
  position: relative;
  margin: 40px 0px;
}
.label-txt {
  position: absolute;
  top: -1.6em;
  padding: 2px;
  font-family: sans-serif;
  font-size: .8em;
  letter-spacing: 1px;
  color: rgb(120,120,120);
  transition: ease .3s;
}
.input {
  width: 100%;
  padding: 10px;
  background: transparent;
  border: none;
  outline: none;
}

.line-box {
  position: relative;
  width: 100%;
  height: 2px;
  background: #BCBCBC;
}

.line {
  position: absolute;
  width: 0%;
  height: 2px;
  top: 0px;
  left: 50%;
  transform: translateX(-50%);
  background: #f87d0ad7;
  transition: ease .6s;
}

.input:focus + .line-box .line {
  width: 100%;
}

.label-active {
  top: -3em;
}

button {
  display: inline-block;
  padding: 12px 24px;
  background: #d45e0ed7;
  font-weight: bold;
  color: #fff;
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
  transition: ease .3s;
}
button a{
  text-decoration:none;
}

button:hover {
  background: #ff7300;
  color: #ffffff;
}


</style>

    




