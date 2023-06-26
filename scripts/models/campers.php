<?php

namespace App;

use connect;

class ModelCampers extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO campers(id_team_schedule, id_route , id_trainer, id_psycologist, id_teacher, id_level , id_journey, id_staff) VALUES(:team_schedule, :route, :trainer, :psycologist, :teacher, :level, :journey, :staff)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":team_schedule", $data['team_schedule']);
            $res->bindParam(":route", $data['route']);
            $res->bindParam(":trainer", $data['trainer']);
            $res->bindParam(":psycologist", $data['psycologist']);
            $res->bindParam(":teacher", $data['teacher']);
            $res->bindParam(":level", $data['level']);
            $res->bindParam(":journey", $data['journey']);
            $res->bindParam(":staff", $data['staff']);

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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.team_name AS "team", t3.name_route AS "ruta", t4.id AS "trainer", t5.id AS "psychologist", t6.id AS "teacher", t7.name_level AS "nombre_level", t8.name_journey AS "name_journey", t9.first_name AS "name_staff" FROM campers AS t1';
            $queryGetAll .= ' INNER JOIN team_schedule AS t2 ON t1.id_team_schedule = t2.id';
            $queryGetAll .= ' INNER JOIN routes AS t3 ON t1.id_route = t3.id';
            $queryGetAll .= ' INNER JOIN trainers AS t4 ON t1.id_trainer = t4.id';
            $queryGetAll .= ' INNER JOIN psychologist AS t5 ON t1.id_psychologist = t5.id';
            $queryGetAll .= ' INNER JOIN teachers AS t6 ON t1.id_teacher = t6.id';
            $queryGetAll .= ' INNER JOIN teachers AS t6 ON t1.id_teacher = t6.id';
            $queryGetAll .= ' INNER JOIN levels AS t7 ON t1.id_level = t7.id';
            $queryGetAll .= ' INNER JOIN journey AS t8 ON t1.id_journey = t8.id';
            $queryGetAll .= ' INNER JOIN staff AS t9 ON t1.id_staff = t9.id';


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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.team_name AS "team", t3.name_route AS "ruta", t4.id AS "trainer", t5.id AS "psychologist", t6.id AS "teacher", t7.name_level AS "nombre_level", t8.name_journey AS "name_journey", t9.first_name AS "name_staff" FROM campers AS t1';
            $queryGetid .= ' INNER JOIN team_schedule AS t2 ON t1.id_team_schedule = t2.id';
            $queryGetid .= ' INNER JOIN routes AS t3 ON t1.id_route = t3.id';
            $queryGetid .= ' INNER JOIN trainers AS t4 ON t1.id_trainer = t4.id';
            $queryGetid .= ' INNER JOIN psychologist AS t5 ON t1.id_psychologist = t5.id';
            $queryGetid .= ' INNER JOIN teachers AS t6 ON t1.id_teacher = t6.id';
            $queryGetid .= ' INNER JOIN teachers AS t6 ON t1.id_teacher = t6.id';
            $queryGetid .= ' INNER JOIN levels AS t7 ON t1.id_level = t7.id';
            $queryGetid .= ' INNER JOIN journey AS t8 ON t1.id_journey = t8.id';
            $queryGetid .= ' INNER JOIN staff AS t9 ON t1.id_staff = t9.id';
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
            $query = 'DELETE FROM campers WHERE id = :id';
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
            $query = 'UPDATE campers SET';
            $params = [];

            if ($data['team_schedule'] !== null) {
                $query .= ' id_area = :id_area,';
                $params[':id_area'] = $data['area'];
            }
            if (isset($data['staff'])) {
                $query .= ' id_staff = :id_staff,';
                $params[':id_staff'] = $data['staff'];
            }
            if (isset($data['route'])) {
                $query .= ' id_route = :id_route,';
                $params[':id_route'] = $data['route'];
            }
            if (isset($data['journeys'])) {
                $query .= ' id_journeys = :id_journeys,';
                $params[':id_journeys'] = $data['journeys'];
            }
            if (isset($data['psycologist'])) {
                $query .= ' id_psycologist = :id_psycologist,';
                $params[':id_psycologist'] = $data['psycologist'];
            }
            if (isset($data['trainer'])) {
                $query .= ' id_trainer = :id_trainer,';
                $params[':id_trainer'] = $data['trainer'];
            }
            if (isset($data['teacher'])) {
                $query .= ' id_teacher = :id_teacher,';
                $params[':id_teacher'] = $data['teacher'];
            }
            if (isset($data['level'])) {
                $query .= ' id_level = :id_level,';
                $params[':id_level'] = $data['level'];
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
