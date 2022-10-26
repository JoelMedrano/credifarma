<?php

class AdminsController
{
    /*=============================================
	Login de administradores
	=============================================*/

    public function login()
    {
        if (isset($_POST["loginEmail"])) {

            /*=============================================
			Validamos la sintaxis de los campos
			=============================================*/
            if (preg_match('/^[.a-zA-Z0-9_]+([.][.a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["loginEmail"])) {

                $url = "users?login=true&suffix=user";
                $method = "POST";
                $fields = array(

                    "email_user" => $_POST["loginEmail"],
                    "password_user" => $_POST["loginPassword"]

                );

                $response = CurlController::request($url, $method, $fields);

                /*=============================================
				Validamos que si escriba correctamente los datos
				=============================================*/
                if ($response->status == 200) {

                    if ($response->results[0]->state_user != "1") {

                        echo ' <div class="alert alert-danger">You do not have permissions to access</div>';
                        return;
                    }

                    /*=============================================
					Creamos variable de sesión
					=============================================*/
                    $_SESSION["admin"] = $response->results[0];

                    echo '<script>

					window.location = "' . $_SERVER["REQUEST_URI"] . '"

					</script>';
                } else {
                    echo '<div class="alert alert-danger">' . $response->results . '</div>';
                }
            } else {
                echo '<div class="alert alert-danger">Field syntax error</div>';
            }
        }
    }
}