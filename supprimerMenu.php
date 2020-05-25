<?php
session_start();
include "libraries/fonctions.lib";

include "class/menuClass.php";
include "class/menuENClass.php";
connexionPOO($bd);


$tousMenus = selectMenusBD($bd);
if (isset($_GET["action"])) {
    if ($_GET["action"] == "supprimer") {
        $menu = new Menu();
        $menuEN = new MenuEN();
        foreach ($tousMenus as &$unMenu) {
            $var = "del" . $unMenu->francais->idMenu . "";
            if (isset($_POST[$var])) // Si, par exemple, un input avec 'del1' a été envoyé.
            {
                $menu->setIdMenu($unMenu->francais->idMenu);
                $menu->supprimerMenuBD($bd);

                $menuEN->setIdMenu($unMenu->anglais->idMenu);
                $menuEN->supprimerMenuBD($bd);
            }
        }
        $tousMenus = selectMenusBD($bd);
    }
}
include "inclus/entete.inc";
showMenusDeletable($tousMenus);
?>

<?php
include "inclus/piedPage.inc";
?>
