<?php

if (isset($routesArray[3])) {

    $security = explode("~", base64_decode($routesArray[3]));

    if ($security[1] == $_SESSION["admin"]->token_user) {
        $select = "id_purchase,code_purchase,id_provider_purchase,td_purchase,document_purchase,guide_purchase,tp_purchase,state_purchase,total_purchase,id_user_purchase,id_company_purchase,pcreg_purchase,usreg_purchase,pcmod_purchase,usmod_purchase,date_expiration_purchase,date_created_purchase,date_updated_purchase";

        $url = "purchases?select=" . $select . "&linkTo=id_purchase&equalTo=" . $security[0];
        $method = "GET";
        $fields = array();

        $response = CurlController::request($url, $method, $fields);

        if ($response->status == 200) {

            $purchase = $response->results[0];

            $url = "providers?select=*&linkTo=id_provider&equalTo=" . $purchase->id_provider_purchase;
            $method = "GET";
            $fields = array();

            $response = CurlController::request($url, $method, $fields);

            $provider = $response->results[0];

            $td_purchase = $purchase->td_purchase;
            if ($td_purchase == null ||  $td_purchase = "") {
                $tdcode = "Seleccionar Documento";
            } else {
                $td = file_get_contents("views/assets/json/tipo_documento.json");
                $td = json_decode($td, true);

                foreach ($td as $key => $value) {

                    if ($value["code"] == $purchase->td_purchase) {
                        $tdcode = $value["description"];
                    }
                }
            }

            $tp_purchase = $purchase->tp_purchase;
            if ($tp_purchase == null ||  $tp_purchase = "") {
                $tpcode = "Seleccionar Tipo";
            } else {
                $tp = file_get_contents("views/assets/json/tipo_pago.json");
                $tp = json_decode($tp, true);

                foreach ($tp as $key => $value) {

                    if ($value["code"] == $purchase->tp_purchase) {
                        $tpcode = $value["description"];
                    }
                }
            }

            $id_company = $purchase->id_company_purchase;

            $url = "relations?rel=artspurs,articles&type=artpur,article&select=*&linkTo=id_purchase_artpur&equalTo=" . $security[0];

            $method = "GET";
            $fields = array();

            $artpur = CurlController::request($url, $method, $fields)->results;
        } else {

            echo '<script>

            window.location = "/purchases";

            </script>';
        }
    } else {

        echo '<script>

				window.location = "/purchases";

				</script>';
    }
}
?>
<div class="card card-dark card-outline">

    <form method="post" class="needs-validation formularioCompras" novalidate enctype="multipart/form-data">

        <input type="hidden" value="<?php echo $purchase->id_purchase ?>" name="idPurchase">

        <div class="card-header">

            <?php

            require_once "controllers/purchases.controller.php";

            $create = new PurchasesController();
            $create->edit($purchase->id_purchase);

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

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','purchases','code_purchase')" name="codigo" value="<?php echo $purchase->code_purchase ?>" required readonly>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Proveedor
                        ======================================-->
                        <div class="col-lg-10 form-group m-0">

                            <label>Proveedor<sup class="text-danger">*</sup></label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" onchange="validateRepeat(event,'regex','providers','bussiness_name_provider')" name="bussiness_name" id="bussiness_name" value="<?php echo $provider->bussiness_name_provider ?>" readonly>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
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

                                <option value="<?php echo $purchase->td_purchase ?>"><?php echo $purchase->td_purchase . ' - ' . $tdcode ?></option>

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

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="document" value="<?php echo $purchase->document_purchase ?>">

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        GUIA
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Guia</label>

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="guide" value="<?php echo $purchase->guide_purchase ?>">

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

                                <option value="<?php echo $purchase->tp_purchase ?>"><?php echo $purchase->tp_purchase . ' - ' . $tpcode ?></option>

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

                            $url = "companies?select=id_company,name_company";
                            $method = "GET";
                            $fields = array();

                            $companies = CurlController::request($url, $method, $fields)->results;

                            ?>

                            <div class="form-group">

                                <select class="form-control select2" name="sucursal" id="sucursal" style="width:100%" required>

                                    <option value="">Seleccionar Sucursal</option>

                                    <?php if ($id_company == 0) : ?>

                                        <option value="">Seleccionar Funcion Terapeútica</option>

                                        <?php foreach ($companies as $key => $value) : ?>

                                            <option value="<?php echo $value->id_company ?>"><?php echo $value->name_company ?></option>

                                        <?php endforeach ?>

                                    <?php else : ?>

                                        <?php foreach ($companies as $key => $value) : ?>

                                            <?php if ($value->id_company == $id_company) : ?>
                                                <option value="<?php echo $id_company ?>" selected><?php echo $value->name_company ?></option>

                                            <?php else :   ?>
                                                <option value="<?php echo $value->id_company ?>"><?php echo $value->name_company ?></option>

                                            <?php endif ?>


                                        <?php endforeach ?>

                                    <?php endif ?>

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

                            <input type="text" class="form-control" pattern="[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}" name="total" id="total" value="<?php echo $purchase->total_purchase ?>" readonly>

                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>

                        </div>

                        <!--=====================================
                        Vencimiento
                        ======================================-->
                        <div class="col-lg-3 form-group m-0">

                            <label>Fecha de pago</label>

                            <input type="date" class="form-control" name="expiration" id="expiration" value="<?php echo $purchase->date_expiration_purchase ?>">

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

                                <label for="">Precio S. IGV</label>

                            </div>

                            <div class="col-lg-1">

                                <label for="">Precio C. IGV</label>

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

                        <?php foreach ($artpur as $key => $value) : ?>

                            <?php
                            $url = "relations?rel=inventories,artspurs&type=inventory,artpur&select=*&linkTo=id_artpur_inventory&equalTo=" . $value->id_artpur;

                            $method = "GET";
                            $fields = array();

                            $inventory = CurlController::request($url, $method, $fields)->results[0];
                            ?>

                            <?php if (isset($inventory->state_inventory) && $inventory->state_inventory == "1") : ?>

                                <div class="row mt-1">
                                    <!-- Descripción del artículo -->
                                    <div class="col-lg-3">
                                        <div class="input-group">
                                            <span class="input-group-addon"><button type="button" class="btn btn-danger btn-sm quitarArticulo" idArticle="<?php echo $value->id_article_artpur ?>"><i class="fa fa-times"></i></button></span>

                                            <textarea type="text" class="form-control form-control-sm nuevaDescripcionArticulo" style="font-size:12px" rows="2" readonly idArticle="<?php echo $value->id_article_artpur ?>"><?php echo $value->name_article ?></textarea>
                                        </div>
                                    </div>
                                    <!-- Cantidad -->
                                    <div class="col-lg-1 ingresoCantidad" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevaCantidadArticulo" name="nuevaCantidadArticulo" min="0" value="<?php echo $value->amount_artpur ?>">
                                    </div>
                                    <!-- Faccion -->
                                    <div class="col-lg-1 ingresoFraccion" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevaFraccionArticulo" name="nuevaFraccionArticulo" min="0" value="<?php echo $value->fraction_artpur ?>" fracArticle="<?php echo $value->frac_article ?>">
                                    </div>
                                    <!-- Precio con igv -->
                                    <div class="col-lg-1 ingresoPrecioConIGV" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevoPrecioArticuloConIGV" min="0" value="<?php echo $value->priceyt_artpur ?>" required>
                                    </div>
                                    <!-- Precio sin igv -->
                                    <div class="col-lg-1 ingresoPrecioSinIGV" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevoPrecioArticuloSinIGV" min="0" value="<?php echo $value->pricent_artpur ?>" readonly>
                                    </div>
                                    <!-- Descuento -->
                                    <div class="col-lg-1 ingresoDescuento" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevoDescuentoArticulo" min="0" value="<?php echo $value->discount_artpur ?>" max="100">
                                    </div>
                                    <!-- Total -->
                                    <div class="col-lg-1 ingresoTotal" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevoTotalArticulo" min="0" total="0" value="<?php echo $value->total_artpur ?>" readonly>
                                    </div>
                                    <!-- Utilidad -->
                                    <div class="col-lg-1 ingresoUtilidad" style="padding-left:0px">
                                        <input type="number" step="any" class="form-control form-control-sm nuevoUtilidadArticulo" pv="" readonly>
                                    </div>
                                    <!-- Fecha Vencimiento -->
                                    <div class="col-lg-1 ingresoFV" style="padding-left:0px">
                                        <input type="month" class="form-control form-control-sm nuevoFVArticulo" style="font-size:10px" value="<?php echo $value->date_expiration_artpur ?>">
                                    </div>
                                    <!-- Lote -->
                                    <div class="col-lg-1 ingresoLote" style="padding-left:0px">
                                        <input type="text" class="form-control form-control-sm nuevoLoteArticulo" value="<?php echo $value->lote_artpur ?>">
                                    </div>
                                </div>

                            <?php endif ?>

                        <?php endforeach ?>


                    </div>

                    <input type="hidden" id="jsonDetalleCompra" name="jsonDetalleCompra">

                </div>

                <div class="col-lg-12">
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
    window.document.title = "Compras - Editar"
</script>