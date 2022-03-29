<?php

//PAGE D'ACCUEIL

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";


$ecoId = $_GET['id'];
$userId = $_SESSION['idUser'];
$laDate = date('Y-m-d H:i:s');

echo $ecoId . "/" . $userId . "/" . $date;
$sql = "INSERT INTO `modifications`(`mdf_idEcole`, `mdf_idUser`, `mdf_date`) VALUES (:idEcole, :idUser, :laDate)";
$res = $db->prepare($sql);
$exec = $res->execute(array(":idEcole"=>$ecoId, ":idUser"=>$userId, ":laDate"=>$laDate));

if($exec){
    echo "Insertion réussie";
}
else{
    echo "Insertion echoué";
}

header('location:historique.php?id='.$ecoId);

?>

