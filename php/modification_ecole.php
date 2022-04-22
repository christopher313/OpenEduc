<?php

//INITIALISATION DE LA PAGE

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

        $adresse = $donnees['eco_adresse']



        ?>

        <!DOCTYPE html>
        <html lang="FR">
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="../css/style.css">
            <title>OpenEduc - Modifications des informations de <?php echo $donnees['eco_nom']?></title>
        </head>
        <body class="bg-light">

        <div class="container text-center py-5">
            <h1>Modifications des informations de <?php echo $donnees['eco_nom'] ?></h1>

            <div class="row">
                <div class="col-2 d-flex flex-column text-end">
                    <label for="nom" class="form-label m-2">Nom de l'école: </label>
                    <label for="ref" class="form-label ">Référence: </label>
                    <label for="adresse" class="form-label m-2">Adresse: </label>
                    <label for="cp" class="form-label m-2">Code Postal: </label>
                    <label for="ville" class="form-label m-2">Ville: </label>
                    <label for="email" class="form-label m-2">Email: </label>
                    <label for="tel" class="form-label m-2">Tél: </label>
                </div>

                <div class="col">
                    <form action="modification_ecole_traitement.php?id=<?php echo $ecoId ?>" method="post" class="d-flex flex-column">
                        <input class="m-2" id="nom" type="text" placeholder="Nom de l'école" name="school_name" value="<?php echo $donnees['eco_nom']?>" required></label>
                        <input class="m-2" type="text" placeholder="Référence" name="school_ref" value="<?php echo $donnees['eco_ref']?>" required></label>
                        <input class="m-2" type="text" placeholder="Adresse" name="school_adresse" value="<?php echo $donnees['eco_adresse']?>" required></label>
                        <input class="m-2" type="number" placeholder="Code Postal" name="school_cp" value="<?php echo $donnees['eco_cp']?>" required></label>
                        <input class="m-2" type="text" placeholder="Ville" name="school_city" value="<?php echo $donnees['eco_ville']?>" required></label>
                        <input class="m-2" type="mail" placeholder="Mail" name="school_mail" value="<?php echo $donnees['eco_mail']?>" required></label>
                        <input class="m-2" type="tel" placeholder="Numéro de téléphone" name="school_number" value="<?php echo $donnees['eco_tel']?>" required></label>
                        <label style="text-align: left; font-size: 0.8em; margin-bottom: 15px;">Les champs avec un astérique, sont des champs obligatoires.</label>
                        <input class="btn btn-dark" type="submit" value="Modifier" name="bouton_envoie">
                    </form>
                </div>

                <div class="col-2">

                </div>

            </div>

            
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