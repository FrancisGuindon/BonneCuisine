<?php
if (isset($_COOKIE['langue'])) {
    $langue = $_COOKIE['langue'];
} else {
    $langue = "fr";
    setcookie("langue", "fr", time() + (60 * 60 * 24 * 365));
}

if (isset($_GET['langue'])) {
    if ($_GET['langue'] == 'english') {
        $langue = "en";
        setcookie("langue", "en", time() + (60 * 60 * 24 * 365));
    } else if ($_GET['langue'] == 'francais') {
        $langue = "fr";
        setcookie("langue", "fr", time() + (60 * 60 * 24 * 365));
    }
}
/* Récupération du contenu du fichier .json */
$contenu_fichier_json = file_get_contents('json/lang/' . $langue . '.json');

/* Les données sont récupérées sous forme de tableau (true) */
$data = json_decode($contenu_fichier_json, true);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">

    <link rel="shortcut icon" href="images/cuisine.ico">
    <link rel="stylesheet" href="css/cuisine.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/bonnecuisine.js"></script>
    <title>La Bonne Cuisine</title>
</head>

<body>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <!-- Title -->
        <a class="navbar-brand" href="index.php">
            <img class="img-fluid" src="images/logoBonneCuisine.png" width=200 alt="Logo Bonne Cuisine">
        </a>

        <!-- Collapse Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu options -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <div class="imgText">
                        <a class="nav-link" href="menu.php">
                            <img src="images/menu.png" width=35 alt="Menu">
                            <?php echo $data["nav_menu"] ?>
                        </a>
                    </div>
                </li>

                <li class="nav-item">
                    <div class="imgText">
                        <a class="nav-link" href="rejoindre.php">
                            <img src="images/contact.png" width=35 alt="Contact">
                            <?php echo $data["nav_contact"] ?>
                        </a>
                    </div>
                </li>



                <?php
                if (isset($_SESSION['connecte'])) {
                    if ($_SESSION['connecte']) {
                        print("
                <li class='nav-item dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='navbarDropdown' role='button'
                       data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                        Admin
                    </a>
                    <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                        <a class='dropdown-item' href='ajouterMenu.php'>" . $data['nav_admin_addMenu'] . "</a>
                            <div class='dropdown-divider'></div>
                                <a class='dropdown-item' href='modifierMenu.php'>" . $data['nav_admin_modifyMenu'] . "</a>
                            <div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='supprimerMenu.php'>" . $data['nav_admin_deleteMenu'] . "</a>
                    </div> 
                </li>
                    ");
                    }
                } ?>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="imgText">
                    <a class="nav-link" id="aCart" href="commande.php">
                        <img id="imgCart" src="images/shopping-cart.png" width=35 alt="Shopping cart">
                        <div id="hideOnCollapse">Votre panier</div>
                    </a>
                </li>
                <li class="nav-item">
                    <?php
                    if (isset($_SESSION['connecte'])) {
                        print('<a class="nav-link" href="connexion.php?action=deconnexion">');
                        echo $data["nav_deconnexion"];
                        print('</a>');
                    } else {
                        print('<a class="nav-link" id="connexion" href="connexion.php">');
                        echo $data["nav_connexion"];
                        print('</a>');
                    }
                    ?>

                </li>
            </ul>
        </div>

    </nav>