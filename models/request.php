<?php
class Request
{

    private $connection;

    public $id;
    public $parent_id;
    public $birth_certificate;
    public $clinic_card;
    public $uploaded_on;
    public $status;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getRequestById($id)
    {
        $query = $this->connection->query("SELECT * FROM request where id = $id");
        $request = $query->fetch_assoc();
        return $request;
    }

    public function getRequests()
    {
        $query = $this->connection->query("SELECT * FROM request ORDER BY uploaded_on DESC");
        $requests = array();
        while ($row = $query->fetch_assoc()) {
            // $requests[] = $row;
            array_push($requests, $row);
        }
        return $requests;
    }

    public function getRequestsByParent($parent_id)
    {
        $query = $this->connection->query("SELECT * FROM request WHERE parent_id = $parent_id ORDER BY uploaded_on DESC ");
        $requests = array();
        while ($row = $query->fetch_assoc()) {
            $requests[] = $row;
        }
        return $requests;
    }
}
