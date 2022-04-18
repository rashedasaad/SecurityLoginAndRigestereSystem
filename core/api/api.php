<?php

declare(strict_types=1);
require_once "../funcs/functions.php";
require_once "../database/DB.php";
class API
{
    public $i = 0;
    public $respone = [];
    public function restapi($tabel)
    {
        global $con;
        if ($con) {
            $sql = "SELECT * FROM $tabel";
            $resultat = mysqli_query($con, $sql);

            if ($resultat) {
                header("Content-Type: JSON");
                while ($row = mysqli_fetch_assoc($resultat)) {
                    $this->respone[$this->i]["id"] = $row["id"];
                    $this->respone[$this->i]["email"] = $row["email"];
                    $this->respone[$this->i]["user_id"] = $row["user_id"];

                    $this->i++;
                }
                return json_encode($this->respone, JSON_HEX_AMP);
            }
        }
    }
}

$api = new API;

echo $api->restapi("user");

