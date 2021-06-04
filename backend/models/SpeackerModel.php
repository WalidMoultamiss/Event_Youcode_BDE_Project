<?php

class SpeackerModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getSpeackers()
    {
        $this->db->query("SELECT * FROM speacker");
        return $this->db->all();
    }


    public function speackerInfo($id)
    {
        $this->db->query("SELECT * FROM speacker WHERE id_speaker = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                speacker
            SET
                full_name = :full_name,
                url_img = :url_img,
                description = :description,
                id_event = :id_event
                ");
            $this->db->bind(':full_name', $data->full_name);
            $this->db->bind(':url_img', $data->url_img);
            $this->db->bind(':description', $data->description);
            $this->db->bind(':id_event', $data->id_event);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }
}
