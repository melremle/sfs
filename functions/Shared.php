<?php
session_start();
require_once dirname(__DIR__) . '/models/MediaTypesModel.php';
require_once dirname(__DIR__) . '/models/FilesModel.php';
require_once dirname(__DIR__) . '/models/HistoryModel.php';
require_once dirname(__DIR__) . '/models/UsersModel.php';


class Shared
{

    public function getSharedWithMe()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id'])) {
            $oid = $_SESSION['user']['id'];

            $file = new FilesModel;
            $file->OwnerID = $oid;
            echo json_encode($file->getShared());
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

    public function downloadNow()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && isset($_GET['fid'])) {
            $fid = $_GET['fid'];
            $file = new FilesModel;
            $file->ID = $fid;
            $details = $file->getFileDetailForDownload();

            if (isset($details['filename'])) {
                $paylname = $details['filename'];
                $type = $details['filetype'];
                $path = $details['path'];
                $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $path;
                if (file_exists($fpath)) {
                    header('Content-Description: File Transfer');
                    header('Content-Type: application/force-download');
                    header('Content-Disposition: attachment; filename="' . $paylname . $type . '"');
                    header('Content-Transfer-Encoding: binary');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($fpath));
                    ob_clean();
                    flush();
                    readfile($fpath);
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'Download failed. Please try again.'
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Download failed. Please try again.'
                    )
                );
            }
        } else {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }


    public function verifyKey()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['key']) && isset($_POST['fid'])) {
            $uid = $_SESSION['user']['id'];
            $key = $_POST['key'];
            $fid = $_POST['fid'];
            $file = new FilesModel;

            $t = base64_encode(JWT_SECRET . $key);

            $token = $file->getEKey($uid, $fid, $t);
            if ($token) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Granted'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Wrong Key or you don\'t have permission to download this item'
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
