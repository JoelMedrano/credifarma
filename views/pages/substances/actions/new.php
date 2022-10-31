<?php

$select = "code_substance";

$url = "substances?select=" . $select . "&orderBy=code_substance&orderMode=DESC&startAt=0&endAt=1";
$method = "GET";
$fields = array();

$response = CurlController::request($url, $method, $fields);

$tamaño = 4;

if ($response->status == 200) {
    $code = $response->results[0];
    $maxCode = str_pad($code->code_substance + 1, $tamaño, '0', STR_PAD_LEFT);
} else {
    $maxCode = str_pad('1', $tamaño, '0', STR_PAD_LEFT);
}

?>

<div class="card card-dark card-outline">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <div class="card-header">

            <?php

            require_once "controllers/substances.controller.php";

            $create = new SubstancesController();
            $create->create();

            ?>

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','substances','code_substance')" name="codigo" value="<?php echo $maxCode ?>" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Nombre
                    ======================================-->
                    <div class="col-lg-10 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="nombre" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Vadecum
                    ======================================-->
                    <div class="col-lg-12 form-group">

                        <label>Vadecum</label>

                        <textarea type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="vadecum"></textarea>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                </div>


            </div>

        </div>

        <div class="card-footer">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="/substances" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>


    </form>

</div>

<script>
    window.document.title = "Sustancias - Nueva"
</script>