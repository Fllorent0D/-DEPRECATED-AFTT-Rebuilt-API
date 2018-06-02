<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 21/08/16
 * Time: 21:58
 */



/**
 * Permet de récupérer une feuille de match
 * @package App\Api
 */
class FeuilleMatch extends ApiRequest
{
    /**
     * FeuilleMatch constructor.
     * @param Int id de la feuille
     */
    function __construct($idfeuille)
    {
        $this->setFile('feuille_de_matche');
        $this->setParam(["IC" => $idfeuille]);
    }

    public function getJoueurs(){
        return $this->request()[0];
    }

    public function getMatchs(){
        return $this->request()[1];

    }

    public function getDetails(){
        return $this->request()[2];
    	
    }

}