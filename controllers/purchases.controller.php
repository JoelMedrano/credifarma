<?php

class PurchasesController
{

    //*Crear terapias
    public function create()
    {
        if (isset($_POST["codigo"])) {

            if (!empty($_POST["jsonDetalleCompra"])) {
                echo '<script>
    
                    /* matPreloader("on");
                    fncSweetAlert("loading", "Loading...", ""); */
    
                </script>';
                if (
                    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"])
                ) {

                    //*Agrupamos la información 
                    $pcreg_purchase = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                    $usreg_purchase = $_SESSION["admin"]->username_user;

                    $data = array(

                        "code_purchase" => trim(strtoupper($_POST["codigo"])),
                        "id_provider_purchase" => $_POST["provider"],
                        "td_purchase" => trim(strtoupper($_POST["td"])),
                        "document_purchase" => trim(strtoupper($_POST["document"])),
                        "guide_purchase" => trim(strtoupper($_POST["guide"])),
                        "tp_purchase" => trim(strtoupper($_POST["tp"])),
                        "id_user_purchase" => $_SESSION["admin"]->id_user,
                        "id_company_purchase" => $_POST["sucursal"],
                        "total_purchase" => $_POST["total"],
                        "date_expiration_purchase" => $_POST["expiration"],
                        "pcreg_purchase" =>  $pcreg_purchase,
                        "usreg_purchase" =>  $usreg_purchase,
                        "date_created_purchase" => date("Y-m-d")

                    );

                    //*Solicitud a la API
                    $url = "purchases?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                    $method = "POST";
                    $fields = $data;

                    $response = CurlController::request($url, $method, $fields);

                    $id = $response->results->lastId;

                    //*Respuesta de la API
                    if ($response->status == 200) {

                        $listaArticulos = json_decode($_POST["jsonDetalleCompra"], true);

                        foreach ($listaArticulos as $key => $value) {

                            $dataDet = array(

                                "id_purchase_artpur" => $id,
                                "id_article_artpur" => $value["id_article"],
                                "id_company_artpur" => $_POST["sucursal"],
                                "id_user_artpur" => $_SESSION["admin"]->id_user,
                                "amount_artpur" => $value["cantidad"],
                                "fraction_artpur" => $value["fraccion"],
                                "pricent_artpur" => $value["preciosigv"],
                                "priceyt_artpur" => $value["preciocigv"],
                                "discount_artpur" => $value["descuento"],
                                "total_artpur" => $value["total"],
                                "lote_artpur" => $value["lote"],
                                "pcreg_artpur" =>  $pcreg_purchase,
                                "usreg_artpur" =>  $usreg_purchase,
                                "date_expiration_artpur" => $value["vencimiento"],
                                "date_created_artpur" => date("Y-m-d")

                            );

                            //*Solicitud a la API
                            $urlDet = "artspurs?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                            $method = "POST";
                            $fields = $dataDet;

                            $responseDet = CurlController::request($urlDet, $method, $fields);

                            $urlArtCom = "relations?rel=artscoms,companies&type=artcom,company&select=id_artcom,id_article_artcom,frac_price_artcom,blis_price_artcom,full_price_artcom&linkTo=id_article_artcom,id_company_artcom&equalTo=" . $value["id_article"] . "," . $_POST["sucursal"];

                            $method = "GET";
                            $fields = array();

                            $responseInv = CurlController::request($urlArtCom, $method, $fields);

                            $inventory = $responseInv->results[0];

                            $dataInv = array(

                                "id_purchase_inventory" => $id,
                                "id_article_inventory" => $value["id_article"],
                                "id_company_inventory" => $_POST["sucursal"],
                                "amount_inventory" => $value["cantidad"],
                                "fraction_inventory" => $value["fraccion"],
                                "pca_inventory" => $value["preciocigv"],
                                "pva_inventory" => $inventory->full_price_artcom,
                                "pvf_inventory" => $inventory->frac_price_artcom,
                                "pvb_inventory" => $inventory->blis_price_artcom,
                                "lote_inventory" => $value["lote"],
                                "date_expiration_inventory" => $value["vencimiento"],
                                "pcreg_inventory" =>  $pcreg_purchase,
                                "usreg_inventory" =>  $usreg_purchase,
                                "date_created_inventory" => date("Y-m-d")

                            );

                            //*Solicitud a la API
                            $urlInv = "inventories?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                            $method = "POST";
                            $fields = $dataInv;

                            $responseInv = CurlController::request($urlInv, $method, $fields);

                            echo '<script>

                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "Your records were created successfully", "/purchases");
    
                        </script>';
                        }
                    } else {
                        echo '<script>
    
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncNotie(3, "Error saving catogory");
    
                        </script>';
                    }
                } else {

                    echo '<script>
    
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncNotie(3, "Field syntax error");
    
                    </script>';
                }
            } else {

                echo '<script>

					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "No se encontraron artículos");

				</script>';
            }
        }
    }
}
