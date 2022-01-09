<?php
require_once('models/user.php');

class Midwife extends User implements AdviceObserver
{
    private $connection;

    private $id;
    private $email;
    private $center;
    private $area;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function update()
    {
    }

    ///////////////////////////////////////////////////////////
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getCentre()
    {
        return $this->center;
    }
    public function setCentre($center)
    {
        $this->center = $center;
        return $this;
    }

    public function getArea()
    {
        return $this->area;
    }
    public function setArea($area)
    {
        $this->area = $area;
        return $this;
    }
    ////////////////////////////////////////////////////////////

    public function getDetails()
    {
        $query = $this->connection->query("SELECT * FROM midwife");
        $details = array();
        while ($row = $query->fetch_assoc()) {
            array_push($details, $row);
        }
        return $details;
    }

    public function getChildReportDetails($mail, $search_)
    {
        $childReportDetails = array();
        if ($search_ != '') {
            // echo "search<br>";
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

    //this is not completed
    public function getD($search_)
    {
        $advices = array();
        if ($search_ != '') {

            echo "search<br>";
            $search = mysqli_real_escape_string($this->connection, $search_);
            $query = $this->connection->query("SELECT * FROM midwife WHERE (id LIKE '%{$search}%'or areas '%{$search}%' OR email LIKE '%{$search}% );");
            echo ("query");
        } else {
            $query = $this->connection->query("SELECT * FROM midwife ;");
        }

        while ($row = $query->fetch_assoc()) {
            array_push($advices, $row);
        }
        return $advices;
    }
}
