<?php

require_once '../vendor/autoload.php';

class Flight extends Controller
{

    public $data = [];
    public $key = "Falc0n";

    public function __construct()
    {
        $this->userModel = $this->model('FlightModel');
    }

    public function flights()
    {
        $flights = $this->userModel->getFlights();
        print_r(json_encode($flights));
    }

    public function info($id)
    {
        $flight = $this->userModel->flightInfo($id);
        print_r(json_encode($flight));
    }

    public function Return($id)
    {
        $flight = $this->userModel->ReturnFlights($id);
        print_r(json_encode($flight));
    }


    public function add()
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "Admin") {
                    $flight = $this->userModel->add($this->data);
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

    public function delete($id)
    {
        print_r($id);
        $this->userModel->delete($id);
    }

    public function edit($id)
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "Admin") {
                    $flight = $this->userModel->edit($this->data, $id);
                    if ($flight) {
                        print_r(json_encode(array(
                            "message" => "Flight Edited with success 💥",
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
        $result = $this->userModel->getBySearch($this->data);
        print_r(json_encode($result));
    }

}
