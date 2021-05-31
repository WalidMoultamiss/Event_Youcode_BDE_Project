<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:POST,GET');
header('Access-Control-Allow-Headers: content-type');
header('Content-Type: application/json');
class Core
{
    protected $Controller = 'Pages';
    protected $Method = 'index';
    protected $params = 'params';
    protected $Data = [];

    public function __construct()
    {
        $url = $this->getUrl();
        if ($url?file_exists('../backend/controllers/' . ucwords($url[0]) . '.php'):null) {
            $this->Controller = ucwords($url[0]);
            unset($url[0]);
        }

        require_once '../backend/controllers/' . $this->Controller . '.php';
        $this->Controller = new $this->Controller;

        if (isset($url[1])) {
            if (method_exists($this->Controller, $url[1])) {
                $this->Method = $url[1];
                unset($url[1]);
            }
        }

        $this->Controller->data = file_get_contents("php://input") ? json_decode(file_get_contents("php://input")) : [];
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->Controller, $this->Method], $this->params);

    }

    public function getUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
