<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';

class Auth
{

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
            $_SESSION['val']['username'] = $_POST['username'];
            $_SESSION['val']['password'] = $_POST['password'];
            if (trim($_POST['username']) == '' || trim($_POST['password']) == '') {
                if (trim($_POST['username']) == '') {
                    $_SESSION['error']['username'] = 'Username is required';
                }
                if (trim($_POST['password']) == '') {
                    $_SESSION['error']['password'] = 'Password is required';
                }
                header('Location: /auth/login');
            } else {
                $user = new UsersModel;
                $user->Username = trim($_POST['username']);
                $user->Password = hash('sha256', md5(trim($_POST['password'])));
                $checkUsername = $user->checkUsername();
                if ($checkUsername > 0) {
                    $checkPassword = $user->checkPassword();
                    if (isset($checkPassword['ID'])) {
                        $_SESSION['user']['id'] = $checkPassword['ID'];
                        $_SESSION['user']['username'] = $checkPassword['Username'];
                        $_SESSION['user']['fullname'] = $checkPassword['fullname'];
                        $_SESSION['user']['avatar'] = $checkPassword['Pic'];
                        $_SESSION['user']['access'] = $checkPassword['Access'];
                        $user->ID = $checkPassword['ID'];
                        $user->updateLastLogin();
                        $user->updateLastAccess();
                        if ($checkPassword['Access'] == 1) {
                            header('Location: /admin/dashboard');
                        } else if ($checkPassword['Access'] == 2) {
                            header('Location: /my-drive');
                        }
                    } else {
                        $_SESSION['error']['login'] = 'Username or Password is incorrect';
                        header('Location: /auth/login');
                    }
                } else {
                    $_SESSION['error']['username'] = 'Username doesn\'t exist';
                    header('Location: /auth/login');
                }
            }
        } else {
            $_SESSION['error']['login'] = 'Invalid Request';
            header('Location: /auth/login');
        }
    }

    public function logout()
    {
        $user = new UsersModel;
        $user->ID = $_SESSION['user']['id'];
        $user->updateLastAccess();
    }

    public function verifyActivationToken()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['token'])) {
            require_once dirname(__DIR__, 2) . '/models/CreatedAccountSession.php';
            $session = new CreatedAccountSession;
            $session->SessionToken = $_GET['token'];
            $token = $session->verifyToken();
            if (isset($token['SessionToken'])) {
                return $token;
            } else {
                return false;
            }
        }
    }

    public function verifyTemporaryPassword()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && isset($_POST['tpassword']) && isset($_POST['password']) && !isset($_SESSION['user']['id'])) {
            require_once dirname(__DIR__, 2) . '/models/CreatedAccountSession.php';
            $errors = array(
                'tpassword' => "",
                'password' => ""
            );
            if (trim($_POST['tpassword']) == "") {
                $errors['tpassword'] = 'Temporary Password is required';
            } else {
                $errors['tpassword'] = "";
            }

            if (trim($_POST['password']) == "") {
                $errors['password'] = "Password is required";
            } else {
                $errors['password'] = $this->validateStrongPassword(trim($_POST['password']));
            }

            if ($errors['tpassword'] != "" || $errors['password'] != "") {
                echo json_encode(array(
                    'success' => false,
                    'message' => $errors
                ));
                exit;
            }

            $session = new CreatedAccountSession;
            $session->SessionToken = $_POST['token'];
            $session->TemporaryPassword = $_POST['tpassword'];
            $tpassword = $session->verifyTPassword();
            if (isset($tpassword['TemporaryPassword'])) {
                $username = $tpassword['Username'];
                $user = new UsersModel;
                $user->Username = $username;
                $user->Password = hash('sha256', md5($_POST['password']));
                if ($user->updatePassword()) {
                    $session->ID = $tpassword['ID'];
                    if ($session->deleteToken()) {
                        echo json_encode(array(
                            'success' => true,
                            'message' => '<p>Password setup completed and your account has been activated. Please use the username that was sent to your email.</p>'
                        ));
                    } else {
                        echo json_encode(array(
                            'success' => false,
                            'message' => 'Operation failed. Please contact your system admin'
                        ));
                    }
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'message' => 'Operation failed. Please contact your system admin'
                    ));
                }
            } else {
                echo json_encode(array(
                    'success' => false,
                    'message' => array('tpassword' => 'Temporary Password is incorrect')
                ));
            }
        } else {
            http_response_code(421);
            echo json_encode(array(
                'success' => false,
                'message' => 'Invalid request'
            ));
        }
    }

    public function validateStrongPassword($password)
    {
        $pattern = '/^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/';

        return !preg_match($pattern, trim($password)) ? "Password should meet the criteria below" : "";
    }
}
