<?php

header('Access-Control-Allow-Origin: http://127.0.0.1:3000');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../vendor/autoload.php';

class User extends Controller
{

    public $data = [];

    public function __construct()
    {
        $this->userModel = $this->model('UserModel');
    }

    public function user($data)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $this->verifyAuth($headers[1]);
                if ($data == 'Admin' || $data == 'Client') {
                    $user = $this->userModel->getUserByRole($data);
                    unset($user->password);
                    print_r(json_encode($user));
                } else {
                    $user = $this->userModel->getUserById($data);
                    unset($user->password);
                    print_r(json_encode($user));
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    "error" => "unauthorized",
                )));
            }
        } else {
            print_r(json_encode(array(
                "error" => "unauthorized",
            )));
        }
    }


    public function archive($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $this->verifyAuth($headers[1]);
                if ($id == 'student') {
                    $user = $this->userModel->archiveUser($id);
                    unset($user->password);
                    print_r(json_encode($user));
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    "error" => "unauthorized",
                )));
            }
        } else {
            print_r(json_encode(array(
                "error" => "unauthorized",
            )));
        }
    }

    public function users()
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    $users = $this->userModel->getUsers();
                        print_r(json_encode(array(
                            "users" => $users,
                        )));
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have Permition to make this action 💢 ",
                    )));
                    die();
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "Authentication error 1💢 ",
                )));
            }
        } else {
            print_r(json_encode(array(
                'error' => "Authentication error 2💢 ",
            )));
        }
    }

    public function login()
    {
        $user = $this->userModel->getUserByEmail($this->data->email);
        if ($user) {
            if (password_verify($this->data->password, $user->password)) {
                $token = $this->auth($user->cin, $user->role, $user->password);
                unset($user->password);
                print_r(json_encode(array(
                    'User' => $user,
                    'Token' => $token,
                )));
            } else {

                $res=json_encode(array(
                    'error' => 'password incorrect',
                ));
                
                print_r($res);
            }
        } else {


            $res=json_encode(array(
                'error' => 'email incorrect',
            ));
           
            print_r($res);
        }
    }

    public function register()
    {
        try {
            $this->data->password = password_hash($this->data->password, PASSWORD_DEFAULT);
            $user = $this->userModel->register($this->data);
            $token = $this->auth($user->cin, $user->role, $user->password);
            unset($user->password);
            print_r(json_encode(array(
                'User' => $user,
                'Token' => $token,
            )));
        } catch (\PDOExeption $err) {
            http_response_code(500);
            print_r(json_encode(array('error' => $err->getMessage())));
            die();
        }

    }
    
    

    // public function delete($id){
    //     $this->userModel->delete($id);
    // }

    public function Token(){
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;

        if ($headers) {
            try {
               
            $this->verifyAuth($headers[1]);
            print_r(json_encode(array('message' => 'Authorized' )));
                    
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    "error" => "unauthorized",
                )));
            }
        } else {
            print_r(json_encode(array(
                "error" => "unauthorized",
            )));
        }
    }
}
