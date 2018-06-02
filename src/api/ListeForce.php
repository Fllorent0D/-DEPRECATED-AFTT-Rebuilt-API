<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 22/08/16
 * Time: 01:26
 */



/**
 * Permet de récupérer la liste de force d'un club
 * @package App\Api
 */
class ListeForce extends ApiRequest
{
    /**
     * ListeForce constructor.
     * @param string
     */
    function __construct($club = "")
    {
        $this->setFile('liste_force_messieurs');
        $this->setParam(['INDICE' => $club]);
    }

    /**
     * @return array
     */
    public function getListeMessieurs()
    {
        return $this->request()[0];
    }

    /**
     * @return array
     */
    public function getListeDames()
    {
        return $this->request()[1];
    }

    /**
     * @return string
     */
    public function getIndice()
    {
        return $this->request()[2];
    }

    /**
     * @return string
     */
    public function getClub()
    {
        return $this->request()[3];
    }
}