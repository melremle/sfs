<?php

require_once dirname(__DIR__) . '/config/database.php';

class UsersModel extends DB
{
    public $ID;
    public $Username;
    public $Email;
    public $Password;
    public $TemporaryPassword;
    public $FirstName;
    public $LastName;
    public $Pic;
    public $IsActive;
    public $PositionID;
    public $OfficeID;
    public $Mobile;
    public $Access;
    public $LastAccess;
    public $LastLogin;
    public $CreatedOn;
    public $UpdatedOn;

    public function __construct(
        $ID = '',
        $Username = '',
        $Email = '',
        $Password = '',
        $TemporaryPassword = '',
        $FirstName = '',
        $LastName = '',
        $Pic = '',
        $IsActive = '',
        $PositionID = '',
        $OfficeID = '',
        $Mobile = '',
        $Access = '',
        $LastAccess = '',
        $LastLogin = '',
        $CreatedOn = '',
        $UpdatedOn = ''
    ) {
        $this->ID = $ID;
        $this->Username = $Username;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->TemporaryPassword = $TemporaryPassword;
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->Pic =   $Pic;
        $this->IsActive =   $IsActive;
        $this->PositionID =   $PositionID;
        $this->OfficeID =   $OfficeID;
        $this->Mobile =   $Mobile;
        $this->Access =   $Access;
        $this->LastAccess =   $LastAccess;
        $this->LastLogin =   $LastLogin;
        $this->CreatedOn = $CreatedOn;
        $this->UpdatedOn = $UpdatedOn;
    }

    public function checkUsername()
    {
        try {
            $con = $this->con();
            $query = "SELECT ID FROM users WHERE Username = :username";
            $sql = $con->prepare($query);
            $params = array(
                $this->Username,
            );
            if ($sql->execute($params)) {
                return $sql->rowCount();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkFullname()
    {
        try {
            $con = $this->con();
            $query = "SELECT ID FROM users WHERE FirstName = :firstname AND LastName = :lastname";
            $sql = $con->prepare($query);
            $params = array(
                ':firstname' => $this->FirstName,
                ':lastname' => $this->LastName,
            );
            if ($sql->execute($params)) {
                return $sql->rowCount();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkEmail()
    {
        try {
            $con = $this->con();
            $query = "SELECT ID FROM users WHERE Email = :email AND ID != :id";
            $sql = $con->prepare($query);
            $params = array(
                ':email' => $this->Email,
                ':id' => $this->ID
            );
            if ($sql->execute($params)) {
                return $sql->rowCount();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function checkPassword()
    {
        try {
            $con = $this->con();
            $query = "SELECT ID, Username, Access, CONCAT(FirstName, ' ', LastName) as fullname, Pic, IsActive FROM users WHERE Username = :username AND Password = :password";
            $sql = $con->prepare($query);
            $params = array(
                $this->Username,
                $this->Password,
            );
            if ($sql->execute($params)) {
                return $sql->fetch();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }



    public function getAllUsers()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    users.ID AS id,
                    Username AS username,
                    CONCAT(FirstName, ' ', LastName) AS fullname,
                    TemporaryPassword AS tpassword,
                    Email AS email,
                    MobileNumber as mobile,
                    LastAccess AS lastaccess,
                    LastLogin AS lastlogin,
                    users.CreatedOn AS created,
                    users.UpdatedOn AS updated,
                    IsActive AS isactive,
                    Position as position,
                    Office as office,
                    Logo as pic
                FROM
                    users
                LEFT JOIN
                    offices
                ON
                    offices.ID = users.OfficeID
                LEFT JOIN
                    positions
                ON
                    positions.ID = users.PositionID
                WHERE
                    Access != 1
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

    public function getAllUsersPerOffice()
    {
        try {
            $con = $this->con();
            $officeID = explode(',', $this->OfficeID);
            $officeQuery = "";
            $cnt = 1;
            foreach ($officeID as $offid) {
                if ($cnt == count($officeID)) {
                    $officeQuery .= " OfficeID = $offid";
                } else {
                    $officeQuery .= " OfficeID = $offid OR";
                }
                $cnt++;
            }
            $query = "
                SELECT
                    users.ID AS id,
                    CONCAT(FirstName, ' ', LastName) AS fullname,
                    Position as position,
                    Office as office,
                    Logo as pic
                FROM
                    users
                LEFT JOIN
                    offices
                ON
                    offices.ID = users.OfficeID
                LEFT JOIN
                    positions
                ON
                    positions.ID = users.PositionID
                WHERE
                    Access != 1 AND
                    (" . $officeQuery . ") AND
                    users.ID != :uid
                ORDER BY
                    FirstName
            ";

            $sql = $con->prepare($query);
            $params = [
                ':uid' => $this->ID,
            ];
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getOneUser()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    ID AS id,
                    Username AS username,
                    FirstName as firstname,
                    LastName as lastname,
                    Email AS email,
                    MobileNumber as mobile,
                    PositionID as position,
                    OfficeID as office,
                    Access as access
                FROM
                    users
                WHERE
                    Access != 1 AND
                    ID = :id
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

    public function getAllUsersPerTerm($fileID, $uid)
    {
        try {
            $con = $this->con();
            $query = "SELECT
                        users.ID as id,
                        CONCAT(FirstName, ' ', LastName) as fullname,
                        Email as email,
                        Username as username,
                        Position as position,
                        Office as office,
                        Logo as pic
                    FROM 
                        users
                    INNER JOIN
                        offices
                    ON
                        offices.ID = users.OfficeID
                    INNER JOIN
                        positions
                    ON
                        positions.ID = users.PositionID
                    WHERE
                        users.ID NOT IN (SELECT UserID FROM shared_files WHERE FileID = :fid) AND
                        users.ID != :uid AND (Access != 1) AND
                        (FirstName LIKE :firstname OR LastName LIKE :lastname OR Email LIKE :email)";
            $params = array(
                ':firstname' => '%' . $this->FirstName . '%',
                ':lastname' => '%' . $this->LastName . '%',
                ':email' => '%' . $this->Email . '%',
                ':fid' => $fileID,
                ':uid' => $uid,
            );
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllUsersNoTerm($fileID, $uid)
    {
        try {
            $con = $this->con();
            $query = "SELECT
                        users.ID as id,
                        CONCAT(FirstName, ' ', LastName) as fullname,
                        Email as email,
                        Username as username,
                        Position as position,
                        Office as office,
                        Logo as pic
                    FROM 
                        users
                    INNER JOIN
                        offices
                    ON
                        offices.ID = users.OfficeID
                    INNER JOIN
                        positions
                    ON
                        positions.ID = users.PositionID
                    WHERE
                        users.ID NOT IN (SELECT UserID FROM shared_files WHERE FileID = :fid) AND
                        users.ID != :uid AND (Access != 1)";
            $params = array(
                ':fid' => $fileID,
                ':uid' => $uid,
            );
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getAllUsersShared($fileID)
    {
        try {
            $con = $this->con();
            $query = "SELECT
                        shared_files.ID as id,
                        CONCAT(FirstName, ' ', LastName) as fullname,
                        Email as email,
                        Username as username,
                        Position as position,
                        Office as office,
                        Logo as pic
                    FROM 
                        users
                    INNER JOIN shared_files ON shared_files.UserID = users.ID
                    INNER JOIN
                        offices
                    ON
                        offices.ID = users.OfficeID
                    INNER JOIN
                        positions
                    ON
                        positions.ID = users.PositionID
                    WHERE
                        shared_files.FileID = :fid AND
                        (Access != 1)
                    ";
            $params = array(
                ':fid' => $fileID,
            );
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getFileDetails($fileID, $owner)
    {
        try {
            $con = $this->con();
            $query = "SELECT
                        media_types.MimeDescription as ftype,
                        files.FileSize as size,
                        files.UpdatedOn as modified,
                        files.CreatedOn as created,
                        IF(files.OwnerID = $owner, 'me', (SELECT CONCAT(FirstName, ' ', LastName) FROM users WHERE users.ID = $owner)) as owner,
                        shared_files.ID as id,
                        CONCAT(FirstName, ' ', LastName) as fullname,
                        Email as email,
                        Username as username,
                        Position as position,
                        Office as office,
                        Logo as pic,
                        files.IsShared as isshared
                    FROM 
                        users
                    INNER JOIN shared_files ON shared_files.UserID = users.ID
                    INNER JOIN
                        offices
                    ON
                        offices.ID = users.OfficeID
                    INNER JOIN
                        positions
                    ON
                        positions.ID = users.PositionID
                    INNER JOIN
                        files
                    ON
                        shared_files.FileID = files.ID
                    INNER JOIN
                        media_types
                    ON
                        media_types.ID = files.FileTypeID
                    WHERE
                        shared_files.FileID = :fid AND
                        (Access != 1)
                    ";
            $params = array(
                ':fid' => $fileID,
            );
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function getFileDetails2($fileID, $owner)
    {
        try {
            $con = $this->con();
            $query = "SELECT
                        media_types.MimeDescription as ftype,
                        files.FileSize as size,
                        files.UpdatedOn as modified,
                        files.CreatedOn as created,
                        IF(files.OwnerID = $owner, 'me', (SELECT CONCAT(FirstName, ' ', LastName) FROM users WHERE users.ID = $owner)) as owner,
                        CONCAT(FirstName, ' ', LastName) as fullname,
                        Email as email,
                        Username as username,
                        files.IsShared as isshared
                    FROM 
                        files
                    INNER JOIN
                        users
                    ON
                        users.ID = files.OwnerID
                    INNER JOIN
                        offices
                    ON
                        offices.ID = users.OfficeID
                    INNER JOIN
                        positions
                    ON
                        positions.ID = users.PositionID
                    INNER JOIN
                        media_types
                    ON
                        media_types.ID = files.FileTypeID
                    WHERE
                        files.ID = :fid
                    ";
            $params = array(
                ':fid' => $fileID,
            );
            $sql = $con->prepare($query);
            if ($sql->execute($params)) {
                return $sql->fetchAll();
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function addUser()
    {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO
                    users
                (
                    Username,
                    Email,
                    TemporaryPassword,
                    FirstName,
                    LastName,
                    PositionID,
                    OfficeID,
                    MobileNumber,
                    Access,
                    CreatedOn
                )
                VALUES
                (
                    :username,
                    :email,
                    :tpassword,
                    :fname,
                    :lname,
                    :position,
                    :office,
                    :mobile,
                    :access,
                    :date
                )
            ";
            $params = array(
                ':username' => $this->Username,
                ':email' => $this->Email,
                ':tpassword' => $this->TemporaryPassword,
                ':fname' => $this->FirstName,
                ':lname' => $this->LastName,
                ':position' => $this->PositionID,
                ':office' => $this->OfficeID,
                ':mobile' => $this->Mobile,
                ':access' => $this->Access,
                ':date' => date('Y-m-d H:i:s')
            );
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

    public function updateUser()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    users
                SET
                    Email = :email,
                    PositionID = :position,
                    OfficeID = :office,
                    MobileNumber = :mobile,
                    Access = :access,
                    UpdatedOn = :date
                WHERE
                    ID = :id
            ";
            $params = array(
                ':email' => $this->Email,
                ':position' => $this->PositionID,
                ':office' => $this->OfficeID,
                ':mobile' => $this->Mobile,
                ':access' => $this->Access,
                ':date' => date('Y-m-d H:i:s'),
                ':id' => $this->ID
            );
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

    public function updatePassword()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    users
                SET
                    TemporaryPassword = '',
                    IsActive = 1,
                    Password = :password,
                    UpdatedOn = :date
                WHERE
                    Username = :username
            ";
            $params = array(
                ':username' => $this->Username,
                ':password' => $this->Password,
                ':date' => date('Y-m-d H:i:s')
            );
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


    public function disableAccount()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    users
                SET
                    IsActive = 0,
                    UpdatedOn = :date
                WHERE
                    ID = :id
            ";
            $params = array(
                ':id' => $this->ID,
                ':date' => date('Y-m-d H:i:s')
            );
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

    public function enableAccount()
    {
        try {
            $con = $this->con();
            $query = "
                UPDATE
                    users
                SET
                    IsActive = 1,
                    UpdatedOn = :date
                WHERE
                    ID = :id
            ";
            $params = array(
                ':id' => $this->ID,
                ':date' => date('Y-m-d H:i:s')
            );
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

    public function getFullname()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    CONCAT(FirstName, ' ', LastName) as fullname
                FROM
                    users
                WHERE
                    ID = :id
            ";
            $params = array(
                ':id' => $this->ID,
            );
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

    public function getEmail()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    Email
                FROM
                    users
                WHERE
                    ID = :id
            ";
            $params = array(
                ':id' => $this->ID,
            );
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

    public function checkIfInactive()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT
                    ID
                FROM
                    users
                WHERE
                    ID = :id AND
                    IsActive = -1
            ";
            $params = array(
                ':id' => $this->ID,
            );
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


    public function updateLastAccess()
    {
        try {
            $con = $this->con();
            $query = "UPDATE users SET LastAccess = :date WHERE ID = :id";
            $sql = $con->prepare($query);
            $params = array(
                ':id' => $this->ID,
                ':date' => date('Y-m-d H:i:s'),
            );
            if ($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
        } catch (PDOException $e) {
            http_response_code(500);
            return (json_encode($e->getMessage()));
        }
    }

    public function updateLastLogin()
    {
        try {
            $con = $this->con();
            $query = "UPDATE users SET LastLogin = :date WHERE ID = :id";
            $sql = $con->prepare($query);
            $params = array(
                ':id' => $this->ID,
                ':date' => date('Y-m-d H:i:s'),
            );
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
