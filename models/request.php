<?php

// include('config/db.php');

class Request
{
    private $connection;

    public $id;
    public $parent_id;
    public $birth_certificate;
    public $clinic_card;
    public $uploaded_on;
    public State $status;

    public function __construct($db)
    {
        $this->connection = $db;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        switch ($status) {
            case $status instanceof Valid:
                $st = 'Valid';
                break;
            case $status instanceof Invalid:
                $st = 'Invalid';
                break;
            case $status instanceof Created:
                $st = 'Created';
                break;
        }

        return $this->connection->query("UPDATE request set status = '$st' where id = $this->id");
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

    public function createRequest1($parent_id, $filename)
    {
        $this->id = $this->connection->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
        WHERE table_name = 'request'");
        $this->parent_id = $parent_id;
        $this->birth_certificate = $filename;
        date_default_timezone_set('Asia/Colombo');
        $this->uploaded_on = date('Y-m-d H:i:s');

        $this->status = new NewRequest();

        return $this->connection->query("INSERT into request (parent_id, birth_certificate, uploaded_on, status) VALUES ('$this->parent_id', '$this->birth_certificate', '$this->uploaded_on', 'New')");
    }

    public function createRequest2($parent_id, $filename1, $filename2)
    {
        $this->id = $this->connection->query("SELECT `auto_increment` FROM INFORMATION_SCHEMA.TABLES
        WHERE table_name = 'request'");
        $this->parent_id = $parent_id;
        $this->birth_certificate = $filename1;
        $this->clinic_card = $filename2;
        date_default_timezone_set('Asia/Colombo');
        $this->uploaded_on = date('Y-m-d H:i:s');

        $this->status = new NewRequest();

        return $this->connection->query("INSERT into request (parent_id, birth_certificate, clinic_card, uploaded_on, status) VALUES ('$this->parent_id', '$this->birth_certificate', '$this->clinic_card', '$this->uploaded_on', 'New')");
    }

    public function validateDocuments($id)
    {
        $request = $this->getRequestById($id);
        $this->id = $request['id'];
        $this->parent_id = $request['parent_id'];
        $this->birth_certificate = $request['birth_certificate'];
        $this->clinic_card = $request['clinic_card'];
        $this->uploaded_on = $request['uploaded_on'];

        // if ($request['status'] == 'New') {
        //     $this->status = new NewRequest();
        // }

        // if ($request['status'] == 'Invalid') {
        //     $this->status = new Invalid();
        // }

        $st = $request['status'];
        switch ($st) {
            case $st == 'New':
                $this->status = new NewRequest();
                break;
            case $st == 'Invalid':
                $this->status = new Invalid();
                break;
            case $st == 'Valid':
                $this->status = new Valid();
                break;
            case $st == 'Created':
                $this->status = new Created();
                break;
        }

        return $this->status->validate($this);
        // return $this->connection->query("UPDATE request set status = 'Valid' where id = $id");;
    }

    public function declineDocuments($id)
    {
        $request = $this->getRequestById($id);
        $this->id = $request['id'];
        $this->parent_id = $request['parent_id'];
        $this->birth_certificate = $request['birth_certificate'];
        $this->clinic_card = $request['clinic_card'];
        $this->uploaded_on = $request['uploaded_on'];

        // if ($request['status'] == 'New') {
        //     $this->status = new NewRequest();
        // }

        // if ($request['status'] == 'Valid') {
        //     $this->status = new Valid();
        // }
        $st = $request['status'];
        switch ($st) {
            case $st == 'New':
                $this->status = new NewRequest();
                break;
            case $st == 'Invalid':
                $this->status = new Invalid();
                break;
            case $st == 'Valid':
                $this->status = new Valid();
                break;
            case $st == 'Created':
                $this->status = new Created();
                break;
        }

        return $this->status->decline($this);
        // return $this->connection->query("UPDATE request set status = 'Invalid' where id = $id");
    }

    public function createReport($id)
    {
        $request = $this->getRequestById($id);
        $this->id = $request['id'];
        $this->parent_id = $request['parent_id'];
        $this->birth_certificate = $request['birth_certificate'];
        $this->clinic_card = $request['clinic_card'];
        $this->uploaded_on = $request['uploaded_on'];

        // if ($request['status'] == 'Valid') {
        //     $this->status = new Valid();
        // }
        $st = $request['status'];
        switch ($st) {
            case $st == 'New':
                $this->status = new NewRequest();
                break;
            case $st == 'Invalid':
                $this->status = new Invalid();
                break;
            case $st == 'Valid':
                $this->status = new Valid();
                break;
            case $st == 'Created':
                $this->status = new Created();
                break;
        }

        $this->status->createChildReport($this);
        // return $this->connection->query("UPDATE request set status = 'Invalid' where id = $id");
    }
}


abstract class State
{
    public abstract function validate($request);
    public abstract function decline($request);
    public abstract function createChildReport($request);
}

class NewRequest extends State
{
    public function validate($request)
    {
        return $request->setStatus(new Valid());
    }
    public function decline($request)
    {
        return $request->setStatus(new Invalid());
    }
    public function createChildReport($request)
    {
        return $request->setStatus(new Created());

        // echo "transition cannot be done from current state";
    }
}
class Created extends State
{
    public function validate($request)
    {
        echo "transition cannot be done from current state";
    }
    public function decline($request)
    {
        echo "transition cannot be done from current state";
    }
    public function createChildReport($request)
    {
        echo "transition cannot be done from current state";
    }
}
class Invalid extends State
{
    public function validate($request)
    {
        return $request->setStatus(new Valid());
    }
    public function decline($request)
    {
        echo "transition cannot be done from current state";
    }
    public function createChildReport($request)
    {
        echo "transition cannot be done from current state";
    }
}
class Valid extends State
{
    public function validate($request)
    {
        echo "transition cannot be done from current state";
    }
    public function decline($request)
    {
        return $request->setStatus(new Invalid());
    }
    public function createChildReport($request)
    {
        return $request->setStatus(new Created());
    }
}
