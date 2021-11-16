<template>
    <div class="modal-body">
        <form action="api/menu" enctype="multipart/form-data" @submit.prevent="submitForm">
            <div class="form-group">
                <label for="exampleFormControlInput1">Menu name</label>
                <input type="text" v-model="form.menu_item_name" class="form-control p-4" id="exampleFormControlInput1" name="menu_name" placeholder="Item name here..." required>
                 <small class="text-danger"> {{errors.menu_item_name }} </small>
            </div>
            <div class="form-group">
                <input type="hidden" v-model="form.restaurant_id"  class="form-control p-4" id="exampleFormControlInput1" name="restaurant_id" placeholder="restaurant id." required>
            </div>
        
            <div class="form-group">
                <label for="maneu-name">Description</label>
                <textarea name="description" v-model="form.description" class="form-control p-3" id="" cols="10" rows="5">Describe the menu</textarea>
                 <small class="text-danger"> {{ errors.description}} </small>
            </div>
             
             <div class="form-group">.
                 <label for="exampleFormControlInputprice">Price</label>
                <input type="number" step=0.01 min="1" class="form-control p-4" id="exampleFormControlInputprice" name="price" placeholder="Price" required>
            </div>
            <div class="form-group">
                 <label for="exampleFormControlInputfile">Discount</label>
                <input type="number" step=0.01 min="1"  class="form-control p-4" id="exampleFormControlInputfile" name="discount" placeholder="discount">
            </div>
             <div class="form-group">.
                 <label for="exampleFormControlInputprice">Peparation time</label>
                <input type="number"   class="form-control p-4" v-bind="form.preparation_time" id="exampleFormControlInputprice" name="preparation_time" placeholder="Preparation time" required>
            </div>
             <div class="form-group">.
                 <label for="exampleFormControlInputprice">Allegy warning</label>
                 <select name="" id="" class="form-control p-4" multiple>
                     <option value="">-select-</option>
                     <option value="">Alcohol free</option>
                     <option value="">Cheese</option>
                     <option value="">Caffeine</option>
                     <option value="">Cheese</option>
                     <option value="">Chocolate</option>
                 </select>
            </div>
             <div class="col-sm-6 p-2">
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark item as new </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="p-2" name="is_new" v-bind="form.is_new">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div> 
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark item as signiture </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_signiture" v-bind="form.is_signiture">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div>
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'>  Mark item as special presentation </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_signiture" v-bind="form.is_signiture">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div>
                        <div class="row custom-control p-3  custom-switch  ">
                            <span clas='col-xs-8'> Publish </span>
                            <span class="col-xs-4">
                                <label class="switch ">
                                    <input type="checkbox" class="" name="is_signiture" v-bind="form.is_signiture">
                                    <span class="slider round"></span>
                                </label>
                            </span>                                    
                        </div>                       
                        <div class="form-group">
                            <input type="hidden" class="form-control p-4" v-bind="form.restaurant_id" name="resaturant_id" required>
                            <input type="hidden" class="form-control p-4" v-bind="form.sub_menu_id" name="resaturant_id" required>
                        </div>
                    </div>  
            <div class="modal-footer text-center mx-auto">
                <button type="submit" class="btn primary-btn "  @click="submitForm()" data-dismiss="modal">Save </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data(){
        return{
            form:{
                menu_item_name:'',
                restaurant_id:1,
                sub_menu_id:1,
                description:'', 
                file:'', 
                preparation_time:1.2, 
                allergy_warning:'', 
                is_new:1, 
                is_signiture:1, 
                is_special_presentation:1, 
                publish:1, 
                discount:0,
                price:0,
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
                form_data.append('description', this.form.description);                
                form_data.append('is_signiture', this.form.is_signiture);
                form_data.append('is_new', this.form.is_new);
                form_data.append('publish', this.form.publish);
            console.log('Price: ', this.form.price);
            axios.post('/api/menu-item', form_data)
            .then( response => {
            if( response.status = 201){
                this.$swal('Success, Sub new menu item added!');
                this.$inertia.visit('/menu-items');
                } 
            })
            .catch( error => {
               this.$swal('Failed, Menu not added!');
                console.log(error.response.data.errors);                    
            });
        },

        validateForm () {
            if(!this.form.menu_Item_name) this.errors.menu_item_name = 'Item name field is required' ;
            else delete this.errors.menu_item_name;

            if(!this.form.price) this.errors.price = 'Price field is required' ;
            else delete this.errors.price;

            if(!this.form.preparation_time) this.errors.preparation_time = 'preparation_time field is required' ;
            else delete this.errors.preparation_time;

            if(!this.form.restaurant_id) this.errors.restaurant_id = 'Restaurant id field is required' ;
            else  delete this.errors.restaurant_id; 

            if(!this.form.sub_menu_id) this.errors.sub_menu_id = 'Sub menu id field is required' ;
            else  delete this.errors.menu_id;
            console.log(this.errors); 
        }    
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