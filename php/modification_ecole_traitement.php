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
    $ecoId = $_GET['id'];
    $civiliteAPEA = $_POST['civiliteAPEA'];
    $pnomAPEA = $_POST['pnomAPEA'];
    $nomAPEA = $_POST['nomAPEA'];
    $mailAPEA = $_POST['mailAPEA'];
    $pnomCrs = $_POST['pnomCrs'];
    $nomCrs = $_POST['nomCrs'];
    $mailCrs = $_POST['mailCrs'];
    $posteCrs = $_POST['posteCrs'];
    $telCrs = $_POST['telCrs'];
    $civiliteCrs = $_POST['civiliteCrs'];


    //REQUETE SQL POUR INSERER LES DONNEES DE L ECOLE 
    $sql = "UPDATE `ecole` SET eco_nom=:nom, eco_ref=:ref, eco_adresse=:adresse, eco_cp=:cp, eco_ville=:ville, eco_mail=:mail, eco_tel=:tel, eco_nomAPEA = :nomAPEA, eco_mailAPEA = :mailAPEA WHERE eco_id='$ecoId'";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel, ":nomAPEA"=>$nomAPEA, "mailAPEA"=>$mailAPEA ));
    

    //REQUETE POUR RECUPERER INFOS ECOLES
     //REQUETE POUR RECUPERER LES INFORMATIONS DE L'ECOLE
     $sql3 = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id LEFT JOIN correspondant_mairie ON correspondant_mairie.cm_idEcole=ecole.eco_id  LEFT JOIN correspondant_apea ON correspondant_apea.ca_ecoId=ecole.eco_id WHERE `eco_id`= $ecoId";
     $recipesStatement3 = $db->prepare($sql3);
     $recipesStatement3->execute();
     $donnees3 = $recipesStatement3->fetch(PDO::FETCH_ASSOC);

     // MAIRIE

     if(($donnees3['cm_prenom'] == "") && ($donnees3['cm_nom'] == "")){
        $sql2 =  "INSERT INTO `correspondant_mairie`(`cm_idEcole`, `cm_civilite`, `cm_prenom`, `cm_nom`, `cm_poste`, `cm_tel`, `cm_mail`) VALUES (:ecoId, :civiliteCrs, :pnomCrs, :nomCrs, :posteCrs, :telCrs, :mailCrs)";
        $res2 = $db->prepare($sql2);
        $exec = $res2->execute(array(":ecoId"=>$ecoId, ":civiliteCrs"=>$civiliteCrs, ":pnomCrs"=>$pnomCrs, ":nomCrs"=>$nomCrs, ":posteCrs"=>$posteCrs, ":telCrs"=>$telCrs, ":mailCrs"=>$mailCrs));
     }
     else{
         $sql4 = "UPDATE `correspondant_mairie` SET `cm_civilite`=:civiliteCrs,`cm_prenom`= :pnomCrs,`cm_nom`= :nomCrs,`cm_poste`= :posteCrs,`cm_tel`= :telCrs,`cm_mail`= :mailCrs WHERE `cm_idEcole` = $ecoId;";
         $res4 = $db->prepare($sql4);
         $exec = $res4->execute(array(":civiliteCrs"=>$civiliteCrs, ":pnomCrs"=>$pnomCrs, ":nomCrs"=>$nomCrs, ":posteCrs"=>$posteCrs, ":telCrs"=>$telCrs, ":mailCrs"=>$mailCrs));
         ?><h1>JAJAJA</h1><?php
     }


     //APEA
     echo $ecoId . " / " . $civiliteAPEA . " / " . $pnomAPEA . " / " . $nomAPEA ." / " . $mailAPEA;  

     if(($donnees3['ca_prenom'] == "") && ($donnees3['ca_nom'] == "")){
        $sql5 =  "INSERT INTO `correspondant_apea`(`ca_ecoId`, `ca_civilite`, `ca_prenom`, `ca_nom`, `ca_mail`) VALUES (:ecoId, :civiliteAPEA, :pnomAPEA, :nomAPEA, :mailAPEA)";
        $res5 = $db->prepare($sql5);
        $exec = $res5->execute(array(":ecoId"=>$ecoId, ":civiliteAPEA"=>$civiliteAPEA, ":pnomAPEA"=>$pnomAPEA, ":nomAPEA"=>$nomAPEA, ":mailAPEA"=>$mailAPEA));
     }
     else{
        $sql6 = "UPDATE `correspondant_apea` SET `ca_civilite`=:civiliteAPEA,`ca_prenom`= :pnomAPEA,`ca_nom`= :nomAPEA, `ca_mail`= :mailAPEA WHERE `ca_ecoId` = $ecoId;";
        $res6 = $db->prepare($sql6);
        $exec = $res6->execute(array(":civiliteAPEA"=>$civiliteAPEA, ":pnomAPEA"=>$pnomAPEA, ":nomAPEA"=>$nomAPEA, ":mailAPEA"=>$mailAPEA));
        if($exec){?>
            <h1> <?php echo "insert 1" ?></h1><?php
         }
     }




        
    
  

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