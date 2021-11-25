<?php
require ('header.php'); 
$valid = true; // Variable pour verifier si les champs sont vide 
// Initialisation message erreur
$erreur_login = "";
$erreur_prenom = "";
$erreur_nom = "";
$erreur_login = "";
$erreur_mdp = "";
$erreur_mdp2 = "";
$modif = "";
// Vérifier si le formulaire a été validé
if(isset($_POST["button"])) { 
    /*Variables du formulaire */
    $login = $_POST["login"];
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $password = $_POST["password"];
    $password2 = $_POST["password2"];
// Vérifier si les champs sont remplis
    if(isset($login, $firstname, $surname, $password)) { 
        if(empty($login)) { // Si le champ login est vide, un message d'erreur est affiché
            $valid = false; // La variable de vérification est false donc le formulaire ne peut être envoyé
            $erreur_login = "Le champ 'login' est vide.";
        }
// Création de la $select pour savoir s'il y a un login de la bdd identique à un login taper par l'utilisateur 
        $select = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE Login = '$login'");
        if(mysqli_num_rows($select)) {
            $valid = false; // La vérif est fausse.
            echo "Le login existe déja.";
        }        
        elseif(empty($firstname)) {
            $valid = false;
            $erreur_prenom = "Le champ 'prenom' est vide.";
        }
        elseif(empty($surname)) {
            $valid = false;
            $erreur_nom = "Le champ 'nom' est vide.";
        }
        elseif(empty($password)) {
            $valid = false;
            $erreur_mdp = "Le champ 'mot de passe' est vide.";
        }
        elseif($password != $password2) { // Si la confirmation du mot de passe n'est pas identique
            $valid = false; // La vérif est fausse.
            $erreur_mdp2 = "La confirmation de mot de passe ne correspond pas.";
        } 
        else { // Sinon on hache le mot de passe... 
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            // ..et on insert les données de l'utilisateur dans la bdd.
            mysqli_query($bdd, "INSERT INTO `utilisateurs`(`Login`, `Prenom`, `Nom`, `Password`) VALUES ('$login','$firstname','$surname','$hashed_password')");
            $valid = true;
            // Création d'une session une fois les données récupéré
            $select = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE Login = '$login'");
            $resultat = mysqli_fetch_all($select, MYSQLI_ASSOC);
            header('Location: connexion.php');
        }
    }
}
?>
        <main class="main-inscription">
            <h1>Inscription</h1> 
            <section>
                <h2>Formulaire d'inscription</h2>
                <form class="formulaire-inscription" action="" method="post">
                    <label for="login">Login</label>
                    <input type="text" id="login" name="login" placeholder="<?php echo $erreur_login;?>">

                    <label for="firstname">Prénom</label>
                    <input type="text" id="firstname" name="firstname" placeholder="<?php echo $erreur_prenom;?>">

                    <label for="surname">Nom</label>
                    <input type="text" id="surname" name="surname" placeholder="<?php echo $erreur_nom;?>">

                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" placeholder="<?php echo $erreur_mdp;?>">

                    <label for="password2">Confirmation du mot de passe</label>
                    <input type="password" id="password2" name="password2" placeholder="<?php echo $erreur_mdp2;?>">

                    <input type="submit" id="button" name="button">
                </form>
            </section>
        </main>
        <?php include('../pages/footer.php') ?>   
    </body>
</html>