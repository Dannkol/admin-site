<?php


namespace App;

use connect;

class ModelPersonal_ref extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO personal_ref(full_name , cel_number, relationship, occupation) VALUES(:full_name, :cel_number, :relationship, :occupation)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":full_name", $data['full_name']);
            $res->bindParam(":cel_number", $data['cel_number']);
            $res->bindParam(":relationship", $data['relationship']);
            $res->bindParam(":occupation", $data['occupation']);



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
            $queryGetAll = 'SELECT id , full_name, cel_number, relationship, occupation FROM personal_ref';
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
            $queryGetid = 'SELECT id , full_name, cel_number, relationship, occupation FROM personal_ref';
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
            $query = 'DELETE FROM personal_ref WHERE id = :id';
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
            $query = 'UPDATE personal_ref SET';
            $params = [];

            if ($data['full_name'] !== null) {
                $query .= ' full_name = :full_name,';
                $params[':full_name'] = $data['full_name'];
            }
            if ($data['cel_number'] !== null) {
                $query .= ' cel_number = :cel_number,';
                $params[':cel_number'] = $data['cel_number'];
            }
            if ($data['relationship'] !== null) {
                $query .= ' relationship = :relationship,';
                $params[':relationship'] = $data['relationship'];
            }
            if ($data['occupation'] !== null) {
                $query .= ' occupation = :occupation,';
                $params[':occupation'] = $data['occupation'];
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
