<?php

require_once '../vendor/autoload.php';

class Event extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->eventModel = $this->model('EventModel');
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
                    $flight = $this->eventModel->add($this->data);
                    if ($flight) {
                        print_r(json_encode(array(
                            "message" => "Flight Created with success 💥",
                        )));
                    }
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

    public function archive($id)
    {
        if($this->eventModel->archive($id)){
        print_r(json_encode(array("message"=>"the status of the id:$id has been set to archived")));
        }else{
            print_r(json_encode(array("error"=>"error")));
        }
        
    }


    public function highlighted($id)
    {
        if($this->eventModel->highlighted($id)){
            print_r(json_encode(array("message"=>"the status of the id:$id has been set to highlighted")));
            }else{
                print_r(json_encode(array("error"=>"error")));
            }
    }


    public function regular($id)
    {
        print_r($id);

        {
            if($this->eventModel->regular($id)){
                print_r(json_encode(array("message"=>"the status of the id:$id has been set to regular")));
                }else{
                    print_r(json_encode(array("error"=>"error")));
                }
        }
    }


    public function edit($id)
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "student") {
                    $flight = $this->eventModel->edit($this->data, $id);
                    if ($flight) {
                        print_r(json_encode(array(
                            "message" => "Flight Edited with success 💥",
                        )));
                    }
                } else {
                    print_r(json_encode(array(
                        'error' => "You Don't Have Permission to make this action 💢 ",
                    )));
                    die();
                }
            } catch (\Throwable $th) {
                print_r(json_encode(array(
                    'error' => "Authentication error 💢 ",
                )));
            }
        } else {
            print_r(json_encode(array(
                'error' => "Authentication error 💢 "
            )));
        }

    }


    public function search(){
        $result = $this->eventModel->getBySearch($this->data);
        print_r(json_encode($result));
    }

}
