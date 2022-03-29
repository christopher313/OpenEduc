<?php

//PAGE D'ACCUEIL

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

/*
SELECT mdf_date, mdf_idUser, eco_nom  
FROM `modifications` 
INNER JOIN ecole 
ON modifications.mdf_idEcole = ecole.eco_id 
INNER JOIN compte
ON modifications.mdf_idUser = compte.ct_username
WHERE mdf_idEcole = 27;

*/


$idEcole = $_GET['id'];

$sql = "SELECT mdf_date, mdf_idUser, eco_nom FROM `modifications` INNER JOIN ecole ON modifications.mdf_idEcole = ecole.eco_id WHERE mdf_idEcole = '$idEcole'";

$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="img/Copie de OPEN.png">
    <title>Historique des modifications de <?php echo ad?></title>
</head>
<body>

<div class="historique-container">
<ul>
    <?php
        foreach($recipes as $recipe){?>
            <li ><div class="historique-box"><a class="historique-item"><?php echo $recipe['mdf_date'] . "| Utilisateur: " . $recipe['mdf_idUser'] . " a modifier ecole: " . $recipe['eco_nom']; ?></a></div></li>
        <?php
        }
    ?>
</ul>
</div>
   
    


    
</body>
</html>