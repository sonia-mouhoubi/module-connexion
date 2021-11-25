<?php
require('header.php'); ?>
        <main>
        <!-- Permet d'afficher le nom de l'utilisateur connecté. -->
        <?php if(isset($_SESSION['prenom'])) { ?> <p class="user-connecte">Bonjour  
        <?php echo $_SESSION['prenom']; ?>, vous êtes connecté.</p> <?php } ?>

            <section class="accueil_presentation">
                <h1>Babyville, la créche qui choouchoute vos enfants</h1>
                <p>Gallus Hierapolim profecturus ut expeditioni specie tenus adesset, Antiochensi plebi 
                suppliciter obsecranti ut inediae dispelleret metum, quae per multas difficilisque causas adfore 
                iam sperabatur, non ut mos est principibus.</p>
                <img src="../img/accueil.jpg" alt="">
            </section>
            <section>
            <h3>Tarifs selon ressources</h3>
                <table class="tableau-connexion">
                    <thead>
                        <tr>
                            <th>Obrutis callibus</th>
                            <th>Tarif horaire</th>
                            <th>Tarif mensuel</th>
                            <th>Tarif annuel</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Emensis itaque difficultatibus multis et nive obrutis callibus</th>
                            <td>0,80€</td>
                            <td>100€</td>
                            <td>800€</td>
                        </tr>
                        <tr>
                            <th>Emensis itaque difficultatibus multis et nive obrutis callibus</th>
                            <td>1€</td>
                            <td>150€</td>
                            <td>1000€</td>

                        </tr>
                        <tr>
                            <th>Emensis itaque difficultatibus multis et nive obrutis callibus</th>
                            <td>2€</td>
                            <td>250€</td>
                            <td>1500€</td>
                        </tr>
                    </tbody>
                </table> 
            </section>
            <section class="accueil_inscription ">
                <h2>Vous avez besoin de faire garder votre enfant</h2>
                <p>Inscrivez-vous en cliquant sur le lien suivant : <a href="inscription.php">Inscription</a></p>
            </section>
        </main>
        <?php include('footer.php') ?>       
    </body>
</html>