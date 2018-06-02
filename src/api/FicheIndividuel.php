<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 22/08/16
 * Time: 01:53
 */



/**
 * Permet de récupérer la fiche d'un joueur (victoire/défaites/?)
 * @package App\Api
 */
class FicheIndividuel extends ApiRequest
{
    /**
     * FicheIndividuel constructor.
     * @param Numéro de licence
     */
    function __construct($licence)
    {
        $this->setParam(["LICENCE" => $licence]);
        $this->setFile('fiche_indi');
    }

    /**
     * @return Array
     */
    public function getInfoJoueur()
    {
        return $this->request()[0];
    }

    /**
     * @return Array
     */
    public function getVictoires()
    {
        $victoires = $this->request()[2];
        return $this->link($victoires, "V");
    }

    /**
     * @return Array
     */
    public function getDefaites()
    {
        $defaites = $this->request()[3];
        return $this->link($defaites, "D");
    }

    /**
     * @param array $resultats
     * @param $methode
     * @return array
     */
    private function link(array $resultats, $methode)
    {
        $classements = $this->request()[1];
        $return = array();
        for($i = 0; $i < count($classements); $i++)
            $return[$classements[$i]->T] = $resultats[$i]->$methode;

        return $return;
    }
}