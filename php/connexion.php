<?php

//INITIALISATION DE LA PAGE
include("database.php");
session_start();

?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>OpenEduc - Connexion </title>
</head>
<body>
    <div class="page_container">

        <form action="" method="post">
            <input type="text" placeholder="Nom d'utilisateur" name="username">
            <input type="password" placeholder="password" name="password">
            <input type="submit" value="Envoyer" name="bouton_envoie">
        </form>

        <?php 

        if(isset($_SESSION['user'])){
            header("location:../index.php");
        }

        if(isset($_POST["username"])){

            // VARIABLES
            $user = $_POST["username"];
            $password = $_POST['password'];

            //REQUETE SQL
            $sql = "SELECT * FROM `compte` WHERE `ct_username`= '$user' AND `ct_password`= '$password'";
            $recipesStatement = $db->prepare($sql);
            $recipesStatement->execute();
            $donnees = $recipesStatement->fetch(PDO::FETCH_ASSOC);

            //SI USER ET MDP SONT JUSTE ALORS
            $row_cnt = $recipesStatement->rowCount();
            if($row_cnt == 1){
                session_start();
                $_SESSION['user'] = $user;
                $_SESSION['role'] = $donnees['ct_role'];
                header('location: dashboard.php');
            }
            else{
                printf("Compte inexistant");
            }
        }

        ?>

   
    </div>


    
</body>
</html>