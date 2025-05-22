<?php
require_once 'config/Database.php';

class Booking {
    private $conn;
    private $table = "bookings";
    
    public $id;
    public $train_id;
    public $route_id;
    public $passenger_name;
    public $passenger_phone;
    public $departure_date;
    public $departure_time;
    public $seat_number;
    public $ticket_price;
    public $booking_status;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    // CREATE
    public function create() {
        $query = "INSERT INTO " . $this->table . " (train_id, route_id, passenger_name, passenger_phone, departure_date, departure_time, seat_number, ticket_price, booking_status) VALUES (:train_id, :route_id, :passenger_name, :passenger_phone, :departure_date, :departure_time, :seat_number, :ticket_price, :booking_status)";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':train_id', $this->train_id);
        $stmt->bindParam(':route_id', $this->route_id);
        $stmt->bindParam(':passenger_name', $this->passenger_name);
        $stmt->bindParam(':passenger_phone', $this->passenger_phone);
        $stmt->bindParam(':departure_date', $this->departure_date);
        $stmt->bindParam(':departure_time', $this->departure_time);
        $stmt->bindParam(':seat_number', $this->seat_number);
        $stmt->bindParam(':ticket_price', $this->ticket_price);
        $stmt->bindParam(':booking_status', $this->booking_status);
        
        return $stmt->execute();
    }
    
    // READ ALL WITH JOINS
    public function readAll() {
        $query = "SELECT b.*, t.train_name, t.train_type, r.departure_station, r.arrival_station, r.distance_km, r.duration_hours 
                  FROM " . $this->table . " b 
                  LEFT JOIN trains t ON b.train_id = t.id 
                  LEFT JOIN routes r ON b.route_id = r.id 
                  ORDER BY b.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    // READ ONE
    public function readOne() {
        $query = "SELECT b.*, t.train_name, t.train_type, r.departure_station, r.arrival_station, r.distance_km, r.duration_hours 
                  FROM " . $this->table . " b 
                  LEFT JOIN trains t ON b.train_id = t.id 
                  LEFT JOIN routes r ON b.route_id = r.id 
                  WHERE b.id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        return $stmt->fetch();
    }
    
    // UPDATE
    public function update() {
        $query = "UPDATE " . $this->table . " SET train_id = :train_id, route_id = :route_id, passenger_name = :passenger_name, passenger_phone = :passenger_phone, departure_date = :departure_date, departure_time = :departure_time, seat_number = :seat_number, ticket_price = :ticket_price, booking_status = :booking_status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':train_id', $this->train_id);
        $stmt->bindParam(':route_id', $this->route_id);
        $stmt->bindParam(':passenger_name', $this->passenger_name);
        $stmt->bindParam(':passenger_phone', $this->passenger_phone);
        $stmt->bindParam(':departure_date', $this->departure_date);
        $stmt->bindParam(':departure_time', $this->departure_time);
        $stmt->bindParam(':seat_number', $this->seat_number);
        $stmt->bindParam(':ticket_price', $this->ticket_price);
        $stmt->bindParam(':booking_status', $this->booking_status);
        
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