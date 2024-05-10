<?php
include_once ("manip.php");


$json = json_decode(file_get_contents('php://input'), true);
$result = null;

//if (isset($json['id_information_garde'])) {
    $id_information_garde = htmlspecialchars($json['id']);

//$id_information_garde = 1;

$log = manip::SelectInfoG($id_information_garde);


    if ($log !== []) {
        $result["success"] = true;

        // $log[] --> tableau dans un tableau

        $result["frais_eventuel"] = $log[0]["frais_sup"];
        $result["heureA"] = $log[0]["heure_arrivee"];
        $result["heureD"] = $log[0]["heure_depart"];
        $result["repas"] = $log[0]["nb_repas"];
        $result["dateP"] = $log[0]["date_info_garde"];

    } else {

        $result["success"] = false;
        $result["error"] = "L'affichage n'a pas fonctionné";
    }



echo json_encode($result);
