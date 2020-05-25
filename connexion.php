<?php
session_start();
include "libraries/fonctions.lib";

connexionPOO($bd);
//ajouterUsager($bd, 'test@hotmail.com', 'test');


// Connexion
if (isset($_GET["action"])) {
    if ($_GET["action"] == "connexion") {
        if (validerUsagerPOO($bd, $_POST['username'], $_POST['password'])) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['connecte'] = true;

            //header("Location: index.php");
        } else {
            $messageErreur = "Courriel ou mot de passe invalide.";
        }
    }
    if ($_GET["action"] == "recuperation") // Récupération du mot de passe
    {
        $username = $_POST['username'];
        if ($username == "") // Si courriel est vide / non-renseigné
        {
            $recupStatus = "Veuillez entrer un nom d'utilisateur dans le champ respectif avant d'envoyer.";
        } else if (validerUsername($bd, $username)) {
            $demandeUnique = true;
            $randomKey = '1';

            commencer5minTimer($bd, $username, $demandeUnique, $randomKey);
            if ($demandeUnique) // Pour ne pas avoir deux demandes du meme usager dans le meme 5 minutes
            {
                $recupStatus = envoyerCourriel($bd, $username, $randomKey);
            } else {
                $recupStatus = "Vous avez déjà une demande de réinitialisation de mot de passe active. Veuillez suivre les instructions dans votre courriel envoyé.";
            }
        } else // Le courriel n'existe pas dans la base de données
        {
            $recupStatus = "Ce nom d'utilisateur n'exite pas comme client de notre compagnie. Veuillez vérifier votre nom d'utilisateur.";
        }
    }
    if ($_GET["action"] == "deconnexion") {
        session_unset();
        redirectionToIndex(false);
    }
}

// Quand le mot de passe a été changé
if (isset($_GET['message'])) {
    if ($_GET['message'] == "pwdReset") {
        $recupStatus = "Votre mot de passe à été changé. Vous pouvez l'utiliser dès maintenant.";
    }
}

include "inclus/entete.inc";
?>

    <div class="col-lg-6 offset-lg-3 justify-content-center">
        <div id="infos" class="p-3">
            <h1 class="text-center text-white">Connexion</h1>
            <form class="mt-5" id="formConnexion" name="formConnexion" method="POST"
                  action="connexion.php?action=connexion">
                <div class="form-group form-inline input-group">
                    <label class="col-5 align-content-center" for="username">Nom d'utilisateur </label>
                    <input type="text" name="username" class="form-control" placeholder="Votre nom d'utilisateur"
                           required>
                </div>

                <div class="form-group form-inline input-group">
                    <label class="col-5" for="password">Mot de passe : </label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Votre mot de passe" required>
                </div>

                <div class="text-danger text-center" id="messageErreur">
                    <?php if (isset($messageErreur)) {
                        echo $messageErreur;
                    } ?></div>

                <div class="text-center pad-b"><a onclick="submitRecuperation();" href="#">Mot de passe oublié? Cliquez
                        ici</a></div>

                <div id="recupStatus" class="text-center text-white pad-b">
                    <?php if (isset($recupStatus)) {
                        echo $recupStatus;
                    } ?>
                </div>

                <div class="text-center">
                    <div class="text-center">
                        <input type="submit" class="btn btn-info" value="Se connecter"/>
                        <input type="reset" class="btn btn-secondary" value="Annuler"/>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
include "inclus/piedPage.inc"
?>