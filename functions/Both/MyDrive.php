<?php
session_start();
require_once dirname(__DIR__, 2) . '/models/MediaTypesModel.php';
require_once dirname(__DIR__, 2) . '/models/FilesModel.php';
require_once dirname(__DIR__, 2) . '/models/HistoryModel.php';
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MyDrive
{

    public function upload()
    {
        if (isset($_FILES['file']) && $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $uids = $_POST['uid'];

            $file =  $_FILES['file'];
            $alteredFilename = $_POST['filename'];
            $mediaType = new MediaTypesModel;
            $mediaType->MimeType = $file['type'];
            $mediaType->ExtensionName = "." . pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowedMimeTypes = $mediaType->verifyIfAllowedMediaMimeTypes();

            if (count($allowedMimeTypes) > 0) {
                if ($file['error'] == 0 && $file['size'] > 0) {



                    $filename = hash('sha256', md5($file['name']) . strtotime('now'));

                    $targetUploadFolder = dirname(__DIR__, 2) . '/web/files/uploads';

                    $filepath = 'uploads/' . $filename;
                    $mimeID = $allowedMimeTypes[0]['id'];
                    // $mimeExt = $allowedMimeTypes[0]['name'];
                    $files = new FilesModel;
                    $files->OwnerID = $_SESSION['user']['id'];
                    $files->FileTypeID = $mimeID;
                    $files->FileSize = $file['size'];
                    $files->FileName = $alteredFilename;

                    $newFileFolder = $targetUploadFolder . '/' . $filename;

                    if (!copy($file['tmp_name'], $newFileFolder)) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Upload error'
                            )
                        );
                        exit;
                    }
                    unlink($file['tmp_name']);

                    $files->FilePath = $filepath;
                    $lastID = $files->upload();
                    if (!is_array($lastID)) {
                        $history = new HistoryModel;
                        $history->UserId = $_SESSION['user']['id'];
                        $history->FileId = $lastID;
                        $history->ActivityType = 2;
                        $history->Activity = " uploaded a file";
                        $history->insertHistory();
                        if (strlen(trim($uids)) > 0) {
                            $this->shareNow($uids, $lastID);
                        }
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'File Uploaded',
                                'id' => $lastID
                            )
                        );
                    } else {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Upload error'
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

    public function checkDownload()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['oid']) && isset($_GET['id']) && isset($_SESSION['user']['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->ID = $_GET['id'];
            $files->OwnerID = $_GET['oid'];
            $res = $files->checkIfOwner();
            if ($_SESSION['user']['access'] == 1) {
                $details = $files->getFileDetailForDownload();
                if (isset($details['filename'])) {
                    $path = $details['path'];
                    $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $path;
                    if (file_exists($fpath)) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Can download'
                            )
                        );
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
            } else if ($res === true) {
                $details = $files->getFileDetailForDownload();
                if (isset($details['filename'])) {
                    $path = $details['path'];
                    $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $path;
                    if (file_exists($fpath)) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Can download'
                            )
                        );
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
                        'success' => true,
                        'message' => 'Shared'
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

    public function download()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['oid']) && isset($_GET['id'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            $files = new FilesModel;
            $files->ID = $_GET['id'];
            $files->OwnerID = $_GET['oid'];
            $res = $files->checkIfOwner();
            if ($_SESSION['user']['access'] == 1) {
                $details = $files->getFileDetailForDownload();
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
            } else if ($res === true) {
                $details = $files->getFileDetailForDownload();
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
                        'success' => true,
                        'message' => 'Shared'
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

    public function shareNow($uids, $fid)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id'])) {
            $fileId = $fid;
            $userIdArr = explode(',', $uids);
            $oid = $_SESSION['user']['id'];

            $file = new FilesModel;
            $file->ID = $fileId;
            $file->OwnerID = $oid;
            $filenameOfFile = $file->getOneFilename()['filename'];

            if (count($userIdArr) > 0) {
                foreach ($userIdArr as $v) {
                    $keyContent = base64_encode(openssl_random_pseudo_bytes(15));
                    $ekey = base64_encode(JWT_SECRET . $keyContent);
                    $user = new UsersModel;
                    $user->ID = $v;
                    $fullname = $user->getFullname()['fullname'];
                    $email = $user->getEmail()['Email'];
                    $mail = new PHPMailer(true);
                    $token = $ekey;
                    $query = array(
                        'file' => $filenameOfFile,
                        'id' => $fileId,
                        'token' => $token
                    );
                    $link = APP_URL . '/shared-with-me?' . http_build_query($query);
                    try {
                        require_once dirname(__DIR__) . '/Both/EmailTemplates.php';

                        $template = new EmailTemplates;

                        $mail->isSMTP();
                        $mail->Host       = EMAIL_HOST;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = EMAIL_USERNAME;
                        $mail->Password   = EMAIL_PASSWORD;
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = EMAIL_PORT;

                        $mail->setFrom(EMAIL_USERNAME, 'Secure File Sharing');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Item Shared with you';
                        $mail->addEmbeddedImage(dirname(__DIR__, 2) . '/web/assets/images/image-4.png', 'image-4.png');
                        $mail->MsgHTML($template->fileShared($fullname, $link, $keyContent, $filenameOfFile));


                        if ($mail->send()) {
                            $file->UserID = $v;
                            $file->Token = $ekey;
                            $res = $file->shareFile();
                        } else {
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => 'Operation failed. Please try again.'
                                )
                            );
                            exit;
                        }
                    } catch (Exception $e) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => $mail->ErrorInfo
                            )
                        );
                        exit;
                    }
                }

                if ($res) {
                    $file->updateShareFile();
                }
            }
        }
    }

    public function share()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['fid']) && isset($_POST['uids'])) {
            $fileId = $_POST['fid'];
            $userIdArr = explode(',', $_POST['uids']);
            $oid = $_SESSION['user']['id'];

            $file = new FilesModel;
            $file->ID = $fileId;
            $file->OwnerID = $oid;
            $filenameOfFile = $file->getOneFilename()['filename'];

            if (count($userIdArr) > 0) {
                foreach ($userIdArr as $v) {
                    $keyContent = base64_encode(openssl_random_pseudo_bytes(15));
                    $ekey = base64_encode(JWT_SECRET . $keyContent);
                    $user = new UsersModel;
                    $user->ID = $v;
                    $fullname = $user->getFullname()['fullname'];
                    $email = $user->getEmail()['Email'];
                    $mail = new PHPMailer(true);
                    $token = $ekey;
                    $query = array(
                        'file' => $filenameOfFile,
                        'id' => $fileId,
                        'token' => $token
                    );
                    $link = APP_URL . '/shared-with-me?' . http_build_query($query);
                    try {
                        require_once dirname(__DIR__) . '/Both/EmailTemplates.php';

                        $template = new EmailTemplates;

                        $mail->isSMTP();
                        $mail->Host       = EMAIL_HOST;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = EMAIL_USERNAME;
                        $mail->Password   = EMAIL_PASSWORD;
                        $mail->SMTPSecure = 'tls';
                        $mail->Port       = EMAIL_PORT;

                        $mail->setFrom(EMAIL_USERNAME, 'Secure File Sharing');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = 'Item Shared with you';
                        $mail->addEmbeddedImage(dirname(__DIR__, 2) . '/web/assets/images/image-4.png', 'image-4.png');
                        $mail->MsgHTML($template->fileShared($fullname, $link, $keyContent, $filenameOfFile));


                        if ($mail->send()) {
                            $file->UserID = $v;
                            $file->Token = $ekey;
                            $res = $file->shareFile();
                        } else {
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => 'Operation failed. Please try again.'
                                )
                            );
                            exit;
                        }
                    } catch (Exception $e) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => $mail->ErrorInfo
                            )
                        );
                        exit;
                    }
                }

                if ($res) {
                    $file->updateShareFile();
                    echo json_encode(
                        array(
                            'success' => true,
                            'message' => 'File Shared'
                        )
                    );
                }
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'No user is selected'
                    )
                );
            }
        } else if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_SESSION['user']['id'])) {
            parse_str(file_get_contents('php://input'), $_DELETE);
            $id = $_DELETE['id'];
            $fid = $_DELETE['fid'];

            $file = new FilesModel;
            $file->ID = $id;


            if ($file->removeFromShare()) {
                $cnt = $file->countFromShare($fid);
                if ($cnt == 0) {
                    $file->updateUnShareFile($fid);
                }
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'User\'s access for this file has been removed',
                        'shared' => $cnt > 0
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Operation failed. Please try again.'
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

    public function moveArchive()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['fid'])) {
            $fileId = $_POST['fid'];

            $file = new FilesModel;
            $file->ID = $fileId;
            if ($file->moveToArchive()) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Item moved to archive'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Operation failed. Please try again'
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


    public function moveTrash()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['fid'])) {
            $fileId = $_POST['fid'];

            $file = new FilesModel;
            $file->ID = $fileId;
            if ($file->moveToTrash()) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Item moved to trash'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Operation failed. Please try again'
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

    public function moveDrive()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['fid'])) {
            $fileId = $_POST['fid'];

            $file = new FilesModel;
            $file->ID = $fileId;
            if ($file->moveToDrive()) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Item restored to drive'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Operation failed. Please try again'
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


    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_POST['fid'])) {
            $fileId = $_POST['fid'];

            $file = new FilesModel;
            $file->ID = $fileId;
            $res = $file->getFileDetailForDownload()['path'];
            $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $res;
            if (file_exists($fpath)) {
                unlink($fpath);
            }
            if ($file->permanentDelete()) {
                echo json_encode(
                    array(
                        'success' => true,
                        'message' => 'Item premanently deleted'
                    )
                );
            } else {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => 'Operation failed. Please try again'
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
