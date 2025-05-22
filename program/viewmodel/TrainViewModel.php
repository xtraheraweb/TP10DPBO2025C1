<?php
require_once 'model/Train.php';

class TrainViewModel {
    private $train;

    public function __construct() {
        $this->train = new Train();
    }

    public function getTrainList() {
        return $this->train->readAll();
    }

    public function getTrainById($id) {
        $this->train->id = $id;
        return $this->train->readOne();
    }

    public function addTrain($train_name, $train_type, $capacity) {
        $this->train->train_name = $train_name;
        $this->train->train_type = $train_type;
        $this->train->capacity = $capacity;
        return $this->train->create();
    }

    public function updateTrain($id, $train_name, $train_type, $capacity) {
        $this->train->id = $id;
        $this->train->train_name = $train_name;
        $this->train->train_type = $train_type;
        $this->train->capacity = $capacity;
        return $this->train->update();
    }

    public function deleteTrain($id) {
        $this->train->id = $id;
        return $this->train->delete();
    }
}