<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 22/08/16
 * Time: 01:46
 */


/**
 * Permet de récupérer le calendrier d'une saison d'un club
 * @package App\Api
 */
class CalendrierClub extends ApiRequest
{
    /**
     * Constructeur.
     * @param Indice du club
     */
    function __construct($club)
    {
        $this->setFile('calendrier_par_club');
        $this->setParam(['INDICE' => $club]);
    }

    /**
     * @return array
     */
    public function getCalendrier()
    {
        return $this->request()[0];
    }

    /**
     * @return string
     */
    public function getClub()
    {
        return $this->request()[2];
    }

    /**
     * @return string
     */
    public function getIndice()
    {
        return $this->request()[1];
    }
}