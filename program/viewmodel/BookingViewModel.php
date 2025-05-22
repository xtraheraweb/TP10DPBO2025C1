<?php
require_once 'model/Booking.php';
require_once 'model/Train.php';
require_once 'model/Route.php';

class BookingViewModel {
    private $booking;
    private $train;
    private $route;

    public function __construct() {
        $this->booking = new Booking();
        $this->train = new Train();
        $this->route = new Route();
    }

    public function getBookingList() {
        return $this->booking->readAll();
    }

    public function getBookingById($id) {
        $this->booking->id = $id;
        return $this->booking->readOne();
    }

    public function getTrains() {
        return $this->train->readAll();
    }

    public function getRoutes() {
        return $this->route->readAll();
    }

    public function addBooking($train_id, $route_id, $passenger_name, $passenger_phone, $departure_date, $departure_time, $seat_number, $ticket_price, $booking_status) {
        $this->booking->train_id = $train_id;
        $this->booking->route_id = $route_id;
        $this->booking->passenger_name = $passenger_name;
        $this->booking->passenger_phone = $passenger_phone;
        $this->booking->departure_date = $departure_date;
        $this->booking->departure_time = $departure_time;
        $this->booking->seat_number = $seat_number;
        $this->booking->ticket_price = $ticket_price;
        $this->booking->booking_status = $booking_status;
        return $this->booking->create();
    }

    public function updateBooking($id, $train_id, $route_id, $passenger_name, $passenger_phone, $departure_date, $departure_time, $seat_number, $ticket_price, $booking_status) {
        $this->booking->id = $id;
        $this->booking->train_id = $train_id;
        $this->booking->route_id = $route_id;
        $this->booking->passenger_name = $passenger_name;
        $this->booking->passenger_phone = $passenger_phone;
        $this->booking->departure_date = $departure_date;
        $this->booking->departure_time = $departure_time;
        $this->booking->seat_number = $seat_number;
        $this->booking->ticket_price = $ticket_price;
        $this->booking->booking_status = $booking_status;
        return $this->booking->update();
    }

    public function deleteBooking($id) {
        $this->booking->id = $id;
        return $this->booking->delete();
    }
}