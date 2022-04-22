<?php

//PAGE DE TRAITEMENT POUR AJOUTER LES DROITS UTILISATEURS 

//INITIALISATION DE LA PAGE

require "navmenu.php";


//VARIABLES

if(isset($_POST['user_droit'])){
    $idCreateur = $_SESSION['idUser'];
    $ecoId = $_GET['id'];
    $link = "droits.php?id=" . $ecoId;
    $nomUtilisateur = $_POST['user_droit'];



    //REQUETE SQL POUR RECUPERER L'ID UTILISATEUR A PARTIR DE L'INPUT NOM D'UTILISATEUR
    $sqlIdUtilisateur = "SELECT ct_id FROM `compte` WHERE `ct_username`= '$nomUtilisateur'";
    $recipesStatement = $db->prepare($sqlIdUtilisateur);
    $recipesStatement->execute();
    $donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

    //VARIABLES
    $idUtilisateur = $donnees['ct_id'];

    //REQUETE SQL POUR INSERER LE NOUVEAU DROIT UTILISATEUR
    $sqlInsertUser = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES ( :creatorId, :usrId, :ecoId)";
    $recipesStatement = $db->prepare($sqlInsertUser);
    $exec = $recipesStatement->execute(array(":creatorId"=>$idCreateur, ":usrId"=>$idUtilisateur, ":ecoId"=>$ecoId));


    //REDIRECTION 
    header('location: ' . $link );
}
else{
    header('location: accueil.php' );
}

?>