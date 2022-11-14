<?php

$select = "actual_correlative";

$url = "correlatives?select=id_correlative,actual_correlative&linkTo=code_correlative&equalTo=co";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);

$tamaño = 5;

if ($response->status == 200) {
    $code = $response->results[0];
    $maxCode = str_pad($code->actual_correlative, $tamaño, '0', STR_PAD_LEFT);
} else {
    $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
}

?>
<div class="card card-dark card-outline">

    <form method="post" class="needs-validation formularioCompras" novalidate enctype="multipart/form-data">

        <div class="card-header">

            <?php

            require_once "controllers/purchases.controller.php";

            $create = new PurchasesController();
            $create->create();

            ?>
        </div>

        <div class="card-body form-group row">

            <div class="col-lg-12 row">

                <div class="col-lg-12">

                    <div class="form-group mt-2 row">

                        <!--=====================================
                        Codigo
                        ======================================-->
                        <div class="col-lg-2 form-group m-0">

                            <label>Código</label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','purchases','code_purchase')" name="codigo" value="<?php echo $maxCode ?>" required readonly>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Proveedor
                        ======================================-->
                        <div class="col-lg-10 form-group m-0">

                            <label>Proveedor<sup class="text-danger">*</sup></label>

                            <?php

                            $url = "providers?select=*&linkTo=state_provider&equalTo=1";
                            $method = "GET";
                            $fields = array();

                            $providers = CurlController::request($url, $method, $fields)->results;

                            ?>

                            <div class="form-group">

                                <select class="form-control select2" name="provider" style="width:100%" required>

                                    <option value="">Seleccionar Proveedor</option>

                                    <?php foreach ($providers as $key => $value) : ?>

                                        <option value="<?php echo $value->id_provider ?>"><?php echo $value->code_provider . ' - ' . $value->bussiness_name_provider ?></option>

                                    <?php endforeach ?>

                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>
                        </div>

                        <!--=====================================
                        Tipo Documento
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Tipo Documento</label>

                            <?php

                            $td = file_get_contents("views/assets/json/tipo_documento.json");
                            $td = json_decode($td, true);

                            ?>

                            <select class="form-control select2" name="td" id="td" required>

                                <option value>Seleccionar Documento</option>

                                <?php foreach ($td as $key => $value) : ?>

                                    <?php if ($value["code"] == "01" || $value["code"] == "03" || $value["code"] == "99") : ?>
                                        <option value="<?php echo $value["code"] ?>"><?php echo $value["code"] . ' - ' . $value["description"] ?></option>
                                    <?php endif ?>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Documento
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Documento</label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="document" required>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        GUIA
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Guia</label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="guide">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Tipo Pago
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Tipo Pago</label>

                            <?php

                            $tp = file_get_contents("views/assets/json/tipo_pago.json");
                            $tp = json_decode($tp, true);

                            ?>

                            <select class="form-control select2" name="tp" id="tp" required>

                                <option value>Seleccionar Tipo</option>

                                <?php foreach ($tp as $key => $value) : ?>

                                    <option value="<?php echo $value["code"] ?>"><?php echo $value["code"] . ' - ' . $value["description"] ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Compañia
                        ======================================-->
                        <div class="col-lg-6 form-group m-0">

                            <label>Sucursal<sup class="text-danger">*</sup></label>

                            <?php

                            $url = "companies";
                            $method = "GET";
                            $fields = array();

                            $companies = CurlController::request($url, $method, $fields)->results;

                            ?>

                            <div class="form-group">

                                <select class="form-control select2" name="sucursal" id="sucursal" style="width:100%" required>

                                    <option value="">Seleccionar Sucursal</option>

                                    <?php foreach ($companies as $key => $value) : ?>

                                        <option value="<?php echo $value->id_company ?>"><?php echo $value->name_company ?></option>

                                    <?php endforeach ?>

                                </select>

                                <div class="valid-feedback">Valid.</div>
                                <div class="invalid-feedback">Please fill out this field.</div>

                            </div>
                        </div>

                        <!--=====================================
                        Total
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Total S/</label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="total" id="total" readonly>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Vencimiento
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Fecha de pago</label>

                            <input type="date" class="form-control" name="expiration" id="expiration">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                    </div>

                    <!--=====================================
                    TITULOS
                    ======================================-->
                    <div class="card card-primary card-outline">

                        <div class="row">

                            <div class="col-lg-3">

                                <label>Artículo</label>

                            </div>

                            <div class="col-lg-1">

                                <label>Cantidad</label>

                            </div>

                            <div class="col-lg-1">

                                <label>Fracción</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Precio C. IGV</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Precio S. IGV</label>

                            </div>


                            <div class="col-lg-1">

                                <label for="">Dscto %</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Total</label>

                            </div>

                            <div class="col-lg-1">

                                <label>Utilidad</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Vencimiento</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Lote</label>

                            </div>

                        </div>

                    </div>

                    <!--=====================================
                    ENTRADA PARA AGREGAR MATERIAPRIMA
                    ======================================-->

                    <div class="form-group nuevoDetalleCompra">


                    </div>

                    <input type="hidden" id="jsonDetalleCompra" name="jsonDetalleCompra">

                </div>

                <div class="col-lg-12">

                    <div class="card-tools">

                        <h3 class="card-title">
                            <button type="button" class="btn bg-dark btn-sm btnRecargarTabla">Recargar Tabla</button>
                        </h3>

                        <table id="adminsTable" class="table table-bordered table-striped tableArticlesPurchases">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombre</th>
                                    <th>Laboratorio</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="card-footer">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="/purchases" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>

    </form>

</div>

<script src="views/assets/custom/datatable/datatable.js"></script>
<script src="views/pages/purchases/purchases.js"></script>
<script>
    window.document.title = "Compras - Nueva"
</script>