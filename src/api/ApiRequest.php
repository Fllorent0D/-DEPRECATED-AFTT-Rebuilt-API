<?php
/**
 * Created by PhpStorm.
 * User: florentcardoen
 * Date: 18/08/16
 * Time: 16:21
 */


abstract class ApiRequest
{
    private $baseurl = "http://affrbtt-asbl.be/pda/";
    private $ch;
    private $timeout = 15;
    private $file;
    private $params = [];
    private $url;
    protected $data;
    private $debug = false;
    private $paramChanged = false;

    public function setDebug($debug)
    {
        if(is_bool($debug))
            $this->debug = $debug;
    }

    public function getRawData()
    {
        return $this->request();
    }

    protected function setFile($file)
    {
        $this->paramChanged = true;
        $this->file = $file . ".php";
    }
    protected function setParam(array $param, $clear = false)
    {
        $this->paramChanged = true;

        if($clear)
            $this->params = $param;
        else
            $this->params = array_merge($this->params, $param);
    }

    protected function request()
    {
        if(!isset($this->file))
            throw new \Exception('Aucune information sur le fichier à récupérer');

        if(!isset($this->data) || $this->paramChanged){
            $this->data = $this->decode($this->fetch());
            $this->paramChanged = false;
        }

        return $this->data;
    }
    private function generateUrl()
    {
        $this->url = $this->baseurl.$this->file."?".http_build_query($this->params);
    }

    private function fetch()
    {
        $this->generateUrl();
        if($this->debug)
            var_dump($this->url);

        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_URL, $this->url);

        $data = curl_exec($this->ch);

        if($this->debug)
            var_dump($data);

        if($data === false)
            throw new \Exception('Une erreur est survenue lors de la connexion avec le back-end de la fédération. Message d\'erreur : <i>'.curl_strerror(curl_errno($this->ch)).'</i>');

        curl_close($this->ch);

        return $data;
    }
    private function decode($data)
    {
        $decoded = array();
        $splited = preg_split('/\!\!\!|\*\*\*|\$\$\$|\#\#\#|\&\&\&|\+\+\+|\-\-\-|\>\>\>|\/\/\/|\=\=\=|\<\<\</', $data);

        foreach($splited as $key => $item)
        {
            $response = json_decode($item);
            if ($response === null)
            {
                if($item == "null")
                    $response = null;
                else
                    $response = $item;

            }
            array_push($decoded, $response);
        }

        if($this->debug)
            var_dump($decoded);

        return $decoded;
    }



}