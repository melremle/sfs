<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__, 2) . '/models/PositionsModel.php';

class Positions
{

    public function getAllPositions()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            $positions = new PositionsModel;
            echo json_encode($positions->getAllPositions());
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

    public function getOnePosition()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1 && isset($_GET['id'])) {
            $positions = new PositionsModel;
            $positions->ID = $_GET['id'];
            echo json_encode(
                array(
                    'success' => true,
                    'message' => $positions->getOnePosition()
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

    public function addPosition()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1 && isset($_POST['position'])) {
            $positions = new PositionsModel;
            $positions->Position = trim($_POST['position']);
            if (strlen(trim($_POST['position'])) == 0) {
                echo json_encode(
                    array(
                        'success' => false,
                        'duplicate' => true,
                        'message' => 'Position is required'
                    )
                );
                exit;
            }
            if ($positions->checkPosition()) {
                echo json_encode(
                    array(
                        'success' => false,
                        'duplicate' => true,
                        'message' => 'Position Already exist'
                    )
                );
            } else {

                if ($positions->insertPosition()) {
                    echo json_encode(
                        array(
                            'success' => true,
                            'message' => 'Position added'
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

    public function updatePosition()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            parse_str(file_get_contents("php://input"), $_PUT);
            if (isset($_PUT['id']) && isset($_PUT['position'])) {
                $positions = new PositionsModel;
                $positions->ID = trim($_PUT['id']);
                $positions->Position = trim($_PUT['position']);
                if ($positions->checkPosition()) {
                    echo json_encode(
                        array(
                            'success' => false,
                            'duplicate' => true,
                            'message' => 'Position Already exist'
                        )
                    );
                } else {

                    if ($positions->updatePosition()) {
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Position updated'
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

    public function deletePosition()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_SESSION['user']['id']) && $_SESSION['user']['access'] == 1) {
            parse_str(file_get_contents("php://input"), $_DELETE);
            $positions = new PositionsModel;
            if (isset($_DELETE['id'])) {
                $positions->ID = trim($_DELETE['id']);
                if ($positions->deletePosition()) {
                    echo json_encode(
                        array(
                            'success' => true,
                            'message' => 'Position deleted'
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
