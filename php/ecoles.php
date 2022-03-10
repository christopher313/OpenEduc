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
    <title>OpenEduc - Les ecoles </title>
</head>
<body>

    <h1 class="title-h1">Rechercher une ecole</h1>

    <div class="page_container">

        <form action="" method="post" class="formulaire_connexion">
            <img src="../img/OPEN2.png" id="ico"/>
            <input type="text" placeholder="Ecrire ici..." name="search-bar" class="champ"/>
            <input type="submit" value="Rechercher" name="search-button" class="button"/>
        </form>

    </div>


    
</body>
</html>
