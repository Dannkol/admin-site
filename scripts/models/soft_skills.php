<?php

namespace App;

use connect;

class ModelSoft_skills extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO soft_skills(id_team_schedule, id_journey , id_psychologist, id_location, id_subject) VALUES(:id_team_schedule, :id_journey, :id_psychologist, :id_location, :id_subject)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_team_schedule", $data['team_schedule']);
            $res->bindParam(":id_journey", $data['journey']);
            $res->bindParam(":id_psychologist", $data['psychologist']);
            $res->bindParam(":id_location", $data['location']);
            $res->bindParam(":id_subject", $data['subject']);

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
            $queryGetAll = 'SELECT t1 AS "identificador", id_team_schedule, id_journey, id_psychologist, id_location, id_subject FROM soft_skills ';

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
            $queryGetid = 'SELECT id AS "identificador", id_team_schedule, id_journey, id_psychologist, id_location, id_subject FROM soft_skills ';
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
            $query = 'DELETE FROM soft_skills WHERE id = :id';
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
            $query = 'UPDATE soft_skills SET';
            $params = [];

            if ($data['team_schedule'] !== null) {
                $query .= ' id_team_schedule = :id_team_schedule,';
                $params[':id_team_schedule'] = $data['team_schedule'];
            }
            if (isset($data['id_journey'])) {
                $query .= ' id_journey = :id_journey,';
                $params[':id_journey'] = $data['journey'];
            }
            if (isset($data['psychologist'])) {
                $query .= ' id_psychologist = :id_psychologist,';
                $params[':id_psychologist'] = $data['psychologist'];
            }
            if (isset($data['location'])) {
                $query .= ' id_location = :id_location,';
                $params[':id_location'] = $data['location'];
            }
            if (isset($data['subject'])) {
                $query .= ' id_subject = :id_subject,';
                $params[':id_subject'] = $data['subject'];
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
