<?php

try{
    $db = new PDO('mysql:host=127.0.0.1;dbname=bdd_openeduc;charset=utf8', "root", "" );
}
catch(Exception $e){
    die ("Erreur de connexion au serveur : ".$e->getCode());
}

?>