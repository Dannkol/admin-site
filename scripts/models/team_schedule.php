<?php

namespace App;

use connect;

class ModelTeam_schedule extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO team_schedule(team_name, check_in_skills , check_out_skills, check_in_soft, check_out_soft, check_in_english , check_out_english, check_in_review, check_out_review, id_journey) VALUES(:team_name, :check_in_skills, :check_out_skills, :check_in_soft, :check_out_soft, :check_in_english, :check_out_english, :check_in_review, :check_out_review, :id_journey)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":team_name", $data['team_name']);
            $res->bindParam(":check_in_skills", $data['check_in_skills']);
            $res->bindParam(":check_out_skills", $data['check_out_skills']);
            $res->bindParam(":check_in_soft", $data['check_in_soft']);
            $res->bindParam(":check_out_soft", $data['check_out_soft']);
            $res->bindParam(":check_in_english", $data['check_in_english']);
            $res->bindParam(":check_out_english", $data['check_out_english']);
            $res->bindParam(":check_in_review", $data['check_in_review']);
            $res->bindParam(":check_out_review", $data['check_out_review']);
            $res->bindParam(":id_journey", $data['journey']);


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
            $queryGetAll = 'SELECT id AS "identificador", team_name, check_in_skills , check_out_skills, check_in_soft, check_out_soft, check_in_english , check_out_english, check_in_review, check_out_review, id_journey FROM team_schedule ';

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
            $queryGetid = 'SELECT id AS "identificador", team_name, check_in_skills , check_out_skills, check_in_soft, check_out_soft, check_in_english , check_out_english, check_in_review, check_out_review, id_journey FROM team_schedule ';
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
            $query = 'DELETE FROM team_schedule WHERE id = :id';
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
            $query = 'UPDATE team_schedule SET';
            $params = [];

            if ($data['team_name'] !== null) {
                $query .= ' team_name = :team_name,';
                $params[':team_name'] = $data['team_name'];
            }
            if (isset($data['check_in_skills'])) {
                $query .= ' check_in_skills = :check_in_skills,';
                $params[':check_in_skills'] = $data['check_in_skills'];
            }
            if (isset($data['check_out_skills'])) {
                $query .= ' check_out_skills = :check_out_skills,';
                $params[':check_out_skills'] = $data['check_out_skills'];
            }
            if (isset($data['check_in_soft'])) {
                $query .= ' check_in_soft = :check_in_soft,';
                $params[':check_in_soft'] = $data['check_in_soft'];
            }
            if (isset($data['epcheck_out_softs'])) {
                $query .= ' check_out_soft = :check_out_soft,';
                $params[':check_out_soft'] = $data['check_out_soft'];
            }
            if (isset($data['check_in_english'])) {
                $query .= ' check_in_english = :check_in_english,';
                $params[':check_in_english'] = $data['check_in_english'];
            }
            if (isset($data['check_in_review'])) {
                $query .= ' check_in_review = :check_in_review,';
                $params[':check_in_review'] = $data['check_in_review'];
            }
            if (isset($data['check_out_review'])) {
                $query .= ' check_out_review = :check_out_review,';
                $params[':check_out_review'] = $data['check_out_review'];
            }
            if (isset($data['journey'])) {
                $query .= ' id_journey = :id_journey,';
                $params[':id_journey'] = $data['journey'];
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
