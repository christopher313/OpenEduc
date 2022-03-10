<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";
$userid = $_SESSION['idUser'];

$sql = "SELECT * FROM `droits` INNER JOIN ecole ON droits.dr_ecoId = ecole.eco_id WHERE dr_usrId = '$userid'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();



?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - DASHBOARD </title>
</head>
<body>

<h1 class="title-h1">DASHBOARD ADMINISTRATEUR - OPENEDUC</h1>

<div class="page_container">
    <div class="line_column">
        <div class="column">
            <div class="item-column">

                <h2>MES ECOLES</h2>
                <ul>
                    <?php 
                    foreach($recipes as $recipe){?>
                        <li><a href="<?php echo 'page_ecole.php?id='.$recipe['eco_ref'] ?>"><?php echo $recipe['eco_nom']?>   <a href="<?php echo 'supprimer_ecole.php?id='.$recipe['eco_ref']?>" id="delete">X</a></li><?php
                    }?>
                </ul>
            </div>
            <div class="item-button-column">
                <a href="ajouter_ecole.php">+</a>
            </div>
        </div>
        <div class="column">

        </div>
    </div>
</div>






</body>
</html>




