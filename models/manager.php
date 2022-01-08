<?php 
    class manager{
        private $connection;
        private $userId ;
        private $name ;
        private $email ;

        private $midwife_aarray ;
        private $Advice_array ;
        private $childReport_array ;

        public function __construct($connection,$id,$name,$email){
            $this->connection=$connection;
            $this->userId = $id;
            $this->name = $name;
            $this->email = $email;
        }

        public function getMidwives($search_){
            $midwives = array();
            if ($search_ !='') {
                
                // echo "search<br>";
                $search = mysqli_real_escape_string($this->connection, $search_);
                $query = $this->connection->query("SELECT * FROM midwife WHERE (id LIKE '%{$search}%') OR (areas LIKE '%{$search}%') OR (email LIKE '%{$search}%');");
                // echo ("query");
            } else {
                $query = $this->connection->query("SELECT * FROM midwife;");
            }
            
            while ($row = $query->fetch_assoc()) {
                array_push($midwives, $row);
                
            }
            // print_r($midwives);
            return $midwives;
            }
    }
?>