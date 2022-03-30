<?php

//BARRE DE NAVIGATION

//INITIALISATION DE LA PAGE
include("database.php");

?>

<!DOCTYPE html>
<html>
<head>
<style>

    .menu-li{
        font: small-caps bold 18px/1 sans-serif;
    }


.menu-nav{
    display: flex;
    background-color: black;
    flex-direction: row;
    justify-content: flex-end;
}

.menu-ul{
    display: flex;
    flex-direction: row-reverse;
    margin-right: 1px;
    list-style-type: none;
    
}

.menu-li{
    vertical-align: middle;

    
}

.menu-btn{
    display: block;
    border: 2px solid black;
    width: 150px;
    height: 50px;
    text-align:center;
    color: white;
    text-decoration: none;
    padding-top: 30px;

}

.menu-btn:hover{
  background-color: #272323 ;
  border-radius: 15px;
  transition: 0.5s;
}

.img_ico{
    position: absolute;
    top: 0 px;
    left: 0px;

    width: 80px;

}






</style>
<link rel="icon" type="image/png" sizes="16x16" href="../img/OPEN2.png">

</head>
<body>

<nav class="menu-nav">
    <a href="accueil.php"><img class="img_ico" src="../img/Copie de OPEN.png"></a>
    <ul class="menu-ul">
    <?php
    if(isset($_SESSION['user'])){?>
        <li class="menu-li"><a class="menu-btn" style="display:flex; justify-content:center; " href="dashboard.php"><?php echo $_SESSION['user'] ?><ion-icon style="  width:20px; height:20px" name="person-circle-sharp"></ion-icon>
</a></li>
        <li class="menu-li"><a class="menu-btn" href="deconnexion.php">Deconnexion</a></li><?php
    }
    else{?>
        <li class="menu-li"><a class="menu-btn" href="connexion.php">Connexion</a></li><?php
    }
    ?>
    <li class="menu-li"><a class="menu-btn" href="ecoles.php">Les écoles</a></li>
    <li class="menu-li"><a class="menu-btn" href="about.php">A propos</a></li>
    <li class="menu-li"><a class="menu-btn" href="accueil.php">Accueil</a></li>
    </ul>
</nav>


<br/><br/><br/>



<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
</header>