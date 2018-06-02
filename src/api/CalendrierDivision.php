<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 21/08/16
 * Time: 21:23
 */



/**
 * Permet de récupérer le calendrier d'une division
 * @package App\Api
 */
class CalendrierDivision extends ApiRequest
{

    /**
     * CalendrierDivision constructor.
     * @param int|string
     */
    function __construct($idDivision)
    {
        $this->setParam(["ID_DIV" => $idDivision]);
        $this->setFile("calendrier_par_division");
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
    public function getCategorie()
    {
        return $this->request()[1];
    }

    /**
     * @return string
     */
    public function getDivision()
    {
        return $this->request()[2];
    }
}