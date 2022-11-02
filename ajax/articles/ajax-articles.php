<?php

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
}

if (isset($_POST["state"])) {
    $state = new AdminsController();
    $state->state = $_POST["state"];
    $state->idArticle = $_POST["idArticle"];
    $state->token = $_POST["token"];
    $state->dataState();
}
