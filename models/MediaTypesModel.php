<?php
require_once dirname(__DIR__) . '/config/database.php';

class MediaTypesModel extends DB
{
    public $ID;
    public $ExtensionName;
    public $MimeType;
    public $MimeDescription;
    public $Class;
    public $IconPath;
    public $IsAllowed;
    public $CreatedOn;
    public $UpdatedOn;
    public $model = null;

    public function __construct(
        $ID = '',
        $ExtensionName = '',
        $MimeType = '',
        $MimeDescription = '',
        $Class = '',
        $IconPath = '',
        $IsAllowed = '',
        $CreatedOn = '',
        $UpdatedOn = ''
    ) {
        $this->ID = $ID;;
        $this->ExtensionName = $ExtensionName;;
        $this->MimeType = $MimeType;;
        $this->MimeDescription = $MimeDescription;;
        $this->Class = $Class;;
        $this->IconPath = $IconPath;;
        $this->IsAllowed = $IsAllowed;;
        $this->CreatedOn = $CreatedOn;;
        $this->UpdatedOn = $UpdatedOn;;
    }

    public function insertMediaType() {
        try {
            $con = $this->con();
            $query = "
                INSERT INTO media_types (ExtensionName, MimeType, MimeDescription, Class) VALUES (?, ?, ?, ?)
            ";
            $sql = $con->prepare($query);
            $params = array(
                $this->ExtensionName,
                $this->MimeType,
                $this->MimeDescription,
                $this->Class
            );
            if($sql->execute($params)) {
                return true;
            }
            return json_encode($sql->errorInfo());
            
        } catch (PDOException $e) {
            http_response_code(500);
            return(json_encode($e->getMessage()));
        }
    }

    public function getAllowedMediaTypes()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT ID as id, ExtensionName as ext, MimeType as type, MimeDescription as description, Class as class, IconPath as icon FROM media_types WHERE IsAllowed = 1
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

    public function verifyIfAllowedMediaMimeTypes()
    {
        try {
            $con = $this->con();
            $query = "
                SELECT ID as id, ExtensionName as name FROM media_types WHERE IsAllowed = 1 AND MimeType = ? AND ExtensionName = ?
            ";
            $sql = $con->prepare($query);
            $params = [
                $this->MimeType,
                $this->ExtensionName
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
}
