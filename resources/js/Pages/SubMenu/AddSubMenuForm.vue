<template>   
 <!-- add sub Menu modal -->
<div class="modal fade  " id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title text-center" id="exampleModalLabel">Add a section (sub menu)</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>           
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" @submit.prevent="submitForm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Section name</label>
                        <input type="text" class="form-control p-4" name="sub_menu_name" v-model="form.sub_menu_name" id="exampleFormControlInput1"  placeholder="menu name here..." required>
                    </div>
                
                    <div class="form-group">
                        <label for="maneu-name">Description</label>
                        <textarea   class="form-control p-3" v-model="form.description" id="" cols="10" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Photo</label>
                        <input type="file" class="form-control p-4" id="exampleFormControlInput2" placeholder="VAT Included" @change="fileUpload">
                    </div> 
                     <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Publish </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class=""  v-model="form.publish" @click="logPub">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                    <div class="col-sm-6 p-2">
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark section as new </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class=""  v-model="form.is_new">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div> 
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark section as signiture </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_signiture" v-model="form.is_signiture">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div>
                       
                         <div class="form-group">
                            <input type="hidden" class="form-control p-4" v-model="form.restaurant_id" name="resaturant_id" required>
                            <input type="hidden" class="form-control p-4" v-model="form.menu_id" name="resaturant_id" required>
                        </div>
                    </div>                         
                    <div class="text-center mx-auto ">
                        <input type="submit" class="btn primary-btn mr-2" value="Save" @click="submitForm()" data-dismiss="modal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form> 
            </div>    
        </div>
    </div>
</div> 
</template>

<script>
import { reactive } from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { defineComponent } from "vue";

export default defineComponent({
    props:['menu_id', 'restaurant_id'],
    data(){
        return{
            form:{
                sub_menu_name:'menu 1',
                restaurant_id: 0,
                menu_id:0,
                description:'',
                is_new:true,
                is_signiture: true,
                publish: false,
                image:'',
            },
            errors:{},
            success:'',

        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(this.errors.length > 0) return;
            console.log('no errors...');
            console.log(this.form);
            let form_data = new FormData();
                form_data.append('sub_menu_name', this.form.sub_menu_name);
                form_data.append('restaurant_id', this.restaurant_id);
                form_data.append('menu_id', this.menu_id);
                form_data.append('description', this.form.description);
                form_data.append('is_signiture', this.form.is_signiture);
                form_data.append('is_new', this.form.is_new);
                form_data.append('publish', this.form.publish);
                if(this.form.image) form_data.append('image', this.form.image);
                for(var pair of form_data.entries()) {
                    console.log(pair[0]+ ', '+ pair[1]); 
                    }
            axios.post('/api/sub-menu', form_data)
            .then( response => {
            if( response.status = 201){
                console.log('responce: ',response);
                this.$swal('Success, Sub menu added!');
                this.$inertia.reload();
                } 
            })
            .catch( error => {
               this.$swal('Failed, Sub menu not added!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.sub_menu_name) this.errors.sub_menu_name = 'This field is required' ;
            else delete this.errors.sub_menu_name;

            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 

            if(!this.form.menu_id) this.errors.menu_id = 'menu id field is required' ;
            else  delete this.errors.menu_id;
            console.log(this.errors); 
        }, 

        fileUpload(event){
            this.form.image = event.target.files[0];
        } , 
        logPub(){
            console.log(this.form.publish);
        },
        mounted(){
            this.form.menu_id = this.menu_id;
            this.form.restaurant_id = this.restaurant_id;
            console.log(this.form.menu_id);
            console.log(this.form.restaurant_id);
        
           } 
    },
    

});
</script>    

<style lang="scss" scoped>
@import "../../../sass/app.scss";
    .primary-btn{
    background-color: $primary-button;
    color: #fff;
    }
    .btn:hover, .btn:active{
        background-color: $primary-button;
        color: #fff;
    }
 </style>