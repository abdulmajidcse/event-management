<?php

namespace App\Queries;

use App\Handlers\DatabaseHandler;
use PDO;

class EventQuery extends DatabaseHandler
{

    /**
     * Create a new event
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function createEvent(array $data): bool
    {
        // data insert query
        $query = $this->db()->prepare("
            INSERT INTO `events`(
                `user_id`,
                `title`,
                `description`,
                `address`,
                `event_date`,
                `max_attendees`
            )
            VALUES(
                :user_id,
                :title,
                :description,
                :address,
                :event_date,
                :max_attendees
            )
        ");

        return $query->execute([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'description' => $data['description'],
            'address' => $data['address'],
            'event_date' => $data['event_date'],
            'max_attendees' => $data['max_attendees']
        ]);
    }

    /**
     * Update event data
     * 
     * @param array $data
     * 
     * @return bool
     */
    public function updateEvent(array $data): bool
    {
        $query = $this->db()->prepare("
            UPDATE
                `events`
            SET
                `title` = :title,
                `description` = :description,
                `address` = :address,
                `event_date` = :event_date,
                `max_attendees` = :max_attendees
            WHERE
                `id` = :id
        ");

        return $query->execute([
            'title' => $data['title'],
            'description' => $data['description'],
            'address' => $data['address'],
            'event_date' => $data['event_date'],
            'max_attendees' => $data['max_attendees'],
            'id' => $data['id'],
        ]);
    }

    /**
     * Delete event data
     * 
     * @param int $id
     * 
     * @return bool
     */
    public function deleteEvent(int $id): bool
    {
        $query = $this->db()->prepare("
            DELETE
            FROM
                `events`
            WHERE
                `id` = ?
        ");

        return $query->execute([$id]);
    }

    /**
     * Single event data by id
     * 
     * @param int $id
     * 
     * @return mixed
     */
    public function getEventById(int $id): mixed
    {
        // event find query
        $query = $this->db()->prepare("
            SELECT
                *
            FROM
                `events`
            WHERE
                `id` = ?
            LIMIT 1
        ");
        $query->execute([$id]);

        // event data
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Single event data by title
     * 
     * @param string $title
     * 
     * @return mixed
     */
    public function getEventByTitle(string $title): mixed
    {
        // event find query
        $query = $this->db()->prepare("
            SELECT
                *
            FROM
                `events`
            WHERE
                `title` = ?
            LIMIT 1
        ");

        $query->execute([$title]);

        // event data
        return $query->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Get all event
     * With search feature and pagination
     * 
     * @param array $data
     * 
     * @return array
     */
    public function getAllEvent(array $data): array
    {

        // get order by info
        $oderColumn = 'id';
        $oderType = 'DESC';

        if (!empty($data['sortBy'])) {
            if ($data['sortBy'] == 'oldest') {
                $oderType = 'ASC';
            } else if ($data['sortBy'] == 'title_asc') {
                $oderColumn = 'title';
                $oderType = 'ASC';
            } else if ($data['sortBy'] == 'title_desc') {
                $oderColumn = 'title';
                $oderType = 'DESC';
            } else if ($data['sortBy'] == 'max_attendees_asc') {
                $oderColumn = 'max_attendees';
                $oderType = 'ASC';
            } else if ($data['sortBy'] == 'max_attendees_desc') {
                $oderColumn = 'max_attendees';
                $oderType = 'DESC';
            }
        }

        // user id query
        $userIdSearch = !empty($data['userId']) ? 'user_id = :user_id AND' : '';
        // event date query
        $eventDateSearch = !empty($data['eventDate']) ? 'AND `event_date` LIKE :event_date' : '';

        $query = $this->db()->prepare("
            SELECT
                *
            FROM
                `events`
            WHERE
                $userIdSearch
                (
                `title` LIKE :search OR
                `max_attendees` LIKE :search OR
                `address` LIKE :search
                )
                 $eventDateSearch
            ORDER BY
                $oderColumn
            $oderType
            LIMIT :per_page OFFSET :offset
        ");

        // binding params
        $offset = ($data['page'] - 1) * $data['perPage'];
        if (!empty($data['userId'])) {
            $query->bindValue('user_id', $data['userId'], PDO::PARAM_INT);
        }
        $query->bindValue('search', sprintf('%%%s%%', $data['search']), PDO::PARAM_STR);
        if (!empty($data['eventDate'])) {
            $query->bindValue('event_date', sprintf('%%%s%%', $data['eventDate']), PDO::PARAM_STR);
        }
        $query->bindValue('per_page', $data['perPage'], PDO::PARAM_INT);
        $query->bindValue('offset', $offset, PDO::PARAM_INT);

        $query->execute();

        $queryData['events'] = $query->fetchAll(PDO::FETCH_OBJ);

        // Get the total number of records
        $totalEventQuery = $this->db()->prepare("
            SELECT
                COUNT(`id`)
            FROM
                `events`
            WHERE
                $userIdSearch
                (
                `title` LIKE :search OR
                `max_attendees` LIKE :search OR
                `address` LIKE :search
                )
                 $eventDateSearch
        ");

        // binding params
        if (!empty($data['userId'])) {
            $totalEventQuery->bindValue('user_id', $data['userId'], PDO::PARAM_INT);
        }
        $totalEventQuery->bindValue('search', sprintf('%%%s%%', $data['search']), PDO::PARAM_STR);
        if (!empty($data['eventDate'])) {
            $totalEventQuery->bindValue('event_date', sprintf('%%%s%%', $data['eventDate']), PDO::PARAM_STR);
        }

        $totalEventQuery->execute();
        $totalPages = $totalEventQuery->fetchColumn();

        // Calculate the total number of pages
        $queryData['totalPages'] = ceil($totalPages / $data['perPage']);

        return $queryData;
    }
}
