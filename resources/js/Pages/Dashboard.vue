<template>

<Header />
<Topnavbar />

    <div class=" conatiner h-100">
        <div class="row top-cards p-5 align-items-center">
            <div class="card shadow  m-1">
                <div class="card-body">
                    <h3>
                        Edit your menu
                    </h3>
                    <p>
                        Create new menus, add or edit your items and sections in your menus
                    </p>
                    <a href="" class="btn btn primary-btn  mx-auto text-center"> Menus</a>
                </div>
            </div>
            <div class="card shadow  m-1">
                <div class="card-body">
                    <h3>
                        Change your theme
                    </h3>
                    <p>
                        Design your menu to reflect your business and your brand
                    </p>
                    <a href="" class="btn btn-primary">Design</a>
                </div>
            </div> 

        
            <div class="card shadow  m-1 ">
                <div class="card-body">
                    <h3>
                        Menu settings
                    </h3>
                    <p>
                        Set up all the details of your menu to fit it in your business
                    </p>
                    <a href="" class="btn btn-lg btn-warning"> Settings</a>
                </div>
            </div> 
            <div class="card shadow  ">
                <div class="card-body">
                    <h3>
                        Integrations
                    </h3>
                    <p>
                        Connect with the Payment, POS, Printer systems for seamless ordering
                    </p>
                    <a href="" class="btn btn-lg btn-success"> Integrate</a>
                </div>
            </div>          
        </div>

        <!-- banner section -->
        <div class=" banner row justify-content-center p-5" >
            <div class="card shadow page-banner p-5 text-white">            
                <div class="col-xs-8 ">          
                    <h2>
                        Try our contactless online ordering solution!
                    </h2>
                    <p>
                        Get started with FineDine Delivery & Pick-up Menu for online ordering with no excessive commission or use 
                        QR Menu for a contactless dine-in experience.
                    </p>
                    <a href="" class="btn btn-lg bg-white "> https://fndn.mn/antony-restaurant <span class="btn btn-sm btn-default border rounded"> Copy link</span> </a> 
                </div>
                <div class="col-xs-4">
                    <img src="" alt="">
                </div>
            </div>
        </div>

        <!-- feedback and recent orders section  -->
        <div class="row feedback p-5">
            <div class="card shadow card p-2">
               <div class=" ">
                <h4>   Recent orders <span class="float-right btn small primary-btn-color"> All oders</span>        </h4>
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>

            <div class=" card shadow  p-2 m-1 ">
                <div class="  ">
                    <h4> Feedback  <span class="float-right small btn primary-btn-color">All feedback</span>        </h4>
                    <div class="table-responsive">
                        <table class="table table-sm table-hover table-striped">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

<Footer />

</template>

<script>

import Header from "./layouts/Header";
import Topnavbar from "./layouts/Topnavbar";
import Footer from "./layouts/Footer";

export default {
  props: {
    //
  
  },
  components: {
  Header,
  Topnavbar,
   Footer

  },
};
</script>

<style lang="scss" scoped>
@import "../../sass/app.scss";

.top-cards .card{
    width:24%;
}
.feedback .card{
    width:49%;
}


/* media quesries */
@media only screen and (max-width: 900px) {
  .top-cards .card{
    width:48%;
}
.feedback .card{
    width:98%;
}
}
@media only screen and (max-width: 750px) {
    .top-cards .card{
        width:48%;
}
}
@media only screen and (max-width: 650px) {
      .top-cards .card{
        width:98%;
}
}

</style>

