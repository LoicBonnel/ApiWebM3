<?php

class Database extends PDO
{

    //-- Connexion à la bdd

    private $serveur = 'localhost';
    private $base = 'Fripouille';
    private $utilisateur = 'bob';
    private $motDePasse = 'bob';


    private $conn;

    public function __construct()
    {
        try {
            $dns = "mysql:host=$this->serveur;dbname=$this->base;charset=utf8";
            //$dns = "pgsql:host=$serveur;dbname=$base;";
            $this->conn = new PDO($dns, $this->utilisateur, $this->motDePasse);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        //return $conn;
    }

    public function execRequete($sql, $valeurs = null)
    {
        $requete = $this->conn->prepare($sql);

        $requete->execute($valeurs);

        $donnees = $requete->fetchAll();
        $requete->CloseCursor();

        return $donnees;
    }

    public function execRequeteSansRetour($sql, $valeurs = null)
    {
        $requete = $this->conn->prepare($sql);

        $requete->execute($valeurs);
    }
}