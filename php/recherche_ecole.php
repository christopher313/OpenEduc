<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";


$search = $_GET['search-bar'];

$sql = "SELECT eco_nom, eco_ref, eco_ville FROM `ecole` WHERE eco_nom LIKE '%$search%';";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

$row_cnt = $recipesStatement->rowCount();


?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Recherche </title>
</head>
<body>

    <div class="recherche-item">
        <form action="recherche_ecole.php" method="get" class="recherche">
            <input type="text" placeholder="Ecrire ici..." name="search-bar" class="champ"/>
            <input type="submit" value="Rechercher" name="search-button" class="button"/>
        </form>
    </div>


    <h1 class="title-h1">Resultats de votre recherche</h1>

    <div class="page_container">

    


    <br/>
        <ul>
            <?php 

            if($row_cnt == 0){
                echo "Pas de resultat pour votre recherche";
            }
            else{
                foreach($recipes as $recipe){?>
                    <li><a href="page_ecole.php?id=<?php echo $recipe['eco_ref']?>"><?php echo $recipe['eco_nom']?> </li><?php
                }
            }
            
            ?>
            
        </ul>

      

    </div>


    
</body>
</html>
