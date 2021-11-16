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
                        <input type="text" class="form-control p-4" name="sub_menu_name" v-bind="form.sub_menu_name" id="exampleFormControlInput1"  placeholder="menu name here..." required>
                    </div>
                
                    <div class="form-group">
                        <label for="maneu-name">Description</label>
                        <textarea name="description"  class="form-control p-3" v-bind="form.description" id="" cols="10" rows="5">Describe the menu section</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput2">Photo</label>
                        <input type="file" class="form-control p-4" id="exampleFormControlInput2" placeholder="VAT Included">
                    </div> 
                     <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Publish </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" name="publish" v-bind="form.publish">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                    <div class="col-sm-6 p-2">
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark section as new </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_new" v-bind="form.is_new">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div> 
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark section as signiture </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_signiture" v-bind="form.is_signiture">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div>
                       
                         <div class="form-group">
                            <input type="hidden" class="form-control p-4" v-bind="form.restaurant_id" name="resaturant_id" required>
                            <input type="hidden" class="form-control p-4" v-bind="form.menu_id" name="resaturant_id" required>
                        </div>
                    </div>                         
                    <div class="modal-footer w-50  mx-auto">
                        <input type="submit" class="btn primary-btn " value="Save" @click="submitForm()" data-dismiss="modal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form> 
            </div>    
        </div>
    </div>
</div> 
</template>

<script>
export default {
    data(){
        return{
            form:{
                sub_menu_name:'',
                restaurant_id:1,
                menu_id:1,
                description:'',
                is_new:1,
                is_signiture: 1,
                publish: 1,
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
            let form_data = new FormData();
                form_data.append('sub_menu_name', this.form.sub_menu_name);
                form_data.append('restaurant_id', this.form.restaurant_id);
                form_data.append('menu_id', this.form.menu_id);
                // form_data.append('description', this.form.description);
                // form_data.append('is_signiture', this.form.is_signiture);
                // form_data.append('is_new', this.form.is_new);
                // form_data.append('publish', this.form.publish);
            console.log(form_data);
            axios.post('/api/sub-menu', form_data)
            .then( response => {
            if( response.status = 201){
                this.$swal('Success, Sub menu added!');
                this.$inertia.visit('/sub-menu');
                } 
            })
            .catch( error => {
               this.$swal('Failed, Sub menu not added!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.sub_menu_name) this.errors.sub_menu_name = 'Submenu field is required' ;
            else delete this.errors.sub_menu_name;
            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 
            if(!this.form.menu_id) this.errors.menu_id = 'menu id field is required' ;
            else  delete this.errors.menu_id;
            console.log(this.errors); 
        },      
    },
}
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