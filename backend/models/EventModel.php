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

    public function ReturnFlights($id)
    {
        $currFlight = $this->flightInfo($id);
        if ($currFlight) {
            $this->db->query("SELECT * FROM flight WHERE CityFrom = :CityFrom AND CityTo = :CityTo ");
            $this->db->bind(':CityTo', $currFlight->CityFrom);
            $this->db->bind(':CityFrom', $currFlight->CityTo);
            
            // $this->db->bind(':going_time', explode(' ', $currFlight->going_time)[0]);
            return $result = $this->db->all();
        }
        // print_r($currFlight);
        
    }


    public function getBySearch($data)
    {
        try {
            $this->db->query("SELECT * FROM
                flight
            WHERE
                 CityTo = :CityTo and airport = :airport
            BETWEEN :going_time '00:00:00' AND :going_time '23:59:59'
            ");
            $this->db->bind(':going_time', $data->going_time);
            $this->db->bind(':airport', $data->airport);
            $this->db->bind(':CityTo', $data->CityTo);
            $result = $this->db->all();
            return $result;

        } catch (\PDOExeption $err) {
            return $err->getMessage();
        }

    }

}
