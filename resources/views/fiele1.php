@extends('layouts.app')

@section('content')

<div class="container" id="app">
<div >
    <Home />
</div>

                {{-- <div class="alert-success p-2 w-50 m-auto rounded zindex-tooltip m-0">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
      --}}


    <table border="0" cellpadding="5" cellspacing="5" width="100%">
        <tr>
            <td style="background-color: #2c2d3a;padding-left: 120px;">
            </td>
        </tr>
        <tr>
            <td style="background-color: #262734; padding-left: 150px;">
                <table border="0" cellpadding="5" cellspacing="5" width="50%">
                    <tr>
                        <td align="center">
                            <a href="/home">Dashboard</a>
                        </td>
                        <td align="center">
                            <a href="menuthy_section_grid.php">Menu</a>
                        </td>
                        <td align="center">
                            <a href="menuthy_settings.php">Settings</a>
                        </td>
                        <td align="center">
                            <!--<a href="menuthy_display_qr.php">QR Code</a>-->
                            <a href="#" data-toggle="modal" data-target="#exampleModalLong">QR Code</a>
                        </td>
                        <td align="center">
                            <a href="#" data-toggle="modal" data-target="#exampleModalLong1">Mobile Preview</a>
                        </td>
                        <td align="center">
                            <a href="menuthy_dashboard.php?lo=<?php print uniqid()." ss001".uniqid();?>">Logout</a>
                        <td>
                            <a href="menuthy_add_section.php" class="btn btn-success">
                                Add Menu
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-left: 150px;">
                <table border="0" cellpadding="10" cellspacing="10" width="100%">
                    <tr>
                        <td width="33%">
                            <div style="border: 0px solid black; height: 200px;  width: 400px; margin: 15px; padding: 30px; border-radius: 4px;
background: #ffffff;
box-shadow:  8px 8px 16px #cccccc,
             -8px -8px 16px #ffffff;">
                                <h4 style="color: #ed202e;">Menu</h4>
                                <p>
                                    Start by Adding the Menu <br />(i.e: Breakfast, Lunch and Dinner, Beverage)
                                </p>
                                <a href="menuthy_add_section.php" class="btn btn-danger" style="font-size: 15px;">Add
                                    Menus</a> &nbsp;
                                <a href="menuthy_section_grid.php" class="btn btn-danger" style="font-size: 15px;">View
                                    Menus</a>
                            </div>
                        </td>
                        <td width="33%">
                            <div style="border: 0px solid black; height: 200px;  width: 400px; margin: 15px; padding: 30px; border-radius: 4px;
background: #ffffff;
box-shadow:  8px 8px 16px #cccccc,
             -8px -8px 16px #ffffff;">
                                <h4 style="color: #ffc107;"> Menu Settings </h4>
                                <p>

                                    Set up your menu to serve the business purpose
                                </p>
                                <a href="menuthy_settings.php" class="btn btn-warning"
                                    style="font-size: 15px;">Settings</a>
                            </div>


                        </td>
                        <td width="33%">
                            <div style="border: 0px solid black; height: 200px;  width: 400px; margin: 15px; padding: 30px; border-radius: 4px;
background: #ffffff;
box-shadow:  8px 8px 16px #cccccc,
             -8px -8px 16px #ffffff;">
                                <h4 style="color: #17a2b8;"> Menu QR Code </h4>
                                <p>

                                    Get your QR Code for better Customer experience
                                </p>
                                <a href="menuthy_display_qr.php" class="btn btn-info" style="font-size: 15px;"
                                    data-toggle="modal" data-target="#exampleModalLong">Experience</a>
                            </div>



                        </td>
                    </tr>

                </table>




            </td>
        </tr>



    </table>



    </table>

    <!--
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
  Launch demo modal
</button>-->

    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Your Menuthy QR Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>





                
			 



            </div>
        </div>
    </div>

    <!-- Mobile Preview start -->


    <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Menuthy Mobile Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>




                <div class='modal-body' align='center'>





                    <!-- Mobile structure start -->



                    <!-- Mobile Preview CSS start -->

                    <style>
                        /* The device with borders */
                        .smartphone {
                            position: relative;
                            width: 350px;
                            height: 650px;
                            margin: auto;
                            border: 16px black solid;
                            border-top-width: 60px;
                            border-bottom-width: 60px;
                            border-radius: 36px;
                        }

                        /* The horizontal line on the top of the device */
                        .smartphone:before {
                            content: '';
                            display: block;
                            width: 60px;
                            height: 5px;
                            position: absolute;
                            top: -30px;
                            left: 50%;
                            transform: translate(-50%, -50%);
                            background: #333;
                            border-radius: 10px;
                        }

                        /* The circle on the bottom of the device */
                        .smartphone:after {
                            content: '';
                            display: block;
                            width: 35px;
                            height: 35px;
                            position: absolute;
                            left: 50%;
                            bottom: -65px;
                            transform: translate(-50%, -50%);
                            background: #333;
                            border-radius: 50%;
                        }

                        /* The screen (or content) of the device */
                        .smartphone .content {
                            width: 320px;
                            height: 150px;
                            border: 1px solid red;
                            background: white;
                        }

                        < !-- Mobile Preview CSS end -->
                    </style>

                    <div class="smartphone">
                        <div class="content">
                            <iframe src="/w3css/tryw3css_templates_band.htm"
                                style="width:100%;border:none;height:20%; border: 1px solid red;" />
                        </div>
                    </div>

                    <!-- Mobile structure end -->



                </div>



                <!-- Mobile Preview end -->


</div>
@endsection
