<template>
  <!-- add new Menu modal -->
        <div class="modal fade" :id="'updateModal'+  menu.id" tabindex="-1" role="dialog" :aria-labelledby="'updateModal'+  menu.id + 'Label'" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" :id="'updateModal'+ menu.id + 'Label'">Update menu</h3>
                    <button type="button" class="close" :id="menu.id" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <div class="modal-body text-left p-5">
                <form action="#" enctype="multipart/form-data" @submit.prevent="submitForm">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Menu name</label>
                        <input type="text" maxlength="30" v-model="form.menu_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Menu name here...">
                        <small class="text-danger"> {{ errors.menu_name}} </small>
                    </div>
                    <div class="form-group">
                        <input type="hidden" v-model="form.name"  class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Menu name here...">
                    </div>
                
                    <div class="form-group">
                        <label for="maneu-name">Description</label>
                        <textarea name="description" maxlength="60" v-model="form.description" class="form-control p-3" id="" cols="10" rows="5">Describe the menu</textarea>
                        
                    </div>
                      <div class="mx-auto p-2">
                        <label for="exampleFormControlInputimage">Image*  <small class="text-muted"> (Max size 2mb)</small></label>
                        <div class="image-preview mx-auto p-0 m-0 text-center">
                            <img :src="form.img_preview" alt="" >  <br>
                            <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="exampleFormControlInputimage"  placeholder="Preparation time"  @change="fileUpload">
                        </div>    
                        <small class="text-danger"> {{this.errors.image }} </small>              
                    </div>
                    <div class="text-center mx-auto">
                        <button type="submit" class="btn primary-btn mr-2" >Save </button>
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
     props:['menu'],
    data: () => {
        return{
            form:{
                menu_name: '',
                menu_id: '',
                restaurant_id: '',
                description: '',
                image:'',
                img_preview:''
            },
            errors:{             
            },
        }
     },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            let form_data = new FormData();
                form_data.append('menu_name', this.form.menu_name);
                form_data.append('restaurant_id', this.form.restaurant_id);
                form_data.append('description', this.form.description);
                form_data.append('_method', 'PUT');
                if(this.form.image) form_data.append('image', this.form.image);

              Swal.showLoading();
            axios.post('/api/menu/' + this.form.menu_id, form_data)
            .then( response => {
            if( response.status = 200){
                    document.getElementById(this.menu.id).click(); 
                    new Swal({   title:'Success', timer:1200 });
                    this.$inertia.reload();            
                    
                } 
            })
            .catch( error => {
                this.failed= true;
                this.failed_message = 'Failed! Operation not successful. Please try again!';
                console.log(error.response.data.errors);                    
            });
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
        validateForm () {
            if(!this.form.menu_name) this.errors.menu_name = 'This field is required' ;
            else delete this.errors.menu_name;
             
        }        
    },
    mounted () {
        this.form.restaurant_id =  window.authRestaurant.id;
        this.form.menu_name = this.menu.menu_name;
        this.form.menu_id= this.menu.id;
        this.form.description = this.menu.description;
        this.form.img_preview = this.menu.image;
    }
   
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