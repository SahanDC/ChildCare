<?php 
    include_once('advice.php');

    class manager{
        private $connection;
        private $userId ;
        private $name ;
        private $email ;
        public $Errors;

        private $midwife_array ;
        private $Advice_array ;
        private $childReport_array ;

        public function __construct($connection,$id,$name,$email){
            $this->connection=$connection;
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

        public function getMidwives($search_){
            if ($search_ !='') {
                
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

                $this->midwife_array[$row['id']]=$midwife;
            }
            // print_r($midwives);
            return $this->midwife_array;
            }

        public function addMidwife($email,$centre,$areas,$noc){
            $query = "INSERT INTO midwife (email,centre,areas,noc) VALUES ('{$email}','{$centre}','{$areas}',{$noc})";
            $insert = mysqli_query($this->connection, $query);
            if (!$insert) {
                echo mysqli_error($this->connection);
            } else {
                echo "";
            }
        }

        public function get_advices(){
            $query = $this->connection->query("SELECT * FROM advice WHERE isdeleted = 0 ORDER BY id ");
            while ($row = $query->fetch_assoc()) {
                $advice = new Advice($this->connection);
                $advice->set_advice($row['id'],$row['topic'],$row['content'],$row['isdeleted']);
                $this->Advice_array[$row['id']]=$advice;
            }
            // print_r($requests);
            return $this->Advice_array;
        }

        public function deleteAdvice($id){
            $this->Advice_array[$id]->deleteAdvice();
        }

        public function editAdvice($connection,$object,$topic,$content){
            $object->editAdvice($connection,$topic,$content);
        }
        
        function addAdvice($topic,$content)
        {
            $query = $this->connection->query("INSERT INTO advice (topic, content, isdeleted) VALUES ('{$topic}','{$content}',0)");
            if (!$query) {
            echo mysqli_error($this->connection);
            } 
            else {
            echo ""; }
        }

        public function getChildreports($search_){
            if ($search_ !='') {
                
                // echo "search<br>";
                $search = mysqli_real_escape_string($this->connection, $search_);
                $query = $this->connection->query("SELECT * FROM child_report WHERE (name LIKE '%{$search}%' or ChildId LIKE '%{$search}%') ORDER BY ChildId");
                // echo ("query");
            } else {
                $query = $this->connection->query("SELECT * FROM child_report ");
            }
            
            while ($row = $query->fetch_assoc()) {
                $childreport = new ChildReport($row['ChildId']);
                $childreport->addDetails($row);

                $this->childReport_array[$row['ChildId']]=$childreport;
            }
            // print_r($midwives);
            return $this->childReport_array;
            }

//--------------------------error handilig functions --------------------------
            // checks required fields
    private function check_req_fields($req_fields,$field_names){
        for ($i=0 ;  $i<sizeof($req_fields) ; $i++) { 
            if (empty(trim($req_fields[$i]))) {
                array_push($this->Errors, $field_names[$i] . ' is required.');
            }
        }
    }


    private function checkLength($field,$len,$field_name){
        if (strlen($field) > $len) {
            array_push($this->Errors, $field_name . " is too long.");
        }
    }

    }
