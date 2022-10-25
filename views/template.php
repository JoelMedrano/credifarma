<?php

/*=============================================
Capturar las rutas de la URL
=============================================*/
$routesArray = explode("/", $_SERVER['REQUEST_URI']);
$routesArray = array_filter($routesArray);

/*=============================================
Limpiar la Url de variables GET
=============================================*/
foreach ($routesArray as $key => $value) {

    $value = explode("?", $value)[0];
    $routesArray[$key] = $value;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Fixed Sidebar</title>

    <link rel="icon" href="views/assets/img/template/icono.png">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="views/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="views/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="views/assets/plugins/adminlte/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed text-sm sidebar-collapse layout-navbar-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php include "views/modules/navbar.php"; ?>

        <!-- Main Sidebar Container -->
        <?php include "views/modules/sidebar.php"; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <?php

            if (!empty($routesArray[1])) {

                if (
                    $routesArray[1] == "admins" ||
                    $routesArray[1] == "users" ||
                    $routesArray[1] == "stores" ||
                    $routesArray[1] == "categories" ||
                    $routesArray[1] == "subcategories" ||
                    $routesArray[1] == "products" ||
                    $routesArray[1] == "orders" ||
                    $routesArray[1] == "sales" ||
                    $routesArray[1] == "disputes" ||
                    $routesArray[1] == "messages"
                ) {

                    include "views/pages/" . $routesArray[1] . "/" . $routesArray[1] . ".php";
                } else {

                    include "views/pages/404/404.php";
                }
            } else {

                include "views/pages/home/home.php";
            }

            ?>

            <!-- Content Header (Page header) -->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <?php include "modules/footer.php"; ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="views/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="views/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="views/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="views/assets/plugins/adminlte/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="views/assets/plugins/adminlte/js/demo.js"></script>
</body>

</html>