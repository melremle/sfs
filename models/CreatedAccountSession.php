<?php

require_once dirname(__DIR__) . '/config/database.php';

class CreatedAccountSession extends DB
{
    public $ID;
    public $Username;
    public $TemporaryPassword;
    public $SessionToken;

    public function __construct($ID = "", $Username = "", $TemporaryPassword = "", $SessionToken = "")
    {
        $this->ID = $ID;
        $this->Username = $Username;
        $this->TemporaryPassword = $TemporaryPassword;
        $this->SessionToken = $SessionToken;
    }

    public function verifyToken()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    *
                FROM
                    created_account_session
                WHERE
                    SessionToken = :token
            ";
            $sql = $con->prepare($query);
            $params = [
                ':token' => $this->SessionToken,
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function verifyTPassword()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    *
                FROM
                    created_account_session
                WHERE
                    TemporaryPassword = :tpassword AND
                    SessionToken = :token
            ";
            $sql = $con->prepare($query);
            $params = [
                ':token' => $this->SessionToken,
                ':tpassword' => $this->TemporaryPassword,
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function insertToken()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO
                    created_account_session
                (
                    Username,
                    TemporaryPassword,
                    SessionToken
                )
                VALUES
                (
                    :username,
                    :tpassword,
                    :token
                )
            ";
            $sql = $con->prepare($query);
            $params = [
                ':username' => $this->Username,
                ':tpassword' => $this->TemporaryPassword,
                ':token' => $this->SessionToken,
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }

    public function deleteToken()
    {
        try {
            $con = $this->con();
            $query = "
                DELETE FROM
                    created_account_session
                WHERE
                    ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return $e->getMessage();
        }
    }
}
