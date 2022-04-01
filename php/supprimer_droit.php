<?php

//PAGE DE TRAITEMENT POUR SUPPRIMER LES DROITS LIE A L'UTILISATEUR

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//VARIABLES
if(isset($_GET['idDroit'])&&(isset($_GET['idDroit']))){
    $ref_droit = $_GET['idDroit'];
    $ref_ecole = $_GET['idEcole'];




    //REQUETE SQL POUR RECUPERER 1 LIGNE SUR LES DROITS ET LES INFO COMPTE LIÉS A L'ECOLE 
    $sql = "SELECT * FROM `droits` INNER JOIN compte ON droits.dr_usrId = compte.ct_id WHERE droits.dr_ecoId = '$ref_ecole'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $donnees_droit2 = $recipesStatement->fetch(PDO::FETCH_ASSOC);

    if($donnees_droit2['dr_creatorId'] == $_SESSION['idUser']){

        //REQUETE SQL POUR SUPPRIMER LES DROITS PAR RAPPORT A LA REFERANCE DU DROIT AVEC LE LIEN EN GET
        $sql = "DELETE FROM `droits` WHERE `dr_id`='$ref_droit'";
        $recipesStatement = $db->prepare($sql);
        $recipesStatement->execute();



        //REDIRECTION VERS ... 
        $lien = "droits.php?id=".$ref_ecole;
        header('location: ' . $lien);
    }
    else{
        header('location: accueil.php');
    }
}
else{
    header('location: accueil.php');
}


?>