<?php
include('config/db.php');
require_once('models/user.php');
require_once('models/AdviceObserver.php');
require_once('models/user.php');

class Midwife extends User implements AdviceObserver
{
    private $connection;

    private $email;
    private $midwifeId;
    private $center;
    private $area;


    public function __construct($db, $email)
    {
        $this->connection = $db;
        $this->email = $email;
    }

    public function update($topic, $content)
    {
        $email = $this->getEmail();
        // $email = 'thamindukiridana@gmail.com';
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
            ->setUsername('childcare.cse@gmail.com')
            ->setPassword('childcare19');

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        // Create a message
        $message = (new Swift_Message($topic))
            ->setFrom([$email => 'Child Care'])
            ->setTo($email)
            ->addPart($content, "text/html")
            ->setBody('Hello! User');

        // Send the message
        $result = $mailer->send($message);
    }

    ///////////////////////////////////////////////////////////
    public function getId()
    {
        return $this->midwifeId;
    }
    public function setId($midwifeId)
    {
        $this->midwifeId = $midwifeId;
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
            $search = mysqli_real_escape_string($this->connection, $search_);
            $query = $this->connection->query("SELECT * FROM child_report WHERE (ChildId LIKE '%{$search}%' OR (name LIKE '%{$search}%')) And MidwifeEmail = '$mail'");
        } else {
            $query = $this->connection->query("SELECT * FROM child_report WHERE MidwifeEmail = '$mail'");
        }

        while ($row = $query->fetch_assoc()) {
            array_push($childReportDetails, $row);
        }
        return $childReportDetails;
    }

    public function vaccinationWithin2Weeks($childReportDetails)
    {
        $vaccinateWithinTwoWeeks = array();
        foreach ($childReportDetails as $item) {
            if (((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 < 14) && ((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 > 0)) {
                array_push($vaccinateWithinTwoWeeks, $item);
            }
        }
        return $vaccinateWithinTwoWeeks;
    }

    public function vaccinationMissed($childReportDetails)
    {
        $vaccinationMiss = array();
        foreach ($childReportDetails as $item) {
            if ((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 < 0) {
                array_push($vaccinationMiss, $item);
            }
        }
        return $vaccinationMiss;
    }

    public function viewChildReport($id)
    {
        $_SESSION['viewer'] = 'midwife';
        return "window.location ='child_report.php?ChildId={$id}'";
    }
    public function viewMedicalAdvices()
    {
        $_SESSION['viewer'] = 'midwife';
        return 'health advices.php';
    }
}
