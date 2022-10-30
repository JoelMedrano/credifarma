<?php

class LaboratoriesController
{

    //*Crear laboratorios
    public function create()
    {
        if (isset($_POST["codigo"])) {
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["codigo"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name"])

            ) {

                //*Agrupamos la información 
                $pcreg_laboratory = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_laboratory = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_laboratory" => trim($_POST["codigo"]),
                    "ruc_laboratory" => trim($_POST["documento"]),
                    "bussiness_name_laboratory" => trim(strtoupper($_POST["bussiness_name"])),
                    "name_laboratory" => trim(strtoupper($_POST["name"])),
                    "address_laboratory" => trim(strtoupper($_POST["address"])),
                    "postal_code_laboratory" => trim($_POST["ciudad"]),
                    "phone1_laboratory" => trim($_POST["phone1"]),
                    "phone2_laboratory" => trim($_POST["phone2"]),
                    "ceo_laboratory" => trim(strtoupper($_POST["ceo"])),
                    "email_laboratory" => trim(strtoupper($_POST["email"])),
                    "pcreg_laboratory" =>  $pcreg_laboratory,
                    "usreg_laboratory" =>  $usreg_laboratory,
                    "date_created_laboratory" => date("Y-m-d")
                );

                //*Solicitud a la API
                $url = "laboratories?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/laboratories");

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

    //*Editar laboratorios
    public function edit($id)
    {
        if (isset($_POST["idLaboratory"])) {

            echo '<script>

                /* matPreloader("on");
                fncSweetAlert("loading", "Loading...", ""); */

            </script>';

            if ($id == $_POST["idLaboratory"]) {

                $select = "id_laboratory";

                $url = "laboratories?select=" . $select . "&linkTo=id_laboratory&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);
                if ($response->status == 200) {
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["codigo"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["name"])

                    ) {
                        //*Agrupamos la información 
                        $pcmod_laboratory = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $usmod_laboratory = $_SESSION["admin"]->username_user;

                        $data =
                            "code_laboratory=" . trim($_POST["codigo"]) .
                            "&ruc_laboratory=" . trim($_POST["documento"]) .
                            "&bussiness_name_laboratory=" . trim(strtoupper($_POST["bussiness_name"])) .
                            "&name_laboratory=" . trim(strtoupper($_POST["name"])) .
                            "&address_laboratory=" . trim(strtoupper($_POST["address"])) .
                            "&postal_code_laboratory=" . trim($_POST["ciudad"]) .
                            "&phone1_laboratory=" . trim($_POST["phone1"]) .
                            "&phone2_laboratory=" . trim($_POST["phone2"]) .
                            "&ceo_laboratory=" . trim(strtoupper($_POST["ceo"])) .
                            "&email_laboratory=" . trim(strtoupper($_POST["email"])) .
                            "&pcmod_laboratory=" .  $pcmod_laboratory .
                            "&usmod_laboratory=" .  $usmod_laboratory;

                        //*Solicitud a la API
                        $url = "laboratories?id=" . $id . "&nameId=id_laboratory&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //*Respuesta de la API
                        if ($response->status == 200) {

                            echo '<script>

								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncSweetAlert("success", "Your records were created successfully", "/laboratories");

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
