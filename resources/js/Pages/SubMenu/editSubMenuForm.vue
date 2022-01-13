<template>   
 <!-- add sub Menu modal -->
      <div class="modal fade text-left" :id="'updateModal'+  subMenu.id" tabindex="-1" role="dialog" :aria-labelledby="'updateModal'+  subMenu.id + 'Label'" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" :id="'updateModal'+ subMenu.id + 'Label'">Update section</h3>
            <button type="button" class="close" :id="subMenu.id" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>           
            <div class="modal-body p-5">
                <form action="" enctype="multipart/form-data" @submit.prevent="submitForm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Section name <small class="text-muted">Max: 30 characters</small></label>
                        <input type="text" maxlength="20" class="form-control p-4" name="sub_menu_name" v-model="form.sub_menu_name" id="exampleFormControlInput1"  placeholder="menu name here..." required>
                    </div>
                
                    <div class="form-group">
                        <label for="maneu-name">Description <small class="text-muted">Max: 50 characters</small></label>
                        <textarea maxlength="40"  class="form-control p-3" v-model="form.description" id="" cols="10" rows="5"></textarea>
                         <small class="text-danger"> {{ this.errors.description}} </small>
                    </div>
                    <div class="mx-auto p-2">
                        <label for="exampleFormControlInputimage">Image*  <small class="text-muted"> (Max size 2mb)</small></label>
                        <div class="image-preview mx-auto p-0 m-0 text-center">
                            <img :src="form.img_preview" alt="" >  <br>
                            <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="exampleFormControlInputimage"  placeholder="Preparation time"  @change="fileUpload">
                        </div>    
                        <small class="text-danger"> {{this.errors.image }} </small>              
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
                        <div class="form-group">
                            <input type="hidden" class="form-control p-4" v-model="form.restaurant_id" name="resaturant_id" required>
                            <input type="hidden" class="form-control p-4" v-model="form.menu_id" name="resaturant_id" required>
                        </div>
                    </div>                         
                    <div class="text-center mx-auto">
                        <input type="submit" class="btn primary-btn mr-2" value="Save"  >
                        <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
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
    props:['menu_id', 'restaurant_id', 'subMenu'],
    data(){
        return{
            form:{
                sub_menu_name:this.subMenu.sub_menu_name,
                restaurant_id: this.restaurant_id,
                menu_id: this.menu_id,
                description: this.subMenu.description,
                is_new: this.subMenu.is_new,
                is_signiture: this.subMenu.is_signiture,
                publish: this.subMenu.publish,
                image:'',
                img_preview:this.subMenu.image,
            },
            errors:{},
            success:'',

        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            let form_data = new FormData();
                form_data.append('sub_menu_name', this.form.sub_menu_name);
                form_data.append('restaurant_id', this.restaurant_id);
                form_data.append('menu_id', this.menu_id);
                form_data.append('description', this.form.description);
                form_data.append('is_signiture', this.form.is_signiture);
                form_data.append('is_new', this.form.is_new);
                form_data.append('publish', this.form.publish);
                form_data.append('_method', 'PUT');
                if(this.form.image) form_data.append('image', this.form.image);
               Swal.showLoading();
            axios.post('/api/sub-menu/' + this.subMenu.id, form_data)
            .then( response => {
            if( response.status = 201){
                    document.getElementById(this.subMenu.id).click(); 
                    new Swal({   title:'Success', timer:1500 });
                    this.$inertia.reload(); 
                } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.sub_menu_name) this.errors.sub_menu_name = 'This field is required' ;
            else delete this.errors.sub_menu_name;

            if(!this.form.description ) this.errors.description = 'This field is required' ;
            else delete this.errors.description;

            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 

            if(!this.form.menu_id) this.errors.menu_id = 'menu id field is required' ;
            else  delete this.errors.menu_id;
            console.log(this.errors); 
        }, 

         fileUpload(event){
            this.form.image = event.target.files[0]; 
           if(this.form.image.size > 2048 * 1024){
              this.errors.image = "Image too big. Select an image less than 2mb."; 
              return;
           } 
           if(this.form.image['type'] === 'image/jpeg' || this.form.image['type'] === 'image/jpg' || this.form.image['type'] === 'image/png' || this.form.image['type'] === 'image/gif'){
              this.form.img_preview = URL.createObjectURL(event.currentTarget.files[0]); 
              delete this.errors.image
              return;
           } 
           else {
               this.errors.image = " Allowed types jpg/png/jpeg/gif";
               this.form.img_preview = '';
           }
        }, 
       
        mounted(){
            this.form.menu_id = this.menu_id;
            this.form.restaurant_id = this.restaurant_id;
        
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
    .image-preview{
        border-radius: 15px;
        border: 1px dashed gainsboro;
        min-height:8rem;
        padding-top:1rem;
    }
    .image-preview img{
        margin-top: 5px;
        min-height:7rem; 
        max-height: 10rem;
        min-width:7rem;
        max-width:10rem;
        border-radius:15px;
    }
 </style>