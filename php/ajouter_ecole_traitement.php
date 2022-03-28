<?php

//PAGE DE TRAITEMENT POUR AJOUTER UNE ECOLE DANS LA BDD

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//SI UTILISATEUR A PAS LE ROLE 1 OU 2 FAIRE
if($_SESSION['role'] == 1 || 2){

    //VARIABLES
    $nom = $_POST['school_name'];
    $nom = strtoupper($nom);
    $ref = $_POST['school_ref'];
    $adresse = $_POST['school_adresse'];
    $cp = $_POST['school_cp'];
    $ville = $_POST['school_city'];
    $mail = $_POST['school_mail'];
    $tel = $_POST['school_number'];
    $lien = $ref . ".php";
    $idUser = $_SESSION['idUser'];
    $idCreateur = $idUser;


    //REQUETE SQL POUR INSERER LES DONNEES DE L ECOLE 
    $sql = "INSERT INTO `ecole`(`eco_nom`, `eco_ref`, `eco_adresse`, `eco_cp`, `eco_ville`, `eco_mail`, `eco_tel`, `eco_lien`) VALUES (:nom , :ref, :adresse, :cp, :ville, :mail, :tel, :lien) ";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel, ":lien"=>$lien));
    //RECUPERATION DU DERNIERE ID INSERE
    $last_id = $db->lastInsertId();

    //SI LA REQUETE A BIEN FONCTIONNER FAIRE
    if($exec){
        echo "Insertion réussie";
        //REQUETE SQL POUR INSERER LES DROITS AUTOMATIQUE DU CREATEUR DANS LA TABLE DROIT
        $sql = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES (:idCreateur, :idUtilisateur, :idEcole)";
        $res = $db->prepare($sql);
        $exec = $res->execute(array(":idCreateur"=>$idCreateur, ":idUtilisateur"=>$idUser, ":idEcole"=>$last_id));
        echo $idUser ."et " . $last_id;
        //REDIRECTION
        header('location: dashboard.php');
    }
    //SINON FAIRE
    else{
        echo "Insertion echoué";
    }

}

//SINON REDIRECTION 
else{
    header("location:index.php");
}



?>