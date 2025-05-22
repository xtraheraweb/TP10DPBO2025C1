<?php
require_once 'config/Database.php';

class Route {
    private $conn;
    private $table = "routes";
    
    public $id;
    public $departure_station;
    public $arrival_station;
    public $distance_km;
    public $duration_hours;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . " (departure_station, arrival_station, distance_km, duration_hours) VALUES (:departure_station, :arrival_station, :distance_km, :duration_hours)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':departure_station', $this->departure_station);
        $stmt->bindParam(':arrival_station', $this->arrival_station);
        $stmt->bindParam(':distance_km', $this->distance_km);
        $stmt->bindParam(':duration_hours', $this->duration_hours);
        
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
        $query = "UPDATE " . $this->table . " SET departure_station = :departure_station, arrival_station = :arrival_station, distance_km = :distance_km, duration_hours = :duration_hours WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':departure_station', $this->departure_station);
        $stmt->bindParam(':arrival_station', $this->arrival_station);
        $stmt->bindParam(':distance_km', $this->distance_km);
        $stmt->bindParam(':duration_hours', $this->duration_hours);
        
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