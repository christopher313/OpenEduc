<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";
if(isset($_SESSION['idUser'])){
    $idSession = $_SESSION['idUser'];
}
else{
    $idSession = '-1';
}

$ref = $_GET['id'];
$sql = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id WHERE `eco_ref`= '$ref'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$creatorId = $donnees['dr_creatorId'];

$nomEcole = $donnees['eco_nom'];
$adresseEcole = $donnees['eco_adresse'];
$cp = $donnees['eco_cp'];
$ville = $donnees['eco_ville'];
$eco_mail = $donnees['eco_mail'];
$eco_tel = $donnees['eco_tel'];
$eco_tel_decompose = "";
$delimiteur = 0;
$ecoId = $donnees['eco_id'];
$totalEffectif = 0;
$boucle = 0;
$idDroit = $donnees['dr_usrId'];



$sql2 = "SELECT `ct_username` FROM `compte` WHERE `ct_id`= $creatorId";
$recipesStatement2 = $db->prepare($sql2);
$recipesStatement2->execute();
$donnees2 = $recipesStatement2->fetch(PDO::FETCH_ASSOC);

$sql3 = "SELECT * FROM `droits` WHERE `dr_usrId`= '$idSession' AND `dr_ecoId` = '$ecoId' ";
$recipesStatement3 = $db->prepare($sql3);
$recipesStatement3->execute();
$row_cnt = $recipesStatement3->rowCount();


$creatorName = $donnees2['ct_username'];





for($i=0; $i<10; $i++){
    if($delimiteur == 2){
        $delimiteur = 1;
        $eco_tel_decompose = $eco_tel_decompose . " " . $eco_tel[$i];
    }
    else{
        $delimiteur++;
        $eco_tel_decompose = $eco_tel_decompose . $eco_tel[$i];
    }
}

$sql = "SELECT * FROM `classe` WHERE `cl_idEcole`='$ecoId'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();




?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - <?php echo $nomEcole ?></title>
</head>
<body>

<h1 class="title-h1"><?php echo $nomEcole ?></h1>

<div class="page_container">
    <div class="info-ecole">
        <div class="info-ecole-colonne">
            <p><strong>Nom: </strong><?php echo $nomEcole ?></p>
            <p><strong>Identifiant: </strong><?php echo $ref ?></p>
            <p><strong>Adresse: </strong><?php echo $adresseEcole . " ". $cp . " " . $ville  ?> </p>
            <p><strong>Téléphone: </strong><?php echo $eco_tel_decompose ?> </p>
            <p><strong>Email: </strong><a href="<?php echo 'mailto:' . $eco_mail ?>"><?php echo $eco_mail ?> </a></p>
        </div>
        <div class="info-ecole-colonne">
            <p><strong>Année scolaire: </strong> 2021/22</p>
            <p><strong>Dernière mise à jour: </strong> 21-nov-21</p>
            <p><strong>Administrateur: </strong><?php echo $creatorName?> </p>
        </div>
    </div>  
    <?php



    if($row_cnt>=1){?>
    <a href="ajouter_classe.php?id=<?php echo $ref ?>">Ajouter une classe</a>
    <a href="droits.php?id=<?php echo $ref ?>">Gérer les droits</a>
    <?php  
    }
    ?>

    <br/>
    
    <table>
        <tr id="case-sombre">
            <td>Niveau(x)</td>
            <td>Professeur</td>
            <td>Effectifs</td>
            <td></td>
        </tr>

        <?php 
        foreach($recipes as $recipe){ ?>
        <tr>
            <td><?php echo $recipe['cl_idNiveau']?></td>
            <td><?php echo $recipe['cl_civilite'] . " " . $recipe['cl_nomProf']?></td>
            <td><?php echo $recipe['cl_effectif']?></td>
            <td><a href="supprimer_classe.php?idClasse=<?php echo $recipe['cl_id']?>&idEcole=<?php echo $ref?>">X</a></td>
        </tr>
            <?php
            $totalEffectif = $totalEffectif + $recipe['cl_effectif'];
            $boucle++;

        }?>
        

        <tr id="case-demi-sombre">
            <td>&nbsp</td>
            <td>Total effectif école</td>
            <td id="case-exception"><?php echo $totalEffectif ?></td>
        </tr>

        <tr id="case-demi-sombre">
            <td>&nbsp</td>
            <td>Moyenne par classe</td>
            <?php 
            if($boucle>0){
                $moyenneEffectif = $totalEffectif/$boucle;
            }
            else{
                $moyenneEffectif = 0 ;
            }
            ?>
            <td id="case-exception"><?php echo $moyenneEffectif ?></td>
        </tr>




       
    </table>



</div>

<?php

?>
    
</body>
</html>
