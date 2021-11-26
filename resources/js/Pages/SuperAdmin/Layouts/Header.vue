<template>
    <div class="navbar-white">
    <!-- Navbar -->
<nav class="navbar navbar-expand-md navbar-dark">

  <a class="navbar-brand" href="/admin">
    <img src="/images/menuthy_logo_i_a.png" height="30" alt="mdb logo" style="background-color:#d3d3d3; height:70px">
  </a>

  <!-- Collapse button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav1"
    aria-controls="basicExampleNav1" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Breadcrumbs -->
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a class="waves-effect" href="#!">Home</a></li>
    <li class="breadcrumb-item"><a class="waves-effect" href="#!">Dashboard</a></li>
  </ol>
  <!-- Breadcrumbs -->

  <!-- Links -->
  <div class="collapse navbar-collapse" id="basicExampleNav1">

    <!-- Right -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="#!" class="nav-link navbar-link-2 waves-effect">
          <span class="badge badge-pill red">1</span>
          <i class="fas fa-shopping-cart pl-0"></i>
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
      </li>
      <li class="nav-item">
        <a href="#!" class="nav-link waves-effect">
          Sign in
        </a>
      </li>
       <li class="dropdown-item  border-top px-2">
                <form action="/logout" method="POST" enctype="multipart/form-data">
                    <div class="ml-2">
                        <input type="hidden" name="_token" :value="csrf">    
                        <button type="submit" class="btn-danger mx-auto"> 
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