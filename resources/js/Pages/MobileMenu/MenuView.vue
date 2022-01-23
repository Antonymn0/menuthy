<template>

  

<div class="parent-div mx-auto shadow px-1 ">
    <div :class="this.blur +' p-0' "> 
    <div class="header-div">
        <span class="arrow-left p-0 m-0 shadow rounded" data-bs-toggle="modal" data-bs-target="#exampleModal">       
            <i class="bi bi-justify-left"></i>
        </span>
        <img :src=" this.restaurant.image"  v-if="this.restaurant.image"  alt="restaurant-logo" data-bs-toggle="modal" data-bs-target="#headerModal">
        <img src="/images/hotel_logo_placeholder.svg" v-else alt="" style="min-width:100px; height:100px; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#headerModal">
      <span class="res-contacts" v-if="this.show_res_info">Click the image to see contacts.</span>
        <h5 class="pt-2 mb-0 text-center">
            <span v-if="this.restaurant.restaurant_name !== null"> {{ capitalize(this.restaurant.restaurant_name) }}</span>
            <span v-else> Hotel </span> 
        </h5>
        <p class=" text-center m-0" v-if="this.restaurant.description !== 'null'">
            <span v-if="this.restaurant.description !== 'null'"> {{ capitalize(this.restaurant.description) }}</span>
        </p>
         <p class="text-center"> <small>
                 <span style="color:#f89a42;" v-if="this.restaurant.restaurant_phone_number  ">Phone:</span>  <span v-if="this.restaurant.restaurant_phone_number !== 'null' ">{{this.restaurant.restaurant_phone_number}}</span> &nbsp; 
                 <span style="color:#f89a42;" v-if="this.restaurant.restaurant_email !== 'null' ">Email:</span>  <span v-if="this.restaurant.restaurant_email !== 'null' ">{{this.restaurant.restaurant_email}}</span>
        </small> </p>
        <!-- -----------------------------cart items preview button----------------------------------------------- -->
        <div class="cart-items d-flex flex-row-reverse">                       
            <div class="cart-preview mr-3 p-0 " id="cart-preview" data-bs-toggle="modal" data-bs-target="#popupModal"  data-backdrop="static" data-keyboard="false" v-if="this.user.package_type !== 'starter' && this.user.registration_status !== 'trial' ">
              <div class="p-2" id="animate-glow" >
                 <div></div>
                 <div></div>
                 <div></div>
                 <div></div>
                <span> <i class="bi bi-cart-plus"></i> &nbsp;</span> 
                <span> {{this.cart_items.length}} </span>              
              </div>
               
            </div>
        </div>
    <!-- ------------------------------------------------------------ -->
    </div>

<!--Restaurant info Modal -->
<div class="modal fade" id="headerModal" tabindex="-1" aria-labelledby="headerModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="px-2 pt-2">        
        <button type="button" class="btn-close float-right " data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="text-center pb-3">
          <h3>Contacts</h3>
         <div class="header-div mt-1">
            <img :src=" this.restaurant.image"  v-if="this.restaurant.image"  alt="restaurant-logo" data-bs-toggle="modal" data-bs-target="#headerModal">
            <img src="/images/hotel_logo_placeholder.svg" v-else alt="" style="min-width:100px; height:100px" data-bs-toggle="modal" data-bs-target="#headerModal">
           
            <h5 class="pt-2 mb-0 text-center">
                <span v-if="this.restaurant.restaurant_name !== null"> {{ capitalize(this.restaurant.restaurant_name) }}</span>
                <span v-else> Hotel name</span> 
            </h5>
            <p class=" text-center">
                <span v-if="this.restaurant.description !== 'null'"> {{ capitalize(this.restaurant.description) }}</span>
            </p>
           
            <div class="p-0 m-0  mx-auto">
                <p class="  ">
                     <small class="text-left" v-if="this.restaurant.restaurant_email"> Email: <span v-if="this.restaurant.restaurant_email !=='null' "> {{ this.restaurant.restaurant_email}}</span>  </small> <br>
                
                     <small class="text-left" v-if="this.restaurant.restaurant_phone_number"> Phone: <span v-if="this.restaurant.restaurant_phone_number !== 'null'"> {{ this.restaurant.restaurant_phone_number}}</span>   </small>  <br>
               
                     <small class="text-left" v-if="this.restaurant.address "> Address: <span v-if="this.restaurant.address !== 'null'">{{ this.restaurant.address}} </span>  </small>
                </p> 
                <h5>Social media</h5>
                <p style="font-size:2rem"> 
                    <span class="p-2" v-if="this.restaurant.facebook !== 'null'"><a :href="this.restaurant.facebook" target="blank"><i class="bi bi-facebook"></i></a></span>
                    <span class="p-2" v-if="this.restaurant.instagram !== 'null'"><a :href="this.restaurant.instagram" target="blank"><i class="bi bi-instagram" style="color:#ffb917"></i></a></span>
                    <span class="p-2" v-if="this.restaurant.twitter !== 'null'"><a :href="this.restaurant.twitter" target="blank"><i class="bi bi-twitter"></i></a></span>
                    <span class="p-2" v-if="this.restaurant.youtube !== 'null'"><a :href="this.restaurant.youtube" target="blank"><i class="bi bi-youtube text-danger"></i></a></span>
                </p>
            </div>
        </div>
        <button class="btn btn-danger text-center mt-3" data-bs-dismiss="modal" aria-label="Close" > Close</button>
      </div>
    </div>
  </div>
</div>

    <div class="slider-div" id="slider-div">        
        <div v-if="this.current_sub_menus.length" :class="blur" > 
            <carousel :items-to-show="3.5">
                <slide v-for="(sub_menu) in current_sub_menus" :key="sub_menu.id"  style="display:table">
                        <div class="carausel-item mx-1 " v-if="sub_menu.publish == 'true'" >                            
                            <div class="" v-if="sub_menu.image " onclick="toggleActivemenuClass()">
                                <a href="#"> <img :src="sub_menu.image"  @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu)]" alt="menu-image" > </a> 
                            </div>
                            <div class=" " v-else onclick="toggleActivemenuClass()">
                                <a href="#"> <img :src="sub_menu.image" @click="[fetchMenuItems(sub_menu.id), updateMenuName(sub_menu)]" alt="menu-image" > </a> 
                            </div>

                            <p class=" my-3 " >
                                <span class="h5">{{capitalize(sub_menu.sub_menu_name ) }} </span>
                            </p>                           
                        </div> 
                    </slide>
                    <template #addons>
                        <div class="">
                            <Navigation />
                        </div>            
                </template>
            </carousel>
        </div>        
    </div>
    <!-- ----------------------------------------------------------- -->
    <div class=" text-center align-items-center ">
        <h5> <b> {{ capitalize( this.menu_name) }} </b> </h5>
        <p v-if="this.description"> {{this.description}} </p>
    </div>
    <!-- ---------------------item panels------------------------------ -->
    <div v-if="menu_items.length" class="items-panel">  

    <div class="items-div "  v-for="menu_item in menu_items" :key="menu_item.id">
        <div class="row items-div-inner my-2 shadow border" v-if="menu_item.publish == 'true'">
            
            <div class="text-div">
                <div :class=" this.text_right + ' pl-3 pt-3 pb-2 w-auto inner-items-div text_right' ">                    
                    <div class="title ">                        
                        <!-- <span class="price  pr-3  text-right"> <b> {{this.restaurant.currency}} {{menu_item.price}} </b> </span>  -->
                        <span class=""> <h5> {{ capitalize(menu_item.menu_item_name) }} </h5> </span>            
                    </div>
                    <p v-if="menu_item.description !== 'null'" class="mb-1" >{{ capitalize(menu_item.description) }}</p>

                    <!--type hints -->
                    <div class=" radio-btns m-1 arabic">                       
                        <div class="radio-btns-inner arabic d-flex mb-1 align-content-between ">
                            <div class="form-check form-check-inline d-flex align-items-center" v-if="this.user.package_type !== 'starter' && this.user.registration_status !== 'trial' && this.user.table_number > 0">
                                <i class="bi bi-dot pr-0 mr-0" ></i> 
                                <label class="form-check-label" > Dine-In</label>
                            </div>
                            <div class="form-check form-check-inline d-flex align-items-center"  v-if="this.user.package_type !== 'starter' && this.user.package_type !== 'lite' && this.user.registration_status !== 'trial'">
                                <i class="bi bi-dot"></i> 
                                <label class="form-check-label">Take away</label>
                            </div>
                             <div class="form-check form-check-inline d-flex align-items-center align-content-between" v-if="this.user.package_type == 'pro' ||  this.user.package_type == 'premium' ">
                                <i class="bi bi-dot"></i> 
                                <label class="form-check-label" >Drive-Thru</label>
                            </div>
                            <div class="form-check form-check-inline d-flex align-items-center align-content-between" v-if="this.user.package_type == 'premium' && this.user.table_number == 0">
                                <i class="bi bi-dot"></i> 
                                <label class="form-check-label" >Delivery</label>
                            </div>                            
                               
                        </div> 
                    </div>
                    <p class="arabic order-btn text-left pt-1 mt-2 mb-1" stle="position:relative">
                            <span style="position: relative;"> </span>                          
                        <span  v-if="this.User.package_type != null" class="button arabic ord-btn arabic py-2 "> 
                            <a href="#" class=" " @click.prevent="[addToCart( menu_item), this.tossItem($event)]"   v-if="this.user.package_type !== 'starter'">Add <i class="bi bi-cart-plus" style="font-size:1rem;"></i> </a>
                        </span>
                        <span class="arabic px-2 rounded counter" v-if="this.cart_item_qty[menu_item.id] ">
                            <label :for="menu_item.id" class="font-weight-lighter pr-1"> Qty </label>
                            <select :name="menu_item.id" :id="menu_item.id" class="rounded" :ref="menu_item.id" v-model="this.cart_item_qty[menu_item.id]" @change.prevent="this.calculateTotalAmount">
                                <option value="1" default selected> 1</option>
                                <option value="2" > 2</option>
                                <option value="3" > 3</option>
                                <option value="4" > 4</option> 
                                <option value="5" > 5</option>
                                <option value="6" > 6</option>
                                <option value="7" > 7</option>
                                <option value="8" > 8</option>
                            </select>
                            {{this.cart_item_qty[menu_item.id]}}
                            <span @click="removeFromCart(menu_item.id)"  style="position:relative; margin-top:-1.5rem; left:.5rem; font-size:1.5rem; cursor:pointer; border"> <i class="bi bi-x text-danger border rounded-circle py-0 px-1"></i></span> 
                        </span>
                        <span class="open " v-if="this.user.package_type !== 'starter'">  <button class=" arabic " @click.prevent="[addToCart( menu_item), this.tossItem($event)]" ><i class="bi bi-cart-plus" style="font-size:1rem;"></i> Add</button></span>  <br>

                        <span v-if="this.is_item_in_cart == true && this.item_in_cart == menu_item.id "><small class="text-success p-0">Item already in cart!</small></span>
                         <span v-if="this.item_added_to_cart == true && this.item_in_cart == menu_item.id"><small class="text-primary p-0">Item added to cart...</small></span>
                     </p>
                </div>    
            </div>  
            <div class="price-time text-right pt-3 pb-2 px-0 mx-0 my-auto">
                 <span class="price">{{this.restaurant.currency}} {{menu_item.price}}  </span>  <br>
                 <span class="time text-default"> <i class="bi bi-alarm pr-1 text-danger text-right" style="font-size:.7rem;"></i> <small> {{menu_item.preparation_time}} mins </small> </span>
            </div>
                 <div class="img-div ">                      
               <a href="#" @click.prevent="viewItemDetails(menu_item)" data-bs-toggle="modal" data-bs-target="#detailsModal"  data-backdrop="static" data-keyboard="false"> <img :src="menu_item.image" alt="menu-image" class="rounded"></a> 
             </div>     
        </div>
        </div>        
    </div>
    <div v-else class="text-center py-5">
        No items listed in this menu
    </div>
    <div class=" py-2 text-danger d-flex justify-content-center align-items-center">
        <p>
            Powered by: <span><img src="/images/menuthy_logo_iii.svg" alt="menuthy-logo" style="width:80px; height:50px"></span> 
        </p>
    </div>

<!-- ---------------------------------------------------------------- -->           
 <!-- item details modal popup -->
 <div class="modal fade mx-auto text-center item-details" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  mx-auto" >
            <div class="modal-content shadow mx-auto" style="width:400px; max-width:98%;">
            <div class="modal-header px-2">
                <h4 class="modal-title col-xs-6 mx-auto" id="detailsModalLabel" style="color:rgb(241, 103, 48);">
                    <span class="back-btn" id="detailsModal"  data-bs-dismiss="modal"> <i class="bi bi-arrow-left rounded-circle shadow px-2 py-1" ></i> </span>
                    <span>Item details </span>                    
                </h4>
            </div>
            <div class="modal-body" style="background:rgb(247 247 247 / 93%);">
               <div class="item-details" >
                   <div class="details-img" style="overflow:hidden;">
                       <img :src="this.item.image" alt="item-image" class="rounded shadow" style="min-width:350px; max-width:100%; height:200px; object-fit:cover;">
                       <p class="text-center" style="width:350px; max-width:100%;  margin-left:auto; margin-right:auto; bottom:0"> 
                           <span class="float-left"> <i class="bi bi-alarm pr-1 text-danger text-right" style="font-size:.7rem;"></i> <small> {{this.item.preparation_time}} mins </small></span>
                           <span class="float-right" style="color:rgb(241, 103, 48);">  <b> {{this.restaurant.currency}} {{this.item.price}} </b> </span>
                       </p>
                   </div>                   
                   <div class="details-content px-3 arabic">
                       <h4 class="pt-1 mx-auto arabic">{{this.item.menu_item_name}}</h4>
                       <h6 class="mx-auto arabic" v-if="this.item.description">{{this.item.description}}</h6>                       
                    </div>
                    <div class="details-content px-3"> 
                        <p class="labels arabic">
                            <span>Labels: &nbsp; &nbsp; </span>
                            <span class="badge badge-secondary mr-1 p-1" v-if="this.item.is_new == 'true'"> New</span>
                            <span class="badge badge-danger mr-1 p-1"  v-if="this.item.is_hot == 'true'"> Hot</span>
                            <span class="badge badge-success mr-1 p-1" v-if="this.item.is_veg == 'true'"> Veg</span>
                            <span class="badge badge-warning mr-1 p-1" v-if="this.item.is_halal !== 'false' "> Halal</span>
                            <span class="badge badge-primary mr-1 p-1" v-if="this.item.is_signiture == 'true'"> Signature</span>
                        </p>

                        <p class=" arabic " v-if="this.item.ingredients">
                            <span v-if="this.item.ingredients !== 'null' ">Ingredients: &nbsp; {{capitalize(this.item.ingredients)}}  </span>
                        </p>

                        <p class="arabic" v-if="this.item.allergy_warning"> 
                            <span v-if="this.item.allergy_warning !== 'null'">Allergy warning: &nbsp;  {{capitalize(this.item.allergy_warning)}} </span>
                        </p>
                        <p class="arabic">
                            <span class="mr-2" v-if="this.item.carlories !== 1"> Carlories:  {{this.item.carlories}} &nbsp; &nbsp;</span> 
                             <span v-if="this.item.food_origin && this.item.food_origin !== 'null' ">Origin:  {{capitalize(this.item.food_origin)}}  </span>
                        </p>
                     </div>
                     <p class="order-btn pt-2 mt-2 arabic"  v-if="this.user.registration_status !== 'trial' && this.user.package_type !== 'starter' ">                        
                        <span  > <a href="#" class="py-2 mr-3 " @click.prevent="addToCart(this.item)" >Add <i class="bi bi-cart-plus" style="font-size:1rem;"></i> </a></span>         
                            <span class=" arabic rounded counter" v-if="this.cart_item_qty[this.item.id] ">
                                <label :for="this.item.id" class="font-weight-lighter pr-1"> Qty </label>
                                <select :name="this.item.id" :id="this.item.id" class="rounded" :ref="this.item.id" v-model="this.cart_item_qty[this.item.id]" @change="this.calculateTotalAmount">
                                    <option value="1" default selected> 1</option>
                                    <option value="2" > 2</option>
                                    <option value="3" > 3</option>
                                    <option value="4" > 4</option> 
                                    <option value="5" > 5</option>
                                    <option value="6" > 6</option>
                                    <option value="7" > 7</option>
                                    <option value="8" > 8</option>
                                </select>
                                {{this.cart_item_qty[this.item.id]}}
                                <span @click="removeFromCart(this.item.id)"  style="position:relative; margin-top:-1.5rem; left:.5rem; font-size:1.5rem; cursor:pointer; border"> <i class="bi bi-x text-danger border rounded-circle py-0 px-1"></i></span> <br>
                            </span> 
                            <span v-if="this.is_item_in_cart == true"><small class="text-success p-0">Item already in cart!</small></span>
                            <span v-if="this.item_added_to_cart == true"><small class="text-primary p-0">Item added to cart...</small></span>
                        </p>
                </div>
            </div>            
            </div>
        </div>
    </div> 

<!-- ------------------------------------------------ -->
 <!--main menu modal popup -->
 <div class="modal fade mx-auto text-center" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  mx-auto" >
            <div class="modal-content shadow" style="">
            <div class="modal-header">
                <h4 class="modal-title col-xs-6 mx-auto" id="exampleModalLabel" style="color:rgb(241, 103, 48);">Main menu</h4>
            </div>
            <div class="modal-body">
                <ul  v-for="(menu) in current_menus" :key="menu.id" class="list-unstyled px-5">
                     <li class="px-3 py-2 border-bottom"  data-bs-dismiss="modal" v-if="menu.published == 'true'">  
                        <a class="menu-list p-2" href="#"   @click="fetchMenus( menu.id)"  > {{ capitalize(menu.menu_name) }} </a> 
                    </li>
                </ul>
            </div>            
            </div>
        </div>
    </div> 
</div>

 <!--order final pop up --> 
<!--cart items Modal -->
<div class="modal fade mx-auto text-center" id="popupModal" tabindex="-1" aria-labelledby="exampleModalLabel" data-bs-backdrop="exampleModalLabel" data-bs-keyboard="false"  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow h-auto" >
         <div class="pop-up " >
                <div class=" rounded" style="border-radius:15px; overflow:hidden; ">
                    <div class="pop-up-img ">
                        <span class="p-2   back-btn " id="close"  data-bs-dismiss="modal" aria-label="Close" style="cursor:pointer;"> <i class="bi bi-arrow-left shadow rounded-circle px-2 py-1" style="background:rgba(248, 143, 6, 0.808);" > </i></span>          
                    </div>
                    <h4 class="pt-3 pb-1">{{this.cart_items.length}} items in the Cart</h4>
                    <div class="popup-items-div mt-2" id="cart-items" v-if="this.cart_items.length" >
                        <div class="my-1 mx-3 row "  v-for="(item, index) in this.cart_items" :key="index">                            
                            <div class="inner-popup-div rounded border-bottom p-1 mb-2"> 
                                 <span @click="removeFromCart(item.id)" style="position:absolute; margin-top:-1.5rem; right:.5rem; font-size:1.5rem; cursor:pointer;"> <i class="bi bi-x text-danger"></i></span> 
                                <div class="popup-text" style="width:79%; height:auto; float:left">
                                   <span class="select mr-5 rounded">
                                       <label :for="item.id" class=" font-weight-lighter pr-1"> Qty </label>
                                        <select :name="item.id" :id="item.id" class="rounded" :ref="item.id" v-model="this.cart_item_qty[item.id]" @change="this.calculateTotalAmount">
                                            <option value="1" default selected> 1</option>
                                            <option value="2" > 2</option>
                                            <option value="3" > 3</option>
                                            <option value="4" > 4</option>
                                            <option value="5" > 5</option>
                                            <option value="6" > 6</option>
                                            <option value="7" > 7</option>
                                            <option value="8" > 8</option>
                                        </select>
                                        {{this.cart_item_qty[item.id]}}
                                        </span>
                                    <h6  v-if="item.menu_item_name" class="d-flex justify-content-between align-items-center mb-0">
                                        <span> {{ capitalize(item.menu_item_name) }}</span> 
                                        <span style="color:#f16730; width:25%;"> <small>{{this.restaurant.currency}} {{item.price}} </small> </span>
                                    </h6> 
                                    <p class="description mb-0 d-flex justify-content-between text-lighter" >
                                        <span v-if="item.description" class="text-left"> <small> {{ capitalize(item.description) }}</small>  </span>
                                         <span style="width:25%"><i class="bi bi-alarm pl-1 text-danger text-right" style="font-size:.7rem;"></i> <small>{{item.preparation_time}} mins </small> </span>
                                    </p>                                     
                                </div>
                                <div class="popup-img d-flex align-items-center" style="width:20%; height:100%; float:right">                                  
                                    <img :src="item.image" alt="menu-image" class="rounded shadow" style="width:60px; height:auto; object-fit:cover;">                                   
                                </div>
                            </div>                            
                        </div>
                        <p class="text-right lead mb-1 pr-5 mx-1" style="color:#f16730;"> Amount <b>  {{this.restaurant.currency}} {{this.total_amount}} </b></p>
                    </div>
                    <div class="text-muted py-5 lead" v-else> 
                        <small> --  Cart is empty, Please add some items --</small>
                    </div>
                    <div class="pop-up-text  py-2">                       
                    <!-- radio buttons -->
                    <div class=" radio-btns-popup py-1 pb-2 pl-0 ml-0" v-if="this.user.package_type !== 'starter'"> 
                        <div class="form-check form-check-inline" v-if="this.user.table_number > 0">
                            <input class="form-check-input"    v-model="this.order_type" type="radio" :name="menu_item.id" :id=" 'r1' + menu_item.id " value="Dine In" @change.prevent="detectOrderType(this.order_type)">
                            <label class="form-check-label" :for=" 'r1' + menu_item.id "> <small>Dine-In </small> </label>
                        </div>
                        <div class="form-check form-check-inline"  v-if="this.user.package_type !== 'starter' && this.user.package_type !== 'lite'">
                            <input class="form-check-input" type="radio" v-model="this.order_type" :name="menu_item.id" :id=" 'r2' +  menu_item.id" value="Take Away" @change.prevent="detectOrderType(this.order_type)">
                            <label class="form-check-label" :for=" 'r2' +  menu_item.id"> <small>Pick-up </small> </label>
                        </div>
                       <span v-if="this.user.table_number <1"> 
                            <div class="form-check form-check-inline" v-if="this.user.package_type == 'pro' || this.user.package_type == 'premium'">
                                <input class="form-check-input" type="radio" v-model="this.order_type" :name="menu_item.id" :id=" 'r3' + menu_item.id" value="Drive Through" @change.prevent="detectOrderType(this.order_type)">
                                <label class="form-check-label" :for=" 'r3' + menu_item.id"> <small> Drive-Thru </small></label>
                        </div> 
                        </span>
                        <div class="form-check form-check-inline"  v-if="this.user.package_type == 'premium' && this.user.table_number<1">
                            <input class="form-check-input" type="radio" v-model="this.order_type" :name="menu_item.id" :id=" 'r4' + menu_item.id" value="Home Delivery" @change.prevent="detectOrderType(this.order_type)">
                            <label class="form-check-label" :for=" 'r4' + menu_item.id"> <small> Delivery </small> </label>
                        </div> 
                       <br>
                        <small class="text-danger pb-2"> {{this.errors.order_type}}</small>
                    </div>
                        <p class="order-btn  mt-2 mx-auto" id="place-order-btn">  
                            <span :class="this.order_spinner" class="text-center" v-if="this.order_type == 'Dine In' "></span>  <br> 
                            <span  v-if="this.user.package_type == 'premium' && this.order_type == 'Dine In'"> <button class="p-2 px-3 m-1 " @click.prevent="payNow()">Pay now </button></span> 
                            <span  v-if="this.user.package_type !== null && this.user.package_type !== 'starter' && this.order_type == 'Dine In' "> <button class="p-2 px-3 m-1 " @click="pre_placeOrder()" >  Pay Later </button></span> <br>
                            <span  v-if="this.user.package_type !== null && this.user.package_type !== 'starter' && this.order_type !== 'Dine In' "> <button class="p-2 px-3 m-1 " @click="pre_placeOrder()" >  Place order </button></span> <br>
                            <small class="text-danger"> {{this .errors.cart_empty}} </small>
                        </p>
                    </div>
                    <div class="customer-details p-3 border  rounded m-2 mb-3 hidden" id="customer-details" v-if="this.order_type !== '' ">
                        <h5 class=""> Please provide the details below</h5>
                        <div>                           
                            <div class="form-group text-left" v-if="this.order_type == 'Take Away' || this.order_type == 'Home Delivery'">
                                <label for="phone">Phone number </label>
                                <input type="text" class="form-control p-4"  name="sub_menu_name"  v-model="this.customer_phone" id="phone"  placeholder="Phone no" required>
                                <i class="bi bi-telephone px-2 float-right " style="position:relative; right:1.2rem; top:-2.3rem; font-size:1.25rem"></i>
                                <small class="text-danger">{{this.errors.customer_phone}}</small>
                            </div>                            
                            <div class="form-group text-left" v-if="this.order_type == 'Drive Through'">
                                <label for="car_reg">Car registration number </label>
                                <input type="text" class="form-control p-4"  name="sub_menu_name"  v-model="this.car_registration_no" id="ca_reg"  placeholder="Car registration no" required>
                                <i class="bi bi-truck px-2 float-right " style="position:relative; right:1.2rem; top:-2.3rem; font-size:1.25rem"></i>
                                <small class="text-danger">{{this.errors.car_registration_no}}</small>
                            </div>
                           
                            <div class="form-group text-left" v-if="this.order_type == 'Home Delivery'">
                                <label for="car_reg">Address <small v-if="this.errors.location" class="text-primary">( {{this.errors.location}} )</small> </label>  
                                <textarea class="form-control p-4"   v-model="this.address" id="ca_reg"  placeholder="Address" required></textarea>
                                <i class="bi bi-envelope px-2 float-right " style="position:relative; right:1.2rem; top:-5.6rem; font-size:1.25rem"></i>
                                <small class="text-danger">{{this.errors.address}}</small>
                            </div> 
                            <div v-if="this.order_type =='Home Delivery'">
                                <p class="form-check form-check-inline">
                                    <span class="form-check form-check-inline"> Location mode: </span>
                                     <span class="form-check form-check-inline" >
                                        <input class="form-check-input" type="radio" v-model="this.location_type" name="location" id="auto" value="auto" @change.prevent="this.getGeoLocation()" >
                                        <label class="form-check-label" for="auto">Auto </label>
                                    </span>
                                        &nbsp; &nbsp;
                                    <span class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" v-model="this.location_type" name="location" id="manual" value="manual" @change.prevent="this.googlePlacesAutoComplete()">
                                        <label class="form-check-label" for="manual">Select </label>
                                    </span>                                     
                                </p>
                                <div id="location-hidden-fields" @click.prevent="this.updateHiddenFields()">
                                    <span> <input type="hidden" id="lat-hide" v-model="this.latitude" > </span>
                                    <span> <input type="hidden" id="lng-hide" v-model="this.longitude" > </span>
                                    <span> <input type="hidden" id="address-hide" v-model="this.autocomplete_location" > </span>
                                </div>                                
                            </div> 

                            <!-- Google map div container-->
                                <div class="pb-3 hidden  shadow" id="map-container"  style="transition: all 1.5s ease;" v-if="this.location_type == 'auto' ">
                                    <p class="text-left small mb-0 pt-1"> 
                                        <span style="font-weight:600 text-left "> Your Location:</span>   <span id="address" >{{this.autocomplete_location}}</span>                                        
                                    </p>
                                    <div id="map" class="mx-auto pt-0 mt-0" > </div> 
                                  <!-- <p class="mb-0 p-2"> <span class="small text-center py-3 mx-1 my-auto">Tip: Drag the pin on the map to set the location</span> <button class="btn btn-danger btn-sm float-right  " @click.prevent="hideMap()">Close map</button> </p> -->
                                </div>    

                            <div class="form-group text-left py-2" v-if="this.location_type == 'manual' && this.order_type =='Home Delivery'" style="transition: all 1.5s ease;">
                                <div class="form-group w-100 goog mb-0 pb-0" style="position:relative; ">
                                    <label for="searchInput">Set pick-up location  </label> <br>
                                    <input type="text" id="searchInput" class="border form-control  p-4" placeholder="Search location" v-model="this.autocomplete_location"  > 
                                    <i class="bi bi-geo-alt px-2 float-right bg-white" style="position:relative; right:1.2rem; top:-2.3rem; font-size:1.25rem" @click.prevent="this.googlePlacesAutoComplete()"></i> 
                                     <small class="text-default text-left"> <span style="font-weight:600"> Location: </span>  {{ this.autocomplete_location}} </small>
                                     <small class="text-danger"> {{this.errors.autocomplete_location}} </small>
                                </div>
                                   
                            </div>
                            <div class="form-group text-left">
                                <label for="name">Name <small class="text-muted">(Optional) </small></label>
                                <input type="text" class="form-control p-4"  name="sub_menu_name"  v-model="this.customer_name" id="name"  placeholder="Your name" >
                                <i class="bi bi-fonts px-2 float-right " style="position:relative; right:1.2rem; top:-2.3rem; font-size:1.25rem"></i>
                                <small class="text-danger">{{this.errors.customer_name}}</small>
                            </div>
                            <p class="order-btn text-center mt-2 mb-1 mx-auto" v-if="this.User.package_type !== 'starter'">
                                <span :class="this.order_spinner" class="text-center"></span>  <br>          
                                <span  v-if="this.User.package_type == 'premium'"> <button class="p-2 px-3 m-1  " @click.prevent="payNow()" >  Pay now </button></span> 
                                <span  v-if="this.User.package_type !== null"> <button class="p-2 px-3 m-1 " @click.prevent="placeOrder()" >  Pay later </button></span> 
                                <span  v-if="this.User.package_type !==null"> <button class="py-2  m-1 px-4  " @click="cancelPlaceOrder()" > <span ></span> Cancel </button></span> <br>
                                <small class="text-danger"> {{this .errors.cart_empty}} </small>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
         </div>
  </div>
</div> 

<!-- ------------- Translate button--------------------- -->
<div>
    <div class="translate-btn">
        <div class="translate-btn-inner shadow">
        <div id="google_translate_element" @click="alignArabic()"></div>
        </div>
    </div>
</div>

<div style="position:relative" v-if="Object.keys(this.menuthy_orders).length">   
    <!-- ------------ track order button --------------- -->
    <div  style="position:absolute; bottom:0; right:2rem;" class="w-auto" @click.prevent="fetchLocalStorage()">
        <div class="track-order" data-bs-toggle="modal" data-bs-target="#trackOrderModal">
            <span class="p-2 bg-white"><i class="bi bi-broadcast-pin"></i> Track  orders</span>
        </div>
    </div>
</div>

<!-- --------------------- Track orders modal ------------------ -->
<div class="track-order-modal shadow">
    <div class="modal fade" id="trackOrderModal" tabindex="-1" aria-labelledby="trackOrderModalLabel" aria-hidden="true">
  <div class="modal-dialog shadow" >
    <div class="modal-content">
      <div class="px-2 pt-2">        
        <button type="button" class="btn-close float-right " data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="text-center py-2 shadow">
          
         <div class="header-div mt-1">
            <img :src=" this.restaurant.image"  v-if="this.restaurant.image" style="width:50px; height:50px"  alt="restaurant-logo" data-bs-toggle="modal" data-bs-target="#headerModal">
            <img src="/images/hotel_logo_placeholder.svg" v-else alt="" style="width:50px; height:50px" data-bs-toggle="modal" data-bs-target="#headerModal">
           
            <h5 class="pt-2 mb-0 text-center">
                <span v-if="this.restaurant.restaurant_name !== null"> {{ capitalize(this.restaurant.restaurant_name) }}</span>
                <span v-else> Hotel name</span> 
            </h5>
            <p class=" text-center">
                <span v-if="this.restaurant.description !== 'null'"> {{ capitalize(this.restaurant.description) }}</span>
            </p>           
        </div>
        <div class="table-responsive shadow px-2 text-center track-your-order" >
            <h3 style="position:sticky; top:0; background:#fff;">Track your Orders</h3>
            <table class="table-sm p-3 track-your-order">
                <thead class="p-2">
                    <th> #</th>                    
                    <th> Order id </th>                    
                    <th> Order type </th>                     
                    <th> Status </th>                    
                    <th> Paid </th>                     
                    <th> Time recieved </th>                   
                    <th> Action </th>                   
                </thead>
                <tbody v-for="(order, index) in this.menuthy_orders" :key="index" class=""> 
                    <tr  class="p-2 border-top accordion" style="" v-if="order.restaurant_id == this.restaurant.id"> 
                        <td> {{index +1}} </td>
                        <td> {{order.order_number}} </td>
                        <td>{{ this.capitalize( order.order_type)}} </td>

                        <td v-if="order.status == 'received' " class="text-secondary"> {{capitalize(order.status)}} </td>
                        <td v-if="order.status == 'processing' " class="text-primary"> {{capitalize(order.status)}}... </td>
                        <td v-if="order.status == 'completed' " class="text-default"> {{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'canceled' " class="text-danger"> {{capitalize(order.status)}}</td>
                        <td v-if="order.status == 'transit' " class="text-primary"> {{capitalize(order.status)}}...</td>
                        <td v-if="order.status == 'delivered' " class="text-default"> {{capitalize(order.status)}}</td>

                        <td v-if="order.paid == 'true'" class="text-success"> Yes</td>
                        <td v-if="order.paid == 'false'" class="text-danger"> No</td>
                        <td> {{formatDate(order.created_at)}} </td>
                        <td><span class="btn-secondary p-2 badge" @click.prevent="expandRow($event)" style="cusor:pointer"> Details </span> </td>
                    </tr>
                    <tr class="panel  " style="display:none;" v-if="order.restaurant_id == this.restaurant.id"> 
                        <td colspan="7">
                            <div class="table-responsive text-center alert-danger p-1 mx-3 mb-3 pt-0 mt-0 mx-auto">
                                <h5> Items </h5>
                                <table class="table-sm text-center mx-auto" id="innerTable"> 
                                    <thead>
                                        <th>Item name</th>
                                        <th>Qty</th>
                                        <th>Preparation Time</th>
                                        <th>Price</th>
                                    </thead>
                                    <tbody  v-for="(item, index) in order.order_item" :key="index">
                                        <tr> 
                                            <td>{{item.item_name}}</td>
                                            <td>{{item.quantity}}</td>
                                            <td>{{item.preparation_time}} <small> mins </small></td>
                                            <td> <small> {{this.restaurant.currency}} </small> {{item.price_per_item}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>                    
                    </tr>
                </tbody>
            </table>
        </div>
        <button class="btn btn-danger text-center mt-3" data-bs-dismiss="modal" aria-label="Close" > Close</button>
      </div>
    </div>
  </div>
</div>
</div>
</div>


</template>

<script> 
import moment from 'moment';
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide,Navigation } from 'vue3-carousel';
import { Modal } from 'bootstrap';

export default {
  name: 'App',

  props:[
      'menus', 'subMenus', 'menuItems', 'user', 'restaurant',  
    ],
  components: {
    Carousel,
    Slide,
    Navigation
  },
  data(){
      return{
        current_menus:[],
        current_sub_menus:[],
        menu_item:[],
        blur:'',
        order_amount:1,
        restaurant_name:'',
        menu_items:'',
        menu_name:'',
        description:'',
        single_menu_item:'',
        show_menus_list:true,
        show_single_menu_item:false,
        is_take_away:false,
        popupVisible:false,
        order_type:'',
        errors:{},
        User:{},
        client_IP:'',
        cart_items:[],
        cart_item_qty:[], //keeps track of individual cart item qty in an array
        total_amount:0,
        item:{},
        is_item_in_cart:false,
        item_added_to_cart:false,
        item_in_cart:null,
        order_data:'',
        order_items:[],
        language:'',
        car_registration_no:'',
        customer_name:'',
        customer_phone:'',
        address:'',
        spinner:'',
        show_res_info:false,
        latitude:null,
        longitude:null,  
        autocomplete_location:null,
        location_type:'auto',
        order_spinner:null,
        menuthy_orders:[],

      }
  },
  methods:{
       
       formatDate(date){
            if (date) return moment(String(date)).format('L') + ' ' + moment(String(date)).format('LT');            
        },
        expandRow(event){
            var acc = document.getElementsByClassName("accordion");
            var rows= document.getElementsByClassName('panel');
            // for (let i=0; i< rows.length; i++){
            //     rows[i].style.display = "none";             
            // }
            var panel = event.target.parentElement.parentElement.nextSibling;
            if(panel.style.display == "table-row") panel.style.display = "none";
            else  panel.style.display = "table-row";      
            
        },
      // align arabic content
       alignArabic(){
            var el = document.getElementById('google_translate_element');
            var select = el.getElementsByClassName('goog-te-combo')[0];
            var arabic = document.getElementsByClassName('arabic');
            var order_btn = document.getElementsByClassName('order-btn');
            var text_div = document.getElementsByClassName('text-div');
            var radiobtn_inner= document.getElementsByClassName('radio-btns-inner');
            var butons =  document.getElementsByClassName('ord-btn');
            var item_deatails = document.getElementsByClassName('details-content')[1];
            document.getElementById('cart-preview').style.top='4.3rem';
            select.addEventListener('change', function(){  
            if(select.value == 'ar' || select.value == 'ur'){                       
                Array.from(arabic).forEach((item)=>{
                    item.classList.add('text-right');
                });

                Array.from(order_btn).forEach((item)=>{
                    item.classList.add('text-right');
                });

                Array.from(text_div).forEach((item)=>{
                    item.classList.add('text-right');
                });

                Array.from(radiobtn_inner).forEach((item)=>{
                    item.classList.add('float-right');
                });

                Array.from(butons).forEach((item)=>{
                    item.classList.add('float-right');
                });
                item_deatails.classList.add('text-right');
                return;
            } else{
                Array.from(arabic).forEach((item)=>{
                    item.classList.remove('text-right');
                });

                Array.from(order_btn).forEach((item)=>{
                    item.classList.remove('text-right');
                });

                Array.from(text_div).forEach((item)=>{
                    item.classList.remove('text-right');
                });

                Array.from(radiobtn_inner).forEach((item)=>{
                    item.classList.remove('float-right');
                });

                Array.from(butons).forEach((item)=>{
                    item.classList.remove('float-right');
                });
                item_deatails.classList.remove('text-right');
                return;
            }           
            
        })
        },    
        viewItemDetails(menu_item){
            this.item = menu_item;
        },
        addToCart( menu_item){
            var viewportWidth = window.innerWidth;
            console.log( viewportWidth);
            this.is_item_in_cart=false;
            this.cart_items.forEach((item)=>{
                if(item.id == menu_item.id) {
                    this.is_item_in_cart = true;// prevent adding multiple items in the cart 
                    this.item_in_cart = menu_item.id                    
                    setTimeout(() => {
                        this.is_item_in_cart = false; 
                        this.item_in_cart = null; 
                    }, 1500);
                    return;
                }                      
            }); 
            if(!this.is_item_in_cart) {
                document.getElementById('animate-glow').classList.add('animated-button1');                
                var menu_item_id = menu_item.id;
                this.cart_item_qty[menu_item_id]= 1;
                this.cart_items.push(menu_item);   
                this.calculateTotalAmount(); 
                this.item_added_to_cart = true;
                this.item_in_cart = menu_item.id 
                document.getElementById('cart-preview').classList.add('shake');
                setTimeout(() => {
                    this.item_added_to_cart = false;
                    this.item_in_cart = null;
                    document.getElementById('cart-preview').classList.remove('shake');
                   document.getElementById('detailsModal').click();  
               }, 1500);                
               
            }
            delete this .errors.cart_empty ;
        },
        tossItem(event){ 
            return;
            if(this.is_item_in_cart) return;
            var rect = document.getElementById('cart-preview').getBoundingClientRect();
            var cart_offset = document.getElementById('cart-preview').offsetTop
            var margin = 0;        
            let w = window.screen.width;
            let margin_top = 0;  
            let margin_bottom = 0;  
            let margin_left = 0;  
            let margin_right = 0;
            let cart_left = rect.left;
            let cart_right = rect.right;
            let cart_top = rect.top;
            let cart_bottom = rect.bottom;
            // create node element
            var toss_parent = document.createElement("div");
                toss_parent.style.position = 'relative';
            var toss_el = document.createElement("span");
                toss_el.id ='tossing-item';
                toss_el.classList.add('tossing-item') ;
                // toss_parent.appendchild(toss_el);
            var host = event.target.parentElement.parentElement.firstChild
                host.appendChild(toss_el);
               
           var tossInterval = setInterval(() => {
                if(document.getElementById("tossing-item").getBoundingClientRect().left >= cart_left || margin_left > 1000){
                    clearInterval(tossInterval);
                    document.getElementById("tossing-item").remove();
                } 

                document.getElementById("tossing-item").style.left =  '100vw';
                document.getElementById("tossing-item").style.top =   '-100vh';
              
                margin_top -= 15;
                margin_left += 15;
               
                console.log('top: ' + margin_top);
                console.log('left:' + margin_left);
            }, 500);
            
                     
        },
        removeFromCart(item_id){
            this.is_item_in_cart=false;
            this.cart_items.forEach((item)=>{
                if(item.id == item_id){
                    var index = this.cart_items.indexOf(item); // remove item from cart
                    this.cart_items.splice(index, 1);
                    delete this.cart_item_qty[item_id];  
                    
                } ;
                if(!this.cart_items.length) this.cart_item_qty = [];

                this.calculateTotalAmount(); 
            });
            if(!Object.keys(this.cart_items).length) {
                this.errors.cart_empty = "Cart Empty. Pease add some items";
                document.getElementById('animate-glow').classList.remove('animated-button1');
                }
            else delete this.errors.cart_empty;
        },
        calculateTotalAmount(){
            this.is_item_in_cart=false;
              var total = 0;
              this.cart_items.forEach((item)=>{
                  var qty = this.cart_item_qty[item.id]; // get item quatntity from tracker variable
                  var amount = qty * item.price;
                  total += amount;                  
              }) 
            this.total_amount = total; 
        },
        orderFor(number){
            this.order_amount += number;
            if(this.order_amount < 1)this.order_amount = 1;
        },
        capitalize(string) {
            if(string) return string.charAt(0).toUpperCase() + string.slice(1);
            else return; 
            },
    
        updateMenuName(sub_menu){
                this.menu_name= sub_menu.sub_menu_name;
                this.description = sub_menu.description;
        },
        showMenuItem(menu_item){
            this.single_menu_item = menu_item;
            this.show_menus_list = !this.show_menus_list;
            this.show_single_menu_item = !this.show_single_menu_item;
            this.blur = this.blur == 'blur-background' ? '' : 'blur-background';
        },

        fetchMenus( menu_id){
            Swal.showLoading();
            axios.get('/fetch/' + this.restaurant_name + '/main-menu/' + menu_id)
            .then( response => {
                console.log(response);
            if( response.status == 200){
                // this.current_menus = [];
                // this. current_sub_menus = []; 
                // this.menu_items = [];

                this.current_menus = response.data.menus;
                this. current_sub_menus = response.data.subMenus; 
                this.menu_items = response.data.menuItems;
                Swal.close();
                } 
            })
            .catch( error => {
                this.$swal('Failed to fecth!');                
                console.log(error.response);                    
            });
            Swal.close();            
        },

        fetchMenuItems( sub_menu_id){
            Swal.showLoading();
            axios.get('/api/' + this.restaurant_name + '/menu-item/' + sub_menu_id)
                .then( response => {
                if( response.status = 200){
                    this.menu_items = response.data.data;
                    Swal.close();
                    } 
                })
                .catch( error => {
                    this.$swal('Failed to fecth!');                
                    console.log(error.response);                    
                });
        },
        cancelPlaceOrder(){
            document.getElementById('cart-items').classList.remove('zero-height');
            document.getElementById('customer-details').classList.add('hidden');
            document.getElementById('place-order-btn').classList.remove('hidden');
            document.getElementById('cart-items').classList.remove('shadow');
            document.getElementById('cart-items').classList.remove('border-top');
            this.errors = {};
            this.spinner ='';
        },
        detectOrderType(order_type){
            if(order_type == 'Dine In') this.cancelPlaceOrder();
            return;
        },
        pre_placeOrder(){
            if(Object.keys(this.errors).length) return;
            if(!Object.keys(this.cart_items).length){
                this .errors.cart_empty = "Cart Empty. Please add some items";
                return;
            }
            if(this.order_type == 'Dine In'){
                this.cancelPlaceOrder();
                this.placeOrder();
                return;
            }
            if(this.order_type == ''){
                this.errors.order_type = "Please select order type!"; 
                return;
            } 
            else delete this.errors.order_type;
            if(this.order_type == "Home Delivery") this.getGeoLocation();
                    
            document.getElementById('cart-items').classList.add('zero-height');
            document.getElementById('cart-items').classList.add('shadow');
            document.getElementById('cart-items').classList.add('border-top');
            document.getElementById('customer-details').classList.remove('hidden');
            document.getElementById('place-order-btn').classList.add('hidden');
            return;
        } ,

        // ------------place order --------------------
        placeOrder(){ 
            console.log('Place order');  
            this.sendOrder();
            // if(this.order_type == 'Home Delivery') this.getGeoLocation(); // call sendOrder inside get geolocation
            // if(this.order_type !== 'Home Delivery')  this.sendOrder();    // send order straigh away     
            },
        payNow(){   
            this.validateOrder();
            if(Object.keys(this.errors).length) return;     
            if(!this.user.stripe_publishable_key) {
                alert('Operation not possible! n/ This restaurant has no set up any payment method yet!');
                return;
                }                          
            this.getOrderData();  // gather order data    
            if(!confirm('Proceed to checkout?')) return;
            this.order_spinner = 'spinner-border spinner-border-sm';
            const stripe = Stripe(this.user.stripe_publishable_key);

            axios.post('/api/stripe-pay-order-checkout', this.order_data )
            .then( payload => {
                stripe.redirectToCheckout({sessionId: payload.data.id});
            })
            .catch( error => {
                this.order_spinner = null;
               this.$swal('Failed!');
                console.log(error.response);                    
            });
        },
        fetchLocalStorage(){
            this.menuthy_orders = JSON.parse(localStorage.getItem('menuthy_orders')); 
            var tracked_orders =[]           
            this.menuthy_orders.forEach((order) =>{
                if(order.restaurant_id == this.restaurant.id){
                    // refresh order status from remote 
                    axios.get('/api/track-order/'  + order.id)
                    .then( response => {
                        // if order is not expired retain it, else discard it
                        let is_order_expired = this.is_order_expired(response.data.data);
                        if( ! is_order_expired){
                            tracked_orders.push(response.data.data);
                        }                        
                    })
                    .catch( error => {
                        this.$swal('Tracking failed!');                
                        console.log(error.response);                    
                    });
                }                                 
                });
            setTimeout(() => {
                localStorage.setItem('menuthy_orders', JSON.stringify(tracked_orders));
                this.menuthy_orders = JSON.parse(localStorage.getItem('menuthy_orders'));
            }, 2500);
            
        },
        is_order_expired(order){
            // check if order was fulfilled more than 45 minutes ago
            var is_order_expired = false;
            var time_now = moment(new Date()).format("YYYY-MM-DD HH:mm");
            var order_date = null;
            if(order.order_type !== 'Home Delivery') order_date = moment(order.completed_at).add(45, 'minutes').format("YYYY-MM-DD HH:mm");
            if(order.order_type == 'Home Delivery') order_date = moment(order.delivered_at).add(45, 'minutes').format("YYYY-MM-DD HH:mm");
            if(order.status == 'canceled') order_date = moment(order.canceled_at).add(45, 'minutes').format("YYYY-MM-DD HH:mm");
            is_order_expired = moment(time_now).isAfter(order_date) ;
           return is_order_expired;            
        },
        sendOrder(){
            this.validateOrder();
            if(Object.keys(this.errors).length) return;
            if(!Object.keys(this.cart_items).length){
                this.errors.cart_empty = "Cart Empty. Please add some items";
                return;
            }
            this.getOrderData();  // gather order data 
            if(window.confirm("Place a " + this.order_type  + ' order?')){
                this.spinner = 'spinner-border spinner-border-sm';
                axios.post('/api/order', this.order_data)
                    .then( response => {
                        console.log("Order sent...")
                        if( response.status == 201){ 
                            // save order into local storage for tracking
                            var local_storage = JSON.parse(localStorage.getItem('menuthy_orders')) || [];
                            local_storage.push(response.data.data) 
                            localStorage.setItem('menuthy_orders', JSON.stringify(local_storage));
                            
                            this.is_item_in_cart=false;
                            this.cart_items = [];
                            this.cart_item_qty=[];
                            this.spinner = '';
                            this.car_registration_no = '';
                            this.customer_name = '';
                            this.customer_phone = '';
                            this.order_type = '';
                            this.order_data = '';
                            this.order_items = [];
                            this.longitude = '';
                            this.latitude = '';
                            this.address = '';
                            this.cancelPlaceOrder();
                            document.getElementById('close').click();
                            document.getElementById('animate-glow').classList.remove('animated-button1');
                            console.log(response.data);
                            this.$swal( 'Order placed!') ; 
                            console.log(this.latitude, this.longitude); 
                            } 
                        })
                    .catch( error => {
                        this.$swal('Error, Order failed!');                
                        console.log(error.response);                    
                    });
            }
        },
        getOrderData(){ 
            // gather order data  
            this.order_data =new FormData();          
            this.order_data.append('order_number', Date.now());            
            this.order_data.append('restaurant_id', this.restaurant.id);
            this.order_data.append('amount', this.total_amount);
            this.order_data.append('paid', 'false');
            this.order_data.append('number_of_items', this.cart_items.length);
            this.order_data.append('status', 'received');
            this.order_data.append('order_type', this.order_type);
            this.order_data.append('customer_name', this.customer_name);
            this.order_data.append('customer_phone', this.customer_phone);
            this.order_data.append('car_registration_no', this.car_registration_no);
            this.order_data.append('delivery_address', this.address);
            if(this.latitude !== '') this.order_data.append('latitude', this.latitude);
            if(this.longitude !== '') this.order_data.append('longitude', this.longitude);
            if(this.User.table_number > 0) this.order_data.append('table_number', parseInt(this.User.table_number) );
            else this.order_data.append('table_number', -1); //default table number is 1 
            this.getOrderItems();  // gather order items data 
        },
        getOrderItems(){
            // gather order items data
            var items = [];
            this.cart_items.forEach((item)=>{
                var elmnt = {};
                elmnt.item_name = item.menu_item_name;
                elmnt.menu_item_id = item.id;
                elmnt.price_per_item = item.price;
                elmnt.preparation_time = item.preparation_time;
                elmnt.quantity = this.cart_item_qty[item.id]; // get item quantity
                elmnt.amount = item.price * this.cart_item_qty[item.id]; // multiply price by quantity
                items.push(elmnt);
            });
            this.order_items = items;
            this.order_data.append('order_items', JSON.stringify(this.order_items)); //append order items to order data  form  
        },
            // ---------------------google maps geolocation ---------/
        updateHiddenFields(){
            this.latitude = parseFloat(document.getElementById('lat-hide').value);
            this.longitude = parseFloat(document.getElementById('lng-hide').value);
            this.autocomplete_location = document.getElementById('address-hide').value;
        },    
        hideMap(){
          document.getElementById('map').classList.remove('map-styles');
          document.getElementById('map-container').classList.add('hidden');
        },   
        getGeoLocation() {
            if(this.location_type == 'manual') return;
            navigator.geolocation.getCurrentPosition( position => {                
                this.latitude = position.coords.latitude;
                this.longitude = position.coords.longitude;
                document.getElementById('map-container').classList.remove('hidden')
                document.getElementById('map').classList.add('map-styles');;
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: this.latitude, lng: this.longitude},
                    zoom: 13
                });
                var marker = new google.maps.Marker({
                        position: {lat: this.latitude, lng: this.longitude},
                        map: map,
                        draggable: false,
                        animation:google.maps.Animation.DROP,
                    });

                var latlng = {
                            lat: this.latitude,
                            lng: this.longitude
                        };
                var geocoder = new google.maps.Geocoder;
                geocoder.geocode({
                        'location': latlng
                    }, function(results, status) {
                        if (status === 'OK') {
                            if (results[0]) {
                                //This is you formatted address
                                document.getElementById('lat-hide').value = position.coords.longitude; 
                                document.getElementById('lng-hide').value = position.coords.longitude;
                                document.getElementById('address-hide').value = results[0].formatted_address;
                                document.getElementById('location-hidden-fields').click();
                            } else {
                                window.alert('Unable to locate your position!');
                            }
                        } else {
                        window.alert('Geocoder failed due to: ' + status);
                        }
                    });                            
                },
                error => {   
                    alert('Location access is required for effective service delivery. Please make sure it is enabled.');   
                    console.log(error.message);
                },               
            );
        },        
     
        googlePlacesAutoComplete() {
            console.log(this.latitude, this.longitude);
            
            if(this.location_type !== 'manual') return;
            var lat, lng, address;   
            var input = document.getElementById('searchInput');
            var autocomplete = new google.maps.places.Autocomplete(input);
            var infowindow = new google.maps.InfoWindow();               

            autocomplete.addListener('place_changed', function() {
                this.latitude = null;
                this.longitude = null;
                infowindow.close();
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete returned location contains no geometry");
                    return;
                }                
                this.latitude = place.geometry.location.lat();
                this.longitude = place.geometry.location.lng();
                this.autocomplete_location = place.formatted_address;

                document.getElementById('searchInput').value =  place.formatted_address;
                document.getElementById('address-hide').value =  place.formatted_address;
                document.getElementById('lat-hide').value =  place.geometry.location.lat();
                document.getElementById('lng-hide').value =  place.geometry.location.lng();
                document.getElementById('location-hidden-fields').click();
            });   
                           
        },

        validateOrder(){          
            if( this.order_type == '') this.errors.order_type =  'Please choose  order type';
            else delete this.errors.order_type;

            if(this.customer_phone == '' && this.order_type == 'Take Away' || this.customer_phone == '' && this.order_type == 'Home Delivery') this.errors.customer_phone = "Please provide your phone number";                    
            else  delete this.errors.customer_phone;

            if(this.car_registration_no =='' && this.order_type == 'Drive Through') this.errors.car_registration_no ="Please provide your car plate number";
            else delete this.errors.car_registration_no;
            
            if(this.order_type == 'Home Delivery'){
                if(this.address =='' ) this.errors.address ="Please provide your delivery  address";
                else delete this.errors.address;

                if(this.latitude == null || this.longitude == null) this.errors.location ="Please allow location access ";
                else delete this.errors.location;
            }            
        },
        getCookie() {
                var current_cookie = document.cookie;
                return current_cookie.includes('qr_code_scans=');
            }, 
        toggle_show_res_info(){
                this.show_res_info = false;
            },        
    },
  
    mounted(){         
            this.menu_items = this.menuItems;
            this.User= this.user;
            if(this.user.table_number >0) this.order_type = "Dine In";
            if(this.user.table_number < 1) this.order_type = "Drive Through";
            this.current_menus= this.menus;
            this.current_sub_menus= this.subMenus;
            this.restaurant_name = this.restaurant.restaurant_name.replace(/\s+/g, '-').toLowerCase(); 
            this.menuthy_orders = JSON.parse(localStorage.getItem('menuthy_orders')) || [];
            console.log(this.user);
            
            
            // setTimeout( this.toggle_show_res_info(), 3000); 

                // initialize coockies for qr scan counting - expires in 6hrs
                var expiry_time = Math.round( Date.now()/ 1000) + 4300 ; // expire in 6hrs
                var cookie_obj = {
                    'name':'qr_code_scans',
                    'website' : 'menuthy',
                    'restaurant_name' : this.restaurant.restaurant_name,
                    'restaurant_id' : this.restaurant.id,
                    'scan_counted' : false,
                    }  

                    // check if coockie exists first, if it doesnt create one              
                var isset_cookie = document.cookie.includes('qr_code_scans');
                if(!isset_cookie){
                    document.cookie = JSON.stringify(cookie_obj) + ';' + 'expires=' + expiry_time + ';';             
                }
                if(isset_cookie){                          
                    var old_cookie = document.cookie.split(';');
                    var newcookie = JSON.parse(old_cookie[0]);             
                    // see if restaurant is registered in the cookie 
                    if(newcookie.restaurant_id == this.restaurant.id && newcookie.scan_counted == true) return; // if restaurant is in the cookie dont count the scan
                    else{  
                        axios.get('/api/qr-code-scan/'  + this.restaurant.id)
                        .then( response => {
                            if( response.status = 200){
                                newcookie.scan_counted = true;
                                document.cookie =  JSON.stringify(newcookie)+ ';' + 'expires=' + expiry_time;
                            } 
                        })
                        .catch( error => {
                            this.$swal('Failed to scan!');                
                            console.log(error.response);                    
                        });                    
                    }
                }                  
        }
 
};
</script>


<style lang="scss" >
@import "../../../sass/app.scss"; 
@import "../../../css/custom.css"; 
@import url('https://fonts.googleapis.com/css?family=Poppins');

.track-order{
    position:fixed;
    width:auto;
    bottom:2.5rem;
    z-index: 1000;
    font-weight:600;
    border: 1px solid orange;
    border-radius:25px;
    cursor:pointer;
    overflow:hidden;
    transition:height 0.35s ease;
}
.track-order:active{
    background-color:#fefefe;
    border: 1px solid rgba(255, 166, 0, 0.438);
    border-radius:26px;
    

}

.tossing-item {
        height: 1rem;
        width: 1rem;
        background-color: $orange;
        border-radius: 50%;
        border:1px solid orange;
        position:absolute;
        z-index:1000;
        left:0;
        top:0;
        transition: all 1.5s ease;
      }

// * google map styles */
.goog input:focus {
    outline: 0 !important;
    border-color: initial;
    box-shadow: none;
}
.pac-container {
     z-index: 10000 !important;
     top:2rem;
    }
.map-styles{
    width:98%;
    min-height:300px;
    transition: all 1.5s ease;
    -moz-transition: height .5s;
  -ms-transition: height .5s;
  -o-transition: height .5s;
  -webkit-transition: height .5s;
  transition: height .5s;
}
select{
    border: 1px solid $orange;
    color: rgb(141, 101, 101);
}
select:active{
    border: 3px solid $orange;
    color: rgb(182, 123, 123);
}
select:hover{
    border: 2px solid $orange;
    color: rgb(182, 123, 123);
}
select:focus{
    border: 3px solid $orange;
    color: rgb(182, 123, 123);
}

// cart items sticky preview styles
.cart-items{
    position:relative; 
    right:0;
    cursor: pointer;     
}
.cart-preview{
    position:fixed;
    width:auto;  
    top:2rem ; 
    font-size:.9rem;
    z-index: 1000;
    padding:0rem;
    border-radius: 10px;
    background-color: rgb(248, 154, 66);
    border:1px solid rgb(240, 120, 8);
    border-right: 3px solid rgb(240, 120, 8);
    align-items: center;    
    color:#fff;
    cursor: pointer;
    box-shadow: 7px 7px 15px 5px rgba(128, 63, 2, 0.205);
    transition: transform .2s; /* Animation */
    overflow:hidden;
}
.glow{
    border-radius: 13px;
    transform: scale(1.05);
    transition: transform .2s; /* Animation */
}
.cart-preview:hover{
    background-color: rgb(248, 137, 33);
    border:1px solid rgb(243, 121, 7);
}
.cart-preview:active{
    background-color: rgb(252, 123, 2);
    border:1px solid rgb(184, 92, 6);
}

// parent div 
.parent-div{
    color: #585858;
    background-color:#e7e5e53b;
    font-family: poppins !important;
    min-height:100vh;
    width:42rem;
    max-width:100%;  
    overflow-x:hidden;  
    margin-top:-2.5rem; 
    overflow: scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
.track-your-order{
    max-height:25rem;
    overflow: scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
.track-your-order::-webkit-scrollbar {
  display: none;
}

.parent-div::-webkit-scrollbar {
  display: none;
}

.header-div img{
    object-fit:cover;
    width:100px;
    height:100px;
    min-height:100px;
    min-width:100px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    cursor: pointer;
}

.arrow-left{
    position:relative;
    left:1rem;
    top:4rem;
    font-size:2rem;
    padding-left:.7rem;
    padding-right:.7rem;
    cursor: pointer;
    transition: all .5s ease-in-out;
    width: 50px;
    height: 50px;
    text-align: center;    
}
.arrow-left:hover{
    border: 3px solid rgb(236, 233, 233); 
    color:rgba(220, 20, 60, 0.205);
}

.res-contacts{
    border:1px solid $orange;
    border-radius: 15px;
    padding:.5rem;
    z-index: 10;
    text-align: center;
}
// slider div 
.carausel-item{
    display:table-cell;
    padding:.3rem;
    overflow:hidden;
    font-size:1rem;
   max-height: 80%;
   z-index: 1 !important;
}
.slider-div *{
    z-index: 1 !important;
}
.slider-div img{
    object-fit:cover;
    width:180px;
    height:120px;
    max-width:100%;
    max-height:100%;
    border-radius: 5px;
    z-index: 1 !important;
}
 .carousel__prev, .carousel__next {
    background-color: $orange !important;
    margin: .3rem;
    margin-right:.3rem;
    top:3.5rem;
}
.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color:#fff !important;
}

// items div
.items-panel{
    padding-left:.8rem;
    padding-right:.8rem;
}
.items-div{
    margin-left: .5rem;
    padding-right: 10px;
}
.items-div-inner{
    border-radius:15px;
    // overflow:hidden;
}
.img-div{
    object-fit:cover;
    width:25%;
    float:right;
    margin-top:auto;
    margin-bottom:auto;
}
.img-div img{
    object-fit: cover;
    width:150px;
    max-width:100%;
    height:142px;
    max-height:100%;
}
.price-time{
    width:20%;
    display: flex;
    flex-direction:column;
    justify-content: space-between;
    height:137px;
    max-height:99%;
    padding-right:5px;
}
.text-div{
    width:55%;
    display: flex;
    align-items: center;
    padding-right:5px;
    
}
.h5{
    // color:$orange;
    font-weight:500;
    font-size: 1rem; 
}
.description{
font-weight:300;
}
.title{
   min-width:100%;

}
 .price{
    
    float:right;
    color: $orange;
    font-weight:400;
}
.bi-x:hover{
        background-color: rgb(248, 207, 160);
        color:#fff !important;
}
.bi-x:active{
        background-color: rgb(236, 137, 24);
        border:1px solid rgb(250, 136, 7);
        color:#fff !important;
}


// order details
.details-content p{
    font-family:poppins;
    text-align:left;
    font-weight: 500;
}
.item-details .back-btn i{
    position:absolute;
    left:.8rem;
    color: $orange;
}
.item-details .back-btn i:hover{    
    color:#fff;
    border-radius: 1px solid rgb(236, 137, 24);
}


// order btn
.order-btn a, .order-btn button{
    background-color: $orange;
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 7px;
    // text-align: center;
    text-decoration: none;
    font-size: 16px;
}
.order-btn a:hover{
    background-color: rgb(255, 136, 0);
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 16px;
}
.order-btn a:active{
    background-color: rgb(255, 136, 0);
    border: none;
    color: white;
    padding: 4px 9px;
    border-radius: 10px;
    font-size: 16px;
}
.order-btn {
        display:inline-block;
    }
.order-btn .open{
        display:none;
    }
.order-btn i{
    font-size: 1.3rem;
    cursor:pointer;
}

.inner-shadow {
    box-shadow: inset -5rem 0 0 0 #fff;
}
.inner-right-shadow {
    box-shadow: inset 5rem 0 9px -7px #fff;   
}
.hidden{
    display:none;
}

.zero-height{
    max-height:15rem;
    overflow:scroll;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
    i{
        display:none;
    }
}
//hide scroll bar
.zero-height::-webkit-scrollbar {
  display: none;
}

.ribbon{
    position:absolute;
    width:100%;
    top:14rem;
    display:flex;
    align-items: center;
    justify-content: space-between;
    background: rgba(212, 212, 212, 0.596);
}
.ribon-price{
    color:$orange;
    font-weight:400;
    background:white;
    padding-right:15px;
    padding-left:15px;
    border-radius:7px;
    font-size:1.2rem;
}


//radio btns
input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #e9e7e367;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid rgb(248, 211, 108);
    }

    input[type='radio']:checked:after {
        width: 17px;
        height: 17px;
        border-radius: 15px;
        top: -2px;
        left: 0;
        position: relative;
        background-color: $orange;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 3px solid $orange;
    }

.radio-btns{
    padding: 5px 0;
    height:auto;
    width:auto;
}
.radio-btns label{
    font-size:8pt;
}


//popup div
.pop-up{
    position:relative;
    height:auto;
    margin-right:auto;
    margin-left:auto;
    justify-content: center;
    align-items: center;
    margin-left:auto;
    margin-right:auto;
    max-height:500px;
    width:100%;
    min-width:100%;
    border-radius:15px;
    overflow:hidden;
    transition: transform .5s ease;  
    overflow-y:scroll;
}
.pop-up-img img{
    object-fit: cover;
    min-width:350px;
    max-width:350px;
    max-height:250px;
    min-height:250px;
    object-fit: cover;
}
.back-btn{
    position:absolute;
    font-size:1.5rem;
    left:.5rem;
    top:.5rem;    
    color:rgb(224, 221, 221);
}
.back-btn i:hover{
    background:rgba(243, 138, 2, 0.966);
}
.back-btn i:active{
    border:1px solid rgba(206, 118, 4, 0.966);
    background:rgba(241, 138, 2, 0.993);
    color:#fff;
}
.pop-up-text{
   text-align: center;
}
.blur{
    filter: blur(12px);
}

.active{
    border-bottom: 4px solid $orange;
    width:auto;
    padding-bottom: 5px;
    border-radius:5px;
}
.menu-list{
    text-decoration: none;
    display:flex;
    justify-content: center; 
    padding:10px;   
    min-width: 100%;
    color:#9699a2;
    }

.menu-list:hover{
    text-decoration: none;
    background:rgba(241, 138, 2, 0.993);
    color:#fff;
    }
.menu-list:active{
    background:rgba(221, 134, 20, 0.993);
        color:#fff ;
    }
    .modal ul li{
        padding:0;
        color:#9699a2;
    }
    .modal ul li:hover{
        background:rgba(241, 138, 2, 0.993);
        color:#fff ;
    }
    .modal ul li:active{
        background:rgba(221, 134, 20, 0.993);
        color:#fff ;
    }

    //google translate styles
   body > .skiptranslate {
        position:absolute !important;
        top:-20rem !important;
        height:0;
        display: none;
    }
    .skiptranslate iframe{
        position:fixed !important;
        top:-50rem !important;
        height:0;
        display: none;
    }
    
    .goog-te-gadget{
        overflow:hidden;
        height:40px;
        box-shadow: rgb(230, 228, 223);
    }
    .goog-logo-link{
        display:none;
    }
    .translate-btn{
    position:relative;
    overflow:hidden;
    }
    .translate-btn-inner{
        position:fixed;
        bottom:2.3rem;
        overflow-y:hidden !important;
    }
    .translate-btn-inner select{
       width:100px;
       padding:8px;
       border-radius: 10px;;
    }
.select{
        font-size:.65rem;
    }
/* media queries */
@media only screen and (max-width: 600px) {
    
    .parent-div{
        padding:1rem;
        padding-top:0;
        overflow:hidden;
        margin-top: -2rem;
        }
    .items-panel{
        padding-left:.3rem;
        padding-right:.3rem;        
    }
    .items-panel h5, .items-panel .price, .h5, h5{        
        font-size:.73rem ;
    }
    .items-panel p{        
        font-size:.7rem ;
    }
    .counter{
        padding-bottom:5px;
    }
    .order-btn a, .order-btn i{
        font-size:.7rem;
    }
  .img-div{
    vertical-align:middle;
    padding:.2rem;
    padding-right:0;

    }
  .img-div img{
      max-height:100px;
      width:100px;
     max-width:100%;

    }
    .select{
        font-size:.65rem;
    }
    .header-div p{
        font-size: .7rem;;
    }
    .header-div h5{
        font-size: .9.5rem;;
    }
}

/* media queries */
@media only screen and (max-width: 500px) {
    .cart-preview{
        top:2rem ;
        font-size:.7rem;
        padding:7px;
        margin-right: 0 !important;
        }
    .parent-div{
        padding:1rem;
        padding-top:0;
        overflow:hidden;
        }
.carousel__prev, .carousel__next {
    background-color: $orange !important;
    margin: .3rem;
    margin-right:.3rem;
    top:2.3rem;
}
.slider-div img{
    width:150px;
    height:80px;
    max-width:100%;
    max-height:100%;
}
.items-div{
    width:100%;
    padding:0;
    margin:0;
}
.items-div-inner{
    width:100%;
    padding:.5rem;
    margin:0;
}
.text-div{
    padding-left:5px;
}
  .radio-btns{
    display:none;
    }
    .order-btn{
        padding-top:10px;
    }
    .order-btn .button{
        display:none;
    }
    .order-btn .open{
        display:inline-block;
    }
    .inner-items-div{
        padding-left: 0 !important;
    }

}



</style>