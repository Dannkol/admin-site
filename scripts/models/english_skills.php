<?php

namespace App;

use connect;

class ModelaEnglish_skills extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO english_skills(id_team_schedule, id_journey, id_teacher, id_location, id_subject) VALUES(:id_team_schedule, :id_journey, :id_teacher, :id_location, :id_subject)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_team_schedule", $data['team_schedule']);
            $res->bindParam(":id_journey", $data['journey']);
            $res->bindParam(":id_teacher", $data['teacher']);
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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id AS "team_schedule", t3.id AS "journey", t4.id AS "teacher", t5.id AS "location", t6.id AS "subject" FROM english_skills AS t1';
            $queryGetAll .= ' INNER JOIN team_schedule AS t2 ON t1.id_team_schedule = t2.id';
            $queryGetAll .= ' INNER JOIN journey AS t3 ON t1.id_journey = t3.id';
            $queryGetAll .= ' INNER JOIN teachers AS t4 ON t1.id_teacher = t4.id';
            $queryGetAll .= ' INNER JOIN locations AS t5 ON t1.id_location = t5.id';
            $queryGetAll .= ' INNER JOIN subjects AS t5 ON t1.id_subject = t6.id';


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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id AS "team_schedule", t3.id AS "journey", t4.id AS "teacher", t5.id AS "location", t6.id AS "subject" FROM english_skills AS t1';
            $queryGetid .= ' INNER JOIN team_schedule AS t2 ON t1.id_team_schedule = t2.id';
            $queryGetid .= ' INNER JOIN journey AS t3 ON t1.id_journey = t3.id';
            $queryGetid .= ' INNER JOIN teachers AS t4 ON t1.id_teacher = t4.id';
            $queryGetid .= ' INNER JOIN locations AS t5 ON t1.id_location = t5.id';
            $queryGetid .= ' INNER JOIN subjects AS t5 ON t1.id_subject = t6.id';
            $queryGetid .= ' WHERE t1.id = :id';

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
            $query = 'DELETE FROM english_skills WHERE id = :id';
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
            $query = 'UPDATE english_skills SET';
            $params = [];

            if ($data['journey'] !== null) {
                $query .= ' id_journey = :id_journey,';
                $params[':id_journey'] = $data['journey'];
            }
            if (isset($data['teacher'])) {
                $query .= ' id_teacher = :id_teacher,';
                $params[':teacher'] = $data['teacher'];
            }
            if (isset($data['location'])) {
                $query .= ' id_location = :id_location,';
                $params[':id_location'] = $data['location'];
            }
            if (isset($data['subject'])) {
                $query .= ' id_subject = :id_subject,';
                $params[':id_subject'] = $data['subject'];
            }
            if (isset($data['team_schedule'])) {
                $query .= ' id_team_schedule = :id_team_schedule,';
                $params[':id_team_schedule'] = $data['team_schedule'];
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
