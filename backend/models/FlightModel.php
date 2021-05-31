<?php

class FlightModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getFlights()
    {
        $this->db->query("SELECT * FROM flight");
        return $this->db->all();
    }

    public function flightInfo($id)
    {
        $this->db->query("SELECT * FROM flight WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                flight
            SET
                going_time = :going_time,
                arriving_time = :arriving_time,
                Country_from = :Country_from,
                Country_to = :Country_to,
                CityFrom = :CityFrom,
                CityTo = :CityTo,
                price = :price,
                airport = :airport,
                available_places = :available_places
            ");
            $this->db->bind(':going_time', $data->going_time);
            $this->db->bind(':arriving_time', $data->arriving_time);
            $this->db->bind(':Country_from', $data->Country_from);
            $this->db->bind(':Country_to', $data->Country_to);
            $this->db->bind(':CityFrom', $data->CityFrom);
            $this->db->bind(':price', $data->price);
            $this->db->bind(':airport', $data->airport);
            $this->db->bind(':CityTo', $data->CityTo);
            $this->db->bind(':available_places', $data->available_places);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM Flight WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->execute();
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

    public function edit($data, $id)
    {
        try {
            $this->db->query("UPDATE
                flight
            SET
                going_time = :going_time,
                arriving_time = :arriving_time,
                Country_from = :Country_from,
                Country_to = :Country_to,
                CityFrom = :CityFrom,
                CityTo = :CityTo,
                price = :price,
                airport = :airport,
                available_places = :available_places
            WHERE id=:id
            ");
            $this->db->bind(':going_time', $data->going_time);
            $this->db->bind(':arriving_time', $data->arriving_time);
            $this->db->bind(':Country_from', $data->Country_from);
            $this->db->bind(':Country_to', $data->Country_to);
            $this->db->bind(':CityFrom', $data->CityFrom);
            $this->db->bind(':price', $data->price);
            $this->db->bind(':airport', $data->airport);
            $this->db->bind(':CityTo', $data->CityTo);
            $this->db->bind(':available_places', $data->available_places);
            $this->db->bind(':id', $id);

            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
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
