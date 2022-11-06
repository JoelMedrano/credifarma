<?php

if (isset($routesArray[3])) {

    $security = explode("~", base64_decode($routesArray[3]));

    if ($security[1] == $_SESSION["admin"]->token_user) {
        $select = "id_provider,code_provider,td_provider,document_provider,bussiness_name_provider,address_provider,pc_provider,phone1_provider,phone2_provider,contact_provider,email_provider,state_provider,pcreg_provider,usreg_provider,pcmod_provider,usmod_provider,date_created_provider,date_updated_provider";

        $url = "providers?select=" . $select . "&linkTo=id_provider&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {

            $provider = $response->results[0];

            $pc_provider = $provider->pc_provider;
            if ($pc_provider == null ||  $pc_provider = "") {
                $pccode = "Seleccionar ciudad";
            } else {
                $cities = file_get_contents("views/assets/json/ubigeos.json");
                $cities = json_decode($cities, true);

                foreach ($cities as $key => $value) {

                    if ($value["inei"] == $provider->pc_provider) {
                        $pccode = $value["departamento"] . ' - ' . $value["provincia"] . ' - ' . $value["distrito"];
                    }
                }
            }

            $td_provider = $provider->td_provider;
            if ($td_provider == null ||  $td_provider = "") {
                $tdcode = "Seleccionar Departamento";
            } else {
                $td = file_get_contents("views/assets/json/tipo_documento_identidad.json");
                $td = json_decode($td, true);

                foreach ($td as $key => $value) {

                    if ($value["code"] == $provider->td_provider) {
                        $tdcode = $value["description"];
                    }
                }
            }
        } else {

            echo '<script>

            window.location = "/providers";

            </script>';
        }
    } else {

        echo '<script>

				window.location = "/providers";

				</script>';
    }
}
?>
<div class="card card-dark card-outline">

    <form method="post" id="formProvider" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $provider->id_provider ?>" name="idProvider">

        <div class="card-header">

            <?php

            require_once "controllers/providers.controller.php";

            $create = new ProvidersController();
            $create->edit($provider->id_provider);

            ?>

            <div class="col-lg-10 offset-lg-1">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-1 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','providers','code_provider')" name="codigo" value="<?php echo $provider->code_provider ?>" required readonly>

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

                            <option value="<?php echo $provider->td_provider ?>"><?php echo $tdcode ?></option>

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

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateConsultaProviders(event,'numbers')" name="document_provider" id="document_provider" value="<?php echo $provider->document_provider ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Razón Social
                    ======================================-->
                    <div class="col-lg-6 form-group">

                        <label>Razón Social</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','providers','bussiness_name_provider')" name="bussiness_name" id="bussiness_name" value="<?php echo $provider->bussiness_name_provider ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Direccion
                    ======================================-->
                    <div class="col-lg-8 form-group">

                        <label>Direccion</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="address" id="address" value="<?php echo $provider->address_provider ?>">

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

                            <option value="<?php echo $provider->pc_provider ?>"><?php echo $pccode ?></option>

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

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone1" id="phone1" value="<?php echo $provider->phone1_provider ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Telefono 2
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Telefono 2</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'phone')" name="phone2" id="phone2" value="<?php echo $provider->phone2_provider ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Contacto
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Contacto</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'regex')" name="contact" id="contact" value="<?php echo $provider->contact_provider ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Email
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Email</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateJS(event,'email')" name="email" id="email" value="<?php echo $provider->email_provider ?>">

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