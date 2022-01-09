<?php
class User
{

    private $connection;

    public $id;
    public $first_name;
    public $last_name;
    public $email;
    public $mobile_number;
    public $password;
    public $token;
    public $is_active;
    public $date_time;
    public $role;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getUserById($id)
    {
        $query = $this->connection->query("SELECT * FROM user WHERE id = $id");
        $user = $query->fetch_assoc();
        return $user;
    }
}
