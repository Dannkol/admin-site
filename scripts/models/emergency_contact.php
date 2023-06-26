<?php

namespace App;

use connect;

class ModelEmergency_contact extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO emergency_contact(id_staff, cel_number , relationship, full_name, email) VALUES(:id_staff, :cel_number, :relationship, :full_name, :email)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_staff", $data['staff']);
            $res->bindParam(":cel_number", $data['cel_number']);
            $res->bindParam(":relationship", $data['relationship']);
            $res->bindParam(":full_name", $data['full_name']);
            $res->bindParam(":email", $data['email']);

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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id AS "staff", t1.cel_number , t1.relationship , t1.full_name , t1.email FROM emergency_contact AS t1';
            $queryGetAll .= ' INNER JOIN staff AS t2 ON t1.id_staff = t2.id';

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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id AS "staff", t1.cel_number , t1.relationship , t1.full_name , t1.email FROM emergency_contact AS t1';
            $queryGetid .= ' INNER JOIN staff AS t2 ON t1.id_staff = t2.id';
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
            $query = 'DELETE FROM emergency_contact WHERE id = :id';
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
            $query = 'UPDATE emergency_contact SET';
            $params = [];

            if ($data['staff'] !== null) {
                $query .= ' id_staff = :id_staff,';
                $params[':id_staff'] = $data['staff'];
            }
            if (isset($data['cel_number'])) {
                $query .= ' cel_number = :cel_number,';
                $params[':cel_number'] = $data['cel_number'];
            }
            if (isset($data['relationship'])) {
                $query .= ' relationship = :relationship,';
                $params[':relationship'] = $data['relationship'];
            }
            if (isset($data['full_name'])) {
                $query .= ' full_name = :full_name,';
                $params[':full_name'] = $data['full_name'];
            }
            if (isset($data['email'])) {
                $query .= ' email = :email,';
                $params[':email'] = $data['email'];
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
