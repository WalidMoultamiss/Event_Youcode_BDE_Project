<?php

class EventModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getEvents()
    {
        $this->db->query("SELECT * FROM events");
        return $this->db->all();
    }

    public function eventInfo($id)
    {
        $this->db->query("SELECT * FROM events WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                events
            SET
                title = :title,
                event_where = :event_where,
                event_when = :event_when,
                max_places = :max_places,
                classes = :classes,
                description = :description,
                url_img = :url_img,
                status = :status
                ");
            $this->db->bind(':title', $data->title);
            $this->db->bind(':event_where', $data->event_where);
            $this->db->bind(':event_when', $data->event_when);
            $this->db->bind(':max_places', $data->max_places);
            $this->db->bind(':classes', $data->classes);
            $this->db->bind(':url_img', $data->url_img);
            $this->db->bind(':description', $data->description);
            $this->db->bind(':status', $data->status);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

    public function archive($id)
    {
        try {
            $this->db->query("UPDATE
                events
            SET
                status = 'archived'
            WHERE id=:id
            ");
            $this->db->bind(':id', $id);
            $this->db->single();
            // $this->db->   ();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }


    public function highlighted($id)
    {
        try {
            $this->db->query("UPDATE
                events
            SET
                status = 'highlighted'
            WHERE id=:id
            ");
            $this->db->bind(':id', $id);
            $this->db->single();
            // $this->db->   ();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }
    
    
    public function regular($id)
    {
        try {
            $this->db->query("UPDATE
                events
            SET
                status = 'regular'
            WHERE id=:id
            ");
            $this->db->bind(':id', $id);
            $this->db->single();
            // $this->db->   ();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }



    public function edit($eventData)
    {
        $this->db->query("UPDATE `events` SET `max_places`=:max_places WHERE id=:id");
        $this->db->bind(':id', $eventData->id);
        $this->db->bind(':max_places', $eventData->max_places);
        return $this->db->all();
    }

}
