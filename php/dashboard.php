<?php

//PAGE DE PANNEL ADMINISTRATEUR

//INITIALISATION DE LA PAGE

require "navmenu.php";

//VARIABLE
$userid = $_SESSION['idUser'];

if(isset($userid)){

//REQUETE SQL POUR RECUPERER LES DROITS ET LES INFO DU COMPTE LIE A L'ID DE LA SESSION
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
<body class="bg-light">


<div class="container text-center py-5">

    <h1 class="title-h1">DASHBOARD ADMINISTRATEUR</h1>

    <a href="ajouter_ecole.php" class="btn btn-dark text-decoration-none text-white py-2 my-2 text-center"><i class="bi bi-plus-circle"></i> Ajouter une école</a>


    <div class="row">
        <div class="col-2">

        </div>

        <div class="col-8 p-2">


        <!-- //CREER UNE LISTE DES ECOLES OU L'UTILISATEUR A LES DROITS DE MODIFICATIONS -->
                <table class="table">
                    <tr id="case-sombre">
                        <td>Nom de l'école</td>
                        <td>&nbsp</td>
                    </tr>

                    <?php 
                    foreach($recipes as $recipe){ ?>
                    <tr>
                        <td><a class="link-dark text-decoration-none" href="<?php echo 'page_ecole.php?id='.$recipe['eco_id'] ?>"><?php echo $recipe['eco_nom']?></a></td><?php
                            if($recipe['dr_creatorId']== $_SESSION['idUser']){?>
                                <td><a class="link-dark" href="supprimer_ecole.php?id=<?php echo $recipe['eco_id']?>"><i class="bi bi-trash-fill"></i></a></td><?php
                            }
                            else{?>
                                <td>&nbsp</td><?php
                            }?>
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
    header('location:accueil.php');
}
?>




