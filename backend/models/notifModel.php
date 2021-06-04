<?php

class notifModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getNotif()
    {
        $this->db->query("SELECT * FROM notifications");
        return $this->db->all();
    }

    public function add($message)
    {
        try {
            $this->db->query("INSERT INTO
                notifications
            SET
                notif_message = :notif_message
                ");
            $this->db->bind(':notif_message', $message);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

}
