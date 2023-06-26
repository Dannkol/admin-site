<?php

namespace App;

use connect;

class ModelDesign_area extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO design_area(id_area,id_staff,id_position,id_journeys) VALUES(:area,:staff,:position,:journeys)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":area", $data['area']);
            $res->bindParam(":staff", $data['staff']);
            $res->bindParam(":position", $data['position']);
            $res->bindParam(":journeys", $data['journeys']);
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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.name_area AS "area", t3.first_name AS "staff_first_name", t4.name_position AS "position", t5.name_journey AS "journeys" FROM design_area AS t1';
            $queryGetAll .= ' INNER JOIN areas AS t2 ON t1.id_area = t2.id';
            $queryGetAll .= ' INNER JOIN staff AS t3 ON t1.id_staff = t3.id';
            $queryGetAll .= ' INNER JOIN position AS t4 ON t1.id_position = t4.id';
            $queryGetAll .= ' INNER JOIN journey AS t5 ON t1.id_journeys = t5.id';

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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.name_area AS "area", t3.first_name AS "staff_first_name", t4.name_position AS "position", t5.name_journey AS "journeys" FROM design_area AS t1';
            $queryGetid .= ' INNER JOIN areas AS t2 ON t1.id_area = t2.id';
            $queryGetid .= ' INNER JOIN staff AS t3 ON t1.id_staff = t3.id';
            $queryGetid .= ' INNER JOIN position AS t4 ON t1.id_position = t4.id';
            $queryGetid .= ' INNER JOIN journey AS t5 ON t1.id_journeys = t5.id';
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
            $query = 'DELETE FROM design_area WHERE id = :id';
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
            $query = 'UPDATE design_area SET';
            $params = [];

            if ($data['area'] !== null) {
                $query .= ' id_area = :id_area,';
                $params[':id_area'] = $data['area'];
            }
            if (isset($data['staff'])) {
                $query .= ' id_staff = :id_staff,';
                $params[':id_staff'] = $data['staff'];
            }
            if (isset($data['position'])) {
                $query .= ' id_position = :id_position,';
                $params[':id_position'] = $data['position'];
            }
            if (isset($data['journeys'])) {
                $query .= ' id_journeys = :id_journeys,';
                $params[':id_journeys'] = $data['journeys'];
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
