<?php

require "navmenu.php";

if($_SESSION['role'] == 1){


    $nom = $_POST['username'];
    $mdp = $_POST['mdp'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    if($admin == true){
        $admin = 1;
    }
    else{
        $admin = 2;
    }

    $sql = "INSERT INTO `compte`(`ct_username`, `ct_password`, `ct_mail`, `ct_role`) VALUES ( :username, :passwd, :email, :usr_role)";
    $res = $db->prepare($sql);
    $exec = $res->execute(array(":username"=>$nom, ":passwd"=>$mdp, ":email"=>$email, ":usr_role"=>$admin));
    ?>
    <script>confirm("Compte créer avec succès !");</script>
    <?php
    header('location: dashboard.php');


}
else{?>
    <script>alert("Erreur lors de la création du compte");</script>
    <?php
    header('location: accueil.php');
}


?>

