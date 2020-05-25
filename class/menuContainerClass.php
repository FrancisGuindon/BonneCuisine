<?php

class MenuContainer
{
    public $francais;
    public $anglais;

    function __construct()
    {
        $args = func_get_args();

        $this->setFrancais($args[0]);
        $this->setAnglais($args[1]);
    }


    /**
     * @return mixed
     */
    public function getFrancais()
    {
        return $this->francais;
    }

    /**
     * @param mixed $francais
     */
    public function setFrancais($francais)
    {
        $this->francais = $francais;
    }

    /**
     * @return mixed
     */
    public function getAnglais()
    {
        return $this->anglais;
    }

    /**
     * @param mixed $anglais
     */
    public function setAnglais($anglais)
    {
        $this->anglais = $anglais;
    }


}
?>