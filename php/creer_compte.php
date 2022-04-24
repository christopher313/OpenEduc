<?php

    require "navmenu.php";

    if($_SESSION['role'] == 1){?>

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>

        <div class="container text-center py-5">
            <h1>Créer un compte utilisateur</h1>

            <div class="row">

            <div class="col-3"></div>

            <div class="col-6">

                <form class="d-flex flex-column text-start" action="creer_compte_traitement.php" method="post">
                    <div class="form-group">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" name="username" id="username" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="mdp" class="form-label">Mot de passe</label>
                        <input type="password" name="mdp" id="mdp" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="admin" class="form-label">Compte super-administrateur</label>
                        <input type="checkbox" name="admin" id="admin" class="form-checkbox">
                    </div>

                    <input type="submit" value="Créer" name="submit" class="btn btn-dark">

                </form>

            </div>

            <div class="col-3"></div>


            </div>

            
        </div>
        
        
        
    </body>
    </html>



    <?php
    }
    

    else{
        header('location: accueil.php');
    }


?>
