
<?php

//INITIALISATION DE LA PAGE

//INITIALISATION 
include("database.php");
session_start();
require "navmenu.php";


//SI L'UTILISATEUR EST DE NIVEAU 1 OU 2: AFFICHER LA PAGE DE FORMULAIRE POUR L'AJOUT D'UNE PAGE
if($_SESSION['role'] == 1 || 2){?>

    <?php
    }
    else{
        header("location:index.php");
    }

//VARIABLES
$ref = $_GET['id'];
$sql = "SELECT * FROM `ecole` WHERE `eco_ref`= '$ref'";
$recipesStatement = $db->prepare($sql);
$recipesStatement->execute();
$donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);
$idEcole = $donnees['eco_id'];

    
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Ajouter une classe </title>
</head>
<body>
    <h1 class="title-h1">Ajouter une classe pour <?php echo $donnees['eco_nom'] ?></h1>

    <div class="page_container">
        <form action="ajouter_classe_traitement.php?id=<?php echo $ref?>" method="post" class="formulaire_connexion">
            <div class="check-form">
            <label for="nameclasses">Choisir un niveau de classe:</label>
                <select name="classes">
                    <option value="">--Choisisez un niveau--</option>
                    <option value="CP">CP</option>
                    <option value="CP/CE1">CP/CE1</option>
                    <option value="CE1">CE1</option>
                    <option value="CE1/CE2">CE1/CE2</option>
                    <option value="CE2">CE2</option>
                    <option value="CE2/CM1">CE2/CM1</option>
                    <option value="CM1">CM1</option>
                    <option value="CM1/CM2">CM1/CM2</option>
                    <option value="CM2">CM2</option>
                </select>
            </div>
            <br/>
            <div class="radio_civilite">
                <input type="radio" name="civilite" value="M">
                <label for="M">M</label>
                <input type="radio" name="civilite" value="Mme">
                <label for="M">Mme</label>
            </div>
            <input class="champ" type="text" placeholder="Nom du professeur" name="nom_prof">
            <input class="champ" type="number" placeholder="Effectif" name="effectif">
            <input class="champ" type="HIDDEN" value="<?php echo $idEcole ?>" name="idEcole" >
            <input class="button" type="submit" value="Ajouter" name="bouton_envoie">
        </form>



    </div>




    
</body>
</html>
