<?php 
require ('header.php');  
// Initialisation message erreur
$erreur_login = "";
$erreur_prenom = "";
$erreur_nom = "";
$erreur_mdp = "";
$erreur_mdp2 = "";
$modif = "";
// Si la session est ouverte 
if(isset($_SESSION["id"])) {
    $session_id = $_SESSION["id"]; // Création d'une var pour la SESSION ID pour éviter la concaténation.
    // On récupère le login qui est identique à celui de la session connectée. 
    $req_profil = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE Id = '$session_id'");
    // Et on récupére le résultat de la requète $req_profil.
    $resultat = mysqli_fetch_all($req_profil, MYSQLI_ASSOC);   
    // Si le bouton est cliquer
    if(isset($_POST["modifier"])) { 
        $login = $_POST["login"];
        $firstname = $_POST["firstname"];
        $surname = $_POST["surname"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];
        // Si les champs sont remplis
        if(isset($login) && isset($firstname) && isset($surname) && isset($password)) { 
            // Si le champ login est vide, 
            if(empty($login)) { 
                $erreur_login = "Le champ 'login' est vide.";
            }
            // Sinon si le champ prenom est vide, 
            elseif(empty($firstname)) {
                $erreur_prenom = "Le champ 'prenom' est vide.";
            }
            // Sinon si le champ nom est vide, 
            elseif(empty($surname)) {
                $erreur_nom = "Le champ 'nom' est vide.";
            }
            // Sinon si le champ password est vide, 
            elseif(empty($password)) {
                $erreur_mdp = "Le champ 'mot de passe' est vide.";
            }
            // Sinon si le password est différent 
            elseif($password != $password2) { // Si la confirmation du mot de passe n'est pas identique
                $erreur_mdp2 = "La confirmation de mot de passe ne correspond pas.";
            } 
            else {
                 // On hache le mot de passe
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                mysqli_query($bdd, "UPDATE utilisateurs SET Login = '$login', Prenom = '$firstname', Nom = '$surname', Password = '$hashed_password' WHERE Id = $session_id");
                $modif = 'Modification réussie.';                   
            } 
        }
    }      
}
?>
        <main class="main-profil">
        <!-- Permet d'afficher le nom de l'utilisateur connecté. -->
        <?php if(isset($_SESSION['prenom'])) { ?> <p class="user-connecte">Bonjour  
        <?php echo $_SESSION['prenom']; ?>, vous êtes connecté.</p> <?php } ?>

            <h1>Profil</h1> 
            <section>
                <h2>Modifier son profil</h2>
                <p><?php echo $modif;?></p>
                <form class = "formulaire-profil" action="#" method="post">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" value="<?php echo $resultat[0]['Login']?>" placeholder="<?php echo $erreur_login;?>">

                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="firstname" value="<?php echo $resultat[0]['Prenom']?>" placeholder="<?php echo $erreur_prenom;?>">

                    <label for="surname">Nom</label>
                    <input type="text" id="surname" name="surname" value="<?php echo $resultat[0]['Nom']?>" placeholder="<?php echo $erreur_nom;?>">

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="<?php echo $erreur_mdp;?>">

                    <label for="password2">Confirmation du mot de passe</label>
                    <input type="password" id="password2" name="password2" placehoder="<?php echo $erreur_mdp2;?>">

                    <input type="submit" id="modifier" name="modifier" value = "Modifier">
                </form>
            </section>
        </main>
        <?php include('../pages/footer.php') ?>       
    </body>
</html>