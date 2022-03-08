<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();
require "navmenu.php";




?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - DASHBOARD </title>
</head>
<body>

<h1 class="title-h1">DASHBOARD ADMINISTRATEUR - OPENEDUC</h1>

<div class="page_container">
    <div class="line_column">
        <div class="column">
            <div class="item-column">

                <h2>MES ECOLES</h2>
                <ul>
                    <li>Ecole 1</li>
                    <li>Ecole 2</li>
                    <li>Ecole 3</li>
                </ul>
            </div>
            <div class="item-button-column">
                <a>+</a>
            </div>
        </div>
        <div class="column">

        </div>
    </div>
</div>







<?php

if($_SESSION['role'] == 1){?>
    <button id="add-button" onclick="window.location.href = 'ajouter_ecole.php';"><ion-icon name="add-circle-sharp"></ion-icon></button><?php
}


?>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>




