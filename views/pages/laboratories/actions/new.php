<?php

$select = "code_laboratory";

$url = "laboratories?select=" . $select . "&orderBy=code_laboratory&orderMode=DESC&startAt=0&endAt=1";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);

$tamaño = 4;

if ($response->status == 200) {
    $code = $response->results[0];
    $maxCode = str_pad($code->code_laboratory + 1, $tamaño, '0', STR_PAD_LEFT);
} else {
    $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
}

?>

<div class="card card-dark card-outline">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">

            <?php

            require_once "controllers/laboratories.controller.php";

            $create = new LaboratoriesController();
            $create->create();

            ?>

            <div class="col-md-10 offset-md-1">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateRepeat(event,'regex','categories','code_category')" name="codigo" value="<?php echo $maxCode ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    RUC
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>RUC</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateConsulta(event,'numbers','6')" name="documento" id="documento">

                        <div id="valid-feedback" class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Razón Social
                    ======================================-->
                    <div class="col-lg-8 form-group">

                        <label>Razón Social</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','laboratories','bussiness_name_laboratory')" name="bussiness_name" id="bussiness_name">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Nombre
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','laboratories','name_laboratory')" name="name" id="name" required>

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
                    Gerente
                    ======================================-->
                    <div class="col-lg-6 form-group">

                        <label>Gerente</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="ceo" id="ceo">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Contacto
                    ======================================-->
                    <div class="col-lg-6 form-group">

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

                    <a href="/laboratories" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>


    </form>

</div>
<script src="views/pages/laboratories/laboratories.js"></script>

<script>
    window.document.title = "Laboratorios - Nuevo"
</script>