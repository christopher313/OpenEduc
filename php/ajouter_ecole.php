
<?php

//PAGE FORMULAIRE POUR AJOUTER L ECOLE

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
    
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Connexion </title>
</head>
<body>
    <h1 class="title-h1">Ajouter une école</h1>

    <div class="page_container">
        <form action="ajouter_ecole_traitement.php" method="post" class="formulaire_connexion">
            <input class="champ" type="text" placeholder="Nom de l'école" name="school_name">
            <input class="champ" type="text" placeholder="Référence" name="school_ref">
            <input class="champ" type="text" placeholder="Adresse" name="school_adresse">
            <input class="champ" type="text" placeholder="Code Postal" name="school_cp">
            <input class="champ" type="text" placeholder="Ville" name="school_city">
            <input class="champ" type="text" placeholder="Mail" name="school_mail">
            <input class="champ" type="text" placeholder="Numéro de téléphone" name="school_number">
            <input type="checkbox" id="maternelle" sname="maternelle" >
            <label for="school_type">Maternelle</label>
            <input type="checkbox" id="primaire" sname="primaire">
            <label for="school_type">Primaire</label>
            <input class="button" type="submit" value="Ajouter" name="bouton_envoie">
            
        </form>
    </div>




    
</body>
</html>
