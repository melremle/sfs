<?php

require_once dirname(__DIR__) . '/config/database.php';

class FilesModel extends DB
{
    public $ID;
    public $OwnerID;
    public $FileTypeID;
    public $FileName;
    public $FileSize;
    public $FilePath;
    public $IsShared;
    public $IsArchived;
    public $InTrash;
    public $InTrashDate;
    public $UserID;
    public $Token;
    public $CreatedOn;

    public function __construct(
        $ID = '',
        $OwnerID = '',
        $FileTypeID = '',
        $FileName = '',
        $FileSize = '',
        $FilePath = '',
        $IsShared = '',
        $IsArchived = '',
        $InTrash = '',
        $InTrashDate = '',
        $UserID = '',
        $Token = '',
        $CreatedOn = ''
    ) {
        $this->ID = $ID;
        $this->OwnerID = $OwnerID;
        $this->FileTypeID = $FileTypeID;
        $this->FileName = $FileName;
        $this->FileSize = $FileSize;
        $this->FilePath = $FilePath;
        $this->IsShared = $IsShared;
        $this->IsArchived = $IsArchived;
        $this->InTrash = $InTrash;
        $this->InTrashDate = $InTrashDate;
        $this->UserID = $UserID;
        $this->Token = $Token;
        $this->CreatedOn = $CreatedOn;
    }

    public function upload()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO files (OwnerID, FileTypeID, FileName, FileSize, FilePath, CreatedOn) VALUES (?, ?, ?, ?, ?, ?)
            ";
            $sql = $con->prepare($query);
            $params = [
                $this->OwnerID,
                $this->FileTypeID,
                $this->FileName,
                $this->FileSize,
                $this->FilePath,
                date('Y-m-d H:i:s', strtotime('now'))
            ];
            if ($sql->execute($params)) {
                return $con->lastInsertId();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllMyFiles()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.*, mt.ExtensionName as filetype FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID WHERE OwnerID = ? AND IsArchived = 0 AND InTrash = 0";
            $sql = $con->prepare($query);
            $params = [
                $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllMyArchive()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.*, mt.ExtensionName as filetype FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID WHERE OwnerID = ? AND IsArchived = 1 AND InTrash = 0";
            $sql = $con->prepare($query);
            $params = [
                $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }


    public function getAllMyTrash()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.*, mt.ExtensionName as filetype FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID WHERE OwnerID = ? AND IsArchived = 0 AND InTrash = 1";
            $sql = $con->prepare($query);
            $params = [
                $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllFiles()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.*, mt.ExtensionName as filetype, CONCAT(u.FirstName, ' ', u.LastName) as fullname, u.Pic as pic FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID INNER JOIN users as u ON u.ID = f.OwnerID WHERE OwnerID != ? AND IsArchived = 0 AND InTrash = 0";
            $sql = $con->prepare($query);
            $params = [
                $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getShared()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    f.*,
                    mt.ExtensionName AS filetype,
                    CONCAT(u.FirstName, ' ', u.LastName) AS fullname,
                    u.Pic AS pic,
                    u.Username as username,
                    sf.CreatedOn as sharedon
                FROM
                    files AS f
                INNER JOIN media_types AS mt
                ON
                    mt.id = f.FileTypeID
                INNER JOIN users AS u
                ON
                    u.ID = f.OwnerID
                INNER JOIN
                    shared_files as sf
                ON
                    sf.FileID = f.ID
                WHERE
                    sf.UserID = :id AND f.OwnerID != :oid AND f.IsArchived = 0 AND f.InTrash = 0
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->OwnerID,
                ':oid' => $this->OwnerID,
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getOneFilename()
    {
        try {
            $con = $this->con();
            $query = "SELECT FileName as filename FROM files WHERE ID = ?";
            $sql = $con->prepare($query);
            $params = [
                $this->ID
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }


    public function getOneFile()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.*, mt.ExtensionName as filetype, CONCAT(u.FirstName, ' ', u.LastName) as fullname, u.Pic as pic FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID INNER JOIN users as u ON u.ID = f.OwnerID WHERE OwnerID != ? AND IsArchived = 0 AND InTrash = 0";
            $sql = $con->prepare($query);
            $params = [
                $this->ID
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkIfFilenamExists()
    {
        try {
            $con = $this->con();
            $query = "SELECT COUNT(FileName) as cnt, ID as id FROM files WHERE FileName REGEXP :filename AND FileTypeID = :typeid AND OwnerID = :ownerid";
            $sql = $con->prepare($query);
            $params = [
                ':filename' => "^" . $this->FileName . "$|^" . $this->FileName . " \\([0-9]+\\)$",
                ':typeid' => $this->FileTypeID,
                ':ownerid' => $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkIfFilenamExists2()
    {
        try {
            $con = $this->con();
            $query = "SELECT COUNT(FileName) as cnt, ID as id FROM files WHERE FileName = :filename AND FileTypeID = :typeid AND OwnerID = :ownerid";
            $sql = $con->prepare($query);
            $params = [
                ':filename' => $this->FileName,
                ':typeid' => $this->FileTypeID,
                ':ownerid' => $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateFilename()
    {
        try {
            $con = $this->con();
            $query = "UPDATE files SET FileName = :filename WHERE ID = :id";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID,
                ':filename' => $this->FileName
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkIfOwner()
    {
        try {
            $con = $this->con();
            $query = "SELECT Filename file FROM files WHERE ID = :id AND OwnerID = :ownerid";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID,
                ':ownerid' => $this->OwnerID
            ];
            if ($sql->execute($params)) {
                return $sql->rowCount() == 1;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getEKey($uid, $fid, $token)
    {
        try {
            $con = $this->con();
            $query = "SELECT Token FROM shared_files WHERE Token = :token AND UserID = :uid AND FileID = :fid";
            $sql = $con->prepare($query);
            $params = [
                ':token' => $token,
                ':uid' => $uid,
                ':fid' => $fid
            ];
            if ($sql->execute($params)) {
                return $sql->rowCount() == 1;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getFileDetailForDownload()
    {
        try {
            $con = $this->con();
            $query = "SELECT f.FileName as filename, mt.ExtensionName as filetype, f.FilePath as path FROM files as f INNER JOIN media_types as mt ON mt.id = f.FileTypeID WHERE f.ID = :id";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID,
            ];
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateShareFile()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    files
                SET
                    IsShared = 1
                WHERE
                    ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $this->ID,
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateUnShareFile($ID)
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    files
                SET
                    IsShared = 0
                WHERE
                    ID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $ID,
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function shareFile()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO
                    shared_files
                (
                    UserID,
                    OwnerID,
                    FileID,
                    Token,
                    CreatedOn
                )
                VALUES
                (
                    :uid,
                    :oid,
                    :fid,
                    :token,
                    :date
                )
            ";
            $sql = $con->prepare($query);
            $params = [
                ':uid' => $this->UserID,
                ':oid' => $this->OwnerID,
                ':fid' => $this->ID,
                ':token' => $this->Token,
                ':date' => date('Y-m-d H:i:s')
            ];
            if ($sql->execute($params)) {
                return true;
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function removeFromShare()
    {
        try {
            $con = $this->con();
            $query = "
                DELETE FROM
                    shared_files
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
            return (json_encode($e->getMessage()));
        }
    }

    public function countFromShare($ID)
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    ID
                FROM
                    shared_files
                WHERE
                    FileID = :id
            ";
            $sql = $con->prepare($query);
            $params = [
                ':id' => $ID
            ];
            if ($sql->execute($params)) {
                return $sql->rowCount();
            }
            http_response_code(500);
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }


    public function moveToArchive()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    files
                SET
                    IsArchived = 1,
                    InTrash = 0
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
            return (json_encode($e->getMessage()));
        }
    }

    public function moveToDrive()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    files
                SET
                    IsArchived = 0,
                    InTrash = 0
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
            return (json_encode($e->getMessage()));
        }
    }

    public function moveToTrash()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    files
                SET
                    IsArchived = 0,
                    InTrash = 1
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
            return (json_encode($e->getMessage()));
        }
    }


    public function permanentDelete()
    {
        try {
            $con = $this->con();
            $query = "
                DELETE FROM
                    files
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
            return (json_encode($e->getMessage()));
        }
    }
}
