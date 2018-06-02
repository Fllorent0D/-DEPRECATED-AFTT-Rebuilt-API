<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 21/08/16
 * Time: 20:39
 */



/**
 * Permet de récupérer la journée actuelle
 * @package App\Api
 */
class Journee extends ApiRequest
{

    /**
     * Journee constructor.
     */
    public function __construct()
    {
        $this->setFile('journee');
    }

    /**
     * @return int
     */
    public function getJourneeActuelle()
    {
        return (int)$this->request()[0];
    }

}