<?php
namespace app\src;
session_start();
require_once(ROOT_PATH .'/Controllers/loginController.php');

$_SESSION['loginMail'] = $_POST['loginMail'];
$_SESSION['loginPassword'] = $_POST['loginPassword'];

$login = new loginController();
$loginCheck = $login->validateLogin();

?>
