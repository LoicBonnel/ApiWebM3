<?php
include_once ("manip.php");

// Création d'un tableau associatif pour stocker le résultat de la requête
$result = array();

// Vérification si des données JSON sont reçues et si toutes les clés nécessaires sont présentes
if (isset($_POST['heureA'], $_POST['heureD'], $_POST['repas'], $_POST['frais_eventuel'], $_POST['dateP'], $_POST['id'])) {

    // Nettoyage et récupération des valeurs des champs
    $heure_arrivee = filter_input(INPUT_POST, 'heureA', FILTER_SANITIZE_STRING);
    $heure_depart = filter_input(INPUT_POST, 'heureD', FILTER_SANITIZE_STRING);
    $nb_repas = filter_input(INPUT_POST, 'repas', FILTER_SANITIZE_NUMBER_INT);
    $frais_sup = filter_input(INPUT_POST, 'frais_eventuel', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $date_info_garde = filter_input(INPUT_POST, 'dateP', FILTER_SANITIZE_STRING);
    $id_information_garde = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    // Vérification si toutes les valeurs ont été récupérées avec succès
    if ($heure_arrivee !== null && $heure_depart !== null && $nb_repas !== null && $frais_sup !== null && $date_info_garde !== null && $id_information_garde !== null) {

        // Appel de la fonction de la classe manip pour modifier le compte
        $log = manip::ModifierCompte($heure_arrivee, $heure_depart, $nb_repas, $frais_sup, $id_information_garde, $date_info_garde);

        // Définition du succès de l'opération
        $result["success"] = true;

    } else {
        // Un ou plusieurs champs sont vides ou invalides
        $result["success"] = false;
        $result["error"] = "Champs non valides ou non remplis";
    }

} else {
    // Certains champs requis sont manquants
    $result["success"] = false;
    $result["error"] = "Champs requis manquants";
}

// Encodage des résultats en format JSON
echo json_encode($result);
