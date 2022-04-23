<?php

require "navmenu.php";



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paramètres du compte</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/script.js"></script>
</head>
<body>

    
    <div class="container py-5">
        <h1 class="text-center">Paramètres du compte</h1>

        <div class="row">

        <div class="col-3"></div>

        <div class="col-6">

        <form class="d-flex flex-column" method="post" action="changer_mdp_traitement.php">

            <div class="form-group">
                <label for="nom" class="form-label">Nom d'utilisateur</label>
                <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom d'utilisateur" value="<?php echo $_SESSION['user'] ?>" disabled>
            </div>

            <div class="form-group">
                <label for="mdp" class="form-label">Changer votre mot de passe</label>
                <input type="password" id="mdp" name="mdp" class="form-control" placeholder="Nouveau mot de passe">
            </div>

            <div class="form-group">
                <label for="mdp2" class="form-label">Retapez votre nouveau mot de passe</label>
                <input type="password" id="mdp2" name="mdp2" class="form-control" placeholder="Retapez le nouveau mot de passe" onKeyUp="checkPassword()">
            </div>

            <div class="text-danger mt-3"id="div_mdp" hidden>
                <span id="text_mdp">Les 2 mots de passes ne correspondent pas</span>
            </div>

            <input type="submit" value="Envoyer" id="btn" class="btn btn-dark mt-2" disabled>

            </form>

        </div>

        <div class="col-3"></div>


        </div>

        

    </div>
    
</body>
</html>