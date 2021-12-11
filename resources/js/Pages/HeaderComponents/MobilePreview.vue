<template>

 <div>
         <!--  mobile preview modal modal -->
        <div class="modal fade  " id="exampleModalEditmobileMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditmobileMenuLabel" aria-hidden="true">
           
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content ">
                <div class="modal-header">
                    <h3 class="modal-title text-center" id="">Mobile  preview</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body fade-in" >
              
              <div class="smartphone" style="max-width:100%;">
                <div class="content m-0 p-0" style="width:100%; height:100%;" >
                  <iframe :src="this.preview_link"  style="width:100%;border:none; height:100%; margin:1px 0px;" />
                </div>
          </div>

      </div>                
      </div>
  </div>
</div> 
</div> 


</template>

<script>
export default {
data(){
  return{
    preview_link:'',
    restaurant: null,
  }
},
  methods:{
      // generate prview link
      getQqrCodeLink(){
            axios.get('/api/qrcode-generate/'+ this.restaurant.id)
            .then( response => {
              if( response.status = 200){      
                  this.preview_link = response.data;
                } 
            })
            .catch( error => {
               this.$swal('Failed to generate Preview link!');
                console.log(error.response.data.errors);
                return;                    
            });
        },
  },
  mounted(){
    this.restaurant = window.authRestaurant;
     this.getQqrCodeLink();
    
  },
    
}
</script>

<style lang="scss" scoped>

.modal-dialog{
  float:right !important;
  width:50rem;
}



</style>