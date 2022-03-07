<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();

if($_SESSION['role'] == 1){?>

<?php
}
else{
    header("location:../index.php");
}


?>