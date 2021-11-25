<?php
// Initialiser ma session
session_start();
// Inclure le footer
require ('fonctions.php');
// SE CONNECTER A LA BASE DE DONNEE
$bdd = mysqli_connect("localhost", "sonia-mouhoubi", "Coursonia7", "sonia-mouhoubi_moduleconnexion");
if(isset($_POST["deconnect"])) {
    unset($_SESSION["id"]);
    unset($_SESSION['prenom']);
    unset($_SESSION['login']);
    // header('refresh:0');
    header('Location: accueil.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Babyville, la créche des tous petits.</title>
        <meta name="description" content="Babyville est une micro-créche qui à pour but emensis 
        itaque difficultatibus multis et nive obrutis callibus plurimis ubi prope Rauracum ventum."/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Crafty+Girls&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Puppies+Play&display=swap" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">
    </head>
    <body>
        <header class="header">
            <nav>
                <?php if(nestpasconnect()) { ?>
                <a class="logo" href="accueil.php">BabyVille</a>
                <a href="inscription.php">Inscription</a>
                <a href="connexion.php">Connexion</a>
                <?php } 

                if(estconnect()) { ?>
                <a class="logo" href="accueil.php">BabyVille</a>
                <a href="profil.php">Profil</a>
                <?php }?>  

                <?php if (estadmin()) { ?>
                <a href="admin.php">Administration</a>
                <?php } ?>    
            </nav>
            <?php if(isset($_SESSION['prenom'])) { ?> 
                <form action="#" method="post">
                    <input type="submit" id="deconnect" name="deconnect" value="Déconnexion">
                </form> <?php } ?>
        </header>  