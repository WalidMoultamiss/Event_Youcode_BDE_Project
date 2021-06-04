<?php

require_once '../vendor/autoload.php';

class notification extends Controller
{

    public $data = [];
    public $key = "youcode";

    public function __construct()
    {
        $this->notifModel = $this->model('notifModel');
    }

    public function all()
    {
        $notifs = $this->notifModel->getNotifs();
        print_r(json_encode($notifs));
    }

    public function info($id)
    {
        $events = $this->eventModel->eventInfo($id);
        print_r(json_encode($events));
    }

    public function add($message)
    {
        try {
            $notifs = $this->notifModel->add($message);
            if ($notifs) {
                print_r(json_encode(array(
                    "message" => "new notification has been added",
                )));
            } else {
                print_r(json_encode(array(
                    'error' => "You Don't Have Permission to make this action 💢 ",
                )));
                die();
            }

        } catch (\Throwable $th) {
            print_r(json_encode(array(
                'error' => "error ",
            )));
        }
    }

    public function search()
    {
        $result = $this->eventModel->getBySearch($this->data);
        print_r(json_encode($result));
    }
}
