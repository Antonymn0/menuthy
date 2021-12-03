<template>
    <div class="d-flex justify-content-between align-items-center px-5 parent">
             <a class="p-3" href="/">
                <img src="/images/menuthy_logo.svg" class="" width="60%"  alt="menuthy-logo">
            </a>
            <button class="button " style="max-width:8rem;"><a href="/login" class="text-white "> Go to login</a></button>         
    </div>

    <div class="login-block shadow">
        <form action="" class="" enctype="multipart/form-data" @submit.prevent="submitForm()">        
            <h1 pt-1>Tell us about your business</h1>
            <div class="pb-1">
                <label for="restaurnat_name">Business name</label>
                <input type="text"  placeholder="Business name" id="resturant_nane" v-model="form.restaurant_name"/>
                <small class="text-danger text-center">  {{this.errors.restaurant_name}}</small>
            </div>
            <div class="row"> 
                <div class="col-sm-6">
                    <div class="fpb-1">
                        <label for="type">Restaurant type</label>
                        <input type="text" class=" "  placeholder="Restaurant type" id="type" v-model="form.type"/>
                        <small class="text-danger text-center">  {{this.errors.type}}</small>
                    </div>
                </div>
               
                    <div class="col-sm-6">    
                        <div class="fpb-1">
                            <label for="timezone">Timezone</label>
                            <select class="form-select" aria-label="Default select example" v-model="form.timezone" id="timezone">
                                <option  >Select time zone</option>
                                <option v-bind="this.item" v-for="item in timeZones" :key="item">{{item}}</option>
                            </select>
                                <small class="text-danger text-center">  {{this.errors.timezone}}</small>
                        </div>
                    </div>                  
            </div>
            <div class="row">
                <div class="col-sm-6 ">    
                    <div class="pb-1">
                        <label for="timezone">Country</label>
                        <select class="form-select" aria-label="Default select example" v-model="form.selectedCountry" id="country">
                            <option selected >-Select country-</option>
                            <option v-bind="this.item" v-for="item in this.countries" :key="item">{{item}}</option>  
                        </select>
                        <small class="text-danger text-center">  {{this.errors.selectedCountry}}</small>
                    </div>
                </div>
                <div class="col-sm-6 ">    
                    <div class="pb-1">
                        <label for="timezone">Currency</label>
                        <select class="form-select" aria-label="Default select example" v-model="form.currency" id="currency">
                            <option value="#" selected> -Select currency-</option>
                            <option :value="item.code" v-for="item in this.currencies" :key="item"> {{item.code}} : {{item.countryname}} </option>
                        </select>
                        <small class="text-danger text-center">  {{this.errors.currency}}</small>
                    </div>
                </div>
            </div>         
            
<div>
    <country-select />
</div>
            <div>
                <h4 class="mt-5">A little info about yourself</h4>
                <div class="pb-1">
                    <label for="full_name">Full name</label>
                    <input type="text"  placeholder="Full name" id="full_name" v-model="form.full_name" />
                    <small class="text-danger text-center">  {{this.errors.full_name}}</small>
                </div>
                <div class="pb-1">
                    <label for="email">Email</label>
                    <input type="email"  placeholder="Email" id="email" v-model="form.email" @input="this.validateEmail()"/>
                    <small class="text-danger text-center">  {{this.errors.email}}</small>
                </div>    
                              
                <div class="row">
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="password">Password</label>
                        <input type="password"  placeholder="Password" id="password" v-model="form.password"/>
                        <small class="text-danger text-center">  {{this.errors.password}}</small>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="pb-1">
                        <label for="confirm_password">Confirm password</label>
                        <input type="password"  placeholder="Confirm password" id="confirm_password" v-model="form.confirm_password" @input="confirmPassword()" />
                        <small class="text-danger text-center">  {{this.errors.confirm_password}}</small>  
                    </div>
                    </div>
                </div>            
            </div> 
              
            <div class="d-flex align-content-center justify-content-center pt-2">
               <button type="submit" class="m-2 button" style="max-width:8rem;">Register</button>
                <a href="/login" class="text-white button m-2 text-center pt-2" style="max-width:8rem;"> Cancel </a>
            </div> 
             </form>    
           </div>
        
   
</template>

<script>
import vueCountriesCities from "vue-countries-cities";

export default {
    components: {
            vueCountriesCities,

            },
    data(){
        return{
            form:{
                restaurant_name:'',
                type:'',
                timezone:'',
               full_name:'',
               email:'',
               passowrd:'',
               confirm_password:'',
               currency:'',
                selectedCountry: '',      
            },
            regex: /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,24}))$/,
             
             selectedCity: '',
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
            countries:[
                    "Afghanistan",
                    "Albania",
                    "Algeria",
                    "Andorra",
                    "Angola",

                    "Argentina",
                    "Armenia",
                   " Australia",
                    "Austria",
                    "Azerbaijan",
                    
                    "Bahamas",
                   " Bahrain",
                    "Bangladesh",
                    "Barbados",
                    "Belarus",
                    "Belgium",
                    "Belize",
                    "Benin",
                    "Bhutan",
                    "Bolivia",
                   "Bosnia and Herzegovina",
                    "Botswana",
                   "Brazil",
                    "Brunei",
                    "Bulgaria",
                    "Burkina Faso",
                    "Burundi",
                    
                    "Cabo Verde",
                    "Cambodia",
                    "Cameroon",
                    "Canada",
                    "Central African Republic (CAR)",
                    "Chad",
                    "Chile",
                    "China",
                    "Colombia",
                    "Comoros",
                    "Congo",

                    "Costa Rica",
                    "Cote d'Ivoire",
                    "Croatia",
                    "Cuba",
                    "Cyprus",
                    "Czechia",
                    
                    "Denmark",
                    "Djibouti",
                    "Dominica",
                    "Dominican Republic",
                   
                    "Ecuador",
                    "Egypt",
                   " El Salvador",
                    "Equatorial Guinea",
                    "Eritrea",
                    "Estonia",
                    "Eswatini",
                    "Ethiopia",
                    
                    "Fiji",
                    "Finland",
                   " France",
                    
                    "Gabon",
                    "Gambia",
                    "Georgia",
                    "Germany",
                    "Ghana",
                    "Greece",
                    "Grenada",
                    "Guatemala",
                    "Guinea",
                    "Guinea-Bissau",
                    "Guyana",
                    
                    "Haiti",
                    "Honduras",
                    "Hungary",
                    
                    "Iceland",
                    "India",
                    "Indonesia",
                    "Iran",
                    "Iraq",
                    "Ireland",
                    "Israel",
                    "Italy",
                    
                    "Jamaica",
                    "Japan",
                    "Jordan",
                    
                    "Kazakhstan",
                    "Kenya",
                    "Kiribati",
                    "Kosovo",
                   " Kuwait",
                    "Kyrgyzstan",
                    
                    "Laos",
                    "Latvia",
                    "Lebanon",
                    "Lesotho",
                    "Liberia",
                    "Libya",
                    "Liechtenstein",
                    "Lithuania",
                    "Luxembourg",
                    
                    "Madagascar",
                    "Malawi",
                    "Malaysia",
                    "Maldives",
                    "Mali",
                    "Malta",
                    "Marshall Islands",
                    "Mauritania",
                   " Mauritius",
                    "Mexico",
                    "Micronesia",
                    "Moldova",
                    "Monaco",
                    "Mongolia",
                    "Montenegro",
                    "Morocco",
                    "Mozambique",
                    "Myanmar",
                    
                    "Namibia",
                    "Nauru",
                    "Nepal",
                    "Netherlands",
                    "New Zealand",
                   " Nicaragua",
                    "Niger",
                    "Nigeria",
                    "North Korea",
                    "North Macedonia",
                    "Norway",
                    
                    "Oman",
                    
                    "Pakistan",
                    "Palau",
                    "Palestine",
                    "Panama",
                    "Papua New Guinea",
                    "Paragua",
                    "Peru",
                    "Philippines",
                    "Poland",
                    "Portugal",
                    "Qatar",
                    
                    "Romania",
                    "Russia",
                    "Rwanda",
                    
                    "Saint Kitts and Nevis",
                    "Saint Lucia",
                    "Saint Vincent and the Grenadines",
                    "Samoa",
                    "San Marino",
                    "Sao Tome and Principe",
                    "Saudi Arabia",
                    "Senegal",
                    "Serbia",
                    "Seychelles",
                    "Sierra Leone",
                    "Singapore",
                    "Slovakia",
                    "Slovenia",
                    "Solomon Islands",
                    "Somalia",
                    "South Africa",
                    "South Korea",
                    "South Sudan",
                    "Spain",
                    "Sri Lanka",
                    "Sudan",
                    "Suriname",
                    "Sweden",
                    "Switzerland",
                    "Syria",
                    
                    "Taiwan",
                    "Tajikistan",
                    "Tanzania",
                    "Thailand",
                    "Timor-Leste",
                    "Togo",
                    "Tonga",
                    "Trinidad and Tobago",
                    "Tunisia",
                    "Turkey",
                    "Turkmenistan",
                    "Tuvalu",                    
                    "Uganda",
                    "Ukraine",
                    "United Arab Emirates (UAE)",
                    "United Kingdom (UK)",
                    "United States of America (USA)",
                    "Uruguay",
                    "Uzbekistan",                    
                    "Vanuatu",
                    "Vatican City (Holy See)",
                    "Venezuela",
                    "Vietnam",                    
                    "Yemen",                    
                   " Zambia",
                    "Zimbabwe",
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
        submitForm() {
            this.validateForm();
            console.log(this.errors);
            if(Object.keys(this.errors).length) return;
            console.log('No errors in the form...');
            var user_data = new FormData();
                user_data.append('full_name', this.form.full_name);
                user_data.append('email', this.form.email);
                user_data.append('password', this.form.password);
                user_data.append('password_again', this.form.password_again);
                user_data.append('package_type', 'master');          
                
                //Swal.showLoading(),    

            axios.post('api/user', user_data)
            .then( response => {
                if( response.status == 201){                
                    this.storeRestaurant(response.data.data.id); // pass user id to restaurant
                    console.log(response.data);
                } 
            })
            .catch( error => {  
                console.log(error.response.data); 
                 if(error.response.status == 422) {
                     if(error.response.data.errors.email){
                         this.errors.email = error.response.data.errors.email[0];
                         return;
                     } 
                    }
              new Swal({ title: "Error", timer: 2000});                                                                                      
                                       
                });
        },

        storeRestaurant(user_id){
            var restaurant_data = new FormData();
                restaurant_data.append('restaurant_name', this.form.restaurant_name);
                restaurant_data.append('type', this.form.type);
                restaurant_data.append('timezone', this.form.timezone);
                restaurant_data.append('country', this.form.selectedCountry);
                restaurant_data.append('currency', this.form.currency);
                restaurant_data.append('user_id', user_id); // append user id to restaurant

            // register restaurant if user user is successful
            axios.post('api/restaurant', restaurant_data)
            .then( response => {
                if(response.status == 201){
                    new Swal({
                         title: "Success", 
                         timer: 3000,
                         text:"Redirecting to login..."
                         });
                    window.location.href = '/login';
                }
            })
            .catch( error => {
                this.$swal('Failed to create restaurant!');
                console.log(error.response);                    
            });
        },
        validateEmail(){
            if(!this.regex.test(this.form.email)) this.errors.email = 'invalid email!' ;
             else delete this.errors.email;
        },
        confirmPassword(){
            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!' ;
                else delete this.errors.confirm_password; 
        },
        validateForm(){            
            if(!this.form.restaurant_name) this.errors.restaurant_name = 'This field is required!' ;
                else delete this.errors.restaurant_name;  

            if(!this.form.type) this.errors.type = 'This field is required!' ;
                else delete this.errors.type;  

            if(!this.form.timezone) this.errors.timezone = 'This field is required!' ;
                else delete this.errors.timezone; 

            if(!this.form.selectedCountry) this.errors.selectedCountry = 'This field is required!' ;
                else delete this.errors.selectedCountry;  

            if(!this.form.currency) this.errors.currency = 'This field is required!' ;
                else delete this.errors.currency;  

            if(!this.form.full_name) this.errors.full_name = 'This field is required!' ;
                else delete this.errors.full_name;  

            if(!this.form.email) this.errors.email = 'This field is required!' ;
            else delete this.errors.email;

            if(!this.regex.test(this.form.email)) this.errors.email = 'invalid email!' ;
             else delete this.errors.email;

            if(!this.form.password) this.errors.password = 'This field is required!' ;
                else delete this.errors.password;  

            if(!this.form.confirm_password) this.errors.confirm_password = 'This field is required!' ;
                else delete this.errors.confirm_password;  

            if(this.form.password !== this.form.confirm_password) this.errors.confirm_password = 'Password does not match!' ;
                else delete this.errors.confirm_password;  
        },
    },
}
</script>

<style scoped>
  .parent{
    font-family: Montserrat;
  }
.countries-cities{
    height:1rem !important;
    max-height:1rem !important;
    justify-content: space-between!important;
    padding:20px;
}
.countries-cities .select-box{
    border-radius: 15px;
    max-width:49%!important;
    min-width:100px!important;
}
.countries-cities .select-box select {
    border-radius: 15px;
    padding-right: 5px;
    padding-left: 5px;
    max-width: 49%;

}
    
    .login-block {
    width: 50%;
    padding: 20px;
    background: rgba(233, 233, 233, 0);
    border-radius: 5px;
    border-top: 5px solid #ff656c;
    margin: 0 auto;
    margin-bottom: 2rem;

    }
    h4{
        color: rgb(228, 107, 107);
        text-align: center;
    }
    .login-block h1 {
    text-align: center;
    color: rgb(228, 107, 107);
    font-size: 28px;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 20px;
    }
    
    .login-block input {
    width: 100%;
    height: 42px;
    box-sizing: border-box;
    border-radius: 5px;
    border: 1px solid #ccc;
    margin-bottom: 5px;
    font-size: 15px;
    font-family: Montserrat;
    padding-left: .7rem;
    outline: none;
    }    

    .login-block input#password:focus {
        background: #fff 20px bottom no-repeat;
        background-size: 16px 80px;
    }
    
    .login-block input:active, .login-block input:focus .login-block select:focus{
    border: 1px solid #ff656c;
    }
    
    .login-block button, .button {
        width: 100%;
        height: 40px;
        background: #ff656c;
        box-sizing: border-box;
        border-radius: 5px;
        border: 1px solid #e15960;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
        font-family: Montserrat;
        outline: none;
        cursor: pointer;
    }
    
    .login-block button:hover {
    background: #f5414a;
    }
/* media queries */
    @media only screen and (max-width: 900px) {
        .login-block{
            width:80%;
        }
    }
/* media queries */
    @media only screen and (max-width: 700px) {
        .login-block{
            width:98%;
        }
    }

</style>