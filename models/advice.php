<?php
    
    
    class Advice{
        public $topic;
        public $id;
        public $content;
        public $isdeleted;
        public $connection;

        public function __construct($db)
        {
            $this->connection = $db;
        }
    
        function set_topic($topic){
            $this->topic=$topic;
        }
        function set_id($id){
            $this->id=$id;
        }
        function set_content($content){
            $this->content=$content;
        }
        function set_isdeleted($isdeleted){
            $this->isdeleted=$isdeleted;
        }

        function  get_topic(){
            return $this->topic;
        }
        function get_id(){
            return $this->id;
        }
        function get_content(){
            return $this->content;
        }
        function get_isdeleted(){
            return $this->isdeleted;
        }
        // function get_advices(){
        //     $query = $this->connection->query("SELECT * FROM advice ORDER BY id  ");
        //     $requests = array();
        //     while ($row = $query->fetch_assoc()) {
                
        //         if($row['isdeleted']==0)
        //             {
        //             array_push($requests, $row);
        //             }
        //     }
        //     // print_r($requests);
        //     return $requests;

        // }
        function set_advice($id,$topic,$content,$status){
            $this->id=$id;
            $this->topic=$topic;
            $this->content=$content;
            $this->isdeleted=$status;
        }
        function editAdvice($connection,$topic,$content){
            $query=$connection->query("UPDATE advice SET isdeleted=0, content='{$content}', topic='{$topic}' WHERE id = {$this->id} limit 1");
            echo "eeee";
            
            if(!$query)
            {
                echo mysqli_error($this->connection);
            }
            else
            {  
                header("location:health advices.php"); // redirects to all records page
                exit;	
                echo "";
            }

        }
        function deleteAdvice(){
            $query=$this->connection->query("UPDATE advice SET isdeleted=1 WHERE id={$this->id}");
        
            if($query)
            {
                
                header("location:health advices.php"); // redirects to all records page
                exit;	
            }
            else
            {   echo mysqli_connect_error();
                echo "Error deleting record";
                echo mysqli_connect_error(); // display error message if not delete
            }

        }

        // function addAdvice($topic,$content)
        // {
        //     $query = $this->connection->query("INSERT INTO advice (topic, content, isdeleted) VALUES ('{$topic}','{$content}',0)");
        //     if (!$query) {
        //     echo mysqli_error($this->connection);
        //     } 
        //     else {
        //     echo ""; }
        // }


        //thiis is not completed ----  yacai yacai  -----
        function search($term){
            $query = $this->connection->query("SELECT * FROM advice ORDER BY id  ");
            $requests = array();
            while ($row = $query->fetch_assoc()) {
                
                if($row['isdeleted']==0)
                    {
                    array_push($requests, $row);
                    }
            }
            return $requests;
        }
        function getChildReports(){
            $query = $this->connection->query("SELECT * FROM child_report ORDER BY Childid ");
            $reports = array();
            while ($row = $query->fetch_assoc()) {
                
                
                    array_push($reports, $row);
                    
            }
            return $reports;
        }

        
    }