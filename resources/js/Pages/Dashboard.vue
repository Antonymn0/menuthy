<template>

<Header />
<Topnavbar />

    <div class=" conatiner h-100">
        <div class="row justify-content-center h-100">
            
            <div class="card col-sm-3 m-1">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
            <div class="card col-sm-3 m-1">
                <div class="card-body">
                    This is some text within a card body.
                </div>
            </div>
            <div class="card col-sm-3 m-1">
                <div class="card-body">
                    This is some text within a card body.
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

