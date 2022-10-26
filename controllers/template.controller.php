<?php
class TemplateController
{
    /*=============================================
	Traemos la Vista Principal de la plantilla
	=============================================*/
    public function index()
    {
        include "views/template.php";
    }

    /*=============================================
	Ruta del sistema administrativo
	=============================================*/
    static public function path()
    {
        return "http://credifarma.com/";
    }

    /*=============================================
	Ruta para las imágenes del sistema
	=============================================*/
    static public function srcImg()
    {
        return "http://credifarma.com/";
    }

    /*=============================================
	Devolver la imagen del MP
	=============================================*/
    static public function returnImg($id, $picture, $method)
    {

        if ($method == "direct") {

            if ($picture != null) {

                return TemplateController::srcImg() . "views/img/users/" . $id . "/" . $picture;
            } else {

                return TemplateController::srcImg() . "views/img/users/default/default.png";
            }
        } else {

            return $picture;
        }
    }

    /*=============================================
	Función Limpiar HTML
	=============================================*/

    static public function htmlClean($code)
    {

        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

        $replace = array('>', '<', '\\1');

        $code = preg_replace($search, $replace, $code);

        $code = str_replace("> <", "><", $code);

        return $code;
    }
}
