<?php
require_once 'model/Route.php';

class RouteViewModel {
    private $route;

    public function __construct() {
        $this->route = new Route();
    }

    public function getRouteList() {
        return $this->route->readAll();
    }

    public function getRouteById($id) {
        $this->route->id = $id;
        return $this->route->readOne();
    }

    public function addRoute($departure_station, $arrival_station, $distance_km, $duration_hours) {
        $this->route->departure_station = $departure_station;
        $this->route->arrival_station = $arrival_station;
        $this->route->distance_km = $distance_km;
        $this->route->duration_hours = $duration_hours;
        return $this->route->create();
    }

    public function updateRoute($id, $departure_station, $arrival_station, $distance_km, $duration_hours) {
        $this->route->id = $id;
        $this->route->departure_station = $departure_station;
        $this->route->arrival_station = $arrival_station;
        $this->route->distance_km = $distance_km;
        $this->route->duration_hours = $duration_hours;
        return $this->route->update();
    }

    public function deleteRoute($id) {
        $this->route->id = $id;
        return $this->route->delete();
    }
}