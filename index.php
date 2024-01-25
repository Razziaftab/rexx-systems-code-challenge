<?php

require_once 'vendor/autoload.php';
require_once 'config/DatabaseConnection.php';

use App\Controllers\EventController;
use config\DatabaseConnection;

$event = new EventController(DatabaseConnection::getInstance());
try {
    $eventCreate = $event->create();
    if ($eventCreate) {
        echo "Data Inserted successfully.";
    } else {
        echo "Something went wrong!";
    }
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

echo '<br><a href="event_view.php">View Data</a>';
