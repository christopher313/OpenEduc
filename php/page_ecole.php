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

$sql = "SELECT * FROM `ecole` INNER JOIN `droits` ON droits.dr_ecoId=ecole.eco_id LEFT JOIN correspondant_mairie ON correspondant_mairie.cm_idEcole=ecole.eco_id  LEFT JOIN correspondant_apea ON correspondant_apea.ca_ecoId=ecole.eco_id WHERE `eco_id`= $ecoId";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$annee = "2021-2022";

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
$civiliteAPEA = $donnees['ca_civilite'];
$prenomAPEA = $donnees['ca_prenom'];
$nomAPEA = $donnees["ca_nom"];
$mailAPEA = $donnees['ca_mail'];

$civiliteCrs = $donnees['cm_civilite'];
$pnomCrs = $donnees['cm_prenom'];
$nomCrs = $donnees['cm_nom'];
$posteCrs = $donnees['cm_poste'];
$telCrs = $donnees['cm_tel'];
$mailCrs = $donnees['cm_mail'];

if(isset($_GET['annee'])){
    $annee = $_GET['annee'];
}


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


//REQUETE SQL POUR RECUPERE DATE DE DERNIERE MODIFCATION

$sql4 =  "SELECT DATE_FORMAT(mdf_date, '%d/%m/%y à %k:%i:%s' ) as date FROM `modifications` WHERE `mdf_idEcole` = $ecoId ORDER BY mdf_date DESC LIMIT 1;";
$recipesStatement4 = $db->prepare($sql4);
$recipesStatement4->execute();
$donnees4 = $recipesStatement4->fetch(PDO::FETCH_ASSOC);
$dateModif = $donnees4['date'];



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
$sql = "SELECT * FROM `classe` WHERE `cl_idEcole`='$ecoId' AND `cl_annee` = '$annee'";
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
    <script src="../js/script.js"></script>
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
                <p><strong>Année scolaire: </strong> <?php echo $annee ?></p>
                <p><strong>Dernière mise à jour: </strong> <?php echo $dateModif ?></p>
                <p><strong>Administrateur: </strong><?php echo $creatorName?> </p>
                
                <form method="get" action="page_ecole.php" class="d-flex">
                    <input type="text" name="id" id="id" value="<?php echo $ecoId ?>" hidden>
                    <select class="form-select w-25 me-1" name="annee" id="annee">
                        <option value="<?php echo $annee?>"><?php echo $annee?></option>
                        <option value="---------------" disabled>---------------</option>
                        <option value="2021-2022">2021-2022</option>
                        <option value="2020-2021">2020-2021</option>
                        <option value="2019-2020">2019-2020</option>
                        <option value="2018-2019">2018-2019</option>
                        <option value="2017-2018">2017-2018</option>
                    </select>
                    <input type="submit" class="btn btn-light" value="OK">
                </form>

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

        <!-- Referent APEA -->
        <?php
        if($nomAPEA == "" ){?>

            

        <?php
        }
        else{?>
           <h2>Référent APEA</h2>
            <div class="tableau ">
                <table class="table text-center">

                    <tr id="case-sombre">
                        <td>Nom</td>
                        <td>Mail</td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $civiliteAPEA . " " . $prenomAPEA . " " . $nomAPEA ?></td>
                        <td><a href="mailto:<?php echo $mailAPEA?>"><?php echo $mailAPEA ?></a></td>
                    </tr>
                <table>

                <br>

            </div>
        <?php
        }
        ?>

        <!-- Correspondant mairie -->

        <?php
        if(($pnomCrs == "") && ($nomCrs == "") ){?>

            

        <?php
        }
        else{?>
           <h2>Correspondant Local Mairie</h2>
            <div class="tableau ">
                <table class="table text-center">

                    <tr id="case-sombre">
                        <td>Nom</td>
                        <td>Poste</td>
                        <td>Tel</td>
                        <td>Email</td>
                    </tr>
                    
                    <tr>
                        <td><?php echo $civiliteCrs . " " . $pnomCrs . " " . $nomCrs ?></td>
                        <td><?php echo $posteCrs ?></td>
                        <td><?php echo $telCrs ?></td>
                        <td><a href="mailto:<?php echo $mailCrs?>"><?php echo $mailCrs ?></a></td>
                    </tr>
                <table>

                <br>

            </div>
        <?php
        }
        ?>


        <h2>Tableau des effectifs</h2>
        <div class="tableau bg-dark ">
            

            <table class=" table text-center">
                <tr id="case-sombre">
                    <td>Niveau(x)</td>
                    <td>Professeur</td>
                    <td>Effectifs</td>
                    <td>&nbsp</td>
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
                    <td>&nbsp</td>
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
                    <td id="case-exception"><?php echo number_format($moyenneEffectif, 2) ?></td>
                    <td>&nbsp</td>
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


   
    <footer>
    
    <?php

    require 'footer.php'

    ?>
</footer>






    
</body>


</html>

