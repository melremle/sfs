<?php

require_once dirname(__DIR__) . '/config/database.php';

class OfficesModel extends DB
{
    public $ID;
    public $Office;
    public $Logo;
    public $CreatedOn;
    public $UpdatedOn;

    public function __construct($ID = "", $Office = "", $Logo = "", $CreatedOn = "", $UpdatedOn = "")
    {
        $this->ID = $ID;
        $this->Office = $Office;
        $this->Logo = $Logo;
        $this->CreatedOn = $CreatedOn;
        $this->UpdatedOn = $UpdatedOn;
    }

    public function getAllOffices()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT * FROM offices ORDER BY Office
            ";
            $sql = $con->prepare($query);
            if ($sql->execute()) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getOneOffice()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT * FROM offices WHERE ID = :id
            ";
            $params = [
                ':id' => $this->ID
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkOffice()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT ID FROM offices WHERE Office = :office
            ";
            $params = [
                ':office' => $this->Office
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->rowCount() > 0;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function insertOffice()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO offices (Office, Logo, CreatedOn) VALUES (:office, :logo, :date)
            ";
            $params = [
                ':office' => $this->Office,
                ':logo' => $this->Logo,
                ':date' => date('Y-m-d H:i:s'),
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateOffice()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE offices SET Office = :office, UpdatedOn = :date WHERE ID = :id
            ";
            $params = [
                ':office' => $this->Office,
                ':date' => date('Y-m-d H:i:s'),
                ':id' => $this->ID,
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateOfficewLogo()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE offices SET Office = :office, Logo = :logo, UpdatedOn = :date WHERE ID = :id
            ";
            $params = [
                ':office' => $this->Office,
                ':logo' => $this->Logo,
                ':date' => date('Y-m-d H:i:s'),
                ':id' => $this->ID,
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function deleteOffice()
    {
        try {
            $con = $this->con();
            $query = "
                DELETE FROM offices WHERE ID = :id
            ";
            $params = [
                ':id' => $this->ID,
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getOfficeLogo()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT Logo FROM offices WHERE ID = :id
            ";
            $params = [
                ':id' => $this->ID,
            ];
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }
}
