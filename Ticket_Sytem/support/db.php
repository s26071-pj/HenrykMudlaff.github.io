<?php
class DB{
    protected $host = '5.39.83.70';
    protected $user = 'heniu';
    protected $password = 'Doopa2137!';
    protected $database = 'ticket_system_1';

    public $conn;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        if($this->conn->connect_errno){
            die('Database error');
        }
    }
}
?>