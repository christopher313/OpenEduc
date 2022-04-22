
<?php

//PAGE FORMULAIRE POUR AJOUTER L ECOLE

//INITIALISATION DE LA PAGE

require "navmenu.php";

$idSession = $_SESSION['idUser'];

if(isset($idSession)){

    ?>

    <!DOCTYPE html>
    <html lang="FR">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>OpenEduc - Connexion </title>
    </head>
    <body>

    <div class="container text-center py-5">
        <h1>Ajouter une école</h1>

        <form action="ajouter_ecole_traitement.php" method="post" class="d-flex flex-column">
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Nom de l'école" name="school_name" required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Référence" name="school_ref"required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Adresse" name="school_adresse"required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="number" placeholder="Code Postal" name="school_cp"required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="text" placeholder="Ville" name="school_city"required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="mail" placeholder="Mail" name="school_mail"required></label>
            <label style="font-size: 1.5em; color: red">*<input class="champ" type="tel" placeholder="Numéro de téléphone" name="school_number"required></label>
            <label style="text-align: left; font-size: 0.8em; margin-bottom: 15px;">Les champs avec un astérique, sont des champs obligatoires.</label>
            <input class="btn btn-dark" type="submit" value="Ajouter" name="bouton_envoie">
                
        </form>

    </div>

    



        
    </body>
    </html>

    <?php
}
else{
    header('location:accueil.php');
}
?>