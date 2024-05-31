<?php session_start();

class DB_conn {
    private $DB_host = "localhost";
    private $DB_user = "root";
    private $DB_pass = "";
    private $DB_name = "e-vote-sport";

    protected $e;
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->DB_host;dbname=$this->DB_name", $this->DB_user, $this->DB_pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}

$conn = new DB_conn();