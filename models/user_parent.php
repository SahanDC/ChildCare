<?php
require_once('models/user.php');

class User_Parent extends User implements AdviceObserver
{
    private $connection;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getReportsByParent($parent_id)
    {
        $query = $this->connection->query("SELECT * FROM child_report WHERE GuardianId = $parent_id ORDER BY Birthday ASC");
        $reports = array();
        while ($row = $query->fetch_assoc()) {
            $reports[] = $row;
        }
        return $reports;
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

    public function update()
    {
    }
}
