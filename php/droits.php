<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";



    //VARIABLE
    $ref = $_GET['id'];

    //REQUETE SQL POUR RECUPERER LES INFOS DE L'ECOLE A L'AIDE DU LIEN EN GET
    $sql = "SELECT * FROM `ecole` WHERE `eco_ref`= '$ref'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

    $eco_id=$donnees['eco_id'];


    //REQUETE SQL POUR RECUPERER TOUTES LES LIGNES SUR LES DROITS ET LES INFO COMPTE LIÉS A L'ECOLE 
    $sql = "SELECT * FROM `droits` INNER JOIN compte ON droits.dr_usrId = compte.ct_id WHERE droits.dr_ecoId = '$eco_id'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $donnees_droit = $recipesStatement->fetchAll();

    //REQUETE SQL POUR RECUPERER 1 LIGNE SUR LES DROITS ET LES INFO COMPTE LIÉS A L'ECOLE 
    $sql = "SELECT * FROM `droits` INNER JOIN compte ON droits.dr_usrId = compte.ct_id WHERE droits.dr_ecoId = '$eco_id'";
    $recipesStatement = $db->prepare($sql);
    $recipesStatement->execute();
    $donnees_droit2 = $recipesStatement->fetch(PDO::FETCH_ASSOC);

    if($donnees_droit2['dr_creatorId'] == $_SESSION['idUser']){

    ?>

    <!DOCTYPE html>
    <html lang="FR">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>OpenEduc - Gestionnaire de droits</title>
    </head>
    <body>

    <h1 class="title-h1">Gestion des droits de <?php echo $donnees['eco_nom'] ?> </h1>


    <div class="page_container">

        <div class="tableau">
        <h2>Utilisateurs</h2>

            <table>
                <tr id="case-sombre">
                    <td>Utilisateur(s)</td>
                    <td>&nbsp</td>
                </tr>

                <?php 
                foreach($donnees_droit as $donnee_droit){ ?>
                <tr>
                    <td><?php echo $donnee_droit['ct_username']?></td><?php
                        if($donnee_droit['dr_creatorId']== $_SESSION['idUser']){?>
                            <td><a href="supprimer_droit.php?idDroit=<?php echo $donnee_droit['dr_id']?>&idEcole=<?php echo $ref ?>">X</a></td><?php
                        }?>
                </tr><?php
                }?>
                

            </table>
                
        

        </div>
        

    </div>


            <form action="ajouter_droit_utilisateur.php?id=<?php echo $ref?>" method="post" class="formulaire_connexion">
                <input type="text" class="champ" placeholder="Nom d'utilisateur" name="user_droit"/>
                <input type="HIDDEN" value="<?php echo $eco_id ?>" name="eco_id"/>
                <input type="submit" class="bouton" value="Ajouter" name="bouton_droit"/>
            </form>



        
    </body>
    </html>

<?php
}

else{
    header('location: page_ecole.php?id=' . $ref);

}
?>