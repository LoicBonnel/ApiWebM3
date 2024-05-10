<?php
require_once "config.php";

class manip
{

    // à chauqe requête préparée rajouter dans manip
    public static function SelectInfoG($id) {
        $conn = new Database();
        $req= "CALL InfoG_Select_ALL_By_ID(?)";
        $restat = $conn->execRequete($req, array($id));
        return $restat;
    }

    /*
public static function AfficheCompte($id)
{
    $conn = new Database();
    $req = "CALL AfficheProprietaire(?)";
    $restat = $conn->execRequete($req, array($id));
    return $restat;
}

   */

public static function ModifierCompte($heure_arrivee,$heure_depart,$nb_repas,$frais_sup,$date_info_garde,$id_information_garde)
{
    $conn = new Database();
    $req = "CALL InfoG_Update(?,?,?,?,?,?)";
    $restat = $conn->execRequete($req, array($heure_arrivee,$heure_depart,$nb_repas,$frais_sup,$date_info_garde,$id_information_garde));
    return $restat;
}

/*
public static function AjoutAnimaux($id_propri,$nom,$race)
{
    $conn = new Database();
    $req = "CALL AjoutAnimaux(?,?,?)";
    $restat = $conn->execRequete($req, array($id_propri,$nom,$race));
    return $restat;
}
*/


}