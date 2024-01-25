<?php

namespace App\Models;

use Exception;
use PDOException;

class Event
{
    private $table = "events";
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    /**
     * Bulk insert
     *
     * @param $eventsData
     * @return bool
     * @throws Exception
     */
    public function insert($eventsData): bool
    {
        try {
            $this->connection->beginTransaction();
            foreach ($eventsData as $eventData) {
                $employeeName = $eventData->employee_name;
                $employeeMail = $eventData->employee_mail;
                $eventId = $eventData->event_id;
                $eventName = $eventData->event_name;
                $eventDate = $eventData->event_date;
                $participationId = $eventData->participation_id;
                $participationFee = $eventData->participation_fee;
                $version = $eventData->version ?? null;

                $stmt = $this->connection->prepare("INSERT IGNORE INTO employees (employee_name, employee_mail) 
                    VALUES (:employee_name, :employee_mail)");
                $stmt->execute([':employee_name' => $employeeName, ':employee_mail' => $employeeMail]);

                $stmt = $this->connection->prepare(
                    "SELECT employee_id FROM employees WHERE employee_mail = :employee_mail");
                $stmt->execute([':employee_mail' => $employeeMail]);
                $employeeId = $stmt->fetchColumn();

                $stmt = $this->connection->prepare("INSERT IGNORE INTO " . $this->table . " 
                (event_id, event_name, event_date) VALUES (:event_id, :event_name, :event_date)");
                $stmt->execute([':event_id' => $eventId, ':event_name' => $eventName, ':event_date' => $eventDate]);

                $stmt = $this->connection->prepare("INSERT INTO participations
                    (participation_id, employee_id, event_id, participation_fee, version) 
                    VALUES (:participation_id, :employee_id, :event_id, :participation_fee, :version)");
                $stmt->execute(
                    [
                        ':participation_id' => $participationId,
                        ':employee_id' => $employeeId,
                        ':event_id' => $eventId,
                        ':participation_fee' => $participationFee,
                        ':version' => $version,
                    ]);
            }
            $this->connection->commit();
            return true;
        } catch (PDOException $e) {
            $this->connection->rollback();
            throw new Exception("Failed to insert Data: " . $e->getMessage());
        }
    }

    /**
     * Get All Data
     *
     * @param array $filters
     * @return mixed
     */
    public function getAll(array $filters)
    {
        $params = [];
        $query = "SELECT 
            e.event_name, e.event_date, p.participation_id, p.participation_fee, m.employee_name, m.employee_mail
            FROM " . $this->table . " e 
            JOIN participations p ON e.event_id = p.event_id 
            JOIN employees m ON m.employee_id = p.employee_id
            ";
        if (!empty($filters)) {
            foreach ($filters as $key => $filter) {
                $query .= "AND {$key} LIKE ?";
                $params[] = "%{$filter}%";
            }
        }
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        $eventsResult = $stmt->fetchAll();
        $this->connection = null;
        return $eventsResult;
    }

}

