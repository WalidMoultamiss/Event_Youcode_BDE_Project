<?php

require_once '../vendor/autoload.php';

class Speacker extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->speackerModel = $this->model('SpeackerModel');
        $this->userModel = $this->model('UserModel');
        $this->notifModel = $this->model('notifModel');
        $this->validator = $this->middleware();
    }

    public function speackers()
    {
        $speackers = $this->speackerModel->getSpeackers();
        print_r(json_encode($speackers));
    }

    public function info($id)
    {
        $speackers = $this->speackerModel->speackerInfo($id);
        print_r(json_encode($speackers));
    }



    public function add()
    {
        $rules = [
            'full_name' => 'required|min:4',
            'description' => 'required',
            // 'url_img'=>"required",
            'id_event' => 'required|integer'
        ];

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $response = $this->validator->validate($this->data,$rules) ;
                // dont forget to take out the student role
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    try{
                        $currentUser = $this->userModel->getEmailById($infos->id);
                    }catch (\Throwable $th) {
                        print_r(json_encode(array(
                            'error' => "error can't get info user",
                        )));
                    }
                    $speacker = $this->speackerModel->add($this->data);
                    if ($speacker) {
                        $notif = $this->notifModel->add("speacker Created with success by the user: $currentUser->email");
                        echo json_encode(
                            ["message" => "speacker Created with success"]
                        );
                    }
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have Permission to make this action 💢 ",
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

}
