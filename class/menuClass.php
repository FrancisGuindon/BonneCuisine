<?php

class Menu
{
    private $idMenu;
    private $nom;
    private $prix;
    private $description;
    // Constructeurs :
    // new Menu(id) Pour chercher un menu
    // new Menu(nomFR, prix, description) INSERT régulier
    // new Menu(nom, prix, description, id) INSERT avec ID
    function __construct()
    {
        $args = func_get_args();
        $i = func_num_args();

        switch ($i) {
            case 1:
                $this->setId($args[0]);
                break;
            case 4:
                $this->setIdMenu($args[3]);
            case 3:
                $this->setNom($args[0]);
                $this->setPrix($args[1]);
                $this->setDescription($args[2]);
                break;
        }
    }

    function ajouterMenuBD($bd)
    {
        $requete = $bd->prepare("INSERT INTO menu_fr (nom, description, prix) VALUES (:nom, :description, :prix);");
        $requete->execute(array('nom' => $this->nom, 'description' => $this->description, 'prix' => $this->prix));
        $lastInsertId = $bd->lastInsertId();
        $this->setIdMenu($lastInsertId);
        $this->ajouterImage();
    }

    function modifierMenuBD($bd)
    {
        $requeteFR = $bd->prepare("UPDATE menu_fr SET nom=:nom, description=:description, prix=:prix WHERE idMenu=:idMenu");
        $requeteFR->execute(array('nom' => $this->nom, 'description' => $this->description, 'prix' => $this->prix, 'idMenu' => $this->idMenu));

        $this->modifierImage();
    }


    function supprimerMenuBD($bd)
    {
        $requeteFR = $bd->prepare("DELETE FROM menu_fr WHERE idMenu=:idMenu");
        $requeteFR->execute(array('idMenu' => $this->idMenu));

        $this->supprimerImage();
    }

    private function ajouterImage()
    {
        if ($this->verifUpload()) {
            $ext = $this->grabExtensionAdd();

            $fichier = "uploads/temp" . $ext;
            $id = $this->getIdMenu();
            $destination = "images/" . $id . $ext;

            copy($fichier, $destination);
            unlink($fichier);
        }
        else
        {
            $noImg = "images/noimage.png";
            $id = $this->getIdMenu();
            $destination = "images/" . $id . ".png";

            copy($noImg, $destination);
        }
    }

    private function modifierImage()
    {
        if ($this->verifUpload()) {
            $this->supprimerImage();
            $this->ajouterImage();
        }
    }

    private function verifUpload()
    {
        $possibilities = array(
            0 => "uploads/temp.jpg",
            1 => "uploads/temp.jpeg",
            2 => "uploads/temp.png"
        );
        foreach ($possibilities as $possibility)
        {
            if (file_exists($possibility)) { return true; }
        }
        return false;
    }

    private function supprimerImage()
    {
        $id = $this->getIdMenu();
        $ext = $this->grabExtensionDelete($id);
        $pictureFile = "images/" . $id . $ext;
        if (file_exists($pictureFile)) {
            unlink($pictureFile);
        }
    }


    /**
     * Get the value of idMenu
     */
    public function getIdMenu()
    {
        return $this->idMenu;
    }

    /**
     * Set the value of idMenu
     *
     * @return  self
     */
    public function setIdMenu($idMenu)
    {
        $this->idMenu = $idMenu;

        return $this;
    }

    public function grabExtensionDelete($id)
    {
        if (file_exists("images/" . $id . ".jpg")) {
            return ".jpg";
        } else if (file_exists("images/" . $id . ".jpeg")) {
            return ".jpeg";
        } else if (file_exists("images/" . $id . ".png")) {
            return ".png";
        } else {
            return false;
        }
    }

    public function grabExtensionAdd()
    {
        if (file_exists("uploads/temp.jpg")) {
            return ".jpg";
        } else if (file_exists("uploads/temp.jpeg")) {
            return ".jpeg";
        } else if (file_exists("uploads/temp.png")) {
            return ".png";
        } else {
            return false;
        }
    }

    /**
     * Get the value of nom
     */
    public
    function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public
    function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public
    function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */
    public
    function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of description
     */
    public
    function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public
    function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }


}

