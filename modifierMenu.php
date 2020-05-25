<?php
session_start();
include "libraries/fonctions.lib";
include "class/menuClass.php";
include "class/menuENClass.php";

connexionPOO($bd);

$tousMenus = selectMenusBD($bd);
if (isset($_GET["action"])) {
    if ($_GET["action"] == "modifier") {
        include "inclus/entete.inc";
        showMenusModifier($tousMenus, $_GET['item']);
    }
    if ($_GET["action"] == "confirmModifier") {
        $menuFR = new Menu($_POST['nomFR'], $_POST['prix'], $_POST['descriptionFR'], $_GET['id']);
        $menuFR->modifierMenuBD($bd);

        $menuEN = new MenuEN($_POST['nomEN'], $_POST['prix'], $_POST['descriptionEN'], $_GET['id']);
        $menuEN->modifierMenuBD($bd);

        $tousMenus = selectMenusBD($bd);
        include "inclus/entete.inc";
        showMenusNormal($tousMenus);
    }
} else {
    include "inclus/entete.inc";
    showMenusNormal($tousMenus);
}
?>

<?php
include "inclus/piedPage.inc";
?>
