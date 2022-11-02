<?php

if (isset($routesArray[3])) {

    $security = explode("~", base64_decode($routesArray[3]));

    if ($security[1] == $_SESSION["admin"]->token_user) {
        $select = "id_category,code_category,name_category,group_category";

        $url = "categories?select=" . $select . "&linkTo=id_category&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {

            $category = $response->results[0];
        } else {

            echo '<script>

            window.location = "/categories";

            </script>';
        }
    } else {

        echo '<script>

				window.location = "/categories";

				</script>';
    }
}
?>
<div class="card card-dark card-outline">

    <form method="post" class="needs-validation" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $category->id_category ?>" name="idCategory">

        <div class="card-header">

            <?php

            require_once "controllers/categories.controller.php";

            $create = new CategoriesController();
            $create->edit($category->id_category);

            ?>

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-2 row">
                    <!--=====================================
                    Codigo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Código</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateRepeat(event,'regex','categories','code_category')" name="codigo" value="<?php echo $category->code_category ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Nombre
                    ======================================-->
                    <div class="col-lg-8 form-group">

                        <label>Nombre</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateRepeat(event,'regex','categories','name_category')" name="nombre" value="<?php echo $category->name_category ?>" required>

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>

                    <!--=====================================
                    Grupo
                    ======================================-->
                    <div class="col-lg-2 form-group">

                        <label>Grupo</label>

                        <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}" onchange="validateJS(event,'regex')" name="grupo" value="<?php echo $category->group_category ?>">

                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>

                    </div>
                </div>


            </div>

        </div>

        <div class="card-footer">

            <div class="col-md-8 offset-md-2">

                <div class="form-group mt-3">

                    <a href="/categories" class="btn btn-light border text-left">Back</a>

                    <button type="submit" class="btn bg-dark float-right">Save</button>

                </div>

            </div>

        </div>


    </form>

</div>

<script>
    window.document.title = "Categorias - Editar"
</script>