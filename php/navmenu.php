<?php

//INITIALISATION DE LA PAGE
include("../php/database.php");

?>

<!DOCTYPE html>
<html>
<head>
<style>


nav{
    display: flex;
    background-color: black;
    flex-direction: row;
    justify-content: flex-end;
}

ul{
    display: flex;
    flex-direction: row-reverse;
    margin-right: 1px;
    list-style-type: none;
    
}

li{
    vertical-align: middle;

    
}

li a{
    display: block;
    border: 2px solid black;
    width: 150px;
    height: 50px;
    align-items: center;
    text-align: center;
    color: white;
    text-decoration: none;
    padding-top: 30px;

}

li a:hover{
  background-color: #272323 ;
  border-radius: 15px;

}

img{
    position: absolute;
    top: 0 px;
    left: 0px;

    width: 80px;

}




</style>
</head>
<body>

<nav>
    <a href="index.php"><img src="../img/Copie de OPEN.png"></a>
    <ul>
    <?php
    if(isset($_SESSION['user'])){?>
        <li><a href="dashboard.php"><?php echo $_SESSION['user'] ?><ion-icon name="person-circle-sharp"></ion-icon>
</a></li>
        <li><a href="deconnexion.php">Deconnexion</a></li><?php
    }
    else{?>
        <li><a href="connexion.php">Connexion</a></li><?php
    }
    ?>
    <li><a href="ecoles.php">Les écoles</a></li>
    <li><a href="apropos.php">A propos</a></li>
    <li><a href="index.php">Accueil</a></li>
    </ul>
</nav>


<br/><br/><br/>



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
</header>