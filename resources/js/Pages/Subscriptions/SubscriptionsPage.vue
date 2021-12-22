<template>
    <div>
        <Header />
        <TopNavbar />
        
    </div>
    <div class="parent"> 
        <div class="container">
            <div class="header text-center">
                <h1> How much does Menuthy cost? </h1> 
                <p class="text-muted">There is a reason why we are the best in the market. </p> 
            </div>

            <div class="bill-period mx-auto py-5"> 
                <div class="px-1">
                    <p class="yearly shadow active-yearly" @click.prevent="toggleYearlyTabs($event, 'monthly')"> <span><i class="bi bi-check"></i> </span> Billed Monthly</p>
                </div>
                <div class="px-1">
                    <p class="yearly shadow "  @click.prevent="toggleYearlyTabs($event, 'yearly')"> <span ><i class="bi bi-check"></i> </span>  Billed Yearly</p>
                </div>
            </div>
<!-- ------------------------ Monthly package panels------------------------------------------ -->
        <div class="monthly-panels ">
            <div class="types py-1 mx-auto"> 
                <div class="px-2"> <span class="types-tabs shadow active-types" @click.prevent="toggleTypestabs($event)"> Dine-In QR Menu</span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="toggleTypestabs($event)">Delivery and Pick-Up Menu </span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="toggleTypestabs($event)">Tablet Menu </span> </div>
            </div>
           
            <div class="packages py-3 mt-4">
                 <p class="py-2 pb-3 text-center mx-auto mb-0" style="font-weight:500; font-size:20px;">Billed Monthly</p>
                <div class="packages-inner py-2  ">                    
                    <div > 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Basic</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase </h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Pro</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Month</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase</h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Advanced</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency" >QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Month</span>                              
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase </h5>  </button> </p>
                        </div>
                    </div>
                </div>
            </div>
         </div>
<!-- ------------------------ Yearly package panels------------------------------------------ -->
        <div class="yearly-panels hidden">
            <div class="types py-1 mx-auto"> 
                <div class="px-2"> <span class="types-tabs shadow active-types" @click.prevent="toggleTypestabs($event,)"> Dine-In QR Menu</span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="toggleTypestabs($event)">Delivery and Pick-Up Menu </span> </div>
                <div class="px-2"> <span class="types-tabs shadow" @click.prevent="toggleTypestabs($event)">Tablet Menu </span> </div>
            </div>
            <div class="packages py-3 mt-4">  
                <p class="py-2 pb-3 text-center mx-auto mb-0" style="font-weight:500; font-size:20px;">Billed Yearly</p>   
                <div class="packages-inner py-2  ">
                    <div > 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Basic </h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Yearly</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase </h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Pro</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency">QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Yearly</span>
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase</h5>  </button> </p>
                        </div>
                    </div>
                    <div> 
                        <div class="shadow"> 
                            <h4 class="pb-4 mb-3 pt-1 text-dark"> Advanced</h4>
                            <p class="ty-1 price mb-0"> 
                                <span class="currency" >QAR</span>
                                <span class="amount">60</span>
                                <span class="period">/Yearly</span>                              
                            </p>
                            <p class="pb-1 mb-0 text-dark"> <i class="bi bi-check"></i> </p>
                            <p class=""> <button class="btn btn-danger px-5 d-flex align-items-center mx-auto">  <h5>Purchase </h5>  </button> </p>
                        </div>
                    </div>
                </div>
            </div>
         </div>

        </div>
    </div>
    <Footer />
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
            basic:0,
            pro:0,
            advanced:0,
        }
    },
    methods:{
        toggleYearlyTabs(event, period){
            var el = document.getElementsByClassName('yearly');
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
    flex:1;;
    
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
    font-size:40px;
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
    border-left: 3px solid #ED2130 !important;   
    border-bottom: 5px solid #ED2130 !important;   
    
}
.hidden{
    display:none;
}
.visible{
    display:block;
}
</style>