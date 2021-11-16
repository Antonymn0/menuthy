<template>
    <div class="modal-body">
        <form action="api/menu" enctype="multipart/form-data" @submit.prevent="submitForm">
            <div class="form-group">
                <label for="exampleFormControlInput1">Menu name</label>
                <input type="text" v-model="form.menu_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Menu name here...">
                 <small class="text-danger"> {{ errors.menu_name}} </small>
            </div>
            <div class="form-group">
                <input type="hidden" v-model="form.restaurant_id"  class="form-control p-4" id="exampleFormControlInput1" name="restaurant_id" placeholder="restaurant id.">
            </div>
        
            <div class="form-group">
                <label for="maneu-name">Description</label>
                <textarea name="description" v-model="form.description" class="form-control p-3" id="" cols="10" rows="5">Describe the menu</textarea>
                 <small class="text-danger"> {{ errors.description}} </small>
            </div>
            <div class="modal-footer text-center mx-auto">
                <button type="submit" class="btn primary-btn "  @click="submitForm()" data-dismiss="modal">Save </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</template>

<script>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { defineComponent } from "vue";

export default defineComponent({
     props:['menus'],
    data: () => {
        return{
            form:{
                menu_name:'breakfast',
                restaurant_id:1,
                description:'breafast menu',
            },
            errors:{ },
            success:'',

        }
     },
    methods:{
        submitForm () {
            this.validateForm();
            if(this.errors.length > 0) return;
            console.log('no errors...');
            let form_data = new FormData();
                form_data.append('menu_name', this.form.menu_name);
                form_data.append('restaurant_id', this.form.restaurant_id);
                form_data.append('description', this.form.description);
            axios.post('/api/menu', form_data)
            .then( response => {
            if( response.status = 201){               
                this.$swal('Success, Menu created!');
                this.$inertia.visit('/menus');
                } 
            })
            .catch( error => {
                this.failed= true;
                this.failed_message = 'Failed! Operation not successful. Please try again!';
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.name) this.errors.name = 'This field is required' ;
            else delete this.errors.name;
            if(!this.form.description) this.errors.description = 'This field is required' ;
            else  delete this.errors.description; 
        }        
    },
   
});

</script>

<style lang="scss" scoped>
@import "../../../sass/app.scss";

    .primary-btn{
        background-color: #e6034b;
        color: #fff;
        }

    .btn:hover, .btn:active{
            background-color: #e6034b;
        color: #fff;
        }
</style>