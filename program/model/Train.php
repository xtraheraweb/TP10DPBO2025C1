<?php
require_once 'config/Database.php';

class Train {
    private $conn;
    private $table = "trains";
    
    public $id;
    public $train_name;
    public $train_type;
    public $capacity;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . " (train_name, train_type, capacity) VALUES (:train_name, :train_type, :capacity)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':train_name', $this->train_name);
        $stmt->bindParam(':train_type', $this->train_type);
        $stmt->bindParam(':capacity', $this->capacity);
        
        return $stmt->execute();
    }
    
    // READ ALL
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // READ ONE
    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table . " SET train_name = :train_name, train_type = :train_type, capacity = :capacity WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':train_name', $this->train_name);
        $stmt->bindParam(':train_type', $this->train_type);
        $stmt->bindParam(':capacity', $this->capacity);
        
        return $stmt->execute();
    }
    
    // DELETE
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}