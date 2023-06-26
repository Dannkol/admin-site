<?php

namespace App;

use connect;

class ModelStaff extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO staff(doc, first_name , second_name, first_surname, second_surname, eps , id_area, id_city) VALUES(:doc, :first_name, :second_name, :first_surname, :second_surname, :eps, :id_area, :id_city)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":doc", $data['doc']);
            $res->bindParam(":first_name", $data['first_name']);
            $res->bindParam(":second_name", $data['second_name']);
            $res->bindParam(":first_surname", $data['first_surname']);
            $res->bindParam(":second_surname", $data['second_surname']);
            $res->bindParam(":eps", $data['eps']);
            $res->bindParam(":id_area", $data['area']);
            $res->bindParam(":id_city", $data['city']);

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
            $queryGetAll = 'SELECT id AS "identificador", doc, first_name, second_name, first_surname, second_surname, eps, id_area, id_city FROM staff ';

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
            $queryGetid = 'SELECT id AS "identificador", doc, first_name, second_name, first_surname, second_surname, eps, id_area, id_city FROM staff ';
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
            $query = 'DELETE FROM staff WHERE id = :id';
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
            $query = 'UPDATE staff SET';
            $params = [];

            if ($data['first_name'] !== null) {
                $query .= ' first_name = :first_name,';
                $params[':first_name'] = $data['first_name'];
            }
            if (isset($data['second_name'])) {
                $query .= ' second_name = :second_name,';
                $params[':second_name'] = $data['second_name'];
            }
            if (isset($data['first_surname'])) {
                $query .= ' first_surname = :first_surname,';
                $params[':first_surname'] = $data['first_surname'];
            }
            if (isset($data['second_surname'])) {
                $query .= ' second_surname = :second_surname,';
                $params[':second_surname'] = $data['second_surname'];
            }
            if (isset($data['eps'])) {
                $query .= ' eps = :eps,';
                $params[':eps'] = $data['eps'];
            }
            if (isset($data['area'])) {
                $query .= ' id_area = :id_area,';
                $params[':id_area'] = $data['area'];
            }
            if (isset($data['city'])) {
                $query .= ' id_city = :id_city,';
                $params[':id_city'] = $data['city'];
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
