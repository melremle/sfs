<?php

require_once dirname(__DIR__) . '/config/database.php';

class HistoryModel extends DB
{
    public $ID;
    public $UserId;
    public $FileId;
    public $ActivityType;
    public $Activity;
    public $CreatedOn;

    public function __construct(
        $ID = '',
        $UserId = '',
        $FileId = '',
        $ActivityType = '',
        $Activity = '',
        $CreatedOn = ''
    ) {
        $this->ID = $ID;
        $this->UserId = $UserId;
        $this->FileId = $FileId;
        $this->ActivityType = $ActivityType;
        $this->Activity = $Activity;
        $this->CreatedOn = $CreatedOn;
    }

    public function insertHistory()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO history (UserId, FileId, ActivityType, Activity, CreatedOn) VALUES (?, ?, ?, ?, ?)
            ";
            $sql = $con->prepare($query);
            $params = [
                $this->UserId,
                $this->FileId,
                $this->ActivityType,
                $this->Activity,
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
}
