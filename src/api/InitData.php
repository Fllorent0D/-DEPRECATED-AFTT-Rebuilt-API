<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 21/08/16
 * Time: 20:58
 */



/**
 * Permet de récupérer des information de base
 * @package App\Api
 */
class InitData extends ApiRequest
{
    /**
     * InitData constructor.
     */
    function __construct()
    {
        $this->setFile('init_data');
    }

    /**
     * @return array
     */
    public function getClubs()
    {
        return $this->request()[1];
    }

    /**
     * @return array
     */
    public function getDivisions()
    {
        return $this->request()[0];
    }

}