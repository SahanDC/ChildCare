<?php 
class Dbh{
    private $serverName;
    private $userName;
    private $password;
    private $dbName;

    public function connect(){
        $this->serverName ="localhost";
        $this->userName ="root";
        $this->password ="";
        $this->dbName ="child_care";

        $connection = new mysqli($this->serverName,$this->userName,$this->password,$this->dbName);
        return $connection;
    }
}
?>