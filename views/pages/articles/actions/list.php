<?php

if (isset($_GET["start"]) && isset($_GET["end"])) {

    $between1 = $_GET["start"];
    $between2 = $_GET["end"];
} else {

    $between1 = date("Y-m-d", strtotime("-29 day", strtotime(date("Y-m-d"))));
    $between2 = date("Y-m-d");
}

?>

<input type="hidden" id="between1" value="<?php echo $between1 ?>">
<input type="hidden" id="between2" value="<?php echo $between2 ?>">

<div class="card">
    <div class="card-header">

        <h3 class="card-title">
            <a class="btn bg-dark btn-sm" href="/articles/new">Nuevo Artículo</a>
        </h3>

        <div class="card-tools">

            <div class="d-flex">

                <div class="d-flex mr-2">
                    <span class="mr-2">Reportes</span>
                    <input type="checkbox" name="my-checkbox" data-bootstrap-switch data-off-color="light" data-on-color="dark" data-size="mini" data-handle-width="70" onchange="reportActive(event)">
                </div>

                <div class="input-group">
                    <button type="button" class="btn float-right" id="daterange-btn">
                        <i class="far fa-calendar-alt mr-2"></i>
                        <?php echo $between1 ?> - <?php echo $between2 ?>
                        <i class="fas fa-caret-down ml-2"></i>
                    </button>
                </div>

            </div>

        </div>

    </div>

    <div class="form-group row">

        <?php if ($_SESSION["admin"]->rol_user == "administrador") : ?>
            <div class="col-lg-12">
            <?php else : ?>
                <div class="col-lg-9">
                <?php endif ?>

                <div class="card-body">
                    <table id="adminsTable" class="table table-bordered table-striped tableArticles">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Categoria</th>
                                <th>Laboratorio</th>
                                <th>Prescripción</th>
                                <th>Estado</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>

                    </table>
                </div>
                </div>

                <?php if ($_SESSION["admin"]->rol_user == "vendedor") : ?>

                    <div class="col-lg-3">

                        <div class="card card-dark card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" src="views/img/categories/18/farmacos.png" alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center" id="name_article"></h3>

                                <p class="text-muted text-center" id="name_laboratory"></p>

                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item  p-0">
                                        <b>Stock Unidad</b> <a class="float-right" id="full_stock_artcom"></a>
                                    </li>
                                    <li class="list-group-item p-0">
                                        <b>Precio Venta Unidad S/</b> <a class="float-right" id="full_price_artcom"></a>
                                    </li>
                                    <li class="list-group-item p-0">
                                        <b>Stock Fracciones</b> <a class="float-right" id="frac_stock_artcom"></a>
                                    </li>
                                    <li class="list-group-item p-0">
                                        <b>Precio Venta Fracción S/</b> <a class="float-right" id="frac_price_artcom"></a>
                                    </li>
                                </ul>

                            </div>
                        </div>

                        <!-- About Me Box -->
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Datos Principales</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fas fa-hand-holding-medical mr-1"></i> Acción Terapeutica</strong>

                                <p class="text-muted" id="name_therapy">
                                </p>

                                <hr>

                                <strong><i class="fas fa-vials mr-1"></i> Sustancia Activa</strong>

                                <p class="text-muted" id="name_substance"></p>

                                <hr>

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Similares</strong>

                                <div style="background-color: lightblue;width: 100%; height:200px; overflow-y: scroll">

                                    <p class="p-0 m-0">
                                        AB AMBROMOX NF 1200 AMP X1
                                    </p>
                                    <p class="p-0 m-0">
                                        AB AMBROMOX NF 300 AMP X1
                                    </p>
                                    <p class="p-0 m-0">
                                        AB FORTIMICIN NF 600MG AMP
                                    </p>
                                    <p class="p-0 m-0">
                                        AB FORTIMICIN NF 600MG AMP
                                    </p>
                                    <p class="p-0 m-0">
                                        AB FORTIMICIN NF 600MG AMP
                                    </p>
                                    <p class="p-0 m-0">
                                        AB FORTIMICIN NF 600MG AMP
                                    </p>
                                    <p class="p-0 m-0">
                                        AB FORTIMICIN NF 600MG AMP
                                    </p>
                                </div>
                                <hr>

                                <strong><i class="far fa-file-alt mr-1"></i> Receta Médica</strong>

                                <span class="text-danger"><b>SI</b></span>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                <?php endif ?>


            </div>


    </div>


    <script src="views/assets/custom/datatable/datatable.js"></script>
    <script src="views/pages/articles/articles.js"></script>

    <script>
        window.document.title = "Artículos"
    </script>