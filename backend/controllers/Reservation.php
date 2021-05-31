<?php

require_once '../vendor/autoload.php';
require_once '../vendor/fpdf/fpdf.php';

class Reservation extends Controller
{

    public $data = [];

    public function __construct()
    {
        $this->resModel = $this->model('ReservationModel');
        $this->flightModel = $this->model('FlightModel');
    }

    public function me()
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        $cin = $this->verifyAuth($headers[1]);
        $cin = $cin->cin;
        if ($headers) {
            try {
                $reservations = $this->resModel->getMyReservations($cin);
                print_r(json_encode($reservations));
            } catch (\Throwable $th) {
                //throw $th;
            }
        }
    }

    public function all()
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $infos = $this->verifyAuth($headers[1]);
                if ($infos->role == "Admin") {
                    $reservations = $this->resModel->getReservations();
                    if ($reservations) {
                        print_r(json_encode($reservations));
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
                'error' => "Login first please 💢 ",
            )));
        }

    }

    public function add()
    {

        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        $cin = $this->verifyAuth($headers[1]);
        $cin = $cin->cin;
        if ($headers) {
            try {
                $currentfilght = $this->flightModel->flightInfo($this->data->flight);
                if ($currentfilght) {
                    if ($this->data->accepted_return == 1 && $currentfilght->available_places >= $this->data->guests) {
                        $result = $this->resModel->addWithReturn($this->data);
                        $currentfilght->available_places = $currentfilght->available_places - $this->data->guests;
                        $this->flightModel->edit($currentfilght, $this->data->flight);

                    } else if ($currentfilght->available_places >= $this->data->guests) {
                        $result = $this->resModel->add($this->data);
                        $currentfilght->available_places = $currentfilght->available_places - $this->data->guests;
                        $this->flightModel->edit($currentfilght, $this->data->flight);
                    } else {
                        print_r(json_encode(array('error' => 'Plane Full bro 😩')));
                        die();
                    };
                } else {
                    print_r(json_encode(array('error' => 'Flight did not exist 🙄')));
                    die();
                }

                print_r(json_encode(array(
                    'message' => 'Reservation done 🐱‍🏍',
                    'result' => $result)
                ));
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    public function delete($id)
    {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $this->verifyAuth($headers[1]);
                $this->resModel->delete($id);
                print_r(json_encode(array(
                    "message" => "deleted 😱",
                )));
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    function print($id) {
        $headers = apache_request_headers();
        $headers = isset($headers['Authorization']) ? explode(' ', $headers['Authorization']) : null;
        if ($headers) {
            try {
                $this->verifyAuth($headers[1]);

                $pdf = new FPDF();
                $pdf->AddPage();
                $pdf->SetFont('Arial', 'B', 16);
                $pdf->Cell(40, 10, 'Hello World!');
                $pdf->Output();
                exit;
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

}
