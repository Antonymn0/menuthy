<template>
    <div class="d-flex pt-5  flex-column sidebar-nav text-muted flex-shrink-0 mr-0 pr-0 bg-white shadow" >
     
      <ul class="nav nav-pills flex-column mb-auto m-0 p-0">
        <li class="text-center">  
           <a href="/" class="  text-decoration-none  text-muted text-center mx-auto ">  
            <span v-if="authUser.image !== null "> <img    :src="authUser.image"  alt="profile-image" class="rounded-circle m-0 p-0" style="width:50px; height:50px;">  </span>  
            <span v-else><i class="bi bi-person-circle " style="font-size:2.5rem;"></i>  </span> <br>
            <span  class="pt-0 mt-0"> <small v-if="this.authUser.first_name">  {{this.authUser.first_name}} </small> </span>
          </a>
           
        </li>
        <li class="pl-5 pt-4">
          <h4> Admin panel</h4> 
          
        </li>
        <hr class="p-0 m-0">
        <li>
          <a href="/admin" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
            Dashboard
          </a>
        </li>
        <li>
          <a href="/admin/client-portal" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
            Clients portal
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
            View scans
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
            Inbox
          </a>
        </li>
        <li>
          <a href="#" class="nav-link link-dark" data-toggle="modal" data-target="#profile">
            <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
            Admin profile
          </a>
        </li>
      </ul>
      <hr>
      <div class="dropdown d-flex align-items-center pl-5 pb-3">
        <a href="#" class=" link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
          <strong>mdo</strong>
        </a>
        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
          <li class="dropdown-item  border-top px-2">
                <form action="/logout" method="POST" enctype="multipart/form-data">
                    <div class="ml-2">
                        <input type="hidden" name="_token" :value="csrf">                       
                        <i class="bi bi-box-arrow-left pr-1"></i> 
                            Logout                   
                    </div>                        
                </form>                     
            </li>
      </ul>
    </div>

    <!-- ---------------components------------------ -->
    <Profile />
  </div>
</template>

<script>
import Profile from "../../Profile/Profile";
export default {
  components:{
    Profile,
  },

  data () {
    return{
         authUser: window.authUser,
    }
  },
  mounted(){

    
  }
}
</script>

<style scoped lang="scss">
@import "../../../../sass/app.scss";
@import url('https://fonts.googleapis.com/css?family=Poppins');

    .sidebar-nav{
        color:#9699a2;
          display:block;
          width: 18vw; 
          height:100vh;
          font-family: poppins;
    }
    ul li {
      margin-left: auto;
      margin-right: auto;
        width:100%;
        color:#9699a2;
        font-family: poppins;
    }
    ul li a{
      margin-left: auto;
      margin-right: auto;
        width:100% !important;
        color:#9699a2;
        font-family: poppins;
    }


/* media quesries */
@media only screen and (max-width: 900px) {
        .sidebar-nav{
              display:none !important;
        }
}
</style>