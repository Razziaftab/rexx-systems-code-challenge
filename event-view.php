<?php

require_once 'vendor/autoload.php';
require_once 'config/DatabaseConnection.php';

use App\Controllers\EventController;
use config\DatabaseConnection;

$event = new EventController(DatabaseConnection::getInstance());
$event->index();
