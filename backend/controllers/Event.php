<?php

require_once '../vendor/autoload.php';

class Event extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->eventModel = $this->model('EventModel');
        $this->notifModel = $this->model('notifModel');
        $this->userModel = $this->model('UserModel');
    }


    

    public function events()
    {
        $events = $this->eventModel->getEvents();
        print_r(json_encode($events));
    }

    public function info($id)
    {
        $events = $this->eventModel->eventInfo($id);
        print_r(json_encode($events));
    }

    public function Return($id)
    {
        $flight = $this->eventModel->ReturnFlights($id);
        print_r(json_encode($flight));
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
                    try{
                    $currentUser = $this->userModel->getEmailById($infos->id);
                }catch (\Throwable $th) {
                    print_r(json_encode(array(
                        'error' => "error can't get info user",
                    )));
                }
                    $event = $this->eventModel->add($this->data);
                    if ($event) {
                        $notif = $this->notifModel->add("event added by the user: $currentUser->email");
                        print_r(json_encode(array(
                            "message" => "Event Created with success",
                        )));
                    }
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have Permission to make this action",
                    )));
                    die();
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "Authentication error 1",
                )));
            }
        } else {
            print_r(json_encode(array(
                'error' => "Authentication error 2",
            )));
        }
    }

    public function archive($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                // dont forget to take out the student role
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    try{
                    $currentUser = $this->userModel->getEmailById($infos->id);
                    }catch (\Throwable $th) {
                        print_r(json_encode(array(
                            'error' => "error can't get info user",
                        )));
                        die();
                    }if($this->eventModel->archive($id)){
                            $notif = $this->notifModel->add("event has been archived by the user: $currentUser->email");
                            print_r(json_encode(array("message"=>"the status of the id:$id has been set to archived")));
                        }else{
                            print_r(json_encode(array("error"=>"error can't archive the event")));
                            die();
                            }
                    }else {
                        print_r(json_encode(array(
                            'error' => "You Don't Have Permission to make this action",
                        )));
                        die();
                        }
                }catch (\Throwable $th) {
                            print_r(json_encode(array(
                                'error' => "Authentication error 1",
                            )));
                }
            }else {
                print_r(json_encode(array(
                'error' => "Authentication error 2",
                )));}
            }




    public function highlighted($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                // dont forget to take out the student role
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    try{
                    $currentUser = $this->userModel->getEmailById($infos->id);
                    }catch (\Throwable $th) {
                        print_r(json_encode(array(
                            'error' => "error can't get info user",
                        )));
                        die();
                    }if($this->eventModel->archive($id)){
                            $notif = $this->notifModel->add("event has been highlighted by the user: $currentUser->email");
                            print_r(json_encode(array("message"=>"the status of the id:$id has been set to highlighted")));
                        }else{
                            print_r(json_encode(array("error"=>"error can't highlight the event")));
                            die();
                            }
                    }else {
                        print_r(json_encode(array(
                            'error' => "You Don't Have Permission to make this action",
                        )));
                        die();
                        }
                }catch (\Throwable $th) {
                            print_r(json_encode(array(
                                'error' => "Authentication error 1",
                            )));
                }
            }else {
                print_r(json_encode(array(
                'error' => "Authentication error 2",
                )));}
            }





    public function regular($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                // dont forget to take out the student role
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    try{
                    $currentUser = $this->userModel->getEmailById($infos->id);
                    }catch (\Throwable $th) {
                        print_r(json_encode(array(
                            'error' => "error can't get info user",
                        )));
                        die();
                    }if($this->eventModel->regular($id)){
                            $notif = $this->notifModel->add("event has been set to regular by the user: $currentUser->email");
                            print_r(json_encode(array("message"=>"the status of the id:$id has been set to regular")));
                        }else{
                            print_r(json_encode(array("error"=>"error can't set the event to regular")));
                            die();
                            }
                    }else {
                        print_r(json_encode(array(
                            'error' => "You Don't Have Permission to make this action",
                        )));
                        die();
                        }
                }catch (\Throwable $th) {
                            print_r(json_encode(array(
                                'error' => "Authentication error 1",
                            )));
                }
            }else {
                print_r(json_encode(array(
                'error' => "Authentication error 2",
                )));}
            }

}
