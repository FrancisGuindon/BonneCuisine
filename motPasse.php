<?php
session_start();
include "libraries/fonctions.lib";

connexionPOO($bd);

if (isset($_GET["success"])) {
    if ($_GET["success"] == "change") {
        if (!changePassword($bd, $_POST['newPassword'], $_POST['newPasswordConfirm'], $_COOKIE["idUsager"])) // Mot de passe de confirmation pas égale a l'autre mot de passe
        {
            $changeStatus = "Les deux mots de passes ne correspondent pas. Veuillez réesayer.";
        } else // Le changement de mot de passe a réussi
        {
            header("Location: connexion.php?message=pwdReset");
        }
    }
} else {
    $valide = verifierValidite($bd, $_GET['key']);
}

include "inclus/entete.inc";
?>


    <div class="col-lg-6 offset-lg-3 justify-content-center">
        <div id="infos" class="p-3">
            <h1 class="text-center text-white">Votre nouveau mot de passe</h1>
            <form class="mt-5" id="formRecup" name="formRecup" method="POST" action="motPasse.php?success=change">
                <div class="form-group form-inline input-group">
                    <label class="col-5 align-content-center" for="newPassword">Nouveau mot de passe : </label>
                    <input type="password" name="newPassword" class="form-control" placeholder="Mot de passe" required>
                </div>

                <div class="form-group form-inline input-group">
                    <label class="col-5 align-content-center" for="newPasswordConfirm">Confirmez votre nouveau mot de
                        passe : </label>
                    <input type="password" name="newPasswordConfirm" class="form-control"
                           placeholder="Confirmez votre mot de passe" required>
                </div>

                <div class="message text-center text-white"><?php if (isset($changeStatus)) {
                        echo $changeStatus;
                    } ?></div>

                <div class="text-center">
                    <div class="text-center">
                        <input name="submitNewPwd" type="submit" class="btn btn-info" value="Changer mot de passe"/>
                        <input type="reset" class="btn btn-secondary" value="Annuler"/>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
include "inclus/piedPage.inc"
?>