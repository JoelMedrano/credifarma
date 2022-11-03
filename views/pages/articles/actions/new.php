<?php

$select = "code_article";

$url = "articles?select=" . $select . "&orderBy=code_article&orderMode=DESC&startAt=0&endAt=1";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);

$tamaño = 5;

if ($response->status == 200) {
    $code = $response->results[0];
    $maxCode = str_pad($code->code_article + 1, $tamaño, '0', STR_PAD_LEFT);
} else {
    $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
}

$url = "companies";
$method = "GET";
$fields = array();

$companiesData = CurlController::request($url, $method, $fields);
$companies = $companiesData->results;

?>

<div class="card card-dark card-outline">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">

            <?php

            require_once "controllers/articles.controller.php";

            $create = new ArticlesController();
            $create->create();

            ?>

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateRepeat(event,'regex','categories','code_category')" value="<?php echo $maxCode ?>" name="code" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Nombre
                    ======================================-->
                    <div class="col-lg-9 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'regex')" name="name" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Categoría
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Categoria<sup class="text-danger">*</sup></label>

                        <?php

                        $url = "categories?select=id_category,code_category,name_category";
                        $method = "GET";
                        $fields = array();

                        $categories = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group">

                            <select class="form-control select2" name="category" style="width:100%" required>

                                <option value="">Seleccionar Categoria</option>

                                <?php foreach ($categories as $key => $value) : ?>

                                    <option value="<?php echo $value->id_category ?>"><?php echo $value->code_category . ' - ' . $value->name_category ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>
                    </div>

                    <!--=====================================
                    Laboratorios
                    ======================================-->
                    <div class="col-lg-9 form-group">

                        <label>Laboratorio<sup class="text-danger">*</sup></label>

                        <?php

                        $url = "laboratories?select=id_laboratory,code_laboratory,name_laboratory";
                        $method = "GET";
                        $fields = array();

                        $laboratories = CurlController::request($url, $method, $fields)->results;

                        ?>

                        <div class="form-group">

                            <select class="form-control select2" name="laboratory" style="width:100%" required>

                                <option value="">Seleccionar Laboratorio</option>

                                <?php foreach ($laboratories as $key => $value) : ?>

                                    <option value="<?php echo $value->id_laboratory ?>"><?php echo $value->code_laboratory . ' - ' . $value->name_laboratory ?></option>

                                <?php endforeach ?>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>
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

                            <select class="form-control select2" name="therapy" style="width:100%">

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

                            <select class="form-control select2" name="substance" style="width:100%">

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
                    Fraccion
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Fracción</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" name="fraccion" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Stock Minimo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Stk Min</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" name="stkmin">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Stock Maximo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Stk Max</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" name="stkmax">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Verificación
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Verificación</label>

                        <div class="form-group">

                            <select class="form-control select2" name="verification" style="width:100%">

                                <option value="">Seleccionar Opción</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                    </div>

                    <!--=====================================
                    Receta Médica
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Receta Médica</label>

                        <div class="form-group">

                            <select class="form-control select2" name="prescription" style="width:100%">

                                <option value="">Seleccionar Opción</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>

                            </select>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                    </div>

                    <!--=====================================
                    Cod Digemin
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Cod. Digemid</label>

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" name="digemid">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Cod Especial
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Cod. Especial</label>

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" name="special">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Cod Digemin
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Cod. Barra</label>

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" name="barcode">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <hr width="100%" size="10px" color="black">

                    <!--=====================================
                    CONFIGURACION DE EMPRESA
                    ======================================-->
                    <div class="col-lg-12 form-group">
                        <label>Configuracion por sucursal<sup class="text-danger">***</sup></label>

                        <?php foreach ($companies as $key => $value) : ?>

                            <div class="col-lg-12 form-group row">

                                <!--=====================================
                                Sucursal
                                ======================================-->
                                <div class="col-lg-5 form-group">

                                    <label>Sucursal</label>

                                    <input type="hidden" value="<?php echo $value->id_company ?>" name="<?php echo $value->id_company ?>" id="<?php echo $value->id_company ?>">

                                    <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" value="<?php echo $value->name_company ?>" name="company<?php echo $value->id_company ?>" readonly>

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Estado Ubicación
                                ======================================-->
                                <div class="col-lg-1 form-group">

                                    <label>Estado</label>

                                    <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="switch<?php echo $value->id_company ?>" name="switch<?php echo $value->id_company ?>" checked><label class="custom-control-label" for="switch<?php echo $value->id_company ?>"></label></div>

                                </div>

                                <!--=====================================
                                Ubicacion
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Ubicación</label>

                                    <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'text')" name="location<?php echo $value->id_company ?>">

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Utilidad
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Utilidad</label>

                                    <input type="number" step="any" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'number')" name="utility<?php echo $value->id_company ?>">

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Comision
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Comisión</label>

                                    <input type="number" step="any" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'text')" name="commission<?php echo $value->id_company ?>">

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                            </div>

                        <?php endforeach ?>
                    </div>

                </div>

            </div>
        </div>

        <div class="card-footer">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="/articles" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>

    </form>

</div>

<script>
    window.document.title = "Articulos - Nuevo"
</script>