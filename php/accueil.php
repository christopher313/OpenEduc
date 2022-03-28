<?php

//PAGE D'ACCUEIL

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
            <h1 class="title-h1">Bienvenue sur la plateforme OpenEduc</h1>
            <div class="block-image-accueil">
                <img id="img_accueil" src="../img/OPEN2.png"/>
                <a class="button" href="about.php">Decouvrir plus</a>
            </div>
 
    </div> 
    


    
</body>
</html>