<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 22/08/16
 * Time: 01:50
 */



/**
 * Permet de récupérer les informations d'un club
 * @package App\Api
 */
class InfosClub extends ApiRequest
{
    /**
     * InfosClub constructor.
     * @param Indice du club
     */
    function __construct($club)
    {
        $this->setFile('infosClubs');
        $this->setParam(["INDICE" => $club]);
    }

    /**
     * @return Array Informations de base du club
     */
    public function getInfoClub()
    {
        return $this->request()[0][0];
    }

    /**
     * @return Array Informations pratiques du club
     */
    public function getInfoPratique()
    {
        return $this->request()[1][0];
    }

    /**
     * @return Array Liste des responsables du club
     */
    public function getMembres()
    {
        return $this->request()[2];
    }
}