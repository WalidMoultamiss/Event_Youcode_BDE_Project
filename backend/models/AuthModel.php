<?php

class AuthModel
{
    private $db;
    public function __construct()
    {
        $this->db = new DB();
    }

    public function add($refreshToken, $user)
    {
        try {
            $this->db->query("INSERT INTO
                Auth
            SET
                user_id = :user_id,
                refreshToken = :refreshToken
                ");

            $this->db->bind(':refreshToken', $refreshToken);
            $this->db->bind(':user_id', $user);
            $this->db->single();

        } catch (\PDOExeption $err) {
            return $err->getMessage();
            die();
        }

        return true;
    }

    public function currToken($id)
    {
        $this->db->query("SELECT * FROM Auth WHERE user_id = :id ORDER BY id DESC LIMIT 1");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function expiredToken($id)
    {
        $this->db->query("UPDATE Auth
        SET
            expired = :expired WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':expired', 1);
        return $this->db->single();
    }
    public function count($id,$count)
    {
        $this->db->query("UPDATE Auth
        SET
            count = :count WHERE id = :id");
        $this->db->bind(':id', $id);
        $this->db->bind(':count', $count);
        return $this->db->single();
    }
}
