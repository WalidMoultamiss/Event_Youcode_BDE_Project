<?php
class ReservationModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getMyReservations($cin)
    {
        $this->db->query("SELECT * FROM flight f,reservation r,user u WHERE f.id=r.flight AND :Client=r.client AND :Client=u.cin ORDER BY  reserved_time DESC");

        $this->db->bind(':Client', $cin);
        return $this->db->all();
    }

    public function getReservations()
    {
        $this->db->query("SELECT * FROM reservation");
        return $this->db->all();
    }

    public function getReservationByInfos($cin, $flight)
    {
        $this->db->query("SELECT * FROM
            reservation
        WHERE client = :Client AND flight = :flight AND reserved_time
        ORDER BY  reserved_time DESC
        LIMIT 1");

        $this->db->bind(':Client', $cin);
        $this->db->bind(':flight', $flight);
        return $this->db->single();
    }

    public function addWithReturn($data)
    {
        try {
            $this->db->query("INSERT INTO
                reservation
            SET
                accepted_return = :accepted_return,
                client = :cin,
                flight = :flight,
                return_Flight = :return_Flight
            ");
            $this->db->bind(':cin', $data->cin);
            $this->db->bind(':accepted_return', $data->accepted_return);
            $this->db->bind(':flight', $data->flight);
            $this->db->bind(':return_Flight', $data->return_Flight);

            $this->db->single();
            return $this->getReservationByInfos($data->cin, $data->flight);
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
            reservation
        SET
            accepted_return = :accepted_return,
            client = :cin,
            flight = :flight
        ");
            $this->db->bind(':cin', $data->cin);
            $this->db->bind(':accepted_return', $data->accepted_return);
            $this->db->bind(':flight', $data->flight);

            $this->db->single();
            return $this->getReservationByInfos($data->cin, $data->flight);
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

    public function delete($id)
    {
        $this->db->query('DELETE FROM reservation WHERE id=:id');
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
