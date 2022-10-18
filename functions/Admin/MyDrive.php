<?php
session_start();
require_once dirname(__DIR__, 2) . '/models/MediaTypesModel.php';
require_once dirname(__DIR__, 2) . '/models/FilesModel.php';
require_once dirname(__DIR__, 2) . '/models/HistoryModel.php';
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';

class MyDrive
{

    public function filenameAlter()
    {
        if (isset($_FILES['file']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $file =  $_FILES['file'];
            $mediaType = new MediaTypesModel;
            $mediaType->MimeType = $file['type'];
            $mediaType->ExtensionName = "." . pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowedMimeTypes = $mediaType->verifyIfAllowedMediaMimeTypes();

            if (count($allowedMimeTypes) > 0) {
                if ($file['error'] == 0 && $file['size'] > 0) {

                    $mimeID = $allowedMimeTypes[0]['id'];
                    $mimeExt = $allowedMimeTypes[0]['name'];
                    $files = new FilesModel;
                    $files->OwnerID = $_SESSION['user']['id'];
                    $files->FileTypeID = $mimeID;
                    $files->FileName = str_replace($mimeExt, '', $file['name']);
                    $checkDuplicate = $files->checkIfFilenamExists();


                    if ($checkDuplicate['cnt'] > 0) {
                        for ($i = 1; $i <= $checkDuplicate['cnt']; $i++) {
                            $files->FileName = str_replace($mimeExt, '', $file['name']) . ' (' . $i . ')';
                            $checkDuplicate1 = $files->checkIfFilenamExists2();

                            if ($checkDuplicate1['cnt'] == 0) {
                                echo json_encode(
                                    array(
                                        'success' => true,
                                        'message' => str_replace($mimeExt, '', $file['name']) . ' (' . $i . ')',
                                        'ext' => $mimeExt,
                                        'id' => $checkDuplicate1['id']
                                    )
                                );
                                exit;
                            }
                            if ($checkDuplicate1['cnt'] != 0 && $i == $checkDuplicate['cnt']) {
                                $filename = intval($checkDuplicate['cnt']) + 1;
                                echo json_encode(
                                    array(
                                        'success' => true,
                                        'message' => str_replace($mimeExt, '', $file['name']) . ' (' . $filename . ')',
                                        'ext' => $mimeExt,
                                        'id' => $checkDuplicate['id']
                                    )
                                );
                                exit;
                            }
                        }
                    } else {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => str_replace($mimeExt, '', $file['name']),
                                'ext' => $mimeExt,
                                'id' => $checkDuplicate['id']
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'File is invalid'
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'File is invalid'
                    )
                );
            }
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function getAllMyFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->OwnerID = $_SESSION['user']['id'];
            $results = $files->getAllMyFiles();
            echo json_encode($results);
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function getMyArchive()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->OwnerID = $_SESSION['user']['id'];
            $results = $files->getAllMyArchive();
            echo json_encode($results);
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function getMyTrash()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->OwnerID = $_SESSION['user']['id'];
            $results = $files->getAllMyTrash();
            echo json_encode($results);
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function getAllFiles()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->OwnerID = $_SESSION['user']['id'];
            $results = $files->getAllFiles();
            echo json_encode($results);
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function fileName()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id']) && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $fileId = $_GET['id'];
            $files = new FilesModel;
            $files->ID = $fileId;
            $results = $files->getOneFilename();
            echo json_encode($results);
        } else if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            parse_str(file_get_contents("php://input"), $_PUT);
            if (isset($_PUT['id']) && isset($_PUT['filename']) && isset($_PUT['typeid'])) {
                $id = $_PUT['id'];
                $OwnerID = $_PUT['oid'];
                $filename = $_PUT['filename'];
                $typeid = $_PUT['typeid'];
                $files = new FilesModel;
                $files->ID = $id;
                $files->OwnerID = $OwnerID;
                $files->FileName = $filename;
                $files->FileTypeID = $typeid;

                $checkDuplicate = $files->checkIfFilenamExists2();


                if ($checkDuplicate['cnt'] > 0) {
                    echo json_encode(
                        array(
                            'success' => false,
                            'duplicate' => true,
                            'message' => 'Filename already exists.'
                        )
                    );
                } else {
                    $res = $files->updateFilename();
                    if ($res === true) {
                        $history = new HistoryModel;
                        $history->UserId = 1;
                        $history->FileId = $id;
                        $history->ActivityType = 5;
                        $history->Activity = " renamed a file";
                        $history->insertHistory();
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'File renamed successfully'
                            )
                        );
                    } else {
                        http_response_code(500);
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'An error occurred. Operation not completed.'
                            )
                        );
                    }
                }
            } else {
                http_response_code(421);
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Invalid request'
                    )
                );
            }
        } else {
            http_response_code(421);
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }
}
