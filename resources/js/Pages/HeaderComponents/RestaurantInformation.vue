<template>
    <div class="">
        <div class="">
            <!-- <a href="#"  data-toggle="modal" data-target="#exampleModalEditRestaurant" > <i class="bi bi-gear-fill text-white" data-toggle="tooltip" data-placement="bottom" title="Edit restaurant Info"></i></a> -->
            
            <!-- edit restaurant Information modal -->
        <div class="modal fade " id="exampleModalEditRestaurant" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditRestaurantLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Update Restaurant Infomation</h3>
                    <button type="button" class="close" id="closeRestaurant" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body py-2 px-3">
                    <form action="#" enctype="multipart/form-data" @submit.prevent="submitForm()">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Restaurant  name</label>
                            <input type="text" class="form-control p-4"  v-model="form.restaurant_name" id="exampleFormControlInput" placeholder="Restaurant name here...">
                           <small class="text-danger"> {{ errors.restaurant_name}}</small> 
                        </div>
                    
                        <div class="form-group">
                            <label for="maneu-name">Description</label>
                            <textarea  v-model="this.form.description" class="form-control p-3" id="" cols="10" rows="5" placeholer="Description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="maneu-name">Address</label>
                            <input v-model="form.address" class="form-control p-3" id="">
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Country</label>
                                    <input type="text" v-model="form.country"  class="form-control p-4" id="exampleFormControlInput2" placeholder="Country">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">City</label>
                                    <input type="text" class="form-control p-4" v-model="form.city" id="exampleFormControlInput2" placeholder="State">
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Phone</label>
                                    <input type="text" v-model="form.restaurant_phone_number" class="form-control p-4" id="exampleFormControlInput2" placeholder="Phone number">
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput2">Restaurant Email</label>
                                    <input type="email" v-model="form.restaurant_email" class="form-control p-4" id="exampleFormControlInput2" placeholder="Email@example.com" >
                                   <small class="p-1 text-danger">{{ errors.restaurant_email}} </small>                                     
                                </div> 
                            </div>
                        </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleFormControlInput2">Timezone <small class="text-muted">({{form.timezone}}) </small></label>
                                <select class="form-select" aria-label="Default select example" v-model="form.time_zone" >
                                    <option selected >{{form.timezone}}</option>
                                    <option v-bind="this.timezone" v-for="item in timeZones" :key="item">{{item}}</option>   
                                </select>
                            </div> 
                             <div class="pb-1 col-md-6">
                                <label for="timezone">Currency <small class="text-muted"> ( {{form.currency}} )</small></label>
                                <select class="form-select" aria-label="Default select example" v-model="form.currency" id="currency">
                                    <option value="#" selected> {{form.currency}}</option>
                                    <option :value="item.code" v-for="item in this.currencies" :key="item"> {{item.code}} : {{item.countryname}} </option>
                                </select>
                                <small class="text-danger text-center">  {{this.errors.currency}}</small>
                            </div>
                        </div>
                       <div class="mx-auto p-2">
                            <label for="exampleFormControlInputimage">Image* <small class="text-muted"> (Max size 2mb)</small></label>
                            <div class="image-preview mx-auto p-0 m-0 text-center">
                                <img :src="form.img_preview" alt="" >  <br>
                                <input type="file"  name="image" class=" btn-sm btn alert-danger text-white m-2"  id="exampleFormControlInputimage"  placeholder="Preparation time"  @change="fileUpload">
                            </div>    
                            <small class="text-danger"> {{this.errors.image }} </small>              
                        </div>
                        <div class="">
                            <div class="form-group">
                                <label for="exampleFormControlInput2">Website</label>
                                <input type="text" v-model="form.website" class="form-control p-4" id="exampleFormControlInput2" placeholder="Website">
                            </div> 
                        </div>                      
                         
                        <div class="pt-2">
                            <h4>Social accounts</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Facebook</label>
                                        <i class="bi bi-facebook p-2"></i>
                                        <input type="text" v-model="form.facebook" class="form-control p-4 " name="facebook" id="exampleFormControlInput2" placeholder="Facebook">
                                        <small class="text-danger">{{this.errors.facebook}}</small>
                                    </div> 
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Twitter</label>
                                        <i class="bi bi-twitter p-2"></i>
                                        <input type="text" v-model="form.twitter" class="form-control p-4" name="twitter" id="exampleFormControlInput2" placeholder="Twitter">
                                        <small class="text-danger">{{this.errors.twitter}}</small>
                                    </div> 
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label for="exampleFormControlInput2">Youtube</label>
                                        <i class="bi bi-youtube p-2"></i>
                                        <input type="text" v-model="form.youtube" class="form-control p-4" name="youtube" id="exampleFormControlInput2" placeholder="Youtube">
                                        <small class="text-danger">{{this.errors.youtube}}</small>
                                    </div> 
                                    <div>
                                        <input type="hidden" v-model="form.user_id" name="user_id">                                   
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput2">Instagram</label>
                                        <i class="bi bi-instagram p-2"></i>
                                        <input type="text" v-model="form.instagram" class="form-control p-4" name="instagram" id="exampleFormControlInput2" placeholder="Instagram">
                                        <small class="text-danger">{{this.errors.instagram}}</small>
                                    </div>                                     
                                </div>
                            </div>
                        </div>                         
                        <div class="d-flex justify-content-center">
                          <button type="submit" class="btn primary-btn btn-lg m-1" >Update</button>
                          <button type="button" class="btn btn-default btn-lg m-1" >Cancel</button> <br>
                           
                      </div>
                     <p v-if="Object.keys(this.errors).length" class="text-danger text-center p-2"> Errors in the form! </p>
                    </form>
                </div>                
                </div>
            </div>
        </div> 
        </div>

    </div>
</template>

<script>
import { defineComponent } from '@vue/runtime-core';
defineComponent
export default {
    props:['restaurant', 'user'],
    data() {
        return{
            restaurant:window.authRestaurant,
            user: window.authRestaurant,
            form:{
                restaurant_name: '',
               user_id:'' ,
               restaurant_id:'' ,
                address:'',
                country:'',
                city:'',
                description:'',
                restaurant_phone_number:'',
                restaurant_email:'',
                website:'',
                timezone:'',
                facebook:'',
                instagram:'',
                twitter:'',
                youtube:'',
                currency:'',
                img_preview:''
            },            
            errors:{},
             timeZones:[
                  'GMT	Greenwich Mean Time	GMT',
                  'UTC	Universal Coordinated Time	GMT',
                  'ECT	European Central Time	GMT+1:00',
                  'EET	Eastern European Time	GMT+2:00',
                  'ART	(Arabic) Egypt Standard Time	GMT+2:00',
                  'EAT	Eastern African Time	GMT+3:00',
                  'MET	Middle East Time	GMT+3:30',
                  'NET	Near East Time	GMT+4:00',
                  'PLT	Pakistan Lahore Time	GMT+5:00',
                  'IST	India Standard Time	GMT+5:30',
                  'BST	Bangladesh Standard Time	GMT+6:00',
                  'VST	Vietnam Standard Time	GMT+7:00',
                  'CTT	China Taiwan Time	GMT+8:00',
                  'JST	Japan Standard Time	GMT+9:00',
                  'ACT	Australia Central Time	GMT+9:30',
                  'AET	Australia Eastern Time	GMT+10:00',
                  'SST	Solomon Standard Time	GMT+11:00',
                  'NST	New Zealand Standard Time	GMT+12:00',
                  'MIT	Midway Islands Time	GMT-11:00',
                  'HST	Hawaii Standard Time	GMT-10:00',
                  'AST	Alaska Standard Time	GMT-9:00',
                  'PST	Pacific Standard Time	GMT-8:00',
                  'PNT	Phoenix Standard Time	GMT-7:00',
                  'MST	Mountain Standard Time	GMT-7:00',
                  'CST	Central Standard Time	GMT-6:00',
                  'EST	Eastern Standard Time	GMT-5:00',
                  'IET	Indiana Eastern Standard Time	GMT-5:00',
                  'PRT	Puerto Rico and US Virgin Islands Time	GMT-4:00',
                  'CNT	Canada Newfoundland Time	GMT-3:30',
                  'AGT	Argentina Standard Time	GMT-3:00',
                  'BET	Brazil Eastern Time	GMT-3:00',
                  'CAT	Central African Time	GMT-1:00',
                  ],
            currencies:[
                {'code': 'AFN',
                    'countryname': 'Afghanistan',
                    'name': 'Afghanistan Afghani',
                    'symbol': '&#1547;'},

                {'code': 'ARS',
                    'countryname': 'Argentina',
                    'name': 'Argentine Peso',
                    'symbol': '&#36;'},

                {'code': 'AWG',
                    'countryname': 'Aruba',
                    'name': 'Aruban florin',
                    'symbol': '&#402;'},

                {'code': 'AUD',
                    'countryname': 'Australia',
                    'name': 'Australian Dollar',
                    'symbol': '&#65;&#36;'},

                {'code': 'AZN',
                    'countryname': 'Azerbaijan',
                    'name': 'Azerbaijani Manat',
                    'symbol': '&#8380;'},

                {'code': 'BSD',
                    'countryname': 'The Bahamas',
                    'name': 'Bahamas Dollar',
                    'symbol': '&#66;&#36;'},

                {'code': 'BBD',
                    'countryname': 'Barbados',
                    'name': 'Barbados Dollar',
                    'symbol': '&#66;&#100;&#115;&#36;'},

                {'code': 'BDT',
                    'countryname': 'People\'s Republic of Bangladesh',
                    'name': 'Bangladeshi taka',
                    'symbol': '&#2547;'},

                {'code': 'BYN',
                    'countryname': 'Belarus',
                    'name': 'Belarus Ruble',
                    'symbol': '&#66;&#114;'},

                {'code': 'BZD',
                    'countryname': 'Belize',
                    'name': 'Belize Dollar',
                    'symbol': '&#66;&#90;&#36;'},

                {'code': 'BMD',
                    'countryname': 'British Overseas Territory of Bermuda',
                    'name': 'Bermudian Dollar',
                    'symbol': '&#66;&#68;&#36;'},

                {'code': 'BOP',
                    'countryname': 'Bolivia',
                    'name': 'Boliviano',
                    'symbol': '&#66;&#115;'},

                {'code': 'BAM',
                    'countryname': 'Bosnia and Herzegovina',
                    'name': 'Bosnia-Herzegovina Convertible Marka',
                    'symbol': '&#75;&#77;'},

                {'code': 'BWP',
                    'countryname': 'Botswana',
                    'name': 'Botswana pula',
                    'symbol': '&#80;'},

                {'code': 'BGN',
                    'countryname': 'Bulgaria',
                    'name': 'Bulgarian lev',
                    'symbol': '&#1083;&#1074;'},

                {'code': 'BRL',
                    'countryname': 'Brazil',
                    'name': 'Brazilian real',
                    'symbol': '&#82;&#36;'},

                {'code': 'BND',
                    'countryname': 'Sultanate of Brunei',
                    'name': 'Brunei dollar',
                    'symbol': '&#66;&#36;'},

                {'code': 'KHR',
                    'countryname': 'Cambodia',
                    'name': 'Cambodian riel',
                    'symbol': '&#6107;'},

                {'code': 'CAD',
                    'countryname': 'Canada',
                    'name': 'Canadian dollar',
                    'symbol': '&#67;&#36;'},

                {'code': 'KYD',
                    'countryname': 'Cayman Islands',
                    'name': 'Cayman Islands dollar',
                    'symbol': '&#36;'},

                {'code': 'CLP',
                    'countryname': 'Chile',
                    'name': 'Chilean peso',
                    'symbol': '&#36;'},

                {'code': 'CNY',
                    'countryname': 'China',
                    'name': 'Chinese Yuan Renminbi',
                    'symbol': '&#165;'},

                {'code': 'COP',
                    'countryname': 'Colombia',
                    'name': 'Colombian peso',
                    'symbol': '&#36;'},

                {'code': 'CRC',
                    'countryname': 'Costa Rica',
                    'name': 'Costa Rican colón',
                    'symbol': '&#8353;'},

                {'code': 'HRK',
                    'countryname': 'Croatia',
                    'name': 'Croatian kuna',
                    'symbol': '&#107;&#110;'},

                {'code': 'CUP',
                    'countryname': 'Cuba',
                    'name': 'Cuban peso',
                    'symbol': '&#8369;'},

                {'code': 'CZK',
                    'countryname': 'Czech Republic',
                    'name': 'Czech koruna',
                    'symbol': '&#75;&#269;'},

                {'code': 'DKK',
                    'countryname': 'Denmark, Greenland, and the Faroe Islands',
                    'name': 'Danish krone',
                    'symbol': '&#107;&#114;'},

                {'code': 'DOP',
                    'countryname': 'Dominican Republic',
                    'name': 'Dominican peso',
                    'symbol': '&#82;&#68;&#36;'},

                 {'code': 'XCD',
                    'countryname': 'Antigua and Barbuda, Commonwealth of Dominica, Grenada',
                    'name': 'Eastern Caribbean dollar',
                    'symbol': '&#36;'},

                {'code': 'XCD',
                    'countryname':  'Montserrat, St. Kitts and Nevis, Saint Lucia and St. Vincent and the Grenadines',
                    'name': 'Eastern Caribbean dollar',
                    'symbol': '&#36;'},

                {'code': 'EGP',
                    'countryname': 'Egypt',
                    'name': 'Egyptian pound',
                    'symbol': '&#163;'},

                {'code': 'SVC',
                    'countryname': 'El Salvador',
                    'name': 'Salvadoran colón',
                    'symbol': '&#36;'},

                {'code': 'EEK',
                    'countryname': 'Estonia',
                    'name': 'Estonian kroon',
                    'symbol': '&#75;&#114;'},

                {'code': 'EUR',
                    'countryname': 'European Union',
                    'name': 'Euro',
                    'symbol': '&#8364;'},

                {'code': 'FKP',
                    'countryname': 'Falkland Islands',
                    'name': 'Falkland Islands {Malvinas} Pound',
                    'symbol': '&#70;&#75;&#163;'},

                {'code': 'FJD',
                    'countryname': 'Fiji',
                    'name': 'Fijian dollar',
                    'symbol': '&#70;&#74;&#36;'},

                {'code': 'GHC',
                    'countryname': 'Ghana',
                    'name': 'Ghanaian cedi',
                    'symbol': '&#71;&#72;&#162;'},

                {'code': 'GIP',
                    'countryname': 'Gibraltar',
                    'name': 'Gibraltar pound',
                    'symbol': '&#163;'},

                {'code': 'GTQ',
                    'countryname': 'Guatemala',
                    'name': 'Guatemalan quetzal',
                    'symbol': '&#81;'},

                    {'code': 'GGP',
                    'countryname': 'Guernsey',
                    'name': 'Guernsey pound',
                    'symbol': '&#81;'},

                    {'code': 'GYD',
                    'countryname': 'Guyana',
                    'name': 'Guyanese dollar',
                    'symbol': '&#71;&#89;&#36;'},

                {'code': 'HNL',
                    'countryname': 'Honduras',
                    'name': 'Honduran lempira',
                    'symbol': '&#76;'},

                {'code': 'HKD',
                    'countryname': 'Hong Kong',
                    'name': 'Hong Kong dollar',
                    'symbol': '&#72;&#75;&#36;'},

                {'code': 'HUF',
                    'countryname': 'Hungary',
                    'name': 'Hungarian forint',
                    'symbol': '&#70;&#116;'},

                {'code': 'ISK',
                    'countryname': 'Iceland',
                    'name': 'Icelandic króna',
                    'symbol': '&#237;&#107;&#114;'},

                {'code': 'INR',
                    'countryname': 'India',
                    'name': 'Indian rupee',
                    'symbol': '&#8377;'},

                    {'code': 'IDR',
                    'countryname': 'Indonesia',
                    'name': 'Indonesian rupiah',
                    'symbol': '&#82;&#112;'},

                    {'code': 'IRR',
                    'countryname': 'Iran',
                    'name': 'Iranian rial',
                    'symbol': '&#65020;'},

                    {'code': 'IMP',
                    'countryname': 'Isle of Man',
                    'name': 'Manx pound',
                    'symbol': '&#163;'},

                    {'code': 'ILS',
                    'countryname': 'Israel, Palestinian territories of the West Bank and the Gaza Strip',
                    'name': 'Israeli Shekel',
                    'symbol': '&#8362;'},

                    {'code': 'JMD',
                    'countryname': 'Jamaica',
                    'name': 'Jamaican dollar',
                    'symbol': '&#74;&#36;'},

                    {'code': 'JPY',
                    'countryname': 'Japan',
                    'name': 'Japanese yen',
                    'symbol': '&#165;'},

                {'code': 'JEP',
                    'countryname': 'Jersey',
                    'name': 'Jersey pound',
                    'symbol': '&#163;'},

                {'code': 'KZT',
                    'countryname': 'Kazakhstan',
                    'name': 'Kazakhstani tenge',
                    'symbol': '&#8376;'},

                {'code': 'KPW',
                    'countryname': 'North Korea',
                    'name': 'North Korean won',
                    'symbol': '&#8361;'},

                {'code': 'KPW',
                    'countryname': 'South Korea',
                    'name': 'South Korean won',
                    'symbol': '&#8361;'},

                {'code': 'KGS',
                    'countryname': 'Kyrgyz Republic',
                    'name': 'Kyrgyzstani som',
                    'symbol': '&#1083;&#1074;'},

                    {'code': 'LAK',
                    'countryname': 'Laos',
                    'name': 'Lao kip',
                    'symbol': '&#8365;'},

                    {'code': 'LAK',
                    'countryname': 'Laos',
                    'name': 'Latvian lats',
                    'symbol': '&#8364;'},

                    {'code': 'LVL',
                    'countryname': 'Laos',
                    'name': 'Latvian lats',
                    'symbol': '&#8364;'},

                    {'code': 'LBP',
                    'countryname': 'Lebanon',
                    'name': 'Lebanese pound',
                    'symbol': '&#76;&#163;'},

                    {'code': 'LRD',
                    'countryname': 'Liberia',
                    'name': 'Liberian dollar',
                    'symbol': '&#76;&#68;&#36;'},

                        {'code': 'LTL',
                    'countryname': 'Lithuania',
                    'name': 'Lithuanian litas',
                    'symbol': '&#8364;'},

                {'code': 'MKD',
                    'countryname': 'North Macedonia',
                    'name': 'Macedonian denar',
                    'symbol': '&#1076;&#1077;&#1085;'},

                {'code': 'MYR',
                    'countryname': 'Malaysia',
                    'name': 'Malaysian ringgit',
                    'symbol': '&#82;&#77;'},

                {'code': 'MUR',
                    'countryname': 'Mauritius',
                    'name': 'Mauritian rupee',
                    'symbol': '&#82;&#115;'},

                {'code': 'MXN',
                    'countryname': 'Mexico',
                    'name': 'Mexican peso',
                    'symbol': '&#77;&#101;&#120;&#36;'},

                    {'code': 'MNT',
                    'countryname': 'Mongolia',
                    'name': 'Mongolian tögrög',
                    'symbol': '&#8366;'},


                    {'code': 'MZN',
                    'countryname': 'Mozambique',
                    'name': 'Mozambican metical',
                    'symbol': '&#77;&#84;'},

                    {'code': 'NAD',
                    'countryname': 'Namibia',
                    'name': 'Namibian dollar',
                    'symbol': '&#78;&#36;'},

                    {'code': 'NPR',
                    'countryname': 'Federal Democratic Republic of Nepal',
                    'name': 'Nepalese rupee',
                    'symbol': '&#82;&#115;&#46;'},

                    {'code': 'ANG',
                    'countryname': 'Curaçao and Sint Maarten',
                    'name': 'Netherlands Antillean guilder',
                    'symbol': '&#402;'},

                    {'code': 'NZD',
                    'countryname': 'New Zealand, the Cook Islands, Niue, the Ross Dependency, Tokelau, the Pitcairn Islands',
                    'name': 'New Zealand dollar',
                    'symbol': '&#36;'},


                {'code': 'NIO',
                    'countryname': 'Nicaragua',
                    'name': 'Nicaraguan córdoba',
                    'symbol': '&#67;&#36;'},

                {'code': 'NGN',
                    'countryname': 'Nigeria',
                    'name': 'Nigerian naira',
                    'symbol': '&#8358;'},

                    {'code': 'NOK',
                    'countryname': 'Norway and its dependent territories',
                    'name': 'Norwegian krone',
                    'symbol': '&#107;&#114;'},

                    {'code': 'OMR',
                    'countryname': 'Oman',
                    'name': 'Omani rial',
                    'symbol': '&#65020;'},

                    {'code': 'PKR',
                    'countryname': 'Pakistan',
                    'name': 'Pakistani rupee',
                    'symbol': '&#82;&#115;'},

                    {'code': 'PAB',
                    'countryname': 'Panama',
                    'name': 'Panamanian balboa',
                    'symbol': '&#66;&#47;&#46;'},

                    {'code': 'PYG',
                    'countryname': 'Paraguay',
                    'name': 'Paraguayan Guaraní',
                    'symbol': '&#8370;'},

                {'code': 'PEN',
                    'countryname': 'Peru',
                    'name': 'Sol',
                    'symbol': '&#83;&#47;&#46;'},

                {'code': 'PHP',
                    'countryname': 'Philippines',
                    'name': 'Philippine peso',
                    'symbol': '&#8369;'},

                    {'code': 'PLN',
                    'countryname': 'Poland',
                    'name': 'Polish złoty',
                    'symbol': '&#122;&#322;'},

                    {'code': 'QAR',
                    'countryname': 'State of Qatar',
                    'name': 'Qatari Riyal',
                    'symbol': '&#65020;'},

                    {'code': 'RON',
                    'countryname': 'Romania',
                    'name': 'Romanian leu {Leu românesc}',
                    'symbol': '&#76;'},

                    {'code': 'RUB',
                    'countryname': 'Russian Federation, Abkhazia and South Ossetia, Donetsk and Luhansk',
                    'name': 'Russian ruble',
                    'symbol': '&#8381;'},


                {'code': 'SHP',
                    'countryname': 'Saint Helena, Ascension and Tristan da Cunha',
                    'name': 'Saint Helena pound',
                    'symbol': '&#163;'},

                    {'code': 'SAR',
                    'countryname': 'Saudi Arabia',
                    'name': 'Saudi riyal',
                    'symbol': '&#65020;'},

                    {'code': 'RSD',
                    'countryname': 'Serbia',
                    'name': 'Serbian dinar',
                    'symbol': '&#100;&#105;&#110;'},

                    {'code': 'SCR',
                    'countryname': 'Seychelles',
                    'name': 'Seychellois rupee',
                    'symbol': '&#82;&#115;'},

                {'code': 'SGD',
                    'countryname': 'Singapore',
                    'name': 'Singapore dollar',
                    'symbol': '&#83;&#36;'},

                    {'code': 'SBD',
                    'countryname': 'Solomon Islands',
                    'name': 'Solomon Islands dollar',
                    'symbol': '&#83;&#73;&#36;'},

                    {'code': 'SOS',
                    'countryname': 'Somalia',
                    'name': 'Somali shilling',
                    'symbol': '&#83;&#104;&#46;&#83;&#111;'},

                    {'code': 'ZAR',
                    'countryname': 'South Africa',
                    'name': 'South African rand',
                    'symbol': '&#82;'},

                    {'code': 'LKR',
                    'countryname': 'Sri Lanka',
                    'name': 'Sri Lankan rupee',
                    'symbol': '&#82;&#115;'},


                    {'code': 'SEK',
                    'countryname': 'Sweden',
                    'name': 'Swedish krona',
                    'symbol': '&#107;&#114;'},


                    {'code': 'CHF',
                    'countryname': 'Switzerland',
                    'name': 'Swiss franc',
                    'symbol': '&#67;&#72;&#102;'},

                {'code': 'SRD',
                    'countryname': 'Suriname',
                    'name': 'Suriname Dollar',
                    'symbol': '&#83;&#114;&#36;'},

                    {'code': 'SYP',
                    'countryname': 'Syria',
                    'name': 'Syrian pound',
                    'symbol': '&#163;&#83;'},

                    {'code': 'TWD',
                    'countryname': 'Taiwan',
                    'name': 'New Taiwan dollar',
                    'symbol': '&#78;&#84;&#36;'},


                    {'code': 'THB',
                    'countryname': 'Thailand',
                    'name': 'Thai baht',
                    'symbol': '&#3647;'},


                    {'code': 'TTD',
                    'countryname': 'Trinidad and Tobago',
                    'name': 'Trinidad and Tobago dollar',
                    'symbol': '&#84;&#84;&#36;'},


                {'code': 'TRY',
                    'countryname': 'Turkey, Turkish Republic of Northern Cyprus',
                    'name': 'Turkey Lira',
                    'symbol': '&#8378;'},

                {'code': 'TVD',
                    'countryname': 'Tuvalu',
                    'name': 'Tuvaluan dollar',
                    'symbol': '&#84;&#86;&#36;'},

                {'code': 'UAH',
                    'countryname': 'Ukraine',
                    'name': 'Ukrainian hryvnia',
                    'symbol': '&#8372;'},


                {'code': 'GBP',
                    'countryname': 'United Kingdom, Jersey, Guernsey, the Isle of Man', 
                    'name': 'Pound sterling',
                    'symbol': '&#163;'},

                {'code': 'GBP',
                    'countryname': 'Gibraltar, South Georgia and the South Sandwich Islands', 
                    'name': 'Pound sterling',
                    'symbol': '&#163;'},

                {'code': 'GBP',
                    'countryname': 'the British Antarctic Territory, and Tristan da Cunha', 
                    'name': 'Pound sterling',
                    'symbol': '&#163;'},


                {'code': 'UGX',
                    'countryname': 'Uganda',
                    'name': 'Ugandan shilling',
                    'symbol': '&#85;&#83;&#104;'},

                {'code': 'KES',
                    'countryname': 'Kenya',
                    'name': 'Kenyan shilling',
                    'symbol': '&#85;&#83;&#104;'},

                {'code': 'TSH',
                    'countryname': 'Tanzania',
                    'name': 'Tanzanian shilling',
                    'symbol': '&#85;&#83;&#104;'},


                {'code': 'USD',
                    'countryname': 'United States',
                    'name': 'United States dollar',
                    'symbol': '&#36;'},

                {'code': 'UYU',
                    'countryname': 'Uruguayan',
                    'name': 'Peso Uruguayolar',
                    'symbol': '&#36;&#85;'},

                    {'code': 'UZS',
                    'countryname': 'Uzbekistan',
                    'name': 'Uzbekistani soʻm',
                    'symbol': '&#1083;&#1074;'},


                    {'code': 'VEF',
                    'countryname': 'Venezuela',
                    'name': 'Venezuelan bolívar',
                    'symbol': '&#66;&#115;'},


                    {'code': 'VND',
                    'countryname': 'Vietnam',
                    'name': 'Vietnamese dong (Đồng)',
                    'symbol': '&#8363;'},

                    {'code': 'VND',
                    'countryname': 'Yemen',
                    'name': 'Yemeni rial',
                    'symbol': '&#65020;'},

                {'code': 'ZWD',
                    'countryname': 'Zimbabwe',
                    'name': 'Zimbabwean dollar',
                    'symbol': '&#90;&#36;'},
                    ],
        }
    },
    methods:{
        submitForm () {
            this.validateForm();
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var form_data = new FormData();
                form_data.append('restaurant_name', this.form.restaurant_name);
                form_data.append('user_id', this.form.user_id);
                form_data.append('address', this.form.address);
                form_data.append('description', this.form.description);
                form_data.append('country', this.form.country);
                form_data.append('city', this.form.city);
                form_data.append('restaurant_phone_number', this.form.restaurant_phone_number);
                if(this.form.restaurant_email) form_data.append('restaurant_email', this.form.restaurant_email);
                form_data.append('currency', this.form.currency);
                form_data.append('website', this.form.website);
                form_data.append('timezone', this.form.timezone);
                form_data.append('facebook', this.form.facebook);
                form_data.append('instagram', this.form.instagram);
                form_data.append('youtube', this.form.youtube);
                form_data.append('twitter', this.form.twitter); 
                if(this.form.image) form_data.append('image', this.form.image);
                form_data.append('_method', 'PUT');

                Swal.showLoading();
            axios.post('/api/restaurant/' + this.form.restaurant_id, form_data)
            .then( response => {
            if( response.status = 200){
                document.getElementById('closeRestaurant').click();
                new Swal({ title: "Success!",timer: 1500  });
                } 
            })
            .catch( error => {
                Swal.close();
                if(error.response.status == 422) {
                    if(error.response.data.errors.email){
                        this.errors.email = error.response.data.errors.email[0];
                        return;                    } 
                }
               this.$swal('Failed to update!');
                console.log(error.response);                    
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
            if(!this.form.restaurant_name) this.errors.restaurant_name = 'Restaurant name field is required' ;
            else delete this.errors.restaurant_name; 

            if(!this.form.restaurant_email) this.errors.restaurant_email = 'Restaurant Email field is required' ;
            else delete this.errors.restaurant_email; 

            if(!this.form.currency) this.errors.currency = 'Currency field is required' ;
            else delete this.errors.currency;  

            if(this.form.restaurant_email){
                var is_valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.form.restaurant_email);
                if(!is_valid){
                    this.errors.restaurant_email = 'Invalid Email address' ;
                }else{
                   delete this.errors.restaurant_email;  
                }
            } 

            delete this.errors.facebook;
            delete this.errors.youtube;
            delete this.errors.instagram;
            delete this.errors.twitter;
            if(this.form.facebook !== ''  && this.form.facebook !== 'null' && this.form.facebook !== null) {                                    
                if(! /^(https?:\/\/)?((w{3}\.)?)facebook.com\/.*/i.test(this.form.facebook)) this.errors.facebook ="Invalid link";
                else delete this.errors.facebook;              
            }           
            if(this.form.youtube !== '' && this.form.youtube !== 'null' && this.form.youtube !== null) {                                   
                if(! /^(https?:\/\/)?((w{3}\.)?)youtube.com\/.*/i.test(this.form.youtube)) this.errors.youtube ="Invalid link";
                else delete this.errors.youtube;               
            }           
            if(this.form.instagram !== ''  && this.form.instagram !== 'null' && this.form.instagram !== null) {                                    
                if(! /^(https?:\/\/)?((w{3}\.)?)instagram.com\/.*/i.test(this.form.instagram)) this.errors.instagram ="Invalid link";
                else delete this.errors.instagram;             
            }           
            if(this.form.twitter !== ''  && this.form.twitter !== 'null' && this.form.twitter !== null) {                
                if(! /^(https?:\/\/)?((w{3}\.)?)twitter.com\/.*/i.test(this.form.twitter)) this.errors.twitter ="Invalid link";
                else delete this.errors.twitter;              
            } 
            console.log((this.form.twitter))  ;        
                  
        } 
        
    },
    mounted(){
        this.form.restaurant_name = window.authRestaurant.restaurant_name;
        this.form.user_id = window.authUser.id;
        this.form.restaurant_id = window.authRestaurant.id;

        if(window.authRestaurant.address !== 'null') this.form.address = window.authRestaurant.address;
        if(window.authRestaurant.city !== 'null') this.form.country = window.authRestaurant.country;
        if(window.authRestaurant.city !== 'null') this.form.city = window.authRestaurant.city;
        if(window.authRestaurant.restaurant_phone_number !== 'null') this.form.restaurant_phone_number = window.authRestaurant.restaurant_phone_number;
        if(window.authRestaurant.restaurant_email !== 'null') this.form.restaurant_email = window.authRestaurant.restaurant_email;
        if(window.authRestaurant.website !== 'null') this.form.website = window.authRestaurant.website;
        if(window.authRestaurant.timezone !== 'null') this.form.timezone = window.authRestaurant.timezone;
        if(window.authRestaurant.currency !== 'null') this.form.currency = window.authRestaurant.currency;
        if(window.authRestaurant.description !== 'null')this.form.description = window.authRestaurant.description;
        if(  window.authRestaurant.facebook !== 'null') this.form.facebook = window.authRestaurant.facebook;
        if(window.authRestaurant.twitter !== 'null') this.form.twitter = window.authRestaurant.twitter;
        if(window.authRestaurant.instagram !== 'null') this.form.instagram = window.authRestaurant.instagram;
        if(window.authRestaurant.youtube !== 'null') this.form.youtube = window.authRestaurant.youtube;
        if(window.authRestaurant.image !== 'null') this.form.img_preview = window.authRestaurant.image;
    }
    
}
    
    

</script>

<style scoped lang="scss">
@import "../../../sass/app.scss";

.main-sub-menu{
    font-size:1.2rem;
}
    .primary-btn{
        background-color: $primary-button;
        color: #fff;
    }
    .btn:hover, .btn:active{
        background-color: $primary-button;
        color: #fff;
    }
    .menu-card{
        width:24%;
        height:auto;
        max-width:98%;
        margin: .5rem .1rem;
    }

    h3{
        color: $primary-button;
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

    /* media quesries */
    @media only screen and (max-width: 900px) {
    .menu-card{
        width:30%;
    }
    }
    @media only screen and (max-width: 750px) {
    .menu-card{
        width:50%;
    }
    }
    @media only screen and (max-width: 600px) {
    .menu-card{
        width:100%;
    }
    }


</style>
