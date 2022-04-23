<?php

//PAGE TYPE POUR LES INFO ECOLE

//INITIALISATION DE LA PAGE

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
$ecoId = $_GET['id'];

//REQUETE SQL POUR RECUPERER TOUTES LES INFOS DE L'ECOLE EN QUESTION PAR RAPPORT AU LIEN EN GET
$sql = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id WHERE `eco_id`= '$ecoId'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

//VARIABLES
$ref = $donnees['eco_ref'];
$creatorId = $donnees['dr_creatorId'];
$nomEcole = $donnees['eco_nom'];
$adresseEcole = $donnees['eco_adresse'];
$cp = $donnees['eco_cp'];
$ville = $donnees['eco_ville'];
$eco_mail = $donnees['eco_mail'];
$eco_tel = $donnees['eco_tel'];
$eco_tel_decompose = "";

//Pour l'affichage du numéro de téléphone
$delimiteur = 0;

//Pour le calcul de la moyenne des effectifs
$totalEffectif = 0;
$boucle = 0;

$idDroit = $donnees['dr_usrId'];

//Création de liste php pour l'affichage du graphique en js
$listeNomProf = array();
$listeEffectif = array();
$listClasses = array();

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
<body class="bg-light">

<div class="container py-5 ">

    <h1 class="text-center"><?php echo $nomEcole ?></h1>

    <div class="informations pb-4">
        <div class="row bg-dark border border-5 border-dark text-white">
            <div class="col">
                <p><strong>Nom: </strong><?php echo $nomEcole ?></p>
                <p><strong>Identifiant: </strong><?php echo $ref ?></p>
                <p><strong>Adresse: </strong><?php echo $adresseEcole . " ". $cp . " " . $ville  ?> </p>
                <p><strong>Téléphone: </strong><?php echo $eco_tel_decompose ?> </p>
                <p><strong>Email: </strong><a class="link-light" href="<?php echo 'mailto:' . $eco_mail ?>"><?php echo $eco_mail ?> </a></p>
            </div>
            <div class="col">
                <p><strong>Année scolaire: </strong> 2021/22</p>
                <p><strong>Dernière mise à jour: </strong> 21-nov-21</p>
                <p><strong>Administrateur: </strong><?php echo $creatorName?> </p>
            </div>
        </div>
    </div>

    <?php



    if($row_cnt>=1){?>
    <div class="row text-center pb-4">
        

        <div class="col">
            <a class="btn btn-dark w-100" href="historique.php?id=<?php echo $ecoId ?>"><i class="bi bi-clock-history"></i> Historique des modifications</a>
        </div>
            
        <div class="col">
            <a class="btn btn-dark w-100" href="modification_ecole.php?id=<?php echo $ecoId ?>"><i class="bi bi-pencil-fill"></i> Modifier l'école</a>
        </div>

        <div class="col">
            <a class="btn btn-dark w-100" href="ajouter_classe.php?id=<?php echo $ecoId ?>"><i class="bi bi-plus-circle"></i> Ajouter une classe</a>
        </div>
            
        <?php
            if($creatorId == $idSession){?>
            <div class="col">
                <a class="btn btn-dark w-100" href="droits.php?id=<?php echo $ecoId ?>"> <i class="bi bi-people-fill"></i> Gérer les droits</a>
            </div>
                <?php
            }?>
    </div>
    <?php
    }
    ?>

        <div class="tableau bg-dark ">

            <table class=" table text-center">
                <tr id="case-sombre">
                    <td>Niveau(x)</td>
                    <td>Professeur</td>
                    <td>Effectifs</td>
                    <td></td>
                </tr>

                <?php 
                foreach($recipes as $recipe){
                    $listeNomProf[] = $recipe['cl_idNiveau'] . " de " . $recipe['cl_civilite'] . " ". $recipe['cl_nomProf'];
                    $listeEffectif[] = $recipe['cl_effectif'];
                    $listClasses[] = $recipe['cl_idNiveau'];  ?>
                <tr>
                    <td><?php echo $recipe['cl_idNiveau']?></td>
                    <td><?php echo $recipe['cl_civilite'] . " " . $recipe['cl_nomProf']?></td>
                    <td><?php echo $recipe['cl_effectif']?></td>
                    <?php
                    if($row_cnt>0){?>
                        <td><a class="link-dark" href="supprimer_classe.php?idClasse=<?php echo $recipe['cl_id']?>&id=<?php echo $ecoId?>"><i class="bi bi-trash-fill"></i></a></td>
                    <?php
                    }
                    else{?>
                        <td>&nbsp</td><?php
                    }
                    ?>
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

                <!-- Génération d'un graphique représentant les effectifs de chaque écoles.-->

        <div style='position: relative;  margin-top:30px; margin-bottom:30px;'>
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
                labels: [<?php foreach($listeNomProf as $prof){
                    echo '"'. $prof . '",';
                }  ?>] ,
                datasets: [{
                    label: 'effectifs des classes',
                    data: [<?php foreach($listeEffectif as $effectif){
                        echo '"'. $effectif . '",';
                    }
                    ?>],
                    backgroundColor: [
                            <?php foreach($listClasses as $classe)
                            {
                                switch($classe)
                                {
                                    case "CP":
                                        ?>
                                        'rgba(23, 99, 132, 0.2)',
                                        <?php
                                    break;
                                    case "CP/CE1":
                                        ?>
                                        'rgba(54, 162, 235, 0.2)',
                                        <?php
                                    break;
                                    case "CE1":
                                        ?>
                                        'rgba(255, 206, 86, 0.2)',
                                        <?php
                                    break;
                                    case "CE1/CE2":
                                        ?>
                                        'rgba(75, 192, 192, 0.2)',
                                        <?php
                                    break;
                                    case "CE2":
                                        ?>
                                        'rgba(153, 102, 255, 0.2)',
                                        <?php
                                    break;
                                    case "CE2/CM1":
                                        ?>
                                        'rgba(255, 159, 64, 0.2)',
                                        <?php
                                    break;
                                    case "CM1":
                                        ?>
                                        'rgba(204, 63, 63, 0.2)',
                                        <?php
                                    break;
                                    case "CM1/CM2":
                                        ?>
                                        'rgba(140, 66, 16, 0.2)',
                                        <?php
                                    break;
                                    case "CM2":
                                        ?>
                                        'rgba(47, 103, 25, 0.2)',
                                        <?php
                                    break;
                                }
                            }
                        
                            ?>
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: 'rgb(000, 000, 000)',
                        }
                    }
                },
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>

    </div>


   







    
</body>


</html>

