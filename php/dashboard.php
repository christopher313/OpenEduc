<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();

//MESSAGE DE BIENVENU
echo "Bonjour ". $_SESSION['user'];


?>

<button onclick="window.location.href = 'deconnexion.php';">Se deconnecter</button>


<?php


if($_SESSION['role'] == 1){?>
    <button onclick="window.location.href = 'ajouter_ecole.php';">Ajouter une école</button><?php
}


?>


