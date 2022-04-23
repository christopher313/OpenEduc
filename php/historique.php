<?php

//PAGE D'ACCUEIL

//INITIALISATION DE LA PAGE

require "navmenu.php";



$idEcole = $_GET['id'];
if(isset($_SESSION['idUser'])){
    $idSession = $_SESSION['idUser'];



//REQUETE POUR RECUPERER INFORMATION DE LA TABLE HISTORIQUE
$sql = "SELECT mdf_date, mdf_idUser, eco_nom, mdf_type, ct_username FROM `modifications` INNER JOIN ecole ON modifications.mdf_idEcole = ecole.eco_id INNER JOIN compte ON modifications.mdf_idUser=compte.ct_id WHERE mdf_idEcole = '$idEcole' ORDER BY mdf_date DESC;";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

//REQUETE POUR VERIFIER SI UTILISATEUR A BIEN LES DROITS SUR L'ECOLE
$sqlSelectDroits = "SELECT * FROM `droits` WHERE `dr_ecoId`= '$idEcole' AND `dr_usrId`= '$idSession';";
$recipesStatement = $db->prepare($sqlSelectDroits);
$recipesStatement->execute();
$recipesDroits = $recipesStatement->fetchAll();
$row_cnt = $recipesStatement->rowCount();


if($row_cnt>0){



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

<div class="container">
    <h1 class="text-center py-5">Historique des modifications</h1>

    <ul class="list-unstyled">
        <?php

            foreach($recipes as $recipe){
                $typeModif = $recipe['mdf_type'];
                switch($typeModif){
                    case 0:
                        $typeModif = "a ouvert le profil de ";
                        break;
                    case 1:
                        $typeModif = "a supprimé une classe de ";
                        break;
                    case 2:
                        $typeModif = "a ajouté une classe à ";
                        break;
                    case 3:
                        $typeModif = "a modifié les informations de ";
                        break;
                }
                ?>

                    <li ><i class="bi bi-clock-history"> </i><?php echo $recipe['mdf_date'] ?><div class="bg-dark text-white my-2 py-3 px-1"><?php echo " " . $recipe['ct_username'] . " " .  $typeModif . $recipe['eco_nom']; ?></div></li>
                
            <?php
            }
        ?>
    </ul>

</div>


    

   
    


    
</body>
</html>

<?php 
}
else{
    header('location: accueil.php');
}
}
else{
    header('location: accueil.php');
}
?>