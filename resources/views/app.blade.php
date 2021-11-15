<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="images/menuthy_logo_icon.png">

    {{-- bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    {{-- bootstrap icons  --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    {{-- font awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
    {{-- custom stylesheet  --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

@routes
<script src="{{ mix('js/app.js') }}" defer></script>

<style>
    body {
        color:#212529;
        background-color: #fff;
    }
    .primary-btn-color{
        background-color: #e6034b;
        border-color: #e6034b;
        color:#fff;
    }
    .primary-btn-color:hover {
        border-color: #f4516c;
    }
    
    .page-header{
        background-color: #2c2d3a;
    }
    .top-navbar{    
        padding: 0;
        position: relative;
        z-index: 1;
        background: #262734;
        height: 70px;
        -webkit-transition: all .3s ease;
        -moz-transition: all .3s ease;
        -ms-transition: all .3s ease;
        -o-transition: all .3s ease;
        transition: all .3s ease;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        }
    
    .page-banner{
        background-image: linear-gradient(to bottom right, rgb(236, 37, 37), rgb(243, 88, 17));
    }
    }
</style>

</head>

<body class="font-sans antialiased">
    @inertia

    @routes

 <script>
     //mobil burger menu script
     /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
    function openNav() {
    document.getElementById("mySidenav").style.width = "80%";
    document.getElementById("main").style.marginLeft = "250px";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
    }
    
    /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
    function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.body.style.backgroundColor = "white";
    }
 </script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
{{-- webpack.mix.css --}}
<script src="{{ mix('js/app.js') }}" defer></script>



</body>

</html>