<?php


namespace App;

use connect;

class ModelWork_reference extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO work_reference(full_name , cel_number, position, company) VALUES(:full_name, :cel_number, :position, :company)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":full_name", $data['full_name']);
            $res->bindParam(":cel_number", $data['cel_number']);
            $res->bindParam(":position", $data['position']);
            $res->bindParam(":company", $data['company']);

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
            $queryGetAll = 'SELECT id , full_name, cel_number, position, company FROM work_reference';
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
            $queryGetid = 'SELECT id , full_name, cel_number, position, company FROM work_reference';
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
            $query = 'DELETE FROM work_reference WHERE id = :id';
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
            $query = 'UPDATE work_reference SET';
            $params = [];

            if ($data['full_name'] !== null) {
                $query .= ' full_name = :full_name,';
                $params[':full_name'] = $data['full_name'];
            }
            if ($data['cel_number'] !== null) {
                $query .= ' cel_number = :cel_number,';
                $params[':cel_number'] = $data['cel_number'];
            }
            if ($data['position'] !== null) {
                $query .= ' position = :position,';
                $params[':position'] = $data['position'];
            }
            if ($data['company'] !== null) {
                $query .= ' company = :company,';
                $params[':company'] = $data['company'];
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
