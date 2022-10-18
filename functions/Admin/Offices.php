<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__, 2) . '/models/OfficesModel.php';

class Offices
{

    public function getAllOffices()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            $offices = new OfficesModel;
            echo json_encode($offices->getAllOffices());
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

    public function getOneOffice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1 && isset($_GET['id'])) {
            $offices = new OfficesModel;
            $offices->ID = $_GET['id'];
            echo json_encode(
                array(
                    'success' => true,
                    'message' => $offices->getOneOffice()
                )
            );
        } else {
            echo json_encode(
                array(
                    'success' => false,
                    'message' => 'Invalid request'
                )
            );
        }
    }

    public function addOffice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1 && isset($_POST['office'])) {
            $offices = new OfficesModel;
            $offices->Office = trim($_POST['office']);
            $errArr = array(
                'duplicate' => '',
                'img' => '',
            );
            $checkOffice = $offices->checkOffice();
            if (strlen(trim($_POST['office'])) == 0) {
                $errArr['duplicate'] = 'Office is required';
            } else {
                if ($checkOffice) {
                    $errArr['duplicate'] = 'Office Already exist';
                } else {
                    $errArr['duplicate'] = '';
                }
            }
            if (!isset($_FILES['logo'])) {
                $errArr['img'] = 'Image file for logo is required';
            } else {
                $logo =  $_FILES['logo'];
                if ($logo['type'] != 'image/png') {
                    $errArr['img'] = 'Only .png file is allowed';
                } else {
                    $errArr['img'] = '';
                }
            }
            if ($errArr['duplicate'] != '' || $errArr['img'] != '') {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => $errArr
                    )
                );
                exit;
            }
            if ($checkOffice) {
                echo json_encode(
                    array(
                        'success' => false,
                        'duplicate' => true,
                        'message' => 'Office Already exist'
                    )
                );
            } else {
                $logo =  $_FILES['logo'];
                if ($logo['type'] == 'image/png') {
                    $targetUploadFolder = dirname(__DIR__, 2) . '/web/files/logos';
                    $filename = random_int(111, 999) . $logo['name'];

                    $newFileFolder = $targetUploadFolder . '/' . $filename;

                    if (!copy($logo['tmp_name'], $newFileFolder)) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Upload error'
                            )
                        );
                        exit;
                    }
                    unlink($logo['tmp_name']);

                    $offices->Logo = $filename;
                    if ($offices->insertOffice()) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Office added'
                            )
                        );
                    } else {
                        $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename;
                        if (file_exists($fpath)) {
                            unlink($fpath);
                        }
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Operation couldn\'t be completed. Please try again.'
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'img' => true,
                            'message' => 'Only .png file is allowed'
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
    }


    public function updateOffice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1 && isset($_POST['office']) && isset($_POST['id'])) {
            $offices = new OfficesModel;
            $offices->Office = trim($_POST['office']);
            $offices->ID = trim($_POST['id']);
            $wlogo = false;
            $errArr = array(
                'duplicate' => '',
                'img' => '',
            );
            $checkOffice = $offices->checkOffice();
            if (strlen(trim($_POST['office'])) == 0) {
                $errArr['duplicate'] = 'Office is required';
            } else {
                if ($checkOffice) {
                    $errArr['duplicate'] = 'Office Already exist';
                } else {
                    $errArr['duplicate'] = '';
                }
            }
            if (!isset($_FILES['logo'])) {
                $errArr['img'] = '';
                $wlogo = false;
            } else {
                $logo =  $_FILES['logo'];
                $wlogo = true;
                $errArr['duplicate'] = '';
                if ($logo['type'] != 'image/png') {
                    $errArr['img'] = 'Only .png file is allowed';
                } else {
                    $errArr['img'] = '';
                }
            }
            if ($errArr['duplicate'] != '' || $errArr['img'] != '') {
                echo json_encode(
                    array(
                        'success' => false,
                        'message' => $errArr
                    )
                );
                exit;
            }
            if ($wlogo) {
                $logo =  $_FILES['logo'];
                if ($logo['type'] == 'image/png') {
                    $filename = $offices->getOfficeLogo();
                    $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename['Logo'];
                    if (file_exists($fpath)) {
                        unlink($fpath);
                    }
                    $targetUploadFolder = dirname(__DIR__, 2) . '/web/files/logos';
                    $filename = random_int(111, 999) . $logo['name'];

                    $newFileFolder = $targetUploadFolder . '/' . $filename;

                    if (!copy($logo['tmp_name'], $newFileFolder)) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Upload error'
                            )
                        );
                        exit;
                    }
                    unlink($logo['tmp_name']);

                    $offices->Logo = $filename;
                    if ($offices->updateOfficewLogo()) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Office updated'
                            )
                        );
                    } else {
                        $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename;
                        if (file_exists($fpath)) {
                            unlink($fpath);
                        }
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Operation couldn\'t be completed. Please try again.'
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'img' => true,
                            'message' => 'Only .png file is allowed'
                        )
                    );
                }
            } else {
                $filename = $offices->getOfficeLogo();
                $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename['Logo'];
                if (file_exists($fpath)) {
                    unlink($fpath);
                    if ($offices->updateOffice()) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Office updated'
                            )
                        );
                    } else {
                        $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename;
                        if (file_exists($fpath)) {
                            unlink($fpath);
                        }
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Operation couldn\'t be completed. Please try again.'
                            )
                        );
                    }
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
    }

    public function deleteOffice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            parse_str(file_get_contents("php://input"), $_DELETE);
            $offices = new OfficesModel;
            if (isset($_DELETE['id'])) {
                $offices->ID = $_DELETE['id'];
                $filename = $offices->getOfficeLogo();
                $fpath = $_SERVER['DOCUMENT_ROOT'] . '/files/logos/' . $filename['Logo'];
                if (file_exists($fpath)) {
                    if (unlink($fpath)) {
                        $offices->deleteOffice();
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Office deleted'
                            )
                        );
                    } else {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => 'Operation couldn\'t be completed. Please try again.'
                            )
                        );
                    }
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'Operation couldn\'t be completed. Please try again.'
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
