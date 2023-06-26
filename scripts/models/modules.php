<?php

namespace App;

use connect;

class ModelModules extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO modules(id_theme, name_module , start_date, end_date, description, duration_days) VALUES(:theme, :name_module, :start_date, :end_date, :description, :duration_day)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_theme", $data['theme']);
            $res->bindParam(":name_module", $data['name_module']);
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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id AS "id_theme", t2.name_theme AS "name_thematics", name_module , start_date , end_date , description , duration_days FROM modules AS t1';
            $queryGetAll .= ' INNER JOIN themes AS t2 ON t1.id_theme = t2.id';

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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id AS "id_theme", t2.name_theme AS "name_thematics", name_module , start_date , end_date , description , duration_days FROM modules AS t1';
            $queryGetid .= ' INNER JOIN themes AS t2 ON t1.id_theme = t2.id';
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
            $query = 'DELETE FROM modules WHERE id = :id';
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
            $query = 'UPDATE modules SET';
            $params = [];

            if ($data['theme'] !== null) {
                $query .= ' id_theme = :id_theme,';
                $params[':id_theme'] = $data['theme'];
            }
            if (isset($data['name_module'])) {
                $query .= ' name_module = :name_module,';
                $params[':name_module'] = $data['name_module'];
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
