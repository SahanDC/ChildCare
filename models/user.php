<?php
class User
{

    private $connection;

    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $mobile_number;
    private $password;
    private $token;
    private $is_active;
    private $date_time;
    private $role;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUserById($id)
    {
        $query = $this->connection->query("SELECT * FROM user WHERE id = $id");
        $user = $query->fetch_assoc();
        return $user;
    }
}
