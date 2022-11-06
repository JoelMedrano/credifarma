<?php

class ArticlesController
{

    //*Crear articulos
    public function create()
    {

        if (isset($_POST["code"])) {
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["code"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["name"])

            ) {

                //*Agrupamos la información 
                $pcreg_article = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_article = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_article" => trim(strtoupper($_POST["code"])),
                    "name_article" => trim(strtoupper($_POST["name"])),
                    "id_category_article" => trim(strtoupper($_POST["category"])),
                    "id_laboratory_article" => trim(strtoupper($_POST["laboratory"])),
                    "id_therapy_article" => trim(strtoupper($_POST["therapy"])),
                    "id_substance_article" => trim(strtoupper($_POST["substance"])),
                    "frac_article" => trim(strtoupper($_POST["fraccion"])),
                    "stkmin_article" => trim(strtoupper($_POST["stkmin"])),
                    "stkmax_article" => trim(strtoupper($_POST["stkmax"])),
                    "verification_article" => trim(strtoupper($_POST["verification"])),
                    "prescription_article" => trim(strtoupper($_POST["prescription"])),
                    "digemid_article" => trim(strtoupper($_POST["digemid"])),
                    "specialcode_article" => trim(strtoupper($_POST["special"])),
                    "barcode_article" => trim(strtoupper($_POST["barcode"])),
                    "pcreg_article" =>  $pcreg_article,
                    "usreg_article" =>  $usreg_article,
                    "date_created_article" => date("Y-m-d")

                );

                //*Solicitud a la API
                $url = "articles?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                $id = $response->results->lastId;

                //*Agrupamos la información Articulo-Compañia
                $url = "companies";
                $method = "GET";
                $fields = array();

                $companiesData = CurlController::request($url, $method, $fields);
                $companies = $companiesData->results;

                foreach ($companies as $key => $value) {

                    $company = $value->id_company;
                    if (isset($_POST["switch" . $value->id_company])) {
                        $state = "1";
                    } else {
                        $state = "0";
                    }
                    $location = "location" . $value->id_company;
                    $utility = "utility" . $value->id_company;
                    $commission = "commission" . $value->id_company;


                    $dataSucursal = array(

                        "id_article_artcom" => $id,
                        "id_company_artcom" => trim($_POST[$company]),
                        "state_artcom" => trim($state),
                        "location_artcom" => trim($_POST[$location]),
                        "utility_artcom" => trim($_POST[$utility]),
                        "commission_artcom" => trim($_POST[$commission]),
                        "pcreg_artcom" =>  $pcreg_article,
                        "usreg_artcom" =>  $usreg_article,
                        "date_created_artcom" => date("Y-m-d")

                    );

                    //*Solicitud a la API
                    $url = "artscoms?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                    $method = "POST";
                    $fields = $dataSucursal;

                    $responseSucursal = CurlController::request($url, $method, $fields);
                }

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/articles");

                    </script>';
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
        }
    }

    //*Editar articulo
    public function edit($id)
    {
        if (isset($_POST["idArticle"])) {

            echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

            </script>';

            if ($id == $_POST["idArticle"]) {

                if (
                    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["code"]) &&
                    preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["name"])

                ) {

                    //*Agrupamos la información 
                    $pcmod_article = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                    $usmod_article = $_SESSION["admin"]->username_user;

                    $data =

                        "code_article=" . trim(strtoupper($_POST["code"])) .
                        "&name_article=" . trim(strtoupper($_POST["name"])) .
                        "&id_category_article=" . trim(strtoupper($_POST["category"])) .
                        "&id_laboratory_article=" . trim(strtoupper($_POST["laboratory"])) .
                        "&id_therapy_article=" . trim(strtoupper($_POST["therapy"])) .
                        "&id_substance_article=" . trim(strtoupper($_POST["substance"])) .
                        "&frac_article=" . trim(strtoupper($_POST["fraccion"])) .
                        "&stkmin_article=" . trim(strtoupper($_POST["stkmin"])) .
                        "&stkmax_article=" . trim(strtoupper($_POST["stkmax"])) .
                        "&verification_article=" . trim(strtoupper($_POST["verification"])) .
                        "&prescription_article=" . trim(strtoupper($_POST["prescription"])) .
                        "&digemid_article=" . trim(strtoupper($_POST["digemid"])) .
                        "&specialcode_article=" . trim(strtoupper($_POST["special"])) .
                        "&barcode_article=" . trim(strtoupper($_POST["barcode"])) .
                        "&pcmod_article=" .  $pcmod_article .
                        "&usmod_article=" .  $usmod_article;

                    //*Solicitud a la API
                    $url = "articles?id=" . $id . "&nameId=id_article&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                    $method = "PUT";
                    $fields = $data;

                    $response = CurlController::request($url, $method, $fields);

                    //*Agrupamos la información Articulo-Compañia
                    $url = "relations?rel=artscoms,companies&type=artcom,company&select=id_artcom,id_article_artcom,id_company_artcom,name_company,state_artcom,location_artcom,utility_artcom,commission_artcom&linkTo=id_article_artcom&equalTo=" . $id;
                    $method = "GET";
                    $fields = array();

                    $companiesData = CurlController::request($url, $method, $fields);
                    $companies = $companiesData->results;

                    foreach ($companies as $key => $value) {

                        if (isset($_POST["switch" . $value->id_artcom])) {
                            $state = "1";
                        } else {
                            $state = "0";
                        }

                        $location = "location" . $value->id_artcom;
                        $utility = "utility" . $value->id_artcom;
                        $commission = "commission" . $value->id_artcom;

                        $dataSucursal =

                            "state_artcom=" . trim($state) .
                            "&location_artcom=" . trim($_POST[$location]) .
                            "&utility_artcom=" . trim($_POST[$utility]) .
                            "&commission_artcom=" . trim($_POST[$commission]) .
                            "&pcmod_artcom=" .  $pcmod_article .
                            "&usmod_artcom=" .  $usmod_article;

                        //*Solicitud a la API
                        $url = "artscoms?id=" . $value->id_artcom . "&nameId=id_artcom&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $dataSucursal;

                        $responseSucursal = CurlController::request($url, $method, $fields);
                    }

                    //*Respuesta de la API
                    if ($response->status == 200) {
                        echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/articles");

                    </script>';
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
                        fncNotie(3, "Error editing the registry");

                    </script>';
                }
            } else {

                echo '<script>

					fncFormatInputs();
					matPreloader("off");
					fncSweetAlert("close", "", "");
					fncNotie(3, "Error editing the registry");

				</script>';
            }
        }
    }
}
