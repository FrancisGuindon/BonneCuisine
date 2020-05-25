<?php
session_start();
include "libraries/fonctions.lib";
include "inclus/entete.inc";

if (isset($_GET["success"])) {
    if ($_GET["success"] == "false") {
        $recupExpiree = "Votre demande de changement de mot de passe est expirée. Veuillez en faire une nouvelle.";
    }
}
?>
    <div class="text-danger text-center"><?php if (isset($recupExpiree)) {
            echo($recupExpiree);
        } ?>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="img"><img class="d-block img-fluid" src="images/caroussel1.jpg" alt="First slide"></div>
            </div>
            <div class="carousel-item">
                <div class="img"><img class="d-block img-fluid" src="images/caroussel2.jpg" alt="Second slide"></div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#caouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


<?php
include "inclus/piedPage.inc"
?>