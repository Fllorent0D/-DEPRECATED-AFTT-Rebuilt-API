<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 21/08/16
 * Time: 21:45
 */

/**
 * Permet de récupérer les résultats d'une journée dans une division
 * @package App\Api
 */
class Resultats extends ApiRequest
{
    /**
     * @param Jour
     * @param Division
     */
    function __construct($jour, $division)
    {
        $this->setParam(["jour" => $jour, "iddiv" => $division]);
        $this->setFile('results');
    }

    /**
     * @return array
     */
    public function getResultats()
    {
        return $this->request()[0];
    }

    public function getClassements(){
        return $this->request()[1];
    }
    /**
     * @return string
     */
    public function getCategorie()
    {
        return $this->request()[2];
    }

    /**
     * @return string
     */
    public function getDivision()
    {
        return $this->request()[3];
    }

    /**
     * @return string
     */
    public function getDescriptionJournee(){
        return $this->request()[4];
    }

}