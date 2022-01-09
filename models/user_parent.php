<?php
require_once('models/user.php');
include('controllers/autoloader.php');

class User_Parent extends User implements AdviceObserver
{
    private $connection;
    private $email;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function getEmail()
    {
        return $this->email;
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

    public function getParentById($id)
    {
        $query = $this->connection->query("SELECT * FROM user WHERE id = $id");
        $user = $query->fetch_assoc();
        return $user;
    }

    public function update($topic, $content)
    {
        // $parent = $this->connection->query("SELECT * FROM user WHERE id = $id");

        $email = $this->getEmail();
        $email = 'thamindukiridana@gmail.com';
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
}
