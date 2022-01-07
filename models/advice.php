<?php
    
    
    class Advice{
      

        public $topic;
        public $id;
        public $content;
        public $isdeleted;
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
        function get_advices(){
             
            // $sql = 'SELECT * FROM advices WHERE Id= ?;';
            // $content = $this->database->connect()->prepare($sql);
            // if (!$content->execute(array($this->Id))) {
            //     $content=null;
            //     exit();
            // }

            // if($content->rowCount() == 0){
            //     $content = null;
            //     exit();
            // }
            // $details = $content->fetch();
            // $this->topic = $details["topic"];
            // $this->content=$details["content"];
            // $this->id=$details["id"];
            // $this->isdeleted->$details["isdeleted"];
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
        function editAdvice($id,$content,$topic){
            // $sql = 'SELECT * FROM advices WHERE Id = $id';
            // $content = $this->database->connect()->prepare($sql);
            $query=$this->connection->query("UPDATE advice SET isdeleted=0, content='{$content}', topic='{$topic}' WHERE id= {$id} ");
            echo "eeee";
            # $query="INSERT INTO advices (topic, content, isdeleted) VALUES ('{$topic}','{$content}',{$isdeleted})";
             
             $insert =$query;
         
             if(!$insert)
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
        function deleteAdvice($id){
            $query=$this->connection->query("UPDATE advice SET isdeleted=1 WHERE id= {$id} ");
            echo "1111111111111111111111111111111111111111111111111111111111111";
        
            if($query)
            {
                echo "1111111111111111111111111111111111111111111111111111111111111";
                header("location:health advices.php"); // redirects to all records page
                exit;	
            }
            else
            {   echo mysqli_connect_error();
                echo "Error deleting record";
                echo mysqli_connect_error(); // display error message if not delete
            }

        }
    }