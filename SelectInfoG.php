<?php
include_once ("manip.php");

$result = array();

// Vérification si les données JSON sont reçues
$json = json_decode(file_get_contents('php://input'), true);

// Vérification si l'ID d'information de garde est présente dans les données JSON
if (isset($json['id_information_garde'])) {
    // Récupération de l'ID d'information de garde en éliminant les caractères spéciaux
    $id_information_garde = filter_var($json['id_information_garde'], FILTER_SANITIZE_NUMBER_INT);

    // Vérification si l'ID d'information de garde est un nombre entier
    if (filter_var($id_information_garde, FILTER_VALIDATE_INT)) {
        // Utilisation de la méthode de la classe manip pour sélectionner les informations de garde
        $log = manip::SelectInfoG($id_information_garde);

        // Vérification si des informations ont été trouvées
        if (!empty($log)) {
            $result["success"] = true;
            $result["id"] = $log[0]["id_information_garde"];
        } else {
            $result["success"] = false;
            $result["error"] = "ID non trouvé dans la base de données";
        }
    } else {
        $result["success"] = false;
        $result["error"] = "ID non valide";
    }
} else {
    $result["success"] = false;
    $result["error"] = "Champs non remplis";
}

// Encodage des résultats en format JSON
echo json_encode($result);
