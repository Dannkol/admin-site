<?php

namespace App;

use connect;

class ModelaOptional_topics extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO optional_topics(id_topic, id_team, id_subject, id_camper, id_team_educator) VALUES(:topic, :team, :subject, :camper, :team_educator)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":topic", $data['topic']);
            $res->bindParam(":team", $data['team']);
            $res->bindParam(":subject", $data['subject']);
            $res->bindParam(":camper", $data['camper']);
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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id , t3.id , t4.id, t5.id, t6.id FROM optional_topics AS t1';
            $queryGetAll .= ' INNER JOIN topics AS t2 ON t1.id_topic = t2.id';
            $queryGetAll .= ' INNER JOIN team_schedule AS t3 ON t1.id_team = t3.id';
            $queryGetAll .= ' INNER JOIN subjects AS t4 ON t1.id_subject = t4.id';
            $queryGetAll .= ' INNER JOIN campers AS t5 ON t1.id_camper = t5.id';
            $queryGetAll .= ' INNER JOIN team_educators AS t5 ON t1.id_team_educator = t6.id';

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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id , t3.id , t4.id, t5.id, t6.id FROM optional_topics AS t1';
            $queryGetid .= ' INNER JOIN topics AS t2 ON t1.id_topic = t2.id';
            $queryGetid .= ' INNER JOIN team_schedule AS t3 ON t1.id_team = t3.id';
            $queryGetid .= ' INNER JOIN subjects AS t4 ON t1.id_subject = t4.id';
            $queryGetid .= ' INNER JOIN campers AS t5 ON t1.id_camper = t5.id';
            $queryGetid .= ' INNER JOIN team_educators AS t5 ON t1.id_team_educator = t6.id';
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
            $query = 'DELETE FROM optional_topics WHERE id = :id';
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
            $query = 'UPDATE optional_topics SET';
            $params = [];

            if ($data['topic'] !== null) {
                $query .= ' id_topic = :id_topic,';
                $params[':id_topic'] = $data['topic'];
            }
            if (isset($data['team'])) {
                $query .= ' id_team = :id_team,';
                $params[':id_team'] = $data['team'];
            }
            if (isset($data['subject'])) {
                $query .= ' id_subject = :id_subject,';
                $params[':id_subject'] = $data['subject'];
            }
            if (isset($data['camper'])) {
                $query .= ' id_camper = :id_camper,';
                $params[':id_camper'] = $data['camper'];
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
