<?php
session_start();
include "libraries/fonctions.lib";
include "inclus/entete.inc";
include "class/menuClass.php";
connexionPOO($bd);


$tousMenus = selectMenusBD($bd);
?>

<?php

foreach ($tousMenus as &$unMenu) {
    $ext = getFileExtension($unMenu->francais->idMenu);
    if ($langue == 'fr') {
        print("
    <div class='text-white container-fluid'>
        " . $unMenu->francais->nom . "
        <div class='row divItem' style='display: table'>
            <img class='imgMenu' src='images/" . $unMenu->francais->idMenu . $ext . "?" . time() . "' alt='Image du menu'>
            <div class='caption' style='vertical-align: middle; display: table-cell;'>
                Prix: \$CAD " . $unMenu->francais->prix . "
                <br> Remarque : " . $unMenu->francais->description . "
                <br>
            </div>
        </div>
    </div>

        ");
    } else if ($langue == 'en') {
        $prixCA = $unMenu->anglais->prix;
        $result = moneyConvert($prixCA, "CAD", "USD");
        print("
<p>
    <div class='text-white container-fluid'>
        " . $unMenu->anglais->nom . "
        <div class='row divItem' style='display: table'>
            <img class='imgMenu' src='images/" . $unMenu->francais->idMenu . $ext . "?" . time() . "'>
            <div class='caption' style='vertical-align: middle; display: table-cell;'>
                Price : \$USD $result ($prixCA CAD)
                <br> Description : " . $unMenu->anglais->description . "
                <br>
            </div>
        </div>
    </div>
</p>
        ");
    }
}
?>

<?php
include "inclus/piedPage.inc"
?>