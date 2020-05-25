<?php
session_start();
include "libraries/fonctions.lib";
include "class/menuClass.php";
include "class/menuENClass.php";

connexionPOO($bd);

if (isset($_GET['action'])) {
    if ($_GET['action'] == "ajouter") {
        $menuFR = new Menu($_POST['nomFR'], $_POST['prix'], $_POST['descriptionFR']);
        $menuFR->ajouterMenuBD($bd);

        $menuEN = new MenuEN($_POST['nomEN'], $_POST['prix'], $_POST['descriptionEN']);
        $menuEN->ajouterMenuBD($bd);
    }
}

include "inclus/entete.inc";
?>

    <div class="col-lg-6 offset-lg-3 justify-content-center">
        <div id="infos" class="p-3">
            <h1 class="text-center text-white">Ajouter un menu</h1>
            <form class="mt-5" id="formConnexion" name="formConnexion" method="POST" enctype="multipart/form-data"
                  action="ajouterMenu.php?action=ajouter">

                <table class="table">
                    <thead>
                    <tr>
                        <th>Information</th>
                        <th>Français</th>
                        <th>Anglais</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>
                            <label for="nom">Nom :</label>
                        </td>
                        <td>
                            <input type="text" name="nomFR" class="form-control" placeholder="Nom français">
                        </td>
                        <td>
                            <input type="text" name="nomEN" class="form-control" placeholder="Nom anglais">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label class="align-content-center" for="prix">Prix : </label>
                        </td>
                        <td colspan="2">
                            <input type="number" step="0.01" class="form-control" name="prix" placeholder="Prix">
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="nom">Description : </label>
                        </td>
                        <td>
                            <textarea name="descriptionFR" class="form-control"
                                      placeholder="Description française"></textarea>
                        </td>
                        <td>
                            <textarea name="descriptionEN" class="form-control"
                                      placeholder="Description anglaise"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label for="prix">Image : </label>
                        </td>
                        <td colspan="2">
                            <div id="drop_file_zone" ondrop="upload_file(event)" ondragover="return false">
                                <div id="drag_upload_file">
                                    <p>Drop file here</p>
                                    <p>or</p>
                                    <p><input type="button" value="Select File" onclick="file_explorer();"></p>
                                    <input type="file" id="selectfile">
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>


                <div class="text-center">
                    <div class="text-center">
                        <input type="submit" class="btn btn-info" value="Ajouter menu"/>
                        <input type="reset" class="btn btn-secondary" value="Remettre à zéro"/>
                    </div>
                </div>

            </form>
        </div>
    </div>


<?php
include "inclus/piedPage.inc";
?>