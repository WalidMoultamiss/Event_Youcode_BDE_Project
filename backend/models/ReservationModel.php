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

    public function getReservationByInfos($id, $events)
    {
        $this->db->query("SELECT * FROM 
            reservation r
        INNER JOIN members on members.id = :id INNER JOIN events on events.id = :id_events");
        $this->db->bind(':id', $id);
        $this->db->bind(':id_events', $events);
        return $this->db->single();
    }

    // public function addWithReturn($data)
    // {
    //     try {
    //         $this->db->query("INSERT INTO
    //             reservation
    //         SET
    //             id = :id,
    //             events = :events
    //         ");
    //         $this->db->bind(':id', $data->id);
    //         $this->db->bind(':events', $data->events);
    //         $this->db->single();
    //         return $this->getReservationByInfos($data->id, $data->events);
    //     } catch (\PDOExeption $err) {
    //         return $err->getMessage();
    //         die();
    //     }

    //     return true;
    // }

    public function add($data)
    {
        // die(var_dump($data));
        try {
            $this->db->query("INSERT INTO
            reservation
        SET
            id_member = :id_member,
            id_event = :id_event
        ");
            $this->db->bind(':id_member', $data->id_member);
            $this->db->bind(':id_event', $data->id_event);
            $this->db->single();
            return $this->getReservationByInfos($data->id_member, $data->id_event);
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
