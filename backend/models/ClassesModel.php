<?php

class ClassesModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getClasses()
    {
        $this->db->query("SELECT * FROM class");
        return $this->db->all();
    }


    public function classesInfo($id)
    {
        $this->db->query("SELECT * FROM class WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                class
            SET
                ClassName = :ClassName,
                youcode = :youcode
                ");
            $this->db->bind(':ClassName', $data->ClassName);
            $this->db->bind(':youcode', $data->youcode);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }
}
