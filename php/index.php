<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="img/Copie de OPEN.png">
    <title>OpenEduc</title>
</head>
<body>
    
    <div class="page_container">
        <div class="block_container">
            <h1 style="text-align:center;">Bienvenue sur la plateforme en ligne OpenEduc<h1>
        </div>
        <div class="container_accueil">
            <img src="../img/OPEN2" alt="logo OpenEduc" id="img_accueil">
            <button onclick="window.location.href = 'deconnexion.php';">Decouvrir plus</button>
        </div>
    </div>
</body>
</html>