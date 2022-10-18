<?php
session_start();
require_once dirname(__DIR__, 2) . '/models/HistoryModel.php';
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';

class Search
{
    public function searchTerm()
    {
        if (isset($_SESSION['user']['id']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user']) && isset($_GET['fid'])) {
            $userTerm = $_GET['user'];
            $fid = $_GET['fid'];
            $user = new UsersModel;
            $user->FirstName = $userTerm;
            $user->LastName = $userTerm;
            $user->Email = $userTerm;
            echo json_encode($user->getAllUsersPerTerm($fid, $_SESSION['user']['id']));
        } else if (isset($_SESSION['user']['id']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fid'])) {
            $fid = $_GET['fid'];
            $user = new UsersModel;
            echo json_encode($user->getAllUsersNoTerm($fid, $_SESSION['user']['id']));
        }
    }

    public function searchShared()
    {
        if (isset($_SESSION['user']['id']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fid'])) {
            $fid = $_GET['fid'];
            $user = new UsersModel;
            echo json_encode($user->getAllUsersShared($fid));
        }
    }

    public function getFileDetails()
    {
        if (isset($_SESSION['user']['id']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fid'])) {
            $fid = $_GET['fid'];
            $user = new UsersModel;
            $res = $user->getFileDetails($fid, $_SESSION['user']['id']);
            if (count($res) > 0) {
                echo json_encode($user->getFileDetails($fid, $_SESSION['user']['id']));
            } else {
                echo json_encode($user->getFileDetails2($fid, $_SESSION['user']['id']));
            }
        }
    }
}
