<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

if($_SESSION['role'] == 1 || 2){?>

<?php
}
else{
    header("location:index.php");
}

$nom = $_POST['school_name'];
$nom = strtoupper($nom);
$ref = $_POST['school_ref'];
$adresse = $_POST['school_adresse'];
$cp = $_POST['school_cp'];
$ville = $_POST['school_city'];
$mail = $_POST['school_mail'];
$tel = $_POST['school_number'];
$lien = $ref . ".php";


$sql = "INSERT INTO `ecole`(`eco_nom`, `eco_ref`, `eco_adresse`, `eco_cp`, `eco_ville`, `eco_mail`, `eco_tel`, `eco_lien`) VALUES (:nom , :ref, :adresse, :cp, :ville, :mail, :tel, :lien) ";
$sql2 = "INSERT INTO `createur`(`cr_ctId`, `cr_ecoId`) VALUES (:idCreateur, :idEcole)";


$res = $db->prepare($sql);
$res2 = $db->prepare($sql2);

$exec = $res->execute(array(":nom"=>$nom, ":ref"=>$ref, ":adresse"=>$adresse, ":cp"=>$cp, ":ville"=>$ville, ":mail"=>$mail, ":tel"=>$tel, ":lien"=>$lien));
$last_id = $db->lastInsertId();

if($exec){
    echo "Insertion réussie";
    $exec2 = $res2->execute(array(":idCreateur"=>$_SESSION['idUser'], ":idEcole"=>$last_id));
    file_put_contents($lien, '<?php include("database.php"); session_start(); require "navmenu.php"; ?>');
}
else{
    echo "Insertion echoué";
}

?>