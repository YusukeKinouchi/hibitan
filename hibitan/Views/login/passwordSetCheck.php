<?php
session_start();
require_once(ROOT_PATH .'/Controllers/loginController.php');
require_once(ROOT_PATH . '/Models/function.php');

$_SESSION['passwordReset'] = h($_POST['passwordReset']);

$resetPassword = new loginController();
$doReset = $resetPassword->doValidateAndResetPassword();

?>