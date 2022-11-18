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
            <a class="btn bg-dark btn-sm mr-2" href="/articles/new">Nuevo Artículo</a>
        </h3>

        <h3 class="card-title">
            <a class="btn bg-dark btn-sm" href="/articles/import">Importar Artículo</a>
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
                                    <img class="profile-user-img img-fluid img-circle" id="picture_category" src="views/img/categories/31/31.png" alt="User profile picture">
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
                                    <li class="list-group-item p-0">
                                        <b>Receta Médica</b> <a class="float-right" id="prescription_article"></a>
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

                                <strong><i class="fas fa-pencil-alt mr-1"></i> Alternativas</strong>

                                <div class="form-group similares" id="similares">

                                </div>
                                <hr>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                <?php endif ?>


            </div>


    </div>
</div>

<?php

?>

<!-- MODAL Configurar Articulo -->
<div class="modal fade" id="modalConfigurarArticulo">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

                <input type="hidden" name="id_article" id="id_article">
                <input type="hidden" name="id_company" id="id_company">

                <?php

                require_once "controllers/articles.controller.php";

                $create = new ArticlesController();
                $create->update();

                ?>

                <div class="modal-header">
                    <h4 class="modal-title">Solicitar Actualización</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="col-lg-12">

                        <div class="form-group mt-2 row">

                            <!--=====================================
                            Codigo
                            ======================================-->
                            <div class="col-lg-3 form-group">

                                <label>Código</label>

                                <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','categories','code_category')" name="code" id="code" required readonly>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>

                            <!--=====================================
                            Nombre
                            ======================================-->
                            <div class="col-lg-9 form-group">

                                <label>Nombre</label>

                                <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="name" id="name" required readonly>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>

                            <!--=====================================
                            Funcion Terapeutica
                            ======================================-->
                            <div class="col-lg-6 form-group">

                                <label>Funcion Terapeútica</label>

                                <?php

                                $url = "therapies?select=id_therapy,code_therapy,name_therapy";
                                $method = "GET";
                                $fields = array();

                                $therapies = CurlController::request($url, $method, $fields)->results;

                                ?>

                                <div class="form-group">

                                    <select class="form-control select2" name="therapy" id="therapy" style="width:100%">

                                        <option value="">Seleccionar Funcion Terapeútica</option>

                                        <?php foreach ($therapies as $key => $value) : ?>

                                            <option value="<?php echo $value->id_therapy ?>"><?php echo $value->code_therapy . ' - ' . $value->name_therapy ?></option>

                                        <?php endforeach ?>

                                    </select>

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>
                            </div>

                            <!--=====================================
                            Sustancia Activa
                            ======================================-->
                            <div class="col-lg-6 form-group">

                                <label>Sustancia Activa</label>

                                <?php

                                $url = "substances?select=id_substance,code_substance,name_substance";
                                $method = "GET";
                                $fields = array();

                                $substances = CurlController::request($url, $method, $fields)->results;

                                ?>

                                <div class="form-group">

                                    <select class="form-control select2" name="substance" id="substance" style="width:100%">

                                        <option value="">Seleccionar Sustancia Activa</option>

                                        <?php foreach ($substances as $key => $value) : ?>

                                            <option value="<?php echo $value->id_substance ?>"><?php echo $value->code_substance . ' - ' . $value->name_substance ?></option>

                                        <?php endforeach ?>

                                    </select>

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>
                            </div>

                            <!--=====================================
                            Ubicacion
                            ======================================-->
                            <div class="col-lg-6 form-group">

                                <label>Ubicación</label>

                                <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="location" id="location">

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>


                            <!--=====================================
                            Obervacion
                            ======================================-->
                            <div class="col-lg-6 form-group">

                                <label>Observación</label>

                                <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="observation" id="observation">

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>

                        </div>

                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-dark">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>

<script src="views/assets/custom/datatable/datatable.js"></script>
<script src="views/pages/articles/articles.js"></script>

<script>
    window.document.title = "Artículos"
</script>