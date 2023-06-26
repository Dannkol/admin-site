<?php

namespace App;

use connect;

class ModelContact_info extends connect
{
    private static $message;

    public static function post($data)
    {
        try {
            $query = 'INSERT INTO contact_info(id_staff, whatsapp , instagram, linkedin, email, address , cel_number) VALUES(:id_staff, :whatsapp, :instagram, :linkedin, :email, :address, :cel_number)';
            $res = self::getConnection()->prepare($query);
            $res->bindParam(":id_staff", $data['staff']);
            $res->bindParam(":whatsapp", $data['whatsapp']);
            $res->bindParam(":instagram", $data['instagram']);
            $res->bindParam(":linkedin", $data['linkedin']);
            $res->bindParam(":email", $data['email']);
            $res->bindParam(":address", $data['address']);
            $res->bindParam(":cel_number", $data['cel_number']);

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
            $queryGetAll = 'SELECT t1.id AS "identificador", t2.id AS "staff", t1.whatsapp , t1.instagram, t1.linkedin, t1.email, t1.address, t1.cel_number FROM contact_info AS t1';
            $queryGetAll .= ' INNER JOIN staff AS t2 ON t1.staff = t2.id';


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
            $queryGetid = 'SELECT t1.id AS "identificador", t2.id AS "staff", t1.whatsapp , t1.instagram, t1.linkedin, t1.email, t1.address, t1.cel_number FROM contact_info AS t1';
            $queryGetid .= ' INNER JOIN staff AS t2 ON t1.staff = t2.id';

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
            $query = 'DELETE FROM contact_info WHERE id = :id';
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
            $query = 'UPDATE contact_info SET';
            $params = [];

            if ($data['staff'] !== null) {
                $query .= ' id_staff = :id_staff,';
                $params[':staff'] = $data['staff'];
            }
            if (isset($data['whatsapp'])) {
                $query .= ' whatsapp = :whatsapp,';
                $params[':whatsapp'] = $data['whatsapp'];
            }
            if (isset($data['instagram'])) {
                $query .= ' instagram = :instagram,';
                $params[':instagram'] = $data['instagram'];
            }
            if (isset($data['linkedin'])) {
                $query .= ' linkedin = :linkedin,';
                $params[':linkedin'] = $data['linkedin'];
            }
            if (isset($data['email'])) {
                $query .= ' email = :email,';
                $params[':email'] = $data['email'];
            }
            if (isset($data['address'])) {
                $query .= ' address = :address,';
                $params[':address'] = $data['address'];
            }
            if (isset($data['cel_number'])) {
                $query .= ' cel_number = :cel_number,';
                $params[':cel_number'] = $data['cel_number'];
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
