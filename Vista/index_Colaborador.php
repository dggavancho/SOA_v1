<?php
session_start();

//------------------------------------------------
include '../Modelo/solicitud.php';
include '../DAO/solicitudDAO.php';
$solicituddao = new solicitudDAO();

//------------------------------------------------


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="" >
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!--Meta Responsive tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!--Custom style.css-->
    <link rel="stylesheet" href="assets/css/quicksand.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!--Font Awesome-->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <!--Chartist CSS-->
    <link rel="stylesheet" href="assets/css/chartist.min.css">
    <!--Bootstrap Calendar-->
    <link rel="stylesheet" href="assets/js/calendar/bootstrap_calendar.css">

    <!--Ckeditor-->
    <script src="assets/js/ckeditor5/build-classic/ckeditor.js"></script>
    
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title>Sleek Admin</title>
  </head>
  <body>
    
    <!--Page Wrapper-->

    <div class="container-fluid">

        <!--Header-->
        <div class="row header shadow-sm">
            
            <!--Logo-->
            <div class="col-sm-3 pl-0 text-center header-logo">
               <div class="bg-theme mr-3 pt-3 pb-2 mb-0">
                    <h3 class="logo"><a href="#" class="text-secondary logo"><i class="fa fa-rocket"></i> Help Desk<span class="small">DesysWeb</span></a></h3>
               </div>
            </div>
            <!--Logo-->

            <!--Header Menu-->
            <div class="col-sm-9 header-menu pt-2 pb-0">
                <div class="row">
                    <!--Search box and avatar-->
                    <div class="col-sm-8 col-4 text-right flex-header-menu justify-content-end">
                        <div class="search-rounded mr-3" style="margin-top: 10px;">
                            <h5 class="mb-0" >Diego Gavancho Guillermo</h5>
                            <!--<input type="text" class="form-control search-box" placeholder="" />-->
                        </div>
                    </div>
                    <!--Search box and avatar-->
                </div>    
            </div>
            <!--Header Menu-->
        </div>
        <!--Header-->

        <!--Main Content-->

        <div class="row main-content">
            <!--Content right-->
            <div class="col-sm-9 col-xs-12 content pt-3 pl-0" style="margin-left: 10%;">
                <br>
                <h1 class="mb-0" ><strong>Lista de Incidentes Registrados</strong></h1>
                <br>
                <!-- Modal -->
                <div class="row mt-3">
                    <div class="col-sm-12">
                        <!--Bordered table-->
                        <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                            <table class="table table-bordered" id="project_table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                    <th>Asunto</th>
                                    <th>Estado</th>
                                    <th>Técnico</th>
                                    <td>
                                        <?php include './solicitud_crea.php'; ?>
                                    </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>00</td>
                                        <td>Design and Wireframes</td>
                                        <td>Eduardo Zárate</td>
                                        <td>13 Feb, 2018</td>
                                        <td><span class="badge badge-danger">Pendiente</span></td>
                                        <td>
                                            <!--Inbox icon-->
                                            <span class="menu-icon inbox" style="margin-left: 35%;">
                                                <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="badge badge-danger">4</span>
                                                </a>
                                            </span>
                                            <!--Inbox icon-->
                                        </td>
                                        <td><button type="button" class="btn btn-info">Detalles</button></td>
                                    </tr>
                                    <tr>
                                        <td>01</td>
                                        <td>Web design</td>
                                        <td>Alessandra Taquides</td>
                                        <td>10 June, 2018</td>
                                        <td><span class="badge badge-success">Finalizado</span></td>
                                        <td>
                                            <!--Inbox icon-->
                                            <span class="menu-icon inbox" style="margin-left: 35%;">
                                                <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="badge badge-danger">4</span>
                                                </a>
                                            </span>
                                            <!--Inbox icon-->
                                        </td>
                                        <td><button type="button" class="btn btn-info">Detalles</button></td>
                                    </tr>
                                    <tr>
                                        <td>02</td>
                                        <td>App development</td>
                                        <td>Nindi Batubara</td>
                                        <td>09 November, 2018</td>
                                        <td><span class="badge badge-warning">En Espera</span></td>
                                        <td>
                                            <!--Inbox icon-->
                                            <span class="menu-icon inbox" style="margin-left: 35%;">
                                                <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="badge badge-danger">4</span>
                                                </a>
                                            </span>
                                            <!--Inbox icon-->
                                        </td>
                                        <td><button type="button" class="btn btn-info">Detalles</button></td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>App prototyping</td>
                                        <td>Suemy Castro</td>
                                        <td>02 September, 2018</td>
                                        <td><span class="badge badge-danger">Pendiente</span></td>
                                        <td>
                                            <!--Inbox icon-->
                                            <span class="menu-icon inbox" style="margin-left: 35%;">
                                                <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="badge badge-danger">4</span>
                                                </a>
                                            </span>
                                            <!--Inbox icon-->
                                        </td>
                                        <td><button type="button" class="btn btn-info">Detalles</button></td>
                                    </tr>
                                    <tr>
                                        <td>04</td>
                                        <td>Web development</td>
                                        <td>Geraldine Albares</td>
                                        <td>15 December, 2018</td>
                                        <td><span class="badge badge-info">En Proceso</span></td>
                                        <td>
                                            <!--Inbox icon-->
                                            <span class="menu-icon inbox" style="margin-left: 35%;">
                                                <a class="" href="#" role="button" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-envelope"></i>
                                                    <span class="badge badge-danger">4</span>
                                                </a>
                                            </span>
                                            <!--Inbox icon-->
                                        </td>
                                        <td><button type="button" class="btn btn-info">Detalles</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!--/Bordered table-->
                    </div>
                </div>

                <!--Footer-->
                <div class="row mt-5 mb-4 footer">
                    <div class="col-sm-8">
                        <span>&copy; All rights reserved 2023 designed by <a class="text-info" href="#">DesysWeb</a></span>
                    </div>
                    <div class="col-sm-4 text-right">
                        <a href="#" class="ml-2">Contact Us</a>
                        <a href="#" class="ml-2">Support</a>
                    </div>
                </div>
                <!--Footer-->

            </div>
        </div>

        <!--Main Content-->

    </div>

    <!--Page Wrapper-->

    <!-- Page JavaScript Files-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-1.12.4.min.js"></script>
    <!--Popper JS-->
    <script src="assets/js/popper.min.js"></script>
    <!--Bootstrap-->
    <script src="assets/js/bootstrap.min.js"></script>
    <!--Sweet alert JS-->
    <script src="assets/js/sweetalert.js"></script>
    <!--Progressbar JS-->
    <script src="assets/js/progressbar.min.js"></script>
    <!--Charts-->
    <!--Canvas JS-->
    <script src="assets/js/charts/canvas.min.js"></script>
    <!--Bootstrap Calendar JS-->
    <script src="assets/js/calendar/bootstrap_calendar.js"></script>
    <script src="assets/js/calendar/demo.js"></script>
    <!--Bootstrap Calendar-->

    <!--Custom Js Script-->
    <script src="assets/js/custom.js"></script>
    <!--Custom Js Script-->
  </body>
</html>