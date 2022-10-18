<?php
session_start();
require_once dirname(__DIR__, 2) . '/models/UsersModel.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Users
{

    public function getAllUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();
            echo json_encode($user->getAllUsers());
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

    public function getAllUsersPerOffice()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && isset($_GET['officeid'])) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->OfficeID = $_GET['officeid'];
            $user->updateLastAccess();
            echo json_encode($user->getAllUsersPerOffice());
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

    public function getOneUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_GET['id'];
            echo json_encode($user->getOneUser());
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

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['position']) && isset($_POST['office']) && isset($_POST['mobile']) && isset($_POST['access'])) {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $position = $_POST['position'];
                $office = $_POST['office'];
                $mobile = $_POST['mobile'];
                $access = $_POST['access'];
                $errors = array(
                    'firstname' => "",
                    'lastname' => "",
                    'username' => "",
                    'email' => "",
                    'position' => "",
                    'office' => "",
                    'mobile' => "",
                    'access' => ""
                );
                $hasError = false;

                $user->Email = $email;
                $user->Username = $username;
                $user->FirstName = $firstname;
                $user->LastName = $lastname;
                $user->PositionID = $position;
                $user->OfficeID = $office;
                $user->Mobile = $mobile;
                $user->Access = $access;

                if (trim($firstname) == "") {
                    $errors['firstname'] = "First Name is required";
                } else {
                    if ($user->checkFullname() > 0) {
                        $errors['firstname'] = "First Name + Last Name already exist";
                    } else {
                        $errors['firstname'] = "";
                    }
                }

                if (trim($lastname) == "") {
                    $errors['lastname'] = "Last Name is required";
                } else {
                    if ($user->checkFullname() > 0) {
                        $errors['lastname'] = "First Name + Last Name already exist";
                    } else {
                        $errors['lastname'] = "";
                    }
                }

                if (trim($username) == "") {
                    $errors['username'] = "Username is required";
                } else {
                    if (strpos($username, ' ') !== false) {
                        $errors['username'] = "Username must not have spaces";
                    } else {
                        if ($user->checkUsername() > 0) {
                            $errors['username'] = "Username already exist";
                        } else {
                            $errors['username'] = "";
                        }
                    }
                }

                if (trim($position) == "") {
                    $errors['position'] = "Position is required";
                } else {
                    $errors['position'] = "";
                }
                if (trim($office) == "") {
                    $errors['office'] = "Office is required";
                } else {
                    $errors['office'] = "";
                }
                if (trim($mobile) == "") {
                    $errors['mobile'] = "Mobile No is required";
                } else {
                    $errors['mobile'] = $this->validateMobile($mobile);
                }
                if (trim($access) == "") {
                    $errors['access'] = "User Access is required";
                } else {
                    $errors['access'] = "";
                }


                if (trim($email) == "") {
                    $errors['email'] = "Email is required";
                } else {
                    $err = $this->validateEmail($email);
                    $errors['email'] = $err;
                    if ($err == "") {
                        if ($user->checkEmail() > 0) {
                            $errors['email'] = "Email already registered";
                        } else {
                            $errors['email'] = "";
                        }
                    }
                }

                if ($errors['firstname'] == "" && $errors['lastname'] == "" && $errors['username'] == "" && $errors['email'] == "" && $errors['position'] == "" && $errors['office'] == "" && $errors['mobile'] == "" && $errors['access'] == "") {
                    $hasError = false;
                } else {
                    $hasError = true;
                }

                if ($hasError) {
                    echo json_encode(array(
                        'success' => false,
                        'message' => $errors
                    ));
                    exit;
                }

                $tpassword = $this->generateTemporaryPassword();

                $mail = new PHPMailer(true);
                $token = $this->generateToken($username);
                $accountName = $firstname . ' ' . $lastname;
                $tempPassword = $tpassword;
                $activationLink = APP_URL . '/account/activation?token=' . $token;
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
                    $mail->Subject = 'Account Created';
                    $mail->addEmbeddedImage(dirname(__DIR__, 2) . '/web/assets/images/image-1.png', 'image-1.png');
                    $mail->MsgHTML($template->accountCreated($accountName, $tempPassword, $activationLink, $username));


                    if ($mail->send()) {
                        $user->Username = $username;
                        $user->FirstName = $firstname;
                        $user->LastName = $lastname;
                        $user->Email = $email;
                        $user->PositionID = $position;
                        $user->OfficeID = $office;
                        $user->Mobile = $mobile;
                        $user->Access = $access;
                        $user->TemporaryPassword = $tpassword;
                        if ($user->addUser()) {
                            require_once dirname(__DIR__, 2) . '/models/CreatedAccountSession.php';
                            $session = new CreatedAccountSession;
                            $session->Username = $username;
                            $session->TemporaryPassword = $tpassword;
                            $session->SessionToken = $token;
                            $session->insertToken();
                        } else {
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => 'Operation failed. Please try again.'
                                )
                            );
                        }
                        echo json_encode(
                            array(
                                'success' => true,
                                'message' => 'Account Created'
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
                } catch (Exception $e) {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => $mail->ErrorInfo
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

    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_POST['id'];
            $user->updateLastAccess();

            if (isset($_POST['email']) && isset($_POST['position']) && isset($_POST['office']) && isset($_POST['mobile']) && isset($_POST['access'])) {
                $email = $_POST['email'];
                $position = $_POST['position'];
                $office = $_POST['office'];
                $mobile = $_POST['mobile'];
                $access = $_POST['access'];
                $errors = array(
                    'email' => "",
                    'position' => "",
                    'office' => "",
                    'mobile' => "",
                    'access' => ""
                );
                $hasError = false;

                $user->Email = $email;
                $user->PositionID = $position;
                $user->OfficeID = $office;
                $user->Mobile = $mobile;
                $user->Access = $access;

                if (trim($position) == "") {
                    $errors['position'] = "Position is required";
                } else {
                    $errors['position'] = "";
                }
                if (trim($office) == "") {
                    $errors['office'] = "Office is required";
                } else {
                    $errors['office'] = "";
                }
                if (trim($mobile) == "") {
                    $errors['mobile'] = "Mobile No is required";
                } else {
                    $errors['mobile'] = $this->validateMobile($mobile);
                }
                if (trim($access) == "") {
                    $errors['access'] = "User Access is required";
                } else {
                    $errors['access'] = "";
                }


                if (trim($email) == "") {
                    $errors['email'] = "Email is required";
                } else {
                    $err = $this->validateEmail($email);
                    $errors['email'] = $err;
                    if ($err == "") {
                        if ($user->checkEmail() > 0) {
                            $errors['email'] = "Email already registered";
                        } else {
                            $errors['email'] = "";
                        }
                    }
                }

                if ($errors['email'] == "" && $errors['position'] == "" && $errors['office'] == "" && $errors['mobile'] == "" && $errors['access'] == "") {
                    $hasError = false;
                } else {
                    $hasError = true;
                }

                if ($hasError) {
                    echo json_encode(array(
                        'success' => false,
                        'message' => $errors
                    ));
                    exit;
                }
                if ($user->updateUser()) {
                    echo json_encode(
                        array(
                            'success' => true,
                            'message' => 'User\'s account updated'
                        )
                    );
                } else {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'Operation couldn\'t be completed.Please try again.'
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

    public function disableAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            parse_str(file_get_contents("php://input"), $_PUT);
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();

            if (isset($_PUT['id'])) {
                $id = $_PUT['id'];
                $user->ID = $id;
                if ($user->checkIfInactive()) {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'You can\'t disable an Inactive account.'
                        )
                    );
                } else {
                    $mail = new PHPMailer(true);
                    $accountName = $user->getFullname()['fullname'];
                    $email = $user->getEmail()['Email'];
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
                        $mail->Subject = 'Account Disabled';
                        $mail->addEmbeddedImage(dirname(__DIR__, 2) . '/web/assets/images/image-2.png', 'image-2.png');
                        $mail->MsgHTML($template->accountDisabled($accountName,));


                        if ($mail->send()) {
                            if ($user->disableAccount()) {
                                echo json_encode(
                                    array(
                                        'success' => true,
                                        'message' => 'Account disabled'
                                    )
                                );
                            }
                        } else {
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => 'Operation failed. Please try again.'
                                )
                            );
                        }
                    } catch (Exception $e) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => $mail->ErrorInfo
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


    public function enableAccount()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_SESSION['user']['id']) && isset($_SESSION['user']['access']) && $_SESSION['user']['access'] == 1) {
            $user = new UsersModel;
            $user->ID = $_SESSION['user']['id'];
            $user->updateLastAccess();
            parse_str(file_get_contents("php://input"), $_PUT);

            if (isset($_PUT['id'])) {
                $id = $_PUT['id'];
                $user->ID = $id;
                if ($user->checkIfInactive()) {
                    echo json_encode(
                        array(
                            'success' => false,
                            'message' => 'You can\'t enable an Inactive account.'
                        )
                    );
                } else {
                    $mail = new PHPMailer(true);
                    $accountName = $user->getFullname()['fullname'];
                    $email = $user->getEmail()['Email'];
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
                        $mail->Subject = 'Account Re-enabled';
                        $mail->addEmbeddedImage(dirname(__DIR__, 2) . '/web/assets/images/image-3.png', 'image-3.png');
                        $mail->MsgHTML($template->accountEnabled($accountName, APP_URL));


                        if ($mail->send()) {
                            if ($user->enableAccount()) {
                                echo json_encode(
                                    array(
                                        'success' => true,
                                        'message' => 'Account enabled'
                                    )
                                );
                            }
                        } else {
                            echo json_encode(
                                array(
                                    'success' => false,
                                    'message' => 'Operation failed. Please try again.'
                                )
                            );
                        }
                    } catch (Exception $e) {
                        echo json_encode(
                            array(
                                'success' => false,
                                'message' => $mail->ErrorInfo
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

    public function validateEmail(string $email)
    {
        $pattern = '/^[a-zA-Z0-9.a-zA-Z0-9.!#$%&\'*+-\/=?^_`{|}~]+@gmail+\.com+|^[a-zA-Z0-9.a-zA-Z0-9.!#$%&\'*+-\/=?^_`{|}~]+@yahoo+\.com+/';

        if (!preg_match($pattern, trim($email))) {
            if (strpos(trim($email), '@') !== false) {
                if (strlen(substr(trim($email), strpos(trim($email), '@'))) > 1) {
                    return "Email domain not allowed";
                }
            }
            return "Email is invalid";
        }

        return "";
    }

    public function validateMobile(string $mobile)
    {
        $pattern = '/^9\d{9}$/';

        if (!preg_match($pattern, trim($mobile))) {
            return "Mobile No is invalid";
        }

        return "";
    }

    public function generateTemporaryPassword()
    {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randPass = '';

        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($chars) - 1);
            $randPass .= $chars[$index];
        }

        return $randPass;
    }

    public function generateToken($payload)
    {
        $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

        $payload = json_encode($payload . strtotime("now"));

        $encodedHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        $encodedPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        $signature = hash_hmac('sha256', $encodedHeader . "." . $encodedPayload, JWT_SECRET, true);

        $encodedSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        return $encodedHeader . "." . $encodedPayload . "." . $encodedSignature;
    }
}
