<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class AttendeeQuery extends DatabaseHandler
{
    /**
     * Create a new attendee for an event
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createAttendee(array $data): bool
    {
        // data insert query
        $query = $this->db()->prepare("
            INSERT INTO `attendees`(
                `event_id`,
                `name`,
                `email`,
                `address`
            )
            VALUES(
                :event_id,
                :name,
                :email,
                :address
            )
        ");

        return $query->execute([
            'event_id' => $data['event_id'],
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
        ]);
    }

    /**
     * Single attendee data by email
     * 
     * @param string $email
     * 
     * @return mixed
     */
    public function getAttendeeByEventAndEmail(int $eventId, string $email): mixed
    {
        // attendee find query
        $query = $this->db()->prepare("SELECT * FROM `attendees` WHERE `event_id` = ? AND `email` = ? LIMIT 1");
        $query->execute([$eventId, $email]);

        // attendee data
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
