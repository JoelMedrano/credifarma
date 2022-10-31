<?php

class TherapiesController
{

    //*Crear terapias
    public function create()
    {

        if (isset($_POST["codigo"])) {
            echo '<script>

				matPreloader("on");
				fncSweetAlert("loading", "Loading...", "");

			</script>';
            if (
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["codigo"]) &&
                preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nombre"])

            ) {
                //*Agrupamos la información 
                $pcreg_therapy = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_therapy = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_therapy" => trim(strtoupper($_POST["codigo"])),
                    "name_therapy" => trim(strtoupper($_POST["nombre"])),
                    "pcreg_therapy" =>  $pcreg_therapy,
                    "usreg_therapy" =>  $usreg_therapy,
                    "date_created_therapy" => date("Y-m-d")

                );

                //*Solicitud a la API
                $url = "therapies?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/therapies");

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
        if (isset($_POST["idTherapy"])) {

            echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

            </script>';

            if ($id == $_POST["idTherapy"]) {

                $select = "id_therapy";

                $url = "therapies?select=" . $select . "&linkTo=id_therapy&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["codigo"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúÁÉÍÓÚ ]{1,}$/', $_POST["nombre"])
                    ) {

                        //*Agrupamos la información 
                        $pcmod_therapy = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $udmod_therapy = $_SESSION["admin"]->username_user;

                        $data =
                            "code_therapy=" . trim(strtoupper($_POST["codigo"])) .
                            "&name_therapy=" . trim(strtoupper($_POST["nombre"])) .
                            "&pcmod_therapy=" .  $pcmod_therapy .
                            "&usmod_therapy=" .  $udmod_therapy;

                        //*Solicitud a la API
                        $url = "therapies?id=" . $id . "&nameId=id_therapy&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //*Respuesta de la API
                        if ($response->status == 200) {

                            echo '<script>

                                fncFormatInputs();
                                matPreloader("off");
                                fncSweetAlert("close", "", "");
                                fncSweetAlert("success", "Your records were created successfully", "/therapies");

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
