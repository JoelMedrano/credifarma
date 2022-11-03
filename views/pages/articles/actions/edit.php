<?php

if (isset($routesArray[3])) {

    $security = explode("~", base64_decode($routesArray[3]));

    if ($security[1] == $_SESSION["admin"]->token_user) {
        $select = "id_article,code_article,name_article,id_category_article,id_laboratory_article,frac_article,stkmin_article,stkmax_article,id_therapy_article,id_substance_article,prescription_article,verification_article,state_article,digemid_article,specialcode_article,barcode_article,date_created_article";

        $url = "articles?select=" . $select . "&linkTo=id_article&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {

            $article = $response->results[0];
            $id_category = $article->id_category_article;
            $id_laboratory = $article->id_laboratory_article;
            $id_therapy = $article->id_therapy_article;
            $id_substance = $article->id_substance_article;

            $url = "relations?rel=artscoms,companies&type=artcom,company&select=id_artcom,id_article_artcom,id_company_artcom,name_company,state_artcom,location_artcom,utility_artcom,commission_artcom&linkTo=id_article_artcom&equalTo=" . $article->id_article;
            $method = "GET";
            $fields = array();

            $companiesData = CurlController::request($url, $method, $fields);
            $companies = $companiesData->results;
        } else {

            echo '<script>

            window.location = "/articles";

            </script>';
        }
    } else {

        echo '<script>

				window.location = "/articles";

				</script>';
    }
}
?>

<div class="card card-dark card-outline">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $article->id_article ?>" name="idArticle">

        <div class="card-header">

            <?php

            require_once "controllers/articles.controller.php";

            $create = new ArticlesController();
            $create->edit($article->id_article);

            ?>

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-3 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateRepeat(event,'regex','categories','code_category')" value="<?php echo $article->code_article ?>" name="code" required readonly>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Nombre
                    ======================================-->
                    <div class="col-lg-9 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'regex')" value="<?php echo $article->name_article ?>" name="name" required>

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


                                <?php foreach ($categories as $key => $value) : ?>

                                    <?php if ($value->id_category == $id_category) : ?>
                                        <option value="<?php echo $article->id_category_article ?>" selected><?php echo $value->code_category . ' - ' . $value->name_category ?></option>
                                    <?php else : ?>
                                        <option value="<?php echo $value->id_category ?>"><?php echo $value->code_category . ' - ' . $value->name_category ?></option>
                                    <?php endif ?>

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

                                <?php foreach ($laboratories as $key => $value) : ?>

                                    <?php if ($value->id_laboratory == $id_laboratory) : ?>
                                        <option value="<?php echo $id_laboratory ?>" selected><?php echo $value->code_laboratory . ' - ' . $value->name_laboratory ?></option>

                                    <?php else : ?>

                                        <option value="<?php echo $value->id_laboratory ?>"><?php echo $value->code_laboratory . ' - ' . $value->name_laboratory ?></option>

                                    <?php endif ?>

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

                                <?php if ($id_therapy == 0) : ?>

                                    <option value="">Seleccionar Funcion Terapeútica</option>

                                    <?php foreach ($therapies as $key => $value) : ?>

                                        <option value="<?php echo $value->id_therapy ?>"><?php echo $value->code_therapy . ' - ' . $value->name_therapy ?></option>

                                    <?php endforeach ?>

                                <?php else : ?>

                                    <?php foreach ($therapies as $key => $value) : ?>

                                        <?php if ($value->id_therapy == $id_therapy) : ?>
                                            <option value="<?php echo $id_therapy ?>" selected><?php echo $value->code_therapy . ' - ' . $value->name_therapy ?></option>

                                        <?php endif ?>

                                        <option value="<?php echo $value->id_therapy ?>"><?php echo $value->code_therapy . ' - ' . $value->name_therapy ?></option>

                                    <?php endforeach ?>

                                <?php endif ?>


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


                                <?php if ($id_substance == 0) : ?>

                                    <option value="">Seleccionar Sustancia Activa</option>

                                    <?php foreach ($substances as $key => $value) : ?>

                                        <option value="<?php echo $value->id_substance ?>"><?php echo $value->code_substance . ' - ' . $value->name_substance ?></option>

                                    <?php endforeach ?>

                                <?php else : ?>

                                    <?php foreach ($substances as $key => $value) : ?>

                                        <?php if ($value->id_substance == $id_substance) : ?>
                                            <option value="<?php echo $id_substance ?>" selected><?php echo $value->code_substance . ' - ' . $value->name_substance ?></option>

                                        <?php endif ?>

                                        <option value="<?php echo $value->id_substance ?>"><?php echo $value->code_substance . ' - ' . $value->name_substance ?></option>

                                    <?php endforeach ?>

                                <?php endif ?>



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

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" value="<?php echo $article->frac_article ?>" name="fraccion" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Stock Minimo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Stk Min</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" value="<?php echo $article->stkmin_article ?>" name="stkmin">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Stock Maximo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Stk Max</label>

                        <input type="text" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'numbers')" value="<?php echo $article->stkmax_article ?>" name="stkmax">

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

                                <?php if ($article->verification_article != null) : ?>

                                    <?php if ($article->verification_article == "NO") : ?>

                                        <option value="NO">NO</option>
                                        <option value="SI">SI</option>

                                    <?php else : ?>

                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>

                                    <?php endif ?>

                                <?php else : ?>

                                    <option value="">Seleccionar Opción</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">Vimeo</option>

                                <?php endif ?>

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

                                <?php if ($article->prescription_article != null) : ?>

                                    <?php if ($article->prescription_article == "NO") : ?>

                                        <option value="NO">NO</option>
                                        <option value="SI">SI</option>

                                    <?php else : ?>

                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>

                                    <?php endif ?>

                                <?php else : ?>

                                    <option value="">Seleccionar Opción</option>
                                    <option value="SI">SI</option>
                                    <option value="NO">Vimeo</option>

                                <?php endif ?>

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

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" value="<?php echo $article->digemid_article ?>" name="digemid">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Cod Especial
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Cod. Especial</label>

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" value="<?php echo $article->specialcode_article ?>" name="special">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Cod Digemin
                    ======================================-->
                    <div class="col-lg-4 form-group">

                        <label>Cod. Barra</label>

                        <input type="text" class="form-control" pattern="[0-9A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,50}" onchange="validateJS(event,'text&number')" value="<?php echo $article->barcode_article ?>" name="barcode">

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

                                    <input type="hidden" value="<?php echo $value->id_artcom ?>" name="<?php echo $value->id_artcom ?>" id="<?php echo $value->id_artcom ?>">

                                    <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" value="<?php echo $value->name_company ?>" name="company<?php echo $value->id_artcom ?>" readonly>

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Estado Ubicación
                                ======================================-->
                                <div class="col-lg-1 form-group">

                                    <label>Estado</label>

                                    <?php if ($value->state_artcom == 1) : ?>
                                        <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="switch<?php echo $value->id_artcom ?>" name="switch<?php echo $value->id_artcom ?>" checked><label class="custom-control-label" for="switch<?php echo $value->id_artcom ?>"></label></div>
                                    <?php else : ?>
                                        <div class="custom-control custom-switch"><input type="checkbox" class="custom-control-input" id="switch<?php echo $value->id_artcom ?>" name="switch<?php echo $value->id_artcom ?>"><label class="custom-control-label" for="switch<?php echo $value->id_artcom ?>"></label></div>
                                    <?php endif ?>


                                </div>

                                <!--=====================================
                                Ubicacion
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Ubicación</label>

                                    <input type="text" class="form-control" pattern="[A-Za-zñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'text')" name="location<?php echo $value->id_artcom ?>" value="<?php echo $value->location_artcom ?>">

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Utilidad
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Utilidad</label>

                                    <input type="number" step="any" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'number')" name="utility<?php echo $value->id_artcom ?>" value="<?php echo $value->utility_artcom ?>">

                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>

                                </div>

                                <!--=====================================
                                Comision
                                ======================================-->
                                <div class="col-lg-2 form-group">

                                    <label>Comisión</label>

                                    <input type="number" step="any" class="form-control" pattern="[.\\,\\0-9]{1,}" onchange="validateJS(event,'text')" name="commission<?php echo $value->id_artcom ?>" value="<?php echo $value->commission_artcom ?>">

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
    window.document.title = "Articulos - Editar"
</script>