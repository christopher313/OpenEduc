<?php

//PAGE PERMETTANT DE SE DECONNECTER ET DE SE REDIRIGER VERS L'ACCUEIL

require "navmenu.php";
session_destroy();
header('location: accueil.php');


?>