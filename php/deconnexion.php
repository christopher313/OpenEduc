<?php

//PAGE PERMETTANT DE SE DECONNECTER ET DE SE REDIRIGER VERS L'ACCUEIL

session_start();
session_destroy();
header('location: accueil.php');


?>