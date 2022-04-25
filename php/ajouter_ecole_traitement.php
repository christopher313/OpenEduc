<?php

//PAGE DE TRAITEMENT POUR AJOUTER UNE ECOLE DANS LA BDD

//INITIALISATION DE LA PAGE

require "navmenu.php";


//VARIABLES


if(isset($_POST['school_name'])){

    $nom = strtoupper($_POST['school_name']);
    $ref = strtoupper($_POST['school_ref']);
    $adresse = $_POST['school_adresse'];
    $cp = $_POST['school_cp'];
    $ville = strtoupper($_POST['school_city']);
    $mail = $_POST['school_mail'];
    $tel = $_POST['school_number'];
    $idSession = $_SESSION['idUser'];
    $idCreateur = $idSession;
    $pnomCrs = $_POST['pnomCrs'];
    $nomCrs = $_POST['nomCrs'];
    $mailCrs = $_POST['mailCrs'];
    $posteCrs = $_POST['posteCrs'];
    $telCrs = $_POST['telCrs'];
    if(isset($_POST['civiliteCrs'])){
        $civiliteCrs = $_POST['civiliteCrs'];
    }
    
    $civiliteAPEA = $_POST['civiliteAPEA'];
    $pnomAPEA = $_POST['pnomAPEA'];
    $nomAPEA = $_POST['nomAPEA'];
    $mailAPEA = $_POST['mailAPEA'];

    //REQUETE SQL POUR INSERER LES DONNEES DE L ECOLE 
    $sqlInsertEcole = "INSERT INTO `ecole`(`eco_nom`, `eco_ref`, `eco_adresse`, `eco_cp`, `eco_ville`, `eco_mail`, `eco_tel`) VALUES (:nom , :ref, :adresse, :cp, :ville, :mail, :tel) ";
    $res = $db->prepare($sqlInsertEcole);
    $exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel));
    //RECUPERATION DU DERNIERE ID INSERE
    $last_id = $db->lastInsertId();

    //SI LA REQUETE A BIEN FONCTIONNER FAIRE
    if($exec){
        echo "Insertion réussie";
        //REQUETE SQL POUR INSERER LES DROITS AUTOMATIQUE DU CREATEUR DANS LA TABLE DROIT
        $sqlInsertDroits = "INSERT INTO `droits`(`dr_creatorId`, `dr_usrId`, `dr_ecoId`) VALUES (:idCreateur, :idUtilisateur, :idEcole)";
        $res = $db->prepare($sqlInsertDroits);
        $exec = $res->execute(array(":idCreateur"=>$idCreateur, ":idUtilisateur"=>$idSession, ":idEcole"=>$last_id));

        // AJOUTER A l'HISTORIQUE
        $laDate = date('Y-m-d H:i:s');
        $sqlHistorique = "INSERT INTO `modifications`(`mdf_idEcole`, `mdf_idUser`, `mdf_date`, `mdf_type`) VALUES (:idEcole, :idUser, :laDate, :typeModif)";
        $res = $db->prepare($sqlHistorique);
        $exec = $res->execute(array(":idEcole"=>$last_id, ":idUser"=>$idSession, ":laDate"=>$laDate, ":typeModif"=>0));

        //AJOUT DU CORRESPONDANT MAIRIE
        if(($nomCrs == "") && ($pnomCrs == "")){
            
         }
         else{
            $sql2 =  "INSERT INTO `correspondant_mairie`(`cm_idEcole`, `cm_civilite`, `cm_prenom`, `cm_nom`, `cm_poste`, `cm_tel`, `cm_mail`) VALUES (:ecoId, :civiliteCrs, :pnomCrs, :nomCrs, :posteCrs, :telCrs, :mailCrs)";
            $res2 = $db->prepare($sql2);
            $exec2 = $res2->execute(array(":ecoId"=>$last_id, ":civiliteCrs"=>$civiliteCrs, ":pnomCrs"=>$pnomCrs, ":nomCrs"=>$nomCrs, ":posteCrs"=>$posteCrs, ":telCrs"=>$telCrs, ":mailCrs"=>$mailCrs));
         }

        //AJOUT DU CORRESPONDANT APEA
        if(($nomAPEA == "") && ($pnomAPEA == "")){
            
        }
        else{
           $sql3 = "INSERT INTO `correspondant_apea`(`ca_ecoId`, `ca_civilite`, `ca_prenom`, `ca_nom`, `ca_mail`) VALUES (:ecoId,:civiliteAPEA, :pnomAPEA,:nomAPEA, :mailAPEA)";
           $res3 = $db->prepare($sql3);
           $exec3 = $res3->execute(array(":ecoId"=>$last_id, ":civiliteAPEA"=>$civiliteAPEA, ":pnomAPEA"=>$pnomAPEA, ":nomAPEA"=>$nomAPEA, ":mailAPEA"=>$mailAPEA));
        }
       
        
        //REDIRECTION
        header('location: dashboard.php');
        }
    //SINON FAIRE
    else{
        echo "Insertion echoué";
    }
}
else{
    header('location: accueil.php');
}




?>