<?php
namespace modele\metier;


class Lieu {
   //Attribut de la classe Lieu
    private $id;
    
    private $nom;
   
    private $adresse;
    
    private $capacite;
    //Constructeur de la classe Lieu
    function __construct($id, $nom, $adresse, $capacite) {
        $this->id = $id;
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->capacite = $capacite;
    }
    // Accesseur et Mutateur des attributs
    function getId() {
        return $this->id;
    }

    function getNom() {
        return $this->nom;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getCapacite() {
        return $this->capacite;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setNom($nom): void {
        $this->nom = $nom;
    }

    function setAdresse($adresse): void {
        $this->adresse = $adresse;
    }

    function setCapacite($capacite): void {
        $this->capacite = $capacite;
    }



}
