<?php
/* Définition de la langue */
$lang = 'en';

/* Récupération du contenu du fichier .json */
$contenu_fichier_json = file_get_contents($lang.'.json');

/* Les données sont récupérées sous forme de tableau (true) */
$data = json_decode($contenu_fichier_json, true);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang ?>">
    <head>
        <meta charset="utf-8">
        <title><?php echo $data['head_title'] ?></title>
        <meta name="description" content="<?php echo $data['head_description'] ?>">
    </head>    
    <body>      
        <header>
            <h1><?php echo $data['site_h1'] ?></h1>
            <p><?php echo $data['site_description'] ?></p>
        </header>      
        <nav><a href="?lang=en">en</a> <a href="?lang=fr">fr</a></nav>       
        <main>
            <article>
                <header>
                    <h2><?php echo $data['page_h2'] ?></h2>
                </header>
                <?php echo $data['page_content'] ?>
            </article>
        </main>     
        <footer>
            <p><?php echo $data['footer_text'] ?></p>
        </footer>
    </body>
</html>
