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

    public function myReservation()
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
                // dint forget student to admin
                if ($infos->role == "student") {
                    $reservations = $this->resModel->getReservations();
                    if ($reservations) {
                        print_r(json_encode($reservations));
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
                $currentEvent = $this->eventModel->eventInfo($this->data->event);
                if ($currentEvent) {
                    if ($currentEvent->available_places >= $this->data->guests) {
                        $result = $this->resModel->add($this->data);
                        $currentEvent->available_places = $currentEvent->available_places - $this->data->guests;
                        $this->eventModel->edit($currentEvent, $this->data->event);
                    } else {
                        print_r(json_encode(array('error' => 'Event Full bro 😩')));
                        die();
                    };
                } else {
                    print_r(json_encode(array('error' => 'Event did not exist 🙄')));
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
