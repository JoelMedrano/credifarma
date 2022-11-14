<?php
session_start();
require_once "../../controllers/curl.controller.php";

class AdminsController
{

    public $state;
    public $idArticle;
    public $token;

    public function dataState()
    {

        $url = "articles?id=" . $this->idArticle . "&nameId=id_article&token=" . $this->token . "&table=users&suffix=user";
        $method = "PUT";
        $fields = "state_article=" . $this->state;

        $response = CurlController::request($url, $method, $fields)->status;

        echo json_encode($response);
    }

    public function dataImport()
    {

        $url = "dbarticles?id=" . $this->idDbArticle . "&nameId=id_dbarticle&token=" . $this->dbtoken . "&table=users&suffix=user";
        $method = "PUT";
        $fields = "state_dbarticle=" . $this->dbstate;

        $response = CurlController::request($url, $method, $fields)->status;

        if ($response == 200 && $this->dbstate == 2) {

            $url = "dbarticles?select=*&linkTo=id_dbarticle&equalTo=" . $this->idDbArticle;

            $method = "GET";
            $fields = array();

            $db = CurlController::request($url, $method, $fields)->results[0];

            //*Agrupamos la información 
            $pcreg_article = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            $usreg_article = $_SESSION["admin"]->username_user;

            $data = array(

                "code_article" => trim(strtoupper($db->code_dbarticle)),
                "name_article" => trim(strtoupper($db->name_dbarticle)),
                "id_category_article" => trim(strtoupper($db->id_category_dbarticle)),
                "id_laboratory_article" => trim(strtoupper($db->id_laboratory_dbarticle)),
                "id_therapy_article" => trim(strtoupper($db->id_therapy_dbarticle)),
                "id_substance_article" => trim(strtoupper($db->id_substance_dbarticle)),
                "frac_article" => trim(strtoupper($db->frac_dbarticle)),
                "stkmin_article" => trim(strtoupper($db->stkmin_dbarticle)),
                "stkmax_article" => trim(strtoupper($db->stkmax_dbarticle)),
                "verification_article" => trim(strtoupper($db->verification_dbarticle)),
                "prescription_article" => trim(strtoupper($db->prescription_dbarticle)),
                "digemid_article" => trim(strtoupper($db->digemid_dbarticle)),
                "specialcode_article" => trim(strtoupper($db->specialcode_dbarticle)),
                "barcode_article" => trim(strtoupper($db->barcode_dbarticle)),
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

                $dataSucursal = array(

                    "id_article_artcom" => $id,
                    "id_company_artcom" => trim($company),
                    "state_artcom" => "1",
                    "location_artcom" => "",
                    "utility_artcom" => 0,
                    "commission_artcom" => 0,
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
        }

        echo json_encode($response);
    }
}

if (isset($_POST["idArticle"])) {
    $state = new AdminsController();
    $state->state = $_POST["state"];
    $state->idArticle = $_POST["idArticle"];
    $state->token = $_POST["token"];
    $state->dataState();
}

if (isset($_POST["idDbArticle"])) {
    $state = new AdminsController();
    $state->dbstate = $_POST["dbstate"];
    $state->idDbArticle = $_POST["idDbArticle"];
    $state->dbtoken = $_POST["dbtoken"];
    $state->dataImport();
}
