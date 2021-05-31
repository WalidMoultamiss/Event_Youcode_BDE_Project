<?php

class PassengerModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getAll()
    {
        $this->db->query("SELECT * FROM passanger");
        return $this->db->all();
    }

    public function byRes($id)
    {
        $this->db->query("SELECT * FROM passanger WHERE reservation = :id");
        $this->db->bind(':id' , $id);
        return $this->db->all();
    }

    public function add($owner,$data)
    {
        try {
            $this->db->query("INSERT INTO
                passanger
            SET
                cin = :cin,
                first_name = :first_name,
                last_name = :last_name,
                phone = :phone,
                email = :email,
                address = :address,
                updated = :updated,
                num_passport = :num_passport,
                birth_date = :birth_date,
                ticket_owner = :ticket_owner,
                reservation = :reservation
            ");
            $this->db->bind(':cin', $data->cin);
            $this->db->bind(':first_name', $data->first_name);
            $this->db->bind(':last_name', $data->last_name);
            $this->db->bind(':phone', $data->phone);
            $this->db->bind(':email', $data->email);
            $this->db->bind(':ticket_owner', $owner);
            $this->db->bind(':address', $data->address);
            $this->db->bind(':updated', time());
            $this->db->bind(':num_passport', $data->num_passport);
            $this->db->bind(':birth_date', $data->birth_date);
            $this->db->bind(':reservation', $data->reservation);
            $this->db->single();
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }
    
}




