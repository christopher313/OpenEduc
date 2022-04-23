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

            <form action=""></form>
        </div>
        
        
        
    </body>
    </html>



    <?php
    }
    

    else{
        header('location: accueil.php');
    }


?>
