<?php
namespace modele\metier;

use modele\metier\Lieu;
use modele\metier\Groupe;

class Representation {
    // Attribut de la classe Representation
    private $id;
  
    private $date;
   
    private $heuredebut;
 
    private $heurefin;
    
    private $groupe;
    
    private $lieu;
    // Constructeur d'un objet Representation
    function __construct($id, $groupe, $lieu, $date, $heuredebut, $heurefin) {
        $this->id = $id;
        $this->date = $date;
        $this->heuredebut = $heuredebut;
        $this->heurefin = $heurefin;
        $this->groupe = $groupe;
        $this->lieu = $lieu;
       
    }
    // Acceseur et Mutateur des attributs de la classe Representation
    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getHeuredebut() {
        return $this->heuredebut;
    }

    function getHeurefin() {
        return $this->heurefin;
    }

    function getGroupe() {
        return $this->groupe;
    }

    function getLieu() {
        return $this->lieu;
    }

    function setId($id): void {
        $this->id = $id;
    }

    function setDate($date): void {
        $this->date = $date;
    }

    function setHeuredebut($heuredebut): void {
        $this->heuredebut = $heuredebut;
    }

    function setHeurefin($heurefin): void {
        $this->heurefin = $heurefin;
    }

    function setGroupe(Groupe $groupe): void {
        $this->groupe = $groupe;
    }

    function setLieu(Lieu $lieu): void {
        $this->lieu = $lieu;
    }




}
