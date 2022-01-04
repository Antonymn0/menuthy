<template>
 <div >
        <Header />
        <TopNavbar />        
    </div> 
<div class="parent">       
        <div class="">
            <div class="header text-center">
                <h1> How much does Menuthy cost? </h1> 
                <p class="text-muted">There is a reason why we are the best in the market. </p> 
            </div>

             <div class="text-center pt-2">
                <p> <span>  Pay with: </span> <span><img src="/images/stripe_logo.png" class="" style="width:62px"  alt="stripe-logo"></span></p>
            </div>

        <div class="fade-in"> 
            <div class="bill-period mx-auto pt-5"> 
                <div class="px-1" >
                    <p class="yearly shadow active-yearly" 
                    @click.prevent="[toggleYearlyTabs($event, 'monthly'), 
                        updatePackagePrice(33, 66, 133,266),
                        updatePeriod('monthly')                     
                      ]" style="cursor:pointer"> <span><i class="bi bi-check"></i> </span> Billed Monthly</p>
                </div>
                <div class="px-1" >
                    <p class="yearly shadow "  
                    @click.prevent="[toggleYearlyTabs($event, 'yearly'), 
                     updatePackagePrice(333, 777, 1333, 2777),
                     updatePeriod('yearly')
                    ]" style="cursor:pointer">  <span ><i class="bi bi-check"></i> </span>  Billed Yearly </p>
                </div>
            </div>
            <p class="mx-auto w-auto text-center  table-responsive"> <b> Your current subscription </b> <br>
                <table class="table-sm w-auto mx-auto table-striped border table-bordered rounded p-3" style="background-color:rgb(239 236 236);                    ">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Package type</th>
                        <th>Period</th>
                        <th>Subscription date</th>
                        <th>Expiry date</th>
                    </tr>
                    <tr>
                        <td>{{capitalize(this.user.first_name)}} {{capitalize(this.user.last_name)}}</td>
                        <td>{{this.user.email}}</td>

                        <td v-if="this.user.registration_status !== 'trial' ">{{capitalize(this.user.package_type)}}</td>
                        <td v-else>{{capitalize(this.user.registration_status)}}</td>

                        <td> {{capitalize(this.user.package_period)}}</td>
                        <td>{{formatDate(this.user.registration_date)}}</td>

                        <td v-if="this.user.registration_status !== 'trial' ">{{formatDate(this.user.registration_expiry)}}</td>
                        <td v-else>{{formatDate(this.user.trial_expiry)}}</td>
                    </tr>
                </table>

            </p>
<!-- ------------------------ Monthly package panels------------------------------------------ -->
        <div class="monthly-panels  ">            
            <div class="packages py-3 mt-4">
                 <p class="py-2 pb-3 text-center mx-auto mb-0" style="font-weight:500; font-size:20px;">Billed {{this.plan_period}}</p>
                <div class="packages-inner py-2  ">                    
                    <div > 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Starter</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.starter.price}}</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="d-table text-left mx-auto"> 
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code Menu </span>  <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Admin Dashboard </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Menu Management </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> 24/7 Online Support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Multi language support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span> Dine-in Orders </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span> Kitchen Order Management </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span> Cloud POS </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span> Drive-Thru Orders </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Delivery + Driver App </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Accept online payments</span> <br>
                            </p>                           
                            <p class="pt-3"> <button @click.prevent="stripeCheckout(this.starter)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                            <p class="text-muted"> <small>One-Time  Setup fee of 200 QAR applicable </small>  </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow "> 
                            <h4 class="pb-4 mb-3  pt-1 text-dark "> <span class="text-right  " style="position:relative; margin-left:20% "> Lite </span>  <span class="m-0  px-4  float-right recomended"> Recommended</span></h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.lite.price}}</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="d-table text-left mx-auto"> 
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code Menu </span>  <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Admin Dashboard </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Menu Management </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> 24/7 Online Support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Multi language support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Dine-in Orders </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Kitchen Order Management </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Cloud POS </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span> Drive-Thru Orders </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Delivery + Driver App </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Accept online payments</span> <br>
                            </p>
                            <p class="pt-3"> 
                                <button  @click.prevent="stripeCheckout(this.lite)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe</h5>  </button> 
                                </p>
                            <p class="text-muted"> <small>One-Time  Setup fee of 200 QAR applicable </small>  </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Pro</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency" >QAR</span>
                                <span class="amount">{{this.pro.price}}</span>
                                <span class="period">/Month</span>                              
                            </p>
                           <p class="d-table text-left mx-auto"> 
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code Menu </span>  <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Admin Dashboard </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Menu Management </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> 24/7 Online Support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Multi language support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Dine-in Orders </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Kitchen Order Management </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Cloud POS </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Drive-Thru Orders </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Delivery + Driver App </span> <br>
                               <span><i class="bi bi-x"></i> </span> <span>  Accept online payments</span> <br>
                            </p>
                            <p class="pt-3"> <button @click.prevent="stripeCheckout(this.pro)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                            <p class="text-muted"> <small>One-Time  Setup fee of 200 QAR applicable </small>  </p>
                        </div>
                    </div>
                    <div> 
                    <div class="shadow"> 
                        <h4 class="pb-4 mb-3 pt-1 text-dark"> Premium</h4>
                        <p class="ty-1 price mb-0"> 
                            <span class="currency" >QAR</span>
                            <span class="amount">{{this.premium.price}}</span>
                            <span class="period">/Month</span>                              
                        </p>
                        <p class="d-table text-left mx-auto"> 
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code Menu </span>  <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Admin Dashboard </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Menu Management </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> 24/7 Online Support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> Multi language support </span> <br>
                               <span><i class="bi bi-check-lg"></i>  </span> <span> QR Code </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Dine-in Orders </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Kitchen Order Management </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Cloud POS </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span> Drive-Thru Orders </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span>  Delivery + Driver App </span> <br>
                               <span><i class="bi bi-check-lg"></i> </span> <span>  Accept online payments</span> <br>
                        </p>
                        <p class="pt-3"> <button @click.prevent="stripeCheckout(this.premium)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                        <p class="text-muted"> <small>One-Time  Setup fee of 200 QAR applicable </small>  </p>
                    </div>
                </div>
                </div>
            </div>
         </div>
    </div>             
    </div>
    <Footer /> 
</div>
    
</template>

<script>
import moment from 'moment';

import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";

export default {
    props:[ 'stripe_public_key'],
    components:{
        Header,
        Topnavbar,
        Footer,          
    },
    data(){
         return{
             user: window.authUser,
            starter:{
                'name' : 'Menuthy starter plan',
                'price' : 33,
                'description' : 'Menuthy STARTER plan subscription',
                'plan_period' : this.period(),
                'type' : 'stater',
                'specification': ''
                },
            lite:{
                'name' : 'Menuthy lite plan',
                'price' :66,
                'description' : 'Menuthy LITE plan subscription',
                'plan_period' : this.period(),
                'type' : 'lite',
                'specification': ''
            },
            pro:{
                'name': 'Menuthy pro plan',
                'price' :133,
                'description' : 'Menuthy PRO plan subscription',
                'plan_period' : this.period(),
                'type' : 'pro',
                'specification': ''
                },
            premium:{
                'name': 'Menuthy premium plan',
                'price' :266,
                'description' : 'Menuthy PREMIUM plan subscription',
                'plan_period' : this.period(),
                'type' : 'premium',
                'specification': ''
                },
            plan_period:'monthly'            
        }
    },
    methods:{ 
        capitalize(string) {
           if(string) return string.charAt(0).toUpperCase() + string.slice(1);
        },  
        formatDate(date){
            if (date) return moment(String(date)).format('ll');       
        },
        period(){
            return this.plan_period;
        },
        updatePeriod(period){
            this.plan_period = period
        },
        toggleYearlyTabs(event, period){
            var el = document.getElementsByClassName('yearly'); 
            var type = document.getElementsByClassName('types-tabs');           
            Array.from(el).forEach((item)=>{
                item.classList.remove('active-yearly');
                });            
            event.target.classList.add('active-yearly');            
        },
        updatePackagePrice(starter, lite, pro, premium){
            this.starter.price = starter;
            this.lite.price = lite;
            this.pro.price = pro;
            this.premium.price = premium;
        },
       
        stripeCheckout(plan){
            if(this.user.package_type == plan.type){
                alert('You are already subscribed to this plan!');
              return;  
            } 
            if(! confirm('Do you want to subscribe to ' + plan.name +'?')) return;            
            const stripe = Stripe(this.stripe_public_key);
            plan.plan_period = this.plan_period;
            plan.email = window.authUser.email;
            var form_data = new FormData();
            form_data.append('user_data', JSON.stringify({plan}));
            new Swal({
                title: "Hint",
                text:"Use the same email address you used to register your menuthy account."
                });
            Swal.showLoading();
            axios.post('api/stripe-pay-checkout', form_data )
            .then( payload => {
                stripe.redirectToCheckout({sessionId: payload.data.id});
            })
            .catch( error => {
               this.$swal('Failed!');
                console.log(error);                    
            });
        },
        
    },
    mounted(){
       //
    }
     
}
</script>

<style scoped>

    .parent{
        font-family:Poppins !important;
        padding-top:3rem;
    }
    .header{
        font-weight:800;
    }

    /* ------------------------------------- */
    .d-table{
        font-weight: 500;
        font-size:16px;
        line-height:20pt;
    }
    .d-table .bi-check-lg{
        color:#38C733;
        font-weight: 900;
        font-size:19px;
    }
    .d-table .bi-x{
        color: #FF0000;
        font-weight: 900;
        font-size:19px;
    }

    .recomended{ 
        font-size: 11px;
        line-height: 2;
        font-weight: 800;
        text-transform: uppercase;
        background: #000;
        color: #ffffff;
        transform: translateY(0)  translateX(50px) rotate(42deg);
        box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 50%);
    }
    .shadow{
        box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 50%);
        overflow: hidden;
    }
/* --------------------------------- */
    .bill-period{
        width:100%; 
        display:flex;
        font-size:1.5rem;
        justify-content: center;
    }
    .bill-period div{
        width:auto;
        justify-content: center;
        text-align:center;
    }

    .bill-period div p{
        padding:1.2rem;
        border: 1px solid rgb(216, 214, 214);   
        border-radius:35px;
    }
    .bill-period div p:hover{
        background: #ED2130;
        color:#fff;   
         
    }
    .bill-period div span{          
        border-radius:50%;
        padding:5px;        
         
    }

/* ------------------------------------------ */
    .types{
        width:100%; 
        display:flex; 
        justify-content: center;
    }
    .types div{
        width:auto;
        justify-content: center; 
        text-align: center;    
    }
    .types div span{
        padding:1.2rem;  
        border-radius:7px; 
        border-left: 1px solid rgb(223, 148, 148);       
    }
    .types div span:hover{
        background: #ED2130;
        color:#fff;        
    }

/* ---------------------------------------- */
.packages{
    width:100%;
}
.packages .packages-inner{
    width:90%;
    display:flex;
    width:auto;
    text-align: center;
}
.packages .packages-inner div{
    flex:1;    
    padding:1rem;
}
.packages .packages-inner div div{
    padding:1rem, .5rem; 
    border-radius:25px;
    color:#555;
}
.packages .packages-inner div div h4{
    font-weight:800;
    font-size:30px;
}
.packages .packages-inner div div .currency{
    font-weight:600;
    font-size:30px;
}
.packages .packages-inner div div .amount{
    font-weight:800;
    font-size:60px;
}
.packages .packages-inner div div i{
    font-weight:600;
    font-size:18px;
    margin-right:5px;
}
.packages .packages-inner div div p{
   display:flex;
   align-items: center;
   justify-content: center;
}
.packages .packages-inner div div button{
    border-radius:18px;
}

    /* toggle classes */
.active-yearly{
    background: #ED2130;
    color:#fff; 
}
.active-types{
    border-bottom: 5px solid #ED2130 !important;    
}
.hidden{
    display:none;
}


/* //media queries */
  @media only screen and (max-width: 750px) {
      .parent, footer{
          padding-top:1rem;
          background: rgba(243, 242, 242, 0.76);
      }
      h1{
          padding-top:1rem;
      }
      .yearly{
          padding:.4rem !important;
          padding-right: .3.5rem !important;
          font-size:20px;
      }
      .types px-2{
        padding-left:5px;
        padding-right:5px;
    }
      .types{ 
        justify-content: center;
    }
    .types-tabs{
        padding:.3rem !important;
    }
     .packages .packages-inner{
         display:block;
      }
    .packages .packages-inner div{
        width:90%;    
        padding:1rem;
    }
}

  @media only screen and (max-width: 500px) {
      .parent, footer{
          background: rgba(243, 242, 242, 0.76);
      }
      .yearly{
          padding:1rem !important;
          padding-right: .3.5rem !important;
          font-size:16px;
      }
      .types px-2{
        padding-left:.2rem;
        padding-right:.2rem;
        margin:2rem;
        width:100%;
    }
    .bill-period{
        padding-bottom:.3rem !important;
    }
    .types{
        display:block;
        padding: 0 !important;
        text-align: left;
    }
    .types div{ 
        padding:.7rem;
        margin-bottom:.5rem;
        width:auto;
        text-align:center;
    }
    .types-tabs{
        padding:.5rem !important;
    }
     .packages .packages-inner{
         display:block;
      }
    .packages .packages-inner div{
        width:100%;    
        padding:1rem;
    }
    .packages .packages-inner div div h4{
    font-weight:800;
    font-size:20px;
}
.packages .packages-inner div div .currency{
    font-weight:600;
    font-size:20px;
}
.packages .packages-inner div div .amount{
    font-weight:800;
    font-size:40px;
}
.packages .packages-inner div div i{
    font-weight:600;
    font-size:15px;
}
}
</style>