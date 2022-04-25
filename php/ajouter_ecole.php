
<?php

//PAGE FORMULAIRE POUR AJOUTER L ECOLE

//INITIALISATION DE LA PAGE

require "navmenu.php";

$idSession = $_SESSION['idUser'];

if(isset($idSession)){

    ?>

    <!DOCTYPE html>
    <html lang="FR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OpenEduc - Connexion </title>
        <link rel="stylesheet" href="../css/style.css">
        <script type="text/javascript" src="../js/script.js"></script>
    </head>
    <body>

    <div class="container text-center py-5">
        <h1>Ajouter une école</h1>
        
        <div class="row">
            <div class="col-3">

            </div>

            <div class="col-6">

                <form action="ajouter_ecole_traitement.php" method="post" class="d-flex flex-column text-start">

                    <div class="form-group">
                            <label for="nom" class="form-label">Nom de l'école: </label>
                            <input class="form-control" id="nom" type="text" placeholder="Nom de l'école" name="school_name" required>
                        </div>

                        <div class="form-group">
                            <label for="ref" class="form-label">Référence: </label>
                            <input class="form-control" type="text" placeholder="Référence" name="school_ref" required>
                        </div>

                        <div class="form-group">
                            <label for="adresse" class="form-label">Adresse: </label>
                            <input class="form-control" type="text" placeholder="Adresse" name="school_adresse" required>
                        </div>

                        <div class="form-group">
                            <label for="cp" class="form-label">Code Postal: </label>
                            <input class="form-control" type="number" placeholder="Code Postal" name="school_cp" required>
                        </div>

                        <div class="form-group">
                            <label for="ville" class="form-label">Ville: </label>
                            <input class="form-control" type="text" placeholder="Ville" name="school_city" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email: </label>
                            <input class="form-control" type="mail" placeholder="Mail" name="school_mail" required>
                        </div>


                        <div class="form-group">
                            <label for="tel" class="form-label">Tél: </label>
                            <input class="form-control" type="tel" placeholder="Numéro de téléphone" name="school_number" required>
                        </div>

                        <div>
                            <a class="btn btn-dark m-3 " id="btn-apea" value="Référent APEA" onClick="derouleDiv('apea')" >Ajouter référent APEA<a>
                            <a class="btn btn-dark m-3 " id="btn-mairie" onClick="derouleDiv('mairie')" >Ajouter correspondant local Mairie<a>
                        </div>

                        
                        
                        <div id="apea" class="form-control my-3" hidden>
                            <div class="form-group">    
                                <h3>Référent APEA</h3>
                                <label for="civiliteAPEA">Civilité</label>
                                <br>
                                <input type="radio" name="civiliteAPEA" value="Monsieur">
                                <label for="Monsieur">Monsieur</label> 
                                <input type="radio" name="civiliteAPEA" value="Madame"> 
                                <label for="Madame">Madame</label>
                            </div>

                            <div class="form-group">
                                <label for="pnomAPEA" class="form-label">Prénom: </label>
                                <input class="form-control" type="text" placeholder="Prénom" name="pnomAPEA">
                            </div>

                            <div class="form-group">
                                <label for="nomAPEA" class="form-label">Nom: </label>
                                <input class="form-control" type="text" placeholder="Nom" name="nomAPEA">
                            </div>

                            <div class="form-group">
                                <label for="mailAPEA" class="form-label">Email: </label>
                                <input class="form-control" type="text" placeholder="Email" name="mailAPEA">
                            </div>

                        </div>
                        


                        <div class="form-control" id="mairie" hidden>


                            <h3>Correspondant local mairie</h3>
                            <div class="form-group">    
                                <label for="civiliteCrs">Civilité</label>
                                <br>
                                <input type="radio" name="civiliteCrs" value="Monsieur">
                                <label for="Monsieur">Monsieur</label> 
                                <input type="radio" name="civiliteCrs" value="Madame"> 
                                <label for="Madame">Madame</label>
                            </div>

                            <div class="form-group">
                                <label for="pnomCrs" class="form-label">Prénom : </label>
                                <input class="form-control" type="text" placeholder="Prénom" name="pnomCrs">
                            </div>

                            <div class="form-group">
                                <label for="nomCrs" class="form-label">Nom : </label>
                                <input class="form-control" type="text" placeholder="Nom" name="nomCrs">
                            </div>

                            <div class="form-group">
                                <label for="mailCrs" class="form-label">Email : </label>
                                <input class="form-control" type="text" placeholder="Email" name="mailCrs">
                            </div>

                            <div class="form-group">
                                <label for="posteCrs" class="form-label">Poste : </label>
                                <input class="form-control" type="text" placeholder="Poste" name="posteCrs">
                            </div>

                            <div class="form-group">
                                <label for="telCrs" class="form-label">Tél : </label>
                                <input class="form-control" type="text" placeholder="Téléphone" name="telCrs">
                            </div>

                        </div>

                        <div class="form-group ">
                            <input class="btn btn-dark w-100" type="submit" value="Ajouter" name="bouton_envoie">
                        </div>

                        

                </form>

            </div>

            <div class="col-3">

            </div>
        </div>

        

    </div>

    <footer>
    
    <?php

    require 'footer.php'

    ?>
</footer>



        
    </body>
    </html>

    <?php
}
else{
    header('location:accueil.php');
}
?>