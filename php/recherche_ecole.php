<?php

//PAGE DE RESULTAT DE RECHERCHE D'ECOLE

//INITIALISATION DE LA PAGE

require "navmenu.php";

//VARIABLE
$search = $_GET['search-bar'];

//REQUETE SQL POUR CHERCHER SI ECOLE EXISTE EN FONCTION DU TEXT INPUT 
$sql = "SELECT eco_id, eco_nom, eco_ref, eco_ville FROM `ecole` WHERE eco_nom LIKE '%$search%';";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

$row_cnt = $recipesStatement->rowCount();

if(empty($_GET['search-bar']) || ($_GET['search-bar'] == " ")){
    header('location: ecoles.php');
}


?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Recherche </title>
</head>
<body>

<div class="container">

    <div class="titre pt-5 ">
        <h1 class="text-center">Recherche d'ecoles</h1>
    </div>
    
    

    <div class="resultats pt-3">
        <h1>Resultat(s) pour "<?php echo $_GET['search-bar']?>"</h1>

        <ul>
            <?php 

            //SI PAS DE CORRESPONDANCE ECRIRE :
            if($row_cnt == 0){
                echo "Pas de resultat pour votre recherche";
            }
            //SINON AFFICHER LES RESULTAT SOUS FORME DE LISTE 
            else{
                foreach($recipes as $recipe){?>
                    <li><a class="text-decoration-none" href="page_ecole.php?id=<?php echo $recipe['eco_id']?>"><?php echo $recipe['eco_nom']?> </li><?php
                }
            }
            
            ?>
            
        </ul>

    </div>

   

</div>




    

    <div class="page_container">

    


    <br/>
        

      

    </div>


    
</body>
</html>
