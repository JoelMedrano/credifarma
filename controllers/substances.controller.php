<?php

class SubstancesController
{

    //*Crear sustancias
    public function create()
    {
        if (isset($_POST["codigo"])) {
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';

            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["nombre"])

            ) {
                //*Agrupamos la información 
                $pcreg_substance = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_substance = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_substance" => trim(strtoupper($_POST["codigo"])),
                    "name_substance" => trim(strtoupper($_POST["nombre"])),
                    "vadecum_substance" => trim(strtoupper($_POST["vadecum"])),
                    "pcreg_substance" =>  $pcreg_substance,
                    "usreg_substance" =>  $usreg_substance,
                    "date_created_substance" => date("Y-m-d")

                );

                //*Solicitud a la API
                $url = "substances?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>
                
                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/substances");

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

    //*Editar terapias
    public function edit($id)
    {
        if (isset($_POST["idSubstance"])) {
            echo '<script>

            /* matPreloader("on");
            fncSweetAlert("loading", "Loading...", ""); */

        </script>';

            if ($id == $_POST["idSubstance"]) {

                $select = "id_substance";

                $url = "substances?select=" . $select . "&linkTo=id_substance&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);
                if ($response->status == 200) {
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["nombre"])
                    ) {

                        //*Agrupamos la información 
                        $pcmod_substance = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $usmod_substance = $_SESSION["admin"]->username_user;

                        $data =
                            "code_substance=" . trim(strtoupper($_POST["codigo"])) .
                            "&name_substance=" . trim(strtoupper($_POST["nombre"])) .
                            "&vadecum_substance=" . trim(strtoupper($_POST["vadecum"])) .
                            "&pcmod_substance=" .  $pcmod_substance .
                            "&usmod_substance=" .  $usmod_substance;

                        //*Solicitud a la API
                        $url = "substances?id=" . $id . "&nameId=id_substance&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //*Respuesta de la API
                        if ($response->status == 200) {

                            echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "Your records were created successfully", "/substances");

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
                            fncNotie(3, "Field syntax error");

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
