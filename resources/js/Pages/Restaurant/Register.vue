<template>
  <form action="" @submit.prevent="submitForm">
    <label>
        <p class="label-txt">BUSINESS NAME*</p>
        <input type="text" class="input" v-model="form.restaurant_name">
        <div class="line-box">
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
        <input type="text" class="input" v-model="form.time_zone">
        <div class="line-box">
        <div class="line"></div>
        </div>
    </label>
    <label>
        <p class="label-txt">CITY* </p>
        <input type="text" class="input" v-model="form.city">
        <div class="line-box">
        <div class="line"></div>
        </div>
    </label>

    <button type="submit" class="m-1" @click="submitForm">submit</button>
    <button type="submit" class="m-1"><a href="">Cancel</a></button>
    </form>
</template>


<script>
export default {
  props:['user_id'],
  data(){
    return{
      form:{
        restaurant_name:'',
        type:'cafeteria',
        time_zone:'',
        city:'',
        user_id:5,       
      }, 
      errors:{},
      
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
                form_data.append('type', this.form.type);
                form_data.append('city', this.form.city);
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
               this.$swal('Failed, errors in the form!');
                console.log(error.response.data.errors);                    
            });
        },
      validateForm () {
          if(!this.form.restaurant_name) this.errors.restaurant_name = 'Restaurant name is required' ;
          else delete this.errors.restaurant_name;

          if(!this.form.user_id) this.errors.user_id = 'User id field is required' ;
          else  delete this.errors.user_id; 

          if(!this.form.city) this.errors.city = 'City field is required' ;
          else  delete this.errors.city;
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

body {
  background: #C5E1A5;
}
form {
  width: 60%;
  margin: 60px auto;
  background: #efefef;
  padding: 60px 120px 80px 120px;
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
  padding: 10px;
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
  background: #8BC34A;
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
  background: rgb(220,220,220);
  font-weight: bold;
  color: rgb(120,120,120);
  border: none;
  outline: none;
  border-radius: 3px;
  cursor: pointer;
  transition: ease .3s;
}

button:hover {
  background: #8BC34A;
  color: #ffffff;
}
</style>

    




