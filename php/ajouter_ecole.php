
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
        
        <div class="row">
            <div class="col-3">

            </div>

            <div class="col-6">

                <form action="ajouter_ecole_traitement.php" method="post" class="d-flex flex-column text-start">

                    <div class="form-group">
                            <label for="nom" class="form-label">Nom de l'école: </label>
                            <input class="form-control" id="nom" type="text" placeholder="Nom de l'école" name="school_name" required>
                        </div>

                        <div class="form-group">
                            <label for="ref" class="form-label">Référence: </label>
                            <input class="form-control" type="text" placeholder="Référence" name="school_ref" required>
                        </div>

                        <div class="form-group">
                            <label for="adresse" class="form-label">Adresse: </label>
                            <input class="form-control" type="text" placeholder="Adresse" name="school_adresse" required>
                        </div>

                        <div class="form-group">
                            <label for="cp" class="form-label">Code Postal: </label>
                            <input class="form-control" type="number" placeholder="Code Postal" name="school_cp" required>
                        </div>

                        <div class="form-group">
                            <label for="ville" class="form-label">Ville: </label>
                            <input class="form-control" type="text" placeholder="Ville" name="school_city" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email: </label>
                            <input class="form-control" type="mail" placeholder="Mail" name="school_mail" required>
                        </div>


                        <div class="form-group">
                            <label for="tel" class="form-label">Tél: </label>
                            <input class="form-control" type="tel" placeholder="Numéro de téléphone" name="school_number" required>
                        </div>

                        <label style="text-align: left; font-size: 0.8em; margin-bottom: 15px;">Les champs avec un astérique, sont des champs obligatoires.</label>
                        <input class="btn btn-dark" type="submit" value="Ajouter" name="bouton_envoie">

                </form>

            </div>

            <div class="col-3">

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