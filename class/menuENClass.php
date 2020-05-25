<?php

class MenuEN
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
        $requeteEN = $bd->prepare("INSERT INTO menu_en (nom, description, prix) VALUES (:nom, :description, :prix)");
        $requeteEN->execute(array('nom' => $this->nom, 'description' => $this->description, 'prix' => $this->prix));
        $lastInsertId = $bd->lastInsertId();
        $this->setIdMenu($lastInsertId);
    }

    function modifierMenuBD($bd)
    {
        $requeteEN = $bd->prepare("UPDATE menu_en SET nom=:nom, description=:description, prix=:prix WHERE idMenu=:idMenu");
        $requeteEN->execute(array('nom' => $this->nom, 'description' => $this->description, 'prix' => $this->prix, 'idMenu' => $this->idMenu));
    }

    function supprimerMenuBD($bd)
    {
        $requeteEN = $bd->prepare("DELETE FROM menu_en WHERE idMenu=:idMenu");
        $requeteEN->execute(array('idMenu' => $this->idMenu));
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

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prix
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set the value of prix
     *
     * @return  self
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }
}

?>