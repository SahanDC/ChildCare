<?php
include('config/db.php');
require_once('advice.php');
require_once('adviceobserver.php');
require_once('user_parent.php');
require_once('midwife.php');

// Swiftmailer library
require_once './lib/vendor/autoload.php';

global $connection;

// $parentObj = new User_Parent($connection);
// $midwifeObj = new Midwife($connection);

class manager
{
    private $connection;
    private $userId;
    private $name;
    private $email;
    public $Errors;

    private $midwife_array;
    private $Advice_array;
    private $childReport_array;


    private $observers = array();

    public function __construct($connection, $id, $name, $email)
    {
        $this->connection = $connection;
        $this->userId = $id;
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the value of Advice_array
     */
    public function getAdvice_array()
    {
        return $this->Advice_array;
    }

    public function getMidwives($search_)
    {
        if ($search_ != '') {

            // echo "search<br>";
            $search = mysqli_real_escape_string($this->connection, $search_);
            $query = $this->connection->query("SELECT * FROM midwife WHERE (id LIKE '%{$search}%') OR (areas LIKE '%{$search}%') OR (email LIKE '%{$search}%');");
            // echo ("query");
        } else {
            $query = $this->connection->query("SELECT * FROM midwife;");
        }

        while ($row = $query->fetch_assoc()) {
            $midwife = new Midwife($this->connection);
            $midwife->setId($row['id']);
            $midwife->setEmail($row['email']);
            $midwife->setCentre($row['centre']);
            $midwife->setArea($row['areas']);

            $this->midwife_array[$row['id']] = $midwife;
        }
        // print_r($midwives);
        return $this->midwife_array;
    }

    public function addMidwife($email, $centre, $areas, $noc)
    {
        $query = "INSERT INTO midwife (email,centre,areas,noc) VALUES ('{$email}','{$centre}','{$areas}',{$noc})";
        $insert = mysqli_query($this->connection, $query);
        if (!$insert) {
            echo mysqli_error($this->connection);
        } else {
            echo "";
        }
    }

    public function getObservers()
    {
        $query = $this->connection->query("SELECT * FROM user WHERE role != 'manager'");
        $this->observers = array();
        while ($row = $query->fetch_assoc()) {
            if ($row['role'] == 'parent') {
                $observer = new User_parent($this->connection);
                $observer->setEmail($row['email']);
            }
            if ($row['role'] == 'midwife') {
                $observer = new Midwife($this->connection);
                $observer->setEmail($row['email']);
            }
            array_push($this->observers, $observer);
        }
        return $this->observers;
    }

    public function get_advices()
    {
        $query = $this->connection->query("SELECT * FROM advice WHERE isdeleted = 0 ORDER BY id ");
        while ($row = $query->fetch_assoc()) {
            $advice = new Advice($this->connection);
            $advice->set_advice($row['id'], $row['topic'], $row['content'], $row['isdeleted']);
            $this->Advice_array[$row['id']] = $advice;
        }
        // print_r($requests);
        return $this->Advice_array;
    }

    public function deleteAdvice($id)
    {
        $this->Advice_array[$id]->deleteAdvice();
    }

    public function editAdvice($connection, $object, $topic, $content)
    {
        $object->editAdvice($connection, $topic, $content);
    }

    function addAdvice($topic, $content)
    {
        $query = $this->connection->query("INSERT INTO advice (topic, content, isdeleted) VALUES ('{$topic}','{$content}',0)");
        if (!$query) {
            echo mysqli_error($this->connection);
        } else {
            echo "";
        }
        $this->notifyAllObservers($topic, $content);
    }

    // public function getRequestById($id)
    // {
    //     $query = $this->connection->query("SELECT * FROM request where id = $id");
    //     $request = $query->fetch_assoc();
    //     return $request;
    // }

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


    public function getChildreports($search_)
    {
        if ($search_ != '') {

            // echo "search<br>";
            $search = mysqli_real_escape_string($this->connection, $search_);
            $query = $this->connection->query("SELECT * FROM child_report WHERE (name LIKE '%{$search}%' or ChildId LIKE '%{$search}%') ORDER BY ChildId");
            // echo ("query");
        } else {
            $query = $this->connection->query("SELECT * FROM child_report ");
        }

        while ($row = $query->fetch_assoc()) {
            $childreport = ChildReport:: getChildreport($row['ChildId']);
            $childreport->addDetails($row);

            $this->childReport_array[$row['ChildId']] = $childreport;
        }
        // print_r($midwives);
        return $this->childReport_array;
    }


    // public function addObserver($observer)
    // {
    //     $this->observers = $this->getObservers();
    //     $this->observers[] = $observer;
    // }

    public function notifyAllObservers($topic, $content)
    {
        $this->observers = $this->getObservers();
        foreach ($this->observers as $observer) {
            $observer->update($topic, $content);
        }
    }

    public function createChildReport($child_name,$birthday,$guardian,$Request_id,$birth_place,$area,$center,$midwife_email,$NVD,$vaccines){
        $requestobj = new Request($this->connection);
        $request = $requestobj->getRequestById($Request_id);
        $guardianId = $request['parent_id'];
            $childreport = ChildReport::cloneChildreport();
            if($request['clinic_card']!=null){
                $errors=$childreport->createChildReport($child_name,$birthday,$guardian,$guardianId,$Request_id,$birth_place,$area,$center,$midwife_email,$NVD,$vaccines);
            }else{
                $errors=$childreport->createChildReport_Noreport($child_name,$birthday,$guardian,$guardianId,$Request_id,$birth_place,$area,$center,$midwife_email,$NVD);
            }
        array_merge($this->Errors,$errors);
        if(empty($errors)){
            $requestobj->createReport($Request_id);
            array_push($this->Errors,"change state");
        }
        return $this->Errors;
    }
}
