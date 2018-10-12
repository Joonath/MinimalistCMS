<?php
class DBConfig{

    private $status;
    public $connection;
    
    function __construct(){
        $this->connection = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE) or die("Couldn't connect to DB");
        $this->status = true;
    }
    
    function getConnection(){
        return $this->connection;
    }
    
    function close(){
        $this->status = false;
        return mysqli_close($this->connection);
    }
    
    function getStatus(){
        return $this->status;
    }
}

?>