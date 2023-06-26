<?php


namespace App;

use connect;

class ModelWorking_info extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO working_info(id_staff , years_exp, months_exp, id_work_reference, id_personal_ref, start_contract, end_contract) VALUES(:id_staff, :years_exp, :months_exp, :id_work_reference, :id_personal_ref, :id_personal_ref, :start_contract, :end_contract)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_staff", $data['staff']);
            $res->bindParam(":years_exp", $data['years_exp']);
            $res->bindParam(":months_exp", $data['months_exp']);
            $res->bindParam(":work_reference", $data['work_reference']);
            $res->bindParam(":id_personal_ref", $data['personal_ref']);
            $res->bindParam(":start_contract", $data['start_contract']);
            $res->bindParam(":end_contract", $data['end_contract']);

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
            $queryGetAll = 'SELECT id , id_staff , years_exp, months_exp, id_work_reference, id_personal_ref, start_contract, end_contract) FROM working_info';
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
            $queryGetid = 'SELECT id , id_staff , years_exp, months_exp, id_work_reference, id_personal_ref, start_contract, end_contract) FROM working_info';
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
            $query = 'DELETE FROM working_info WHERE id = :id';
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
            $query = 'UPDATE working_info SET';
            $params = [];

            if ($data['staff'] !== null) {
                $query .= ' id_staff = :id_staff,';
                $params[':id_staff'] = $data['staff'];
            }
            if ($data['years_exp'] !== null) {
                $query .= ' years_exp = :years_exp,';
                $params[':years_exp'] = $data['years_exp'];
            }
            if ($data['months_exp'] !== null) {
                $query .= ' months_exp = :months_exp,';
                $params[':months_exp'] = $data['months_exp'];
            }
            if ($data['work_reference'] !== null) {
                $query .= ' id_work_reference = :id_work_reference,';
                $params[':id_work_reference'] = $data['work_reference'];
            }
            if ($data['personal_ref'] !== null) {
                $query .= ' id_personal_ref = :id_personal_ref,';
                $params[':id_personal_ref'] = $data['id_personal_ref'];
            }
            if ($data['start_contract'] !== null) {
                $query .= ' start_contract = :start_contract,';
                $params[':start_contract'] = $data['start_contract'];
            }
            if ($data['end_contract'] !== null) {
                $query .= ' end_contract = :end_contract,';
                $params[':end_contract'] = $data['end_contract'];
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
