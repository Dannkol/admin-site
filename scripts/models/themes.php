<?php

namespace App;

use connect;

class ModelThemes extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO themes(id_chapter, name_theme , start_date, end_date, description, duration_days) VALUES(:chapter, :name_theme, :start_date, :end_date, :description, :duration_day)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_chapter", $data['chapter']);
            $res->bindParam(":name_theme", $data['name_theme']);
            $res->bindParam(":start_date", $data['start_date']);
            $res->bindParam(":end_date", $data['end_date']);
            $res->bindParam(":description", $data['description']);
            $res->bindParam(":duration_days", $data['duration_days']);

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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id AS "id_chapter", t2.name_chapter AS "chapter" , start_date , end_date , description , duration_days FROM themes AS t1';
            $queryGetAll .= ' INNER JOIN chapters AS t2 ON t1.id_chapter = t2.id';

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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id AS "id_chapter", t2.name_chapter AS "chapter" , start_date , end_date , description , duration_days FROM themes AS t1';
            $queryGetid .= ' INNER JOIN chapters AS t2 ON t1.id_chapter = t2.id';
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
            $query = 'DELETE FROM themes WHERE id = :id';
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
            $query = 'UPDATE themes SET';
            $params = [];

            if ($data['chapter'] !== null) {
                $query .= ' id_chapter = :id_chapter,';
                $params[':id_chapter'] = $data['chapter'];
            }
            if (isset($data['name_theme'])) {
                $query .= ' name_theme = :name_theme,';
                $params[':name_theme'] = $data['name_theme'];
            }
            if (isset($data['start_date'])) {
                $query .= ' start_date = :start_date,';
                $params[':start_date'] = $data['start_date'];
            }
            if (isset($data['end_date'])) {
                $query .= ' end_date = :end_date,';
                $params[':end_date'] = $data['end_date'];
            }
            if (isset($data['description'])) {
                $query .= ' description = :description,';
                $params[':description'] = $data['description'];
            }
            if (isset($data['duration_days'])) {
                $query .= ' duration_days = :duration_days,';
                $params[':duration_days'] = $data['duration_days'];
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
