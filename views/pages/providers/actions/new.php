<?php

$select = "code_provider";

$url = "providers?select=" . $select . "&orderBy=code_provider&orderMode=DESC&startAt=0&endAt=1";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);

$tamaño = 3;

if ($response->status == 200) {
    $code = $response->results[0];
    $maxCode = str_pad($code->code_provider + 1, $tamaño, '0', STR_PAD_LEFT);
} else {
    $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
}

?>
<div class="card card-dark card-outline">

    <form method="post" id="formProvider" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">

            <?php

            require_once "controllers/providers.controller.php";

            $create = new ProvidersController();
            $create->create();

            ?>

            <div class="col-lg-10 offset-lg-1">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-1 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','providers','code_provider')" name="codigo" value="<?php echo $maxCode ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Tipo Documento Identidad
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Tipo Documento Identidad</label>

                        <?php

                        $tdi = file_get_contents("views/assets/json/tipo_documento_identidad.json");
                        $tdi = json_decode($tdi, true);

                        ?>

                        <select class="form-control select2" name="td_provider" id="td_provider" required>

                            <option value>Seleccionar Documento</option>

                            <?php foreach ($tdi as $key => $value) : ?>

                                <option value="<?php echo $value["code"] ?>"><?php echo $value["description"] ?></option>

                            <?php endforeach ?>

                        </select>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    RUC
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>RUC</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateConsultaProviders(event,'numbers')" name="document_provider" id="document_provider" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Razón Social
                    ======================================-->
                    <div class="col-lg-6 form-group">

                        <label>Razón Social</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','providers','bussiness_name_provider')" name="bussiness_name" id="bussiness_name">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Direccion
                    ======================================-->
                    <div class="col-lg-8 form-group">

                        <label>Direccion</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="address" id="address">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Codigo postal
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Ciudad</label>

                        <?php

                        $cities = file_get_contents("views/assets/json/ubigeos.json");
                        $cities = json_decode($cities, true);

                        ?>

                        <select class="form-control select2" name="ciudad" id="ciudad">

                            <option value>Seleccionar Ciudad</option>

                            <?php foreach ($cities as $key => $value) : ?>

                                <option value="<?php echo $value["inei"] ?>"><?php echo $value["departamento"] . ' - ' . $value["provincia"] . ' - ' . $value["distrito"] ?></option>

                            <?php endforeach ?>

                        </select>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Telefono 1
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Telefono 1</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone1" id="phone1">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Telefono 2
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Telefono 2</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone2" id="phone2">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Contacto
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Contacto</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="contact" id="contact">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Email
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Email</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'email')" name="email" id="email">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>


                </div>

            </div>

        </div>

        <div class="card-footer">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="/providers" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>


    </form>

</div>
<script src="views/pages/providers/providers.js"></script>


<script>
    window.document.title = "Proveedores - Nueva"
</script>