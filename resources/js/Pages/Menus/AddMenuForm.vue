<template>
  <!-- add new Menu modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-center" id="exampleModalLabel">Add new menu</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
    <div class="modal-body">
        <form action="/upload"  enctype="multipart/form-data" @submit.prevent = "submitForm()">
            <div class="form-group">
                <label for="exampleFormControlInput1">Menu name</label>
                <input type="text" v-model="form.menu_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Menu name here...">
                 <small class="text-danger"> {{ errors.menu_name}} </small>
            </div>
            <div class="form-group">
                <input type="hidden" v-model="form.restaurant_id"  class="form-control p-4" id="exampleFormControlInput1" name="restaurant_id" placeholder="restaurant id.">
            </div>
        <input type="hidden" name="_token" :value="csrf"> 
            <div class="form-group">
                <label for="maneu-name">Description</label>
                <textarea name="description" v-model="form.description" class="form-control p-3" id="" cols="10" rows="5"></textarea>
                 <small class="text-danger"> {{ errors.description}} </small>
            </div>
             <div class="form-group">
                 <label for="file1">Image <small>(Optional)</small></label>
                <input type="file"   class="form-control p-4" id="file1" name="image" placeholder="Image upload" @change="fileUpload">
            </div>
            <div class=" text-center mx-auto">
                <button type="submit" class="btn primary-btn mr-2"   >Save </button>
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
     props:['menus', 'restaurant_id'],
    data: () => {
        return{
            form:{
                menu_name:'',
                restaurant_id: 0,
                description:'',
                image:'',
            },
            errors:{ },
            swal_timer:5000,
            success:'',
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
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
                if(this.form.image) form_data.append('image', this.form.image);
            axios.post('/api/menu', form_data)
            .then( response => {
                if( response.status = 201){               
                    this.$swal('Success, Menu created!');
                    this.$inertia.reload();
                    this.modalShow = false;
                    } 
                })
            .catch( error => {
                this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.menu_name) this.errors.menu_name = 'This field is required' ;
            else delete this.errors.menu_name;
            
        },  
        fileUpload(event){
            this.form.image = event.target.files[0];
        }      
    },
    mounted(){       
        this.form.restaurant_id = this.restaurant_id;
        console.log(this.menus);
        console.log(this.restaurant_id);
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