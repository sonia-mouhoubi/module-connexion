<?php 
 require ('header.php');

$valid = true; // Variable pour verifier si les champs sont vide 
// Initialisation message erreur
$erreur_login = "";
$erreur_mdp = "";
$err_loginpass = "";
// Si le formulaire a été validé
if(isset($_POST["button"])) { 
// Création variables
    $login = $_POST["login"];
    $password = $_POST["password"];
    if(isset($login, $password)) { // Et si mon login et mdp existe
        if(empty($login)) { // Et si le champs est vide
            $valid = false; // La variable retourne false
            $erreur_login = "Le champ est vide.";  
        }
        elseif(empty($password)) { // Sinon si mon password est vide
            $valid = false; // Echo message d'erreur
            $erreur_mdp = "Le champ est vide.";
        }
        // Vérif pour savoir si le login taper est enregister dans la bdd
        $select = mysqli_query($bdd, "SELECT * FROM utilisateurs WHERE Login = '$login'");
        $resultat = mysqli_fetch_all($select, MYSQLI_ASSOC); // On récupére le résultat de la requête.

        if(!empty($resultat)) { // Si le résultat de la requête n'est pas vide(il y a donc un login dans la bdd identique à celui taper.
            if(password_verify($password, $resultat[0]['Password'])) { /* On verifie si le mdd haché du formulaire
                                                                        est identique à celui de la bdd*/
                $valid = true; //On accepte les infos et on créer une session connécté
                $_SESSION['id'] = $resultat[0]['Id'];
                $_SESSION['prenom'] = $resultat[0]['Prenom'];
                $_SESSION['login'] = $resultat[0]['Login'];
                header('Location: accueil.php');
            } 
        }   
        else {
            $err_loginpass = 'Erreur de login ou mot de passe.';
        } 
    }
} 
?>
        <main class="main-connexion">        
            <h1>Connexion</h1>
            <section>
                <h2>Connectez-vous</h2>
                <form class="formulaire-connexion" action="#" method="post">
                    <label for="login">login</label>
                    <input type="text" id="login" name="login" placeholder="<?php echo $erreur_login;?>">

                    <label for="password">Mot de passe</label>
                    <input type="text" id="password" name="password" placeholder="<?php echo $erreur_mdp;?>">

                    <input type="submit" id="button" name="button" value ="Connexion">
                    <p><?php echo $err_loginpass;?></p>
                </form>
            </section>
        </main>
        <?php include('../pages/footer.php') ?>       
    </body>
</html>