<?php

//BARRE DE NAVIGATION

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
date_default_timezone_set('Europe/Paris');



?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>

    <nav class="navbar navbar-expand bg-dark navbar-dark text-white">
        <div class="container">
            <a href="accueil.php"><img src="../img/opn-large-23.png" alt="OpenLogo" style="height: 50px"></a>

            <form action="recherche_ecole.php" method="get" class="d-flex">
                <input type="search" placeholder="Ecrire ici..." name="search-bar" class="form-control me-2"/>
                <input type="submit" value="Rechercher" name="search-button" class="button"/>
            </form>

            <ul class="navbar-nav h6">
                <li class="nav-item active">
                    <a class="nav-link" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">A propos</a>
                </li>

            



            <?php

            if(isset($_SESSION['user'])){?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false"><?php echo $_SESSION['user'] . " " ?><i class="bi bi-person-circle"></i></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="dashboard.php"><i class="bi bi-clipboard-data-fill"></i> Dashboard</a></li>
                    <li><a class="dropdown-item" href="#"><i class="bi bi-gear-fill"></i> Paramètres du compte</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="deconnexion.php"><i class="bi bi-box-arrow-right"></i> Se déconnecter</a></li>
                </ul>
            </li>
            <?php

            }

            else{?>
                <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion</a>
                </li><?php
            }?>



                
            </ul>

            
    </div>
    </nav>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>

