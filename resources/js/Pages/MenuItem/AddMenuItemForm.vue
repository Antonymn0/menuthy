<template>
  <!-- add new Menu modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="exampleModalLabel">Add new Item</h3>
                    <button type="button" class="close" id="closeAddMenu" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    <div class="modal-body p-5">
        <form action="api/menu" enctype="multipart/form-data" ref="form" @submit.prevent="submitForm">
            <div class="form-group">
                <label for="exampleFormControlInput1">Item name* <small class="text-muted">Max: 30 characters</small></label>
                <input type="text" maxlength="30" v-model="form.menu_item_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Item name here..." required>
                 <small class="text-danger"> {{this.errors.menu_item_name }} </small>
            </div>
            <div class="form-group">
                <input type="hidden" v-model="form.restaurant_id"  class="form-control p-4" id="exampleFormControlInput1" name="restaurant_id" placeholder="restaurant id." required>
            </div>
        
            <div class="form-group">
                <label for="maneu-name">Description* <small class="text-muted">Max: 50 characters</small></label>
                <textarea name="description" v-model="form.description" class="form-control p-3" id="" maxlength="50" cols="10" rows="5" placeholder="Describe the menu" required></textarea>
                 <small class="text-danger"> {{ this.errors.description}} </small>
            </div>
             <div class="row"> 
                <div class="form-group col-md-6 ">
                    <label for="exampleFormControlInputprice">Price</label>
                    <input type="number" step=0.5 min="1" v-model="form.price" class="form-control p-4" id="exampleFormControlInputprice" name="price" placeholder="Price" required>
                </div>
                <div class="form-group col-md-6 ">
                    <label for="exampleFormControlInputprice">Peparation time</label>
                    <input type="number"   class="form-control p-4" v-model="form.preparation_time" id="exampleFormControlInputprice" name="preparation_time" placeholder="Preparation time" required>
                </div>
            </div>
            <div class="form-group">
                <label for="maneu-name">Ingredients <small class="text-muted">(Use comma-seperated text)</small></label>
                <textarea name="description" v-model="form.ingredients" class="form-control p-3" id="" cols="5" rows="3" placeholder="Ingredients"></textarea>              
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="exampleFormControlInputprice">Carlories</label>
                    <input type="number" min='1'  class="form-control p-4" v-model="form.carlories" id="exampleFormControlInputprice"  placeholder="Carlories" >
                </div>
                <div class="form-group col-md-6">
                    <label for="exampleFormControlInputprice">Food Origin</label>
                    <input type="text"   class="form-control p-4" v-model="form.food_origin" id="exampleFormControlInputprice"  placeholder="Origin" >
                </div>
            </div>
             <div class="form-group">
                <label for="exampleFormControlInputprice">Allergy warning</label>
                <select v-model="this.form.allergy_warning" class="rounded p-3 w-100 " 
                    style="color: #495057;
                        background-color: #fff;
                        background-clip: padding-box;
                        border: 1px solid #ced4da;">
                    <option  selected value="" >- Select -</option>
                    <option value="Alcohol">Alcohol </option>
                    <option value="Cheese">Cheese</option>
                    <option value="Caffeine">Caffeine</option>
                    <option value="Chocolate">Chocolate</option>
                </select>                 
            </div>
            <div class="mx-auto p-2">
                <label for="exampleFormControlInputimage">Image*  <small class="text-muted"> (Max size 2mb)</small></label>
                <div class="image-preview mx-auto p-0 m-0 text-center">
                    <img :src="form.img_preview" alt="" >  <br>
                    <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2 w-50"  id="exampleFormControlInputimage"  placeholder="Preparation time"  @change="fileUpload" required>
                </div>    
                <small class="text-danger"> {{this.errors.image }} </small>              
           </div>      
           
            <h5 class="pt-3 pb-1 pl-5 border-bottom">
                Lables
            </h5>
            <div class=" row p-2">
                <div class="col-md-6 ">
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'> Publish </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" :checked="form.publish" v-model="form.publish">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                    <div class="row custom-control p-3  custom-switch  ">
                    <span clas='col-xs-8'>  Mark item as New </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="p-2" name="is_new" v-model="form.is_new" :checked="form.is_new">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div> 
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as Hot </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="p-2" name="is_new" v-model="form.is_hot" :checked="form.is_hot">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div> 
                   
                </div>
                <div class="col-md-6">  
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as Veg </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class=""  v-model="form.is_veg" :checked="form.is_veg">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                                     
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as Halal </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" v-model="form.is_halal" :checked="form.is_halal">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                      <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as Signature </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" name="is_signiture" v-model="form.is_signiture" checked="form.is_signiture">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>                  
                    <div class="form-group">
                        <input type="hidden" class="form-control p-4" v-model="form.restaurant_id" name="resaturant_id" required>
                        <input type="hidden" class="form-control p-4" v-model="form.sub_menu_id" name="resaturant_id" required>
                    </div>
                </div>
            </div>  
            <div class="text-center mx-auto ">
                <button type="submit" class="btn primary-btn mr-2 " >Save </button>
                <button type="button" class="btn btn-default"  data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
    
      </div>
    </div>
</div>
</template>

<script>
  import Multiselect from '@vueform/multiselect'
export default { 
components: { Multiselect },
props:['sub_menu'],
    data: () => {
        return{   
            form:{
                menu_item_name:'',
                restaurant_id: '',
                sub_menu_id: '',
                description:'', 
                ingredients:'', 
                carlories:1, 
                preparation_time:1, 
                allergy_warning:'', 
                is_new:false, 
                is_veg:false, 
                is_hot:false,  
                is_halal:false, 
                publish:true, 
                is_signiture:false, 
                discount:1,
                price:1,
                image:'',
                food_origin:'',
                img_preview:'',              
            },           
            errors:{ },
        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            let form_data = new FormData();
                form_data.append('menu_item_name', this.form.menu_item_name);
                form_data.append('restaurant_id', this.form.restaurant_id);
                form_data.append('sub_menu_id', this.form.sub_menu_id);
                form_data.append('price', this.form.price);                
                form_data.append('discount', this.form.discount);                
                form_data.append('description', this.form.description);                
                form_data.append('ingredients', this.form.ingredients);                
                form_data.append('preparation_time', this.form.preparation_time);      
                form_data.append('is_signiture', this.form.is_signiture);
                form_data.append('is_new', this.form.is_new);
                form_data.append('is_hot', this.form.is_hot);
                form_data.append('is_halal', this.form.is_halal);
                form_data.append('is_veg', this.form.is_veg);
                form_data.append('publish', this.form.publish);
                form_data.append('food_origin', this.form.food_origin);
                form_data.append('carlories', this.form.carlories);
                form_data.append('allergy_warning', this.form.allergy_warning);
                if(this.form.image) form_data.append('image', this.form.image);

            Swal.showLoading();
            axios.post('/api/menu-item', form_data)
            .then( response => {
                if( response.status == 201){
                    document.getElementById('closeAddMenu').click(); 
                    new Swal({   title:'Success', timer:1200 });
                    this.$inertia.reload(); 
                    this.$refs.form.reset();
                } 
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(this.form.menu_item_name == '')this.errors.menu_item_name = 'This field is required' ;
            else delete this.errors.menu_item_name

            if(!this.form.description ) this.errors.description = 'This field is required' ;
            else delete this.errors.description;
                
            if(!this.form.price) this.errors.price = 'Price field is required' ;
            else delete this.errors.price;

            if(!this.form.preparation_time) this.errors.preparation_time = 'preparation_time field is required' ;
            else delete this.errors.preparation_time;

            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 

            if(!this.form.sub_menu_id) this.errors.sub_menu_id = 'Sub menu id field is required' ;
            else  delete this.errors.menu_id;

            if(this.form.image == '')  this.errors.image = 'Image is required' ;        
            else  delete this.errors.image;

        },
        fileUpload(event){
            this.form.image = event.target.files[0]; 
            if(this.form.image == '') this.errors.image = "Image is required"; 
            if(this.form.image.size > 2048 * 1024){
              this.errors.image = "Image too big. Select an image less than 2mb."; 
              this.form.image = '';
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
               this.form.image = '';
           }
        },
            
    },
    mounted(){
        this.form.sub_menu_id = this.sub_menu.id;
        this.form.restaurant_id = this.sub_menu.restaurant_id;
    }

}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>
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