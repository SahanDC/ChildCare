<?php
class Midwife{
    private $connection;

    public $id;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getDetails(){
        $query = $this->connection->query("SELECT * FROM midwife");
        $details = array();
        while ($row = $query->fetch_assoc()) {
            array_push($details, $row);
        }
        return $details;
    }

    public function getChildReportDetails($mail, $search){
        $childReportDetails = array();
        if (isset($_GET['search'])) {
            $query = $this->connection->query("SELECT * FROM child_report WHERE (ChildId LIKE '%{$search}%' OR (name LIKE '%{$search}%'))");
        } else {
            $query = $this->connection->query("select * from child_report WHERE MidwifeEmail = '$mail'");
        }
        while ($row = $query->fetch_assoc()) {
            array_push($childReportDetails, $row);
        }
        return $childReportDetails;
    }
}
?>