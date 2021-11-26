<template>
<div class=" parent-div px-2">
    <div class=" logo-part">
        <div class="logo text-center pt-5">
            <img src="/storage/hotel_logo_placeholder.png"  alt="" style="width:100px; height:100px">
            <p class="p-2">
                Hotel description
            </p>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------- -->
    <!-- imge slider -->
    <div class=" carousel-div">
    <div v-if="this.menus.length" :class="blur"> 
            <carousel :items-to-show="3">
                <slide v-for="(sub_menu) in subMenus" :key="sub_menu.id">
                        <div class="inner-carousel-div">
                            <div class=" img-div">
                                <img src="/images/600d2d6d1e745.jpg" alt="" class="shadow">
                            </div>
                            <h5 class="pt-1">
                                Title
                            </h5>
                        </div>
                    </slide>
                    <template #addons>
                        <div class="mx-2">
                            <navigation />
                        </div>            
                </template>
            </carousel>
        </div>
    </div>

    <!-- ---------------------------------------------------------- -->
    
    <div class=" title-part mx-auto title">
        <h3>
            Fast foods
        </h3>
        <p>
            Description here
        </p>
    </div>

    <!-- -------------------------------------- -->
        <!-- menu items / dishes -->
    <div class="parent-conatiner  text-muted" v-for="(sub_menu) in subMenus" :key="sub_menu.id"> 
        <div class="elements-div">
            <div class="shadow inner-elements-div ">
                <div class="image-div">
                    <img src="/images/600d2d6d1e745.jpg" alt="">
                </div>

                <div class="text-div">
                    <p class="ribbon d-flex justify-content-between ">
                        <span class="time text-white pl-2"> <small>10 mins </small> </span>
                        <span class="price"> $10</span>
                    </p>
                    <h4 class="title">
                    <span> Chicken wings</span> 
                    <span class="price float-right pr-3"> $10</span>
                    </h4>
                    <p class="description">
                        Delicious chicken wings with chips
                    </p>
                        <p class="order-btn">
                        <span> <a href="#">Order</a></span> 
                        <span class="time text-default pl-3"><i class="bi bi-alarm pl-1 text-danger text-right"></i> <small>10 mins </small> </span>
                        </p>
                </div>

                <div class="image-div2">
                    <img src="/images/600d2d6d1e745.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

<!-- ---------------------------------------------- -->
</div>






</template>


<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
      props:['menus', 'subMenus', 'menuItems', 'user'],
    components: {
            Carousel,
            Slide,
            Pagination,
            Navigation,
        },
}
</script>


<style lang="scss" >
@import "../../../sass/app.scss"; +



 .logo img,  .logo p {
    justify-content: center;
}


.parent-div{
    width:45rem;
    height:100vh;
    margin:auto;
    border-right: 1px solid grey;
    overflow-y:scroll;
}

.carousel-div{
    padding-bottom:1rem;
}
.carousel__prev, .carousel__next {
    background-color: $orange !important;
}

.carousel__prev svg path, .carousel__next svg path , .nav-link, .menu-name, .carousel__icon{
    color:#fff !important;
}

.inner-carousel-div {
 width:100%;
 padding: .2rem;
}
.img-div  {
 border-radius: 20px;
 overflow: hidden;
}
.img-div img {
 height: 130px;
 max-height: 100%;
 width:100%;
}

.title-part h3, .title-part p{
    display: flex;
    justify-content: center;
}
.parent-container{
    width:90%;
    margin: auto;
}

.elements-div{
    width:24%;
    float:left;
    padding: .2rem;
    text-align: center;
    border-radius: 15px;
}
.inner-elements-div{
    border-radius: 15px;
}
.image-div{
    width:100%;
    height: auto;
    overflow:hidden;
    border-radius: 15px 15px 0 0;
}
.image-div2{
   display:none;
}
.image-div img{
    min-height:50px;         
    width: 100%;
    max-width:100%;
    height:20vh;
    max-height:100%;
}
.text-div{
    position:relative;
    padding-bottom: .2rem;;
    padding-top: .2rem;;
}

.ribbon{
    width:100%;
    position: absolute;
    margin-left: auto;
    margin-right: auto;
    top:-1.5rem;
    z-index: 2;
    background-color: rgba(255, 255, 255, 0.459);
    margin-bottom: 0;
}
.ribbon .price{
    background-color: white;
    padding-left:8px;
    padding-right:8px;
    color:$orange; 
}
.title{
    padding-top:.5rem;
}
.title .price{
    display:none;
}
.description{
    display: none;
}
.order-btn a{
    background-color: $orange;
    border: none;
    color: white;
    padding: 5px 10px;
    border-radius: 7px;;
    text-align: center;
    text-decoration: none;
    font-size: 16px;
}
.order-btn a:hover{
      background-color: #ff2b0698; 
}
.order-btn .time{
    display:none;
}

/* media queries */
@media only screen and (max-width: 900px) {
   .parent-div{
    width:100vw;
     border-right: none;
    }
    .inner-carousel-div {
        width:100%;
        padding: .1rem;
    }

    .img-div img {
        height: 100px;
    
    }

    .elements-div{
        width:99%;       
        text-align: center;
        margin-bottom: .5rem;
        border-radius: 15px;
        display: flex;
        align-items: center;
    }
     .inner-elements-div{
        width:100%;
        
    }
    .image-div{
       display: none;
    }
   
    .ribbon{
        display:none !important;
    }
    .title .price{
    display:block;
    float:right;
    color: $orange;
    }
    .description{
        display:block;
    }
     .image-div2{
         display:block;
        width:30%;
        height:100%;
        float:right;
        overflow:hidden;
        border-radius: 0 15px 15px 0;
    }
    .image-div2 img{
        min-height:50px;         
        width: 100%;
        max-width:100%;
        height:150px;
        max-height:100%;
    }
    .text-div{
        width:70%;
        float:left;
        margin-top:2%;
        margin-bottom:auto;
        padding-left:1rem;
        text-align: left;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .order-btn {

        float:left;
    }
    .order-btn .time{
        display:inline-block;

    }
}

/* media queries */
@media only screen and (max-width: 500px) {
   .elements-div{
        width:95%;
        float:left;
        padding: .5rem;
        text-align: center;
        border-radius: 15px;
    }
    .image-div{
        display:block;
        width:100%;
        height:30vh;
        overflow:hidden;
        border-radius: 15px 15px 0 0;
    }
    .image-div2{
        display:none;
    }
    .text-div{
        width:100%;
    }
    .image-div img{
        min-height:100px;         
        width: 100%;
        max-width:100%;
        height:30vh;
        // max-height:100%;
    }
    .description{
        display: block;
    }
    .order-btn{
        text-align:center;
    }
}

</style>