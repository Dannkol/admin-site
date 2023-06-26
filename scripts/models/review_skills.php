<?php

namespace App;

use connect;

class ModelaReview_skills extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO maint_area(id_team_schedule, id_journey, id_tutor, id_location) VALUES(:team_schedule, :journey, :tutor, :location)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":team_schedule", $data['team_schedule']);
            $res->bindParam(":journey", $data['journey']);
            $res->bindParam(":tutor", $data['tutor']);
            $res->bindParam(":location", $data['location']);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => "inserted data"];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }

    public static function getall()
    {
        try {
            $queryGetAll = 'SELECT id AS "identificador", id_team_schedule, id_journey, id_tutor, id_location FROM review_skills';

            $res = self::getConnection()->prepare($queryGetAll);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }

    public static function getid($id)
    {
        try {
            $queryGetid = 'SELECT id AS "identificador", id_team_schedule, id_journey, id_tutor, id_location FROM review_skills';
            $queryGetid .= ' WHERE id = :id';
            $res = self::getConnection()->prepare($queryGetid);
            $res->bindParam(':id', $id);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }

    public static function delete($id)
    {
        try {
            $query = 'DELETE FROM review_skills WHERE id = :id';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(':id', $id);
            $res->execute();
            self::$message = ["Code" => 200 + $res->rowCount(), "Message" => $res->fetchAll(\PDO::FETCH_ASSOC) == [] ? 'Done' : $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }

    public static function update($id, $data)
    {
        try {
            $query = 'UPDATE review_skills SET';
            $params = [];

            if ($data['team_schedule'] !== null) {
                $query .= ' id_team_schedule = :id_team_schedule,';
                $params[':id_team_schedule'] = $data['team_schedule'];
            }
            if (isset($data['journey'])) {
                $query .= ' id_journey = :id_journey,';
                $params[':id_journey'] = $data['journey'];
            }
            if (isset($data['tutor'])) {
                $query .= ' id_tutor = :id_tutor,';
                $params[':id_tutor'] = $data['tutor'];
            }
            if (isset($data['location'])) {
                $query .= ' id_location = :id_location,';
                $params[':id_location'] = $data['location'];
            }


            // Eliminar la coma final del query
            $query = rtrim($query, ',');

            $query .= ' WHERE id = :id';
            $params[':id'] = $id;

            $res = self::getConnection()->prepare($query);
            $res->execute($params);

            $res->rowCount();

            self::$message = ["Code" => 200, "Message" => $res->fetchAll(\PDO::FETCH_ASSOC)];
        } catch (\PDOException $e) {
            self::$message = ["Code" => $e->getCode(), "Message" => $res->errorInfo()[2]];
        } finally {
            echo json_encode(self::$message);
        }
    }
}
