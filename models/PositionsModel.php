<?php

require_once dirname(__DIR__) . '/config/database.php';

class PositionsModel extends DB
{
    public $ID;
    public $Position;
    public $CreatedOn;
    public $UpdatedOn;

    public function __construct($ID = "", $Position = "", $CreatedOn = "", $UpdatedOn = "")
    {
        $this->ID = $ID;
        $this->Position = $Position;
        $this->CreatedOn = $CreatedOn;
        $this->UpdatedOn = $UpdatedOn;
    }

    public function insertPosition()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO positions (Position, CreatedOn) VALUES (:position, :date)
            ";
            $sql = $con->prepare($query);
            $params = [
                $this->Position,
                date('Y-m-d H:i:s')
            ];
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updatePosition()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE positions SET Position = :position, UpdatedOn = :date WHERE ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':position' => $this->Position,
                ':date' => date('Y-m-d H:i:s'),
                ':id' => $this->ID
            ];
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function deletePosition()
    {
        try {
            $con = $this->con();
            $query = "
                DELETE FROM positions WHERE ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID
            ];
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllPositions()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT * FROM positions ORDER BY Position
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



    public function checkPosition()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT ID FROM positions WHERE Position = :position
            ";
            $sql = $con->prepare($query);
            $params = [
                ':position' => $this->Position
            ];
            if ($sql->execute($params)) {
                return $sql->rowCount() > 0;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getOnePosition()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT ID, Position FROM positions WHERE ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID
            ];
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
