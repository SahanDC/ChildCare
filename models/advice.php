<?php
    
    include_once('dbh.class.php');
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
        function get_advice(){
             
            $sql = 'SELECT * FROM advices WHERE Id= ?;';
            $content = $this->database->connect()->prepare($sql);
            if (!$content->execute(array($this->Id))) {
                $content=null;
                exit();
            }

            if($content->rowCount() == 0){
                $content = null;
                exit();
            }
            $details = $content->fetch();
            $this->topic = $details["topic"];
            $this->content=$details["content"];
            $this->id=$details["id"];
            $this->isdeleted->$details["isdeleted"];

        }
        function editAdvice($content,$topic){
            $sql = 'SELECT * FROM advices WHERE Id = {$this->id}';
            $content = $this->database->connect()->prepare($sql);

        }
    }