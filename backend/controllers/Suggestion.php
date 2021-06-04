<?php

require_once '../vendor/autoload.php';

class suggestion extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->notifModel = $this->model('notifModel');
        $this->SugModel = $this->model('SugModel');
        $this->userModel = $this->model('UserModel');
    }
    

    public function all()
    {
        $sugs = $this->SugModel->getSugs();
        print_r(json_encode($sugs));
    }

    public function info($id)
    {
        $events = $this->eventModel->eventInfo($id);
        print_r(json_encode($events));
    }



    public function add()
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try{
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    $sugs = $this->SugModel->add($this->data);
                    if ($sugs) {
                        $currentUser = $this->userModel->getEmailById($infos->id);
                        $notif = $this->notifModel->add("suggestion added by the user: $currentUser->email");
                        print_r(json_encode(array(
                            "message" => "your suggestion has been sent to the admin",
                        )));
                    }
                }
                }
             catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "error ",
                )));
            }}
        }


    }