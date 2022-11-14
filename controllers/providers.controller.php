<?php

class ProvidersController
{

    //*Crear proveedor
    public function create()
    {
        if (isset($_POST["codigo"])) {

            echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

            </script>';

            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["bussiness_name"])

            ) {
                //*Agrupamos la información 
                $pcreg_provider = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_provider = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_provider" => trim($_POST["codigo"]),
                    "td_provider" => trim($_POST["td_provider"]),
                    "document_provider" => trim($_POST["document_provider"]),
                    "bussiness_name_provider" => trim(strtoupper($_POST["bussiness_name"])),
                    "address_provider" => trim(strtoupper($_POST["address"])),
                    "pc_provider" => trim($_POST["ciudad"]),
                    "phone1_provider" => trim($_POST["phone1"]),
                    "phone2_provider" => trim($_POST["phone2"]),
                    "contact_provider" => trim(strtoupper($_POST["contact"])),
                    "email_provider" => trim(strtoupper($_POST["email"])),
                    "pcreg_provider" =>  $pcreg_provider,
                    "usreg_provider" =>  $usreg_provider,
                    "date_created_provider" => date("Y-m-d")
                );

                //*Solicitud a la API
                $url = "providers?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>
                
                            fncFormatInputs();
                            matPreloader("off");
                            fncSweetAlert("close", "", "");
                            fncSweetAlert("success", "Your records were created successfully", "/providers");
    
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

    //*Editar proveedor
    public function edit($id)
    {
        if (isset($_POST["idProvider"])) {

            echo '<script>
    
                    matPreloader("on");
                    fncSweetAlert("loading", "Loading...", "");
    
                </script>';

            if ($id == $_POST["idProvider"]) {

                $select = "id_provider";

                $url = "providers?select=" . $select . "&linkTo=id_provider&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["bussiness_name"])
                    ) {
                        //*Agrupamos la información 
                        $pcmod_provider = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $usmod_provider = $_SESSION["admin"]->username_user;

                        $data =
                            "code_provider=" . trim($_POST["codigo"]) .
                            "&td_provider=" . trim($_POST["td_provider"]) .
                            "&document_provider=" . trim($_POST["document_provider"]) .
                            "&bussiness_name_provider=" . trim(strtoupper($_POST["bussiness_name"])) .
                            "&address_provider=" . trim(strtoupper($_POST["address"])) .
                            "&pc_provider=" . trim($_POST["ciudad"]) .
                            "&phone1_provider=" . trim($_POST["phone1"]) .
                            "&phone2_provider=" . trim($_POST["phone2"]) .
                            "&contact_provider=" . trim(strtoupper($_POST["contact"])) .
                            "&email_provider=" . trim(strtoupper($_POST["email"])) .
                            "&pcmod_provider=" .  $pcmod_provider .
                            "&usmod_provider=" .  $usmod_provider;

                        //*Solicitud a la API
                        $url = "providers?id=" . $id . "&nameId=id_provider&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //*Respuesta de la API
                        if ($response->status == 200) {

                            echo '<script>
                        
                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "Your records were created successfully", "/providers");

                            </script>';
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
