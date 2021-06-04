<?php

class SugModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function getSugs()
    {
        $this->db->query("SELECT * FROM suggestion");
        return $this->db->all();
    }

    public function add($data)
    {
        try {
            $this->db->query("INSERT INTO
                suggestion
            SET
                title_suggestion = :title_suggestion,
                description = :description,
                goal = :goal,
                id_member = :id_member
                ");
            $this->db->bind(':title_suggestion', $data->title_suggestion);
            $this->db->bind(':description', $data->description);
            $this->db->bind(':goal', $data->goal);
            $this->db->bind(':id_member', $data->id_member);
            $this->db->single();
        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

}
