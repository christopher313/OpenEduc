<?php

//INITIALISATION DE LA PAGE

require "navmenu.php";


if(isset($_GET['id'])){



//VARIABLE
$ecoId = $_GET['id'];

//REQUETE SQL POUR RECUPERER LES INFOS DE L'ECOLE A L'AIDE DU LIEN EN GET
$sql = "SELECT * FROM `ecole` WHERE `eco_id`= '$ecoId'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);



//REQUETE SQL POUR RECUPERER TOUTES LES LIGNES SUR LES DROITS ET LES INFO COMPTE LIÉS A L'ECOLE 
$sql = "SELECT * FROM `droits` INNER JOIN compte ON droits.dr_usrId = compte.ct_id WHERE droits.dr_ecoId = '$ecoId'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees_droit = $recipesStatement->fetchAll();

//REQUETE SQL POUR RECUPERER 1 LIGNE SUR LES DROITS ET LES INFO COMPTE LIÉS A L'ECOLE 
$sql = "SELECT * FROM `droits` INNER JOIN compte ON droits.dr_usrId = compte.ct_id WHERE droits.dr_ecoId = '$ecoId'";
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
<body class="bg-light">

    <div class="container py-5">

        <h1 class="text-center">Gestion des droits de <?php echo $donnees['eco_nom'] ?></h1>
        


        <div class="row">
            <div class="col-3"></div>

            <div class="col-6">
                
                <form action="ajouter_droit_utilisateur.php?id=<?php echo $ecoId?>" method="post" class="text-center d-flex ">
                        <input type="text" class="form-control" placeholder="Nom d'utilisateur" name="user_droit"/>
                        <input type="HIDDEN" value="<?php echo $ecoId ?>" name="eco_id"/>
                        <input type="submit" class="btn btn-dark" value="Ajouter" name="bouton_droit"/>
                </form>

            </div>
            
            <div class="col-3">

            </div>
        </div>

        
        
        <div class="row py-5">

            <div class="col-2">
                
            </div>

            <div class="col-8">
                <table class="table">
                    <tr id="case-sombre">
                        <td>Utilisateur(s)</td>
                        <td>&nbsp</td>
                    </tr>

                    <?php 
                    foreach($donnees_droit as $donnee_droit){ ?>
                    <tr>
                        <td><?php echo $donnee_droit['ct_username']?></td><?php
                            if($donnee_droit['dr_creatorId']!= $donnee_droit['dr_usrId']){
                                ?>
                                <td><a class="link-dark" href="supprimer_droit.php?idDroit=<?php echo $donnee_droit['dr_id']?>&idEcole=<?php echo $ecoId ?>"><i class="bi bi-trash-fill"></i></a></td><?php
                            }
                            else{?>
                                <td>&nbsp</td><?php
                            }
                            ?>
                    </tr><?php
                    }?>        
                </table>
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
    header('location: page_ecole.php?id=' . $ecoId);

}
}
else{
    header('location: accueil.php');
}
?>
