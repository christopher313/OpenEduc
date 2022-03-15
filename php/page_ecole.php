<?php

//PAGE TYPE POUR LES INFO ECOLE

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//SI LA SESSION EXISTE L'ID SESSION = ID USER
if(isset($_SESSION['idUser'])){
    $idSession = $_SESSION['idUser'];
}
//SINON = -1 (PERMET D'EVITER LES BUGS POUR LES DROITS)
else{
    $idSession = '-1';
}


//VARIABLES
$ref = $_GET['id'];

//REQUETE SQL POUR RECUPERER TOUTES LES INFOS DE L'ECOLE EN QUESTION PAR RAPPORT AU LIEN EN GET
$sql = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id WHERE `eco_ref`= '$ref'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

//VARIABLES
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


//REQUETE SQL POUR RECUPERER LES INFO DU COMPTE CREATEUR DE L'ECOLE
$sql2 = "SELECT `ct_username` FROM `compte` WHERE `ct_id`= $creatorId";
$recipesStatement2 = $db->prepare($sql2);
$recipesStatement2->execute();
$donnees2 = $recipesStatement2->fetch(PDO::FETCH_ASSOC);

//REQUETE SQL POUR RECUPERE LES INFOS SUR LES DROITS DE L'UTILISATEUR SUR L'ECOLE
$sql3 = "SELECT * FROM `droits` WHERE `dr_usrId`= '$idSession' AND `dr_ecoId` = '$ecoId' ";
$recipesStatement3 = $db->prepare($sql3);
$recipesStatement3->execute();
$row_cnt = $recipesStatement3->rowCount();


$creatorName = $donnees2['ct_username'];




// BOUCLE POUR L'AFFICHAGE DU NUMERO DE TELEPHONE PERMETTANT L'ESPACEMENT (00 00 00 ..)
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

//REQUETE SQL POUR RECUPERER LES DIFFERENTES CLASSES LIE A L'ECOLE
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
        <a href="ajouter_classe.php?id=<?php echo $ref ?>">Ajouter une classe</a><?php
        if($creatorId == $idSession){?>
            <a href="droits.php?id=<?php echo $ref ?>">Gérer les droits</a><?php
        }
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


<!-- Génération d'un graphique représentant les effectifs de chaque écoles.-->

<div class="chart-container" style='position: relative; height:40vh; width:80vh; margin:auto; margin-top: 30px;'>
<canvas id="myChart"></canvas>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js" 
integrity="sha512-QSkVNOCYLtj73J4hbmVoOV6KVZuMluZlioC+trLpewV8qMjsWqlIQvkn1KGX2StWvPMdWGBqim1xlC8krl1EKQ==" 
crossorigin="anonymous" 
referrerpolicy="no-referrer"></script>
<script>
const ctx = document.getElementById('myChart').getContext('2d');

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode([$nomEcole]) ?>,
        datasets: [{
            label: 'effectifs écoles',
            data: <?php echo json_encode([$totalEffectif]) ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

    
</body>
</html>
