<?php
// Include all ViewModels
require_once 'viewmodel/TrainViewModel.php';
require_once 'viewmodel/RouteViewModel.php';
require_once 'viewmodel/BookingViewModel.php';

// Get entity and action from URL
$entity = $_GET['entity'] ?? 'train';
$action = $_GET['action'] ?? 'list';
$id = $_GET['id'] ?? null;

// Route to appropriate ViewModel based on entity
switch ($entity) {
    case 'train':
        $viewModel = new TrainViewModel();
        handleTrainActions($viewModel, $action, $id);
        break;
        
    case 'route':
        $viewModel = new RouteViewModel();
        handleRouteActions($viewModel, $action, $id);
        break;
        
    case 'booking':
        $viewModel = new BookingViewModel();
        handleBookingActions($viewModel, $action, $id);
        break;
        
    default:
        // Default to train list
        $viewModel = new TrainViewModel();
        handleTrainActions($viewModel, 'list', null);
        break;
}

// Handle Train Actions
function handleTrainActions($viewModel, $action, $id) {
    switch ($action) {
        case 'list':
            $trainList = $viewModel->getTrainList();
            require_once 'views/train/train_list.php';
            break;
            
        case 'add':
            require_once 'views/train/train_form.php';
            break;
            
        case 'edit':
            if ($id) {
                $train = $viewModel->getTrainById($id);
                require_once 'views/train/train_form.php';
            } else {
                header("Location: index.php?entity=train");
            }
            break;
            
        case 'save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $viewModel->addTrain(
                    $_POST['train_name'],
                    $_POST['train_type'],
                    $_POST['capacity']
                );
                
                if ($result) {
                    header("Location: index.php?entity=train&message=created");
                } else {
                    header("Location: index.php?entity=train&action=add&error=1");
                }
            }
            break;
            
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->updateTrain(
                    $id,
                    $_POST['train_name'],
                    $_POST['train_type'],
                    $_POST['capacity']
                );
                
                if ($result) {
                    header("Location: index.php?entity=train&message=updated");
                } else {
                    header("Location: index.php?entity=train&action=edit&id=$id&error=1");
                }
            }
            break;
            
        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->deleteTrain($id);
                
                if ($result) {
                    header("Location: index.php?entity=train&message=deleted");
                } else {
                    header("Location: index.php?entity=train&error=delete_failed");
                }
            }
            break;
            
        default:
            $trainList = $viewModel->getTrainList();
            require_once 'views/train/train_list.php';
            break;
    }
}

// Handle Route Actions
function handleRouteActions($viewModel, $action, $id) {
    switch ($action) {
        case 'list':
            $routeList = $viewModel->getRouteList();
            require_once 'views/route/route_list.php';
            break;
            
        case 'add':
            require_once 'views/route/route_form.php';
            break;
            
        case 'edit':
            if ($id) {
                $route = $viewModel->getRouteById($id);
                require_once 'views/route/route_form.php';
            } else {
                header("Location: index.php?entity=route");
            }
            break;
            
        case 'save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $viewModel->addRoute(
                    $_POST['departure_station'],
                    $_POST['arrival_station'],
                    $_POST['distance_km'],
                    $_POST['duration_hours']
                );
                
                if ($result) {
                    header("Location: index.php?entity=route&message=created");
                } else {
                    header("Location: index.php?entity=route&action=add&error=1");
                }
            }
            break;
            
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->updateRoute(
                    $id,
                    $_POST['departure_station'],
                    $_POST['arrival_station'],
                    $_POST['distance_km'],
                    $_POST['duration_hours']
                );
                
                if ($result) {
                    header("Location: index.php?entity=route&message=updated");
                } else {
                    header("Location: index.php?entity=route&action=edit&id=$id&error=1");
                }
            }
            break;
            
        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->deleteRoute($id);
                
                if ($result) {
                    header("Location: index.php?entity=route&message=deleted");
                } else {
                    header("Location: index.php?entity=route&error=delete_failed");
                }
            }
            break;
            
        default:
            $routeList = $viewModel->getRouteList();
            require_once 'views/route/route_list.php';
            break;
    }
}

// Handle Booking Actions
function handleBookingActions($viewModel, $action, $id) {
    switch ($action) {
        case 'list':
            $bookingList = $viewModel->getBookingList();
            require_once 'views/booking/booking_list.php';
            break;
            
        case 'add':
            $trains = $viewModel->getTrains();
            $routes = $viewModel->getRoutes();
            require_once 'views/booking/booking_form.php';
            break;
            
        case 'edit':
            if ($id) {
                $booking = $viewModel->getBookingById($id);
                $trains = $viewModel->getTrains();
                $routes = $viewModel->getRoutes();
                require_once 'views/booking/booking_form.php';
            } else {
                header("Location: index.php?entity=booking");
            }
            break;
            
        case 'save':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $result = $viewModel->addBooking(
                    $_POST['train_id'],
                    $_POST['route_id'],
                    $_POST['passenger_name'],
                    $_POST['passenger_phone'],
                    $_POST['departure_date'],
                    $_POST['departure_time'],
                    $_POST['seat_number'],
                    $_POST['ticket_price'],
                    $_POST['booking_status']
                );
                
                if ($result) {
                    header("Location: index.php?entity=booking&message=created");
                } else {
                    header("Location: index.php?entity=booking&action=add&error=1");
                }
            }
            break;
            
        case 'update':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->updateBooking(
                    $id,
                    $_POST['train_id'],
                    $_POST['route_id'],
                    $_POST['passenger_name'],
                    $_POST['passenger_phone'],
                    $_POST['departure_date'],
                    $_POST['departure_time'],
                    $_POST['seat_number'],
                    $_POST['ticket_price'],
                    $_POST['booking_status']
                );
                
                if ($result) {
                    header("Location: index.php?entity=booking&message=updated");
                } else {
                    header("Location: index.php?entity=booking&action=edit&id=$id&error=1");
                }
            }
            break;
            
        case 'delete':
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
                $result = $viewModel->deleteBooking($id);
                
                if ($result) {
                    header("Location: index.php?entity=booking&message=deleted");
                } else {
                    header("Location: index.php?entity=booking&error=delete_failed");
                }
            }
            break;
            
        default:
            $bookingList = $viewModel->getBookingList();
            require_once 'views/booking/booking_list.php';
            break;
    }
}
?>