<?php 

class Database {
    public $username = 'root';
    public $password = '';
    public $host = 'localhost';
    public $db = 'ecommerce';

    public function connect() {
        return new PDO("mysql:host=$this->host;dbname=$this->db", $this->username, $this->password);
    }
}