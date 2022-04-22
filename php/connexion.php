<?php

//PAGE FORMULAIRE DE CONNEXION

//INITIALISATION DE LA PAGE

require "navmenu.php";

?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>OpenEduc - Connexion </title>
</head>
<body class="bg-light">



    <div class="container py-5 text-center">

        <h1>Connexion</h1>

        <img src="../img/open-t-n.png" alt="logoopen" style="height:250px">

    
        <div class="row">

            <div class="col-3">
                
            </div>

            <div class="col-6">

                <form action="" method="post" class="d-flex flex-column">
                    <div class="mb-3">
                        <input class="form-control text-center" type="text" placeholder="Nom d'utilisateur" name="username" style="font-size: 22px;">
                    </div>
                    <div class="mb-3">
                        <input class="form-control text-center h6" type="password" placeholder="Mot de passe" name="password" style="font-size: 22px;">
                    </div>
                    <input class="btn btn-dark p-3" type="submit" value="Se connecter" name="bouton_envoie">
                </form>

            </div>

            <div class="col-3">

            </div>


        </div>
            


        <?php 

        //SI UTILISATEUR DEJA CONNECTE REDIRIGER VERS ...
        if(isset($_SESSION['user'])){
            header("location:../accueil.php");
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