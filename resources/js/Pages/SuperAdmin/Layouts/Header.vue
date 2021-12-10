<template>
  <div class=" top-navbar d-flex align-items-center">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark w-100">

      <a class="navbar-brand" href="/admin">
        <img src="/images/white_logo.svg"  alt="mdb logo" class="mx-auto">
      </a>

      <!-- Collapse button -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"
        aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">ggggg</span>
      </button>


      <!-- Links -->
      <div class="collapse navbar-collapse float-right align-items-center" id="basicExampleNav1">

        <!-- Right -->
        <ul class="navbar-nav ml-auto align-items-center">
          <!-- <li class="nav-item">
            <a href="#!" class="nav-link navbar-link-2 waves-effect">
              <span class="badge badge-pill red">1</span>
            
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink3" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="true">
              <i class="united kingdom flag m-0"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#!">Action</a>
              <a class="dropdown-item" href="#!">Another action</a>
              <a class="dropdown-item" href="#!">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="#!" class="nav-link waves-effect">
              Shop
            </a>
          </li>
          <li class="nav-item">
            <a href="#!" class="nav-link waves-effect">
              Contact
            </a>
          </li> -->
          <li class=" px-2">
                    <form action="/logout" method="POST" enctype="multipart/form-data">
                        <div class="ml-2">
                            <input type="hidden" name="_token" :value="csrf">    
                            <button type="submit" class="btn-danger mx-auto rounded"> 
                            <i class="bi bi-box-arrow-left pr-1"></i> 
                                Logout
                        </button>
                        </div>                        
                    </form>                     
                </li>
        </ul>

      </div>
      <!-- Links -->

  </nav>
<!-- Navbar -->
</div>
</template>

<script>
export default {
   data(){
        return{
            authUser: window.authUser,  // Authenticated user Imported from laravel main blade file
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), //csrf token
        }
    },
}
</script>

<style scoped lang="scss">
@import "../../../../sass/app.scss";
@import url('https://fonts.googleapis.com/css?family=Poppins');

.navbar-brand{
    overflow: hidden;
    font-family: poppins;
}
.navbar-brand img{
      width:auto;
      height:60px;
      max-height: 80%;
      padding-left: 1.5rem;
      
}

/* media queries */
@media only screen and (max-width: 900px) {
  .top-navbar{
      display:none;
  }
}
</style>