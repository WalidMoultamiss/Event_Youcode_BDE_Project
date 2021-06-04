<?php

require_once '../vendor/autoload.php';

class Classes extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->classes = $this->model('ClassesModel');
        $this->userModel = $this->model('UserModel');
        $this->notifModel = $this->model('notifModel');
    }

    public function classes()
    {
        $classes = $this->classes->getClasses();
        print_r(json_encode($classes));
    }

    public function info($id)
    {
        $classes = $this->classes->classesInfo($id);
        print_r(json_encode($classes));
    }



    public function add()
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                // dont forget to take out the student role
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    $classes = $this->classes->add($this->data);
                    $currentUser = $this->userModel->getEmailById($infos->id);
                    if ($classes) {
                        $notif = $this->notifModel->add("Class has been Created by $currentUser->email");
                        echo json_encode(
                            ["message" => "Class has been Created with success"]
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
