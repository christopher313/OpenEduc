<?php

//INITIALISATION DE LA PAGE
include("php/database.php");
session_start();

?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/Copie de OPEN.png">
    <title>OpenEduc</title>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="#"><img src="./img/Copie de OPEN.png" alt="logo OpenEduc" id="img_menu"></a></li>
                <li><a href="#">Cours</a></li>
                <li><a href="#">Infos</a></li>
                <li><a href="#">Inscription</a></li>
                <?php
                if(isset($_SESSION['user'])){?>
                    <li><a href="php/deconnexion.php">Deconnexion</a></li><?php
                }
                else{?>
                    <li><a href="php/connexion.php">Connexion</a></li><?php
                }
                ?>
            </ul>
        </nav>
    </header>
    <div class="page_container">
        <div class="block_container">
            <h1 style="text-align:center;">Bienvenue sur la plateforme en ligne OpenEduc<h1>
        </div>
        <div class="container_accueil">
            <img src="./img/OPEN2" alt="logo OpenEduc" id="img_accueil">
            <button onclick="window.location.href = 'deconnexion.php';">Decouvrir plus</button>
        </div>
    </div>
</body>
</html>