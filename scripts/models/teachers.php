<?php

namespace App;

use connect;

class ModelTeachers extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO teachers(id_staff, id_route, id_academic_area, id_position, id_team_educator) VALUES(:staff, :route, :academic_area, :position, :team_educator)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":route", $data['route']);
            $res->bindParam(":staff", $data['staff']);
            $res->bindParam(":academic_area", $data['academic_area']);
            $res->bindParam(":position", $data['position']);
            $res->bindParam(":team_educator", $data['team_educator']);
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
            $queryGetAll = 'SELECT id AS "identificador", id_staff AS "staff", id_route AS "route", id_academic_area AS "academic_area_psycologist", id_position AS "position", id_team_educator AS "team_educator" FROM teachers';

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
            $queryGetid = 'SELECT id AS "identificador", id_staff AS "staff", id_route AS "route", id_academic_area AS "academic_area_psycologist", id_position AS "position", id_team_educator AS "team_educator" FROM teachers';
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
            $query = 'DELETE FROM teachers WHERE id = :id';
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
            $query = 'UPDATE teachers SET';
            $params = [];

            if ($data['route'] !== null) {
                $query .= ' id_route = :id_route,';
                $params[':route'] = $data['route'];
            }
            if (isset($data['academic_area'])) {
                $query .= ' id_academic_area = :id_academic_area,';
                $params[':id_academic_area'] = $data['academic_area'];
            }
            if (isset($data['staff'])) {
                $query .= ' id_staff = :id_staff,';
                $params[':id_staff'] = $data['staff'];
            }
            if (isset($data['position'])) {
                $query .= ' id_position = :id_position,';
                $params[':id_position'] = $data['position'];
            }
            if (isset($data['team_educator'])) {
                $query .= ' id_team_educator = :id_team_educator,';
                $params[':id_team_educator'] = $data['team_educator'];
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
