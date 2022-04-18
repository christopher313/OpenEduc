<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

if(isset($_SESSION['idUser'])){
    //VARIABLES
    $idSession = $_SESSION['idUser'];
    $ecoId = $_GET['id'];


    //REQUETE POUR VERIFIER SI UTILISATEUR A BIEN LES DROITS SUR L'ECOLE
    $sqlSelectDroits = "SELECT * FROM `droits` WHERE `dr_ecoId`= '$ecoId' AND `dr_usrId`= '$idSession';";
    $recipesStatement = $db->prepare($sqlSelectDroits);
    $recipesStatement->execute();
    $recipesDroits = $recipesStatement->fetchAll();
    $row_cnt = $recipesStatement->rowCount();

    if($row_cnt>0){

        //REQUETE POUR RECUPERER LES INFORMATIONS DE L'ECOLE
        $sql = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id WHERE `eco_id`= '$ecoId'";
        $recipesStatement = $db->prepare($sql);
        $recipesStatement->execute();
        $donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);



        ?>

        <!DOCTYPE html>
        <html lang="FR">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../css/style.css">
            <title>OpenEduc - Modifications des informations de <?php echo $donnees['eco_nom']?></title>
        </head>
        <body>

        <div class="page_container">
            <h1 class="title-h1">Modifications des informations de <?php echo $donnees['eco_nom'] ?></h1>
            <?php 
            $adresse = $donnees['eco_adresse']
            ?>
        </div>

        <form action="modification_ecole_traitement.php?id=<?php echo $ecoId ?>" method="post" class="formulaire_connexion">
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Nom de l'école" name="school_name" value="<?php echo $donnees['eco_nom']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Référence" name="school_ref" value="<?php echo $donnees['eco_ref']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Adresse" name="school_adresse" value="<?php echo $donnees['eco_adresse']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="number" placeholder="Code Postal" name="school_cp" value="<?php echo $donnees['eco_cp']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Ville" name="school_city" value="<?php echo $donnees['eco_ville']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="mail" placeholder="Mail" name="school_mail" value="<?php echo $donnees['eco_mail']?>" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="tel" placeholder="Numéro de téléphone" name="school_number" value="<?php echo $donnees['eco_tel']?>" required></label>
            <label style="text-align: left; font-size: 0.8em; margin-bottom: 15px;">Les champs avec un astérique, sont des champs obligatoires.</label>
            <input class="button" type="submit" value="Modifier" name="bouton_envoie">
        </form>


            
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