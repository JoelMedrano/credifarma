<?php

class CategoriesController
{

    //*Crear categorias
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
                $pcreg_category = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                $usreg_category = $_SESSION["admin"]->username_user;

                $data = array(

                    "code_category" => trim(strtoupper($_POST["codigo"])),
                    "name_category" => trim(strtoupper($_POST["nombre"])),
                    "group_category" => trim(strtoupper($_POST["grupo"])),
                    "pcreg_category" =>  $pcreg_category,
                    "usreg_category" =>  $usreg_category,
                    "date_created_category" => date("Y-m-d")

                );

                //*Solicitud a la API
                $url = "categories?token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                $method = "POST";
                $fields = $data;

                $response = CurlController::request($url, $method, $fields);

                //*Respuesta de la API
                if ($response->status == 200) {
                    echo '<script>

                        fncFormatInputs();
                        matPreloader("off");
                        fncSweetAlert("close", "", "");
                        fncSweetAlert("success", "Your records were created successfully", "/categories");

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

    //*Editar categorias
    public function edit($id)
    {
        if (isset($_POST["idCategory"])) {

            echo '<script>

                matPreloader("on");
                fncSweetAlert("loading", "Loading...", "");

            </script>';

            if ($id == $_POST["idCategory"]) {

                $select = "id_category";

                $url = "categories?select=" . $select . "&linkTo=id_category&equalTo=" . $id;
                $method = "GET";
                $fields = array();

                $response = CurlController::request($url, $method, $fields);

                if ($response->status == 200) {
                    if (
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["codigo"]) &&
                        preg_match('/^[-\\(\\)\\=\\%\\&\\$\\;\\_\\*\\/\\#\\?\\¿\\!\\¡\\:\\,\\.\\0-9a-zA-ZñÑáéíóúüÁÉÍÓÚÜ ]{1,}$/', $_POST["nombre"])
                    ) {

                        //*Agrupamos la información 
                        $pcmod_category = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $usmod_category = $_SESSION["admin"]->username_user;

                        $data = "code_category=" . trim(strtoupper($_POST["codigo"])) . "&name_category=" . trim(TemplateController::capitalize($_POST["nombre"])) . "&group_category=" . trim(strtoupper($_POST["grupo"])) . "&pcmod_category=" .  $pcmod_category . "&usmod_category=" .  $usmod_category;

                        //*Solicitud a la API
                        $url = "categories?id=" . $id . "&nameId=id_category&token=" . $_SESSION["admin"]->token_user . "&table=users&suffix=user";
                        $method = "PUT";
                        $fields = $data;

                        $response = CurlController::request($url, $method, $fields);

                        //*Respuesta de la API
                        if ($response->status == 200) {

                            echo '<script>

								fncFormatInputs();
								matPreloader("off");
								fncSweetAlert("close", "", "");
								fncSweetAlert("success", "Your records were created successfully", "/categories");

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
