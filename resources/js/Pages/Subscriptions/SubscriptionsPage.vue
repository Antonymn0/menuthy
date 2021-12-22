<template>
<div class="parent">
    <div>
        <Header />
        <TopNavbar />        
    </div>
     
        <div class="">
            <div class="header text-center">
                <h1> How much does Menuthy cost? </h1> 
                <p class="text-muted">There is a reason why we are the best in the market. </p> 
            </div>

            <div class="bill-period mx-auto py-5"> 
                <div class="px-1">
                    <p class="yearly shadow active-yearly" @click.prevent="[toggleYearlyTabs($event, 'monthly'),  updatePackagePrice(60, 120, 240)]"> <span><i class="bi bi-check"></i> </span> Billed Monthly</p>
                </div>
                <div class="px-1">
                    <p class="yearly shadow "  @click.prevent="[toggleYearlyTabs($event, 'yearly'),  updatePackagePrice(600, 1200, 2400)]"> <span ><i class="bi bi-check"></i> </span>  Billed Yearly <small class="sm small s font-weight-light">Save 20%</small></p>
                </div>
            </div>
<!-- ------------------------ Monthly package panels------------------------------------------ -->
        <div class="monthly-panels ">
            <div class="types py-1 mx-auto"> 
                <div class="px-2"> <span class="types-tabs shadow active-types" @click.prevent="[toggleTypestabs($event), updatePackagePrice(60, 120, 240)]"> Dine-In QR Menu</span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="[toggleTypestabs($event), updatePackagePrice(120,240,480)]">Delivery and Pick-Up Menu </span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="[toggleTypestabs($event), updatePackagePrice(60, 120, 240)]">Tablet Menu </span> </div>
            </div>
           
            <div class="packages py-3 mt-4">
                 <p class="py-2 pb-3 text-center mx-auto mb-0" style="font-weight:500; font-size:20px;">Billed Monthly</p>
                <div class="packages-inner py-2  ">                    
                    <div > 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Basic</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.basic}}</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i>  Connect up to 5 devices </p>
                            <p class="pt-3"> <button @click.prevent="purchasePackage(this.basic)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Pro</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.pro}}</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i>  Connect up to 5 devices</p>
                            <p class="pt-3"> <button  @click.prevent="purchasePackage(this.pro)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe</h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Advanced</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency" >QAR</span>
                                <span class="amount">{{this.advanced}}</span>
                                <span class="period">/Month</span>                              
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i> Connect up to 5 devices </p>
                            <p class="pt-3"> <button @click.prevent="purchasePackage(this.advanced)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                        </div>
                    </div>
                </div>
            </div>
         </div>
<!-- ------------------------ Yearly package panels------------------------------------------ -->
        <div class="yearly-panels hidden">
            <div class="types py-1 mx-auto"> 
                <div class="px-2"> <span class="types-tabs shadow active-types" @click.prevent="[toggleTypestabs($event,),  updatePackagePrice(600, 1200, 2400)]"> Dine-In QR Menu</span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="[toggleTypestabs($event)], updatePackagePrice(1200, 2400, 4800)">Delivery and Pick-Up Menu </span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="[toggleTypestabs($event), updatePackagePrice(600, 1200, 2400)]">Tablet Menu </span> </div>
            </div>
            <div class="packages py-3 mt-4">  
                <p class="py-2 pb-3 text-center mx-auto mb-0" style="font-weight:500; font-size:20px;">Billed Yearly</p>   
                <div class="packages-inner py-2  ">
                    <div > 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Basic </h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.basic}}</span>
                                <span class="period">/Yearly</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i>  Connect up to 5 devices</p>
                            <p class="pt-3"> <button @click.prevent="purchasePackage(this.basic)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Pro</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">{{this.pro}}</span>
                                <span class="period">/Yearly</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i> Connect up to 5 devices </p>
                            <p class="pt-2"> <button @click.prevent="purchasePackage(this.pro)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe</h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Advanced</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency" >QAR</span>
                                <span class="amount">{{this.advanced}}</span>
                                <span class="period">/Yearly</span>                              
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check-circle"></i>  Connect up to 5 devices</p>
                            <p class="pt-3"> <button @click.prevent="purchasePackage(this.advanced)" class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Subscribe </h5>  </button> </p>
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
import Header from "../layouts/Header";
import Topnavbar from "../layouts/Topnavbar";
import Footer from "../layouts/Footer";
export default {
    components:{
        Header,
        Topnavbar,
        Footer,
    },
    data(){
        return{
            basic:60,
            pro:120,
            advanced:240,
        }
    },
    methods:{
        toggleYearlyTabs(event, period){
            var el = document.getElementsByClassName('yearly'); 
            var type = document.getElementsByClassName('types-tabs');           
            Array.from(el).forEach((item)=>{
                    item.classList.remove('active-yearly');
                });            
            event.target.classList.add('active-yearly');
            if(period == 'yearly'){
                document.getElementsByClassName('monthly-panels')[0].classList.add('hidden');
                document.getElementsByClassName('yearly-panels')[0].classList.remove('hidden');
            } 
            if(period == 'monthly'){
                document.getElementsByClassName('monthly-panels')[0].classList.remove('hidden');
                document.getElementsByClassName('yearly-panels')[0].classList.add('hidden');
            } 

            Array.from(type).forEach((item)=>{
                    item.classList.remove('active-types');
                });
            type[0].classList.add('active-types');
            type[3].classList.add('active-types');
        },
        updatePackagePrice(basic, pro, advanced){
            this.basic = basic;
            this.pro = pro;
            this.advanced = advanced;
        },
        toggleTypestabs(event){
            var el = document.getElementsByClassName('types-tabs');
             Array.from(el).forEach((item)=>{
                    item.classList.remove('active-types');
                });
            event.target.classList.add('active-types');
        },
        purchasePackage(subscription){
            console.log(subscription);
        }
    },
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
    width:100%;
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
        width:100%;    
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