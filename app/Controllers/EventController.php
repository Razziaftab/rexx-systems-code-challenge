<?php

namespace App\Controllers;

use App\Services\JsonParseService;
use config\DatabaseConnection;
use App\Models\Event;
use Exception;
use PDO;

class EventController
{
    private PDO $db;

    /**
     * Instantiate object with database connection
     */
    public function __construct(DatabaseConnection $db)
    {
        $this->db = $db->getConnection();
    }

    public function index(): void
    {
        $filters = [];
        if (!empty($_GET["employee_name"])) {
            $filters['employee_name'] = filter_input(INPUT_GET, 'employee_name');
        }
        if (!empty($_GET["event_name"])) {
            $filters['event_name'] = filter_input(INPUT_GET, 'event_name');
        }
        if (!empty($_GET["event_date"])) {
            $filters['event_date'] = filter_input(INPUT_GET, 'event_date');
        }

        $event = new Event($this->db);
        $events = $event->getAll($filters);

        require_once __DIR__ . "/../../views/event_view.php";
    }

    /**
     * @return bool
     * @throws Exception
     */
    public function create(): bool
    {
        $jsonParse = new JsonParseService();
        $eventsData = $jsonParse->ParseJsonFile();

        if (iterator_count($eventsData) > 0) {
            $event = new Event($this->db);
            $event->insert($eventsData);
            return true;
        }
        return false;
    }
}