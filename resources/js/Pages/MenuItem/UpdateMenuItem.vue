<template>

<!-- update Menu modal -->
<div class="modal fade text-left" :id="'updateModal'+  menuItem.id" tabindex="-1" role="dialog" :aria-labelledby="'updateModal'+  menuItem.id + 'Label'" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title " :id="'updateModal'+ menuItem.id + 'Label'">Update menu</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="api/menu" enctype="multipart/form-data" @submit.prevent="submitForm">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Item name</label>
                            <input type="text" @input="logInput" v-model="form.menu_item_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Item name here..." required>
                            <small class="text-danger"> {{this.errors.menu_item_name }} </small>
                        </div>                        
                    
                        <div class="form-group">
                            <label for="maneu-name">Description</label>
                            <textarea name="description" v-model="form.desciption" class="form-control p-3" id="" cols="10" rows="5">Describe the menu</textarea>
                            <small class="text-danger"> {{ this.errors.description}} </small>
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleFormControlInputprice">Price</label>
                            <input type="number" step=0.5 min="1" v-model="form.price" class="form-control p-4" id="exampleFormControlInputprice" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInputfile">Discount</label>
                            <input type="number" step=0.5 min="1" v-model="form.discount" class="form-control p-4" id="exampleFormControlInputfile" name="discount" placeholder="discount">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInputprice">Peparation time</label>
                            <input type="number"   class="form-control p-4" v-model="form.preparation_time" id="exampleFormControlInputprice" name="preparation_time" placeholder="Preparation time" required>
                        </div>
                        <div class="form-group">
                            <label for="maneu-name">Ingredients</label>
                            <textarea name="description" v-model="form.ingredients" class="form-control p-3" id="" cols="10" rows="5"></textarea>              
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInputprice">Carlories</label>
                            <input type="text"   class="form-control p-4" v-model="form.carlories" id="exampleFormControlInputprice"  placeholder="carlories" >
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInputprice">Image </label>
                            <input type="file"   class="form-control p-4"  id="exampleFormControlInputprice"  placeholder="Preparation time" @change="fileUpload">
                        </div>
                    <div>
<Multiselect
  v-model="value"
  mode="tags"
  :searchable="true"
  :createTag="true"
  :options="[
    { value: 'batman', label: 'Batman' },
    { value: 'robin', label: 'Robin' },
    { value: 'joker', label: 'Joker' },
  ]"
/>
  </div>
             <div class="form-group">.
                 <label for="exampleFormControlInputprice">Ingridient warning</label>
                 <select v-model="allergy_warning" class="form-control p-4" multiple>
                     <option value="alcohol">-select-</option>
                     <option value="alcohol">Alcohol free</option>
                     <option value="cheese">Cheese</option>
                     <option value="caffeine">Caffeine</option>
                     <option value="chocolate">Chocolate</option>
                 </select>
            </div>
            <div class="pt-3 pb-1 pl-5 border-bottom">
                Lables
            </div>
            <div class=" row p-2">
                <div class="col-md-6 ">
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as new </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="p-2" name="is_new" v-model="form.is_new" :checked="form.is_new">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div> 
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as hot </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="p-2" name="is_new" v-model="form.is_new" :checked="form.is_new">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div> 
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as signiture </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" name="is_signiture" v-model="form.is_signiture" checked="form.is_signiture">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                </div>
                <div class="col-md-6">  
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as veg </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class=""  v-model="form.is_veg" :checked="form.is_veg">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                                     
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'>  Mark item as special presentation </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" v-model="form.is_signiture" :checked="form.is_special_presentation">
                                <span class="slider round"></span>
                            </label>
                        </span>                                    
                    </div>
                    <div class="row custom-control p-3  custom-switch  ">
                        <span clas='col-xs-8'> Publish </span>
                        <span class="col-xs-4">
                            <label class="switch ">
                                <input type="checkbox" class="" :checked="form.publish" v-model="form.publish">
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
            <div class="modal-footer text-center mx-auto">
                <button type="submit" class="btn primary-btn "  @click="submitForm()" >Save </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    props:['menuItem'],
components: { Multiselect },
    data: () => {
        return{   
     
            form:{
                menu_item_name: '',
                restaurant_id:'',
                sub_menu_id: '',
                description: '', 
                carlories: '', 
                preparation_time: '', 
                allergy_warning: '', 
                is_new: '', 
                is_veg:'', 
                is_hot: '', 
                is_signiture:'', 
                is_special_presentation: '', 
                publish:'', 
                discount: '',
                price: '',
                image: '',
                allergy_warning:'',               
            },
           
            errors:{},
        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(this.errors.length > 0) return;
            console.log('No errors in the form...');
            let form_data = new FormData();
                form_data.append('menu_item_name', this.form.menu_item_name);
                form_data.append('restaurant_id', this.form.restaurant_id);
                form_data.append('sub_menu_id', this.form.sub_menu_id);
                form_data.append('price', this.form.price);                
                form_data.append('discount', this.form.discount);                
                form_data.append('description', this.form.description);                
                form_data.append('preparation_time', this.form.preparation_time);      
                form_data.append('is_signiture', this.form.is_signiture);
                form_data.append('is_new', this.form.is_new);
                form_data.append('publish', this.form.publish);
                form_data.append('allergy_warning', this.form.allergy_warning);
                form_data.append('_method', 'PUT');
                if(this.form.image) form_data.append('image', this.form.image);
            axios.post('/api/menu-item/'+ this.menuItem.id , form_data)
            .then( response => {
            if( response.status = 201){
                this.$swal('Success, Item updated!');
                this.$inertia.reload();
                } 
            })
            .catch( error => {
               this.$swal('Failed, Item not added!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(this.form.menu_item_name == ''){
                this.errors.menu_item_name = 'This field is required' ;
                return;
            }
            if(!this.form.price) this.errors.price = 'Price field is required' ;
            else delete this.errors.price;

            if(!this.form.preparation_time) this.errors.preparation_time = 'preparation_time field is required' ;
            else delete this.errors.preparation_time;

            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 

            if(!this.form.sub_menu_id) this.errors.sub_menu_id = 'Sub menu id field is required' ;
            else  delete this.errors.menu_id;
            this.form = { ...this.form, na:'track'};
            console.log(this.errors); 
        },
        fileUpload(event){
            this.form.image = event.target.files[0];
        },
        logInput(){
            console.log(this.form.menu_item_name);
        } ,    
    },
    mounted(){                   
        this.form.menu_item_name =  this.menuItem.menu_item_name;
        this.form.restaurant_id = 1;
        this.form.sub_menu_id =  this.menuItem.sub_menu_id;
        this.form.description =  this.menuItem.description; 
        this.form.carlories =  this.menuItem.calories; 
        this.form.preparation_time =  this.menuItem.preparation_time; 
        this.form.allergy_warning =  this.menuItem.alergy_warning; 
        this.form.is_new =  this.menuItem.is_new; 
        this.form.is_veg = this.menuItem.is_veg; 
        this.form.is_hot =  this.menuItem.is_hot; 
        this.form.is_signiture = this.menuItem.is_signiture; 
        this.form.is_special_presentation =  this.menuItem.is_special_presentation; 
        this.form.publish =  this.menuItem.publish; 
        this.form.discount =  this.menuItem.discount;
        this.form.price =  this.menuItem.price;
        this.form.image =  this.menuItem.image;
        this.form.allergy_warning = {...this.menuItem.alergy_warning };  
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
</style>