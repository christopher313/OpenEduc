<?php

//PAGE DE TRAITEMENT POUR AJOUTER UNE ECOLE DANS LA BDD

//INITIALISATION DE LA PAGE

require "navmenu.php";

//SI UTILISATEUR A PAS LE ROLE 1 OU 2 FAIRE
if($_SESSION['role'] == 1 || 2){

    //VARIABLES
    $nom = strtoupper($_POST['school_name']);
    $ref = strtoupper($_POST['school_ref']);
    $adresse = $_POST['school_adresse'];
    $cp = $_POST['school_cp'];
    $ville = strtoupper($_POST['school_city']);
    $mail = $_POST['school_mail'];
    $tel = $_POST['school_number'];
    $idSession = $_SESSION['idUser'];
    $idCreateur = $idUser;
    $ecoId = $_GET['id'];


    //REQUETE SQL POUR INSERER LES DONNEES DE L ECOLE 
    $sql = "UPDATE `ecole` SET eco_nom=:nom, eco_ref=:ref, eco_adresse=:adresse, eco_cp=:cp, eco_ville=:ville, eco_mail=:mail, eco_tel=:tel WHERE eco_id='$ecoId'";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel));
  

    //SI LA REQUETE A BIEN FONCTIONNER FAIRE
    if($exec){

        //AJOUT DANS L'HISTORIQUE

        $laDate = date('Y-m-d H:i:s');
        $sqlHistorique = "INSERT INTO `modifications`(`mdf_idEcole`, `mdf_idUser`, `mdf_date`, `mdf_type`) VALUES (:idEcole, :idUser, :laDate, :typeModif)";
        $res = $db->prepare($sqlHistorique);
        $exec = $res->execute(array(":idEcole"=>$ecoId, ":idUser"=>$idSession, ":laDate"=>$laDate, ":typeModif"=>3));


        header('location: dashboard.php');
    }
    //SINON FAIRE
    else{
        echo "Insertion echoué";
    }

}

//SINON REDIRECTION 
else{
    header("location:accueil.php");
}



?>