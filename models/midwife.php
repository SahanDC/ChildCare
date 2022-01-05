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

    public function getChildReportDetails($mail, $search_){
        $childReportDetails = array();
        if ($search_ !='') {
            echo "search<br>";
            $search = mysqli_real_escape_string($this->connection, $search_);
            //$query = "SELECT * FROM child_report WHERE (ChildId LIKE '%{$search}%' OR (name LIKE '%{$search}%')) And MidwifeEmail = '$mail'";
            $query = $this->connection->query("SELECT * FROM child_report WHERE (ChildId LIKE '%{$search}%' OR (name LIKE '%{$search}%')) And MidwifeEmail = '$mail'");
        } else {
            //$query = "SELECT * FROM child_report WHERE MidwifeEmail = '$mail'";
            $query = $this->connection->query("SELECT * FROM child_report WHERE MidwifeEmail = '$mail'");
        }
        //$result = mysqli_query($this->connection,$query);

        // while ($row = mysqli_fetch_assoc($result)) {
        //     array_push($childReportDetails, $row);
        //     print_r($row);
        // }
        while ($row = $query->fetch_assoc()) {
            array_push($childReportDetails, $row);
            //print_r($row);
        }
        return $childReportDetails;
    }
}
?>