<?php

//PAGE FORMULAIRE DE CONNEXION

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
    <title>OpenEduc - Connexion </title>
</head>
<body>
    <div class="page_container">


        <h1 class="title-h1">Connexion</h1>
        <br>
        <div class="content_connect">
        <img id="ico" src="../img/OPEN2.png">
        <form action="" method="post" class="formulaire_connexion">
            <input class="champ" type="text" placeholder="Nom d'utilisateur ou email" name="username">
            <input class="champ" type="password" placeholder="Mot de passe" name="password">
            <input class="button" type="submit" value="Se connecter" name="bouton_envoie">
        </form>
        </div>

        <?php 

        //SI UTILISATEUR DEJA CONNECTE REDIRIGER VERS ...
        if(isset($_SESSION['user'])){
            header("location:../index.php");
        }

        //SI NOM UTILISATEUR RENSEIGNÉ FAIRE (PERMET D EVITER MESSAGE BUG PHP)
        if(isset($_POST["username"])){

            // VARIABLES
            $user = $_POST["username"];
            $password = $_POST['password'];

            //REQUETE SQL POUR RECHERCHER SI LE NOM D UTILISATEUR ET MOT DE PASSE RENSEIGNE EXISTE ET CORRESPONDENT
            $sql = "SELECT * FROM `compte` WHERE `ct_username`= '$user' AND `ct_password`= '$password'";
            $recipesStatement = $db->prepare($sql);
            $recipesStatement->execute();
            $donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

            //SI USER ET MDP SONT JUSTE ALORS
            $row_cnt = $recipesStatement->rowCount();
            if($row_cnt == 1){
                session_start();
                $_SESSION['idUser'] = $donnees['ct_id'];
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $donnees['ct_role'];
                header('location: dashboard.php');
            }
            //SINON
            else{
                printf("Compte inexistant");
            }
        }

        ?>

   
    </div>


    
</body>
</html>