<?php

require_once '../vendor/autoload.php';

class Passenger extends Controller
{

    public function __construct()
    {
        $this->passModel = $this->model('PassengerModel');
    }

    public function add()
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        $cin = $this->verifyAuth($headers[1]);
        $cin = $cin->cin;
        if($headers){
            try{
                if($this->passModel->add($cin,$this->data)){
                    print_r(json_encode(array('message'=>'Reservation done 🐱‍🏍')));
                }
            }catch(\Throwable $th){
                throw $th;
            }
        }
    }

    public function resid($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        $cin = $this->verifyAuth($headers[1]);
        $cin = $cin->cin;
        if($headers){
            try{
                $result = $this->passModel->byRes($id);
                print_r(json_encode($result));
            }catch(\Throwable $th){
                throw $th;
            }
        }
    }

}
