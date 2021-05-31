<?php
use \Firebase\JWT\JWT;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class Controller
{

    //Load the model :
    public $key = "youcode";

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

    public function auth($cin, $role, $hash)
    {
        $iat = time();
        $exp = $iat + 60 * 60;
        $payload = array(
            "iss" => "localhost",
            "aud" => "localhost",
            "iat" => $iat,
            'exp' => $exp,
            'cin' => $cin,
            'role' => $role,
            'hash' => $hash,
        );

        $jwt = JWT::encode($payload, $this->key, 'HS512');
        
        return $jwt;
    }
    public function verifyAuth($token){
      $decoded = JWT::decode($token, $this->key, array('HS512'));
      return $decoded;
    }

}
