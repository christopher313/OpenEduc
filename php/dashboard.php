<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";

//MESSAGE DE BIENVENU
echo "Bonjour ". $_SESSION['user'];


?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Connexion </title>
</head>
<body>

<button onclick="window.location.href = 'deconnexion.php';">Se deconnecter</button>

<?php

if($_SESSION['role'] == 1){?>
    <button onclick="window.location.href = 'ajouter_ecole.php';">Ajouter une école</button><?php
}


?>



    
</body>
</html>




