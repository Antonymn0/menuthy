<template >
    <div class="top-navbar browser-menu">
        <p>

            <nav class="navbar navbar-expand-lg py-0 navbar-dark bg-dark ">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/dashboard">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse p-1" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">                           
                            <li class="nav-item">
                                <a class="nav-link" href="/menus">Menus</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Orders
                                 </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Orders</a></li>
                                <li><a class="dropdown-item" href="#">Tables</a></li>
                                <li><a class="dropdown-item" href="#">Waiters</a></li>
                                <li><a class="dropdown-item" href="#">Modifiers</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">Design</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link " aria-current="page" href="#">Reports</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Feedback
                                 </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Survey forms</a></li>
                                <li><a class="dropdown-item" href="#">Survey results</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                            </li>
                             <li class="nav-item">
                               <a class="nav-link " aria-current="page" href="#">Settings</a>
                            </li>
                            <li class="nav-item dropdown m-1">
                                <a class="nav-link  p-0 m-0" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="bi bi-three-dots" style="font-size: 1.5rem;"></i>
                                 </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Campaigns</a></li>
                                    <li><a class="dropdown-item" href="#">Info page</a></li>
                                    <li><a class="dropdown-item" href="#">Devices</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="#">Integrations</a></li>
                                </ul>
                            </li>                            
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-danger text-white" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </p>
    </div>
</template>

<script>
export default {
    
}
</script>

<style scoped lang="scss">
    ul li{
        padding:.8rem;
        font-size: 14pt;;
    }



</style>