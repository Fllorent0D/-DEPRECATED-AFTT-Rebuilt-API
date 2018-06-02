<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 22/08/16
 * Time: 01:19
 */

namespace App\Api;


/**
 * Permet de récupérer le top individuelle
 * @package App\Api
 */
class TopIndividuel extends ApiRequest
{
    /**
     * TopIndividuel constructor.
     * @param $indice
     */
    function __construct($indice)
    {
        $this->setFile('top_individuel_par_division');
        $this->setParam(['INDICE' => $indice]);
    }


}