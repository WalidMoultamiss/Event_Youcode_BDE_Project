<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class Controller extends Middleware
{

    //Load the model :
    public $message = "message";

    public function middleware()
    {
        require_once 'Middleware.php';
        return new Middleware();
    }
    public function model($model)
    {
        require_once '../backend/models/' . $model . '.php';
        return new $model();

    }

    public function view($url, $data = [])
    {
        if (file_exists('../backend/view/' . $url . '.php')) {
            require_once '../backend/view/' . $url . '.php';
        } else {
            die('View does not exist');
        }
    }

}
