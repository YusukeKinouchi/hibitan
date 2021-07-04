<?php
session_start();
require_once(ROOT_PATH .'/Views/login/directAccessMeasuresForLogin.php');
require_once(ROOT_PATH .'/Controllers/loginController.php');

$_SESSION['mailForReset'] = h($_POST['mailForReset']);

$sendMail = new loginController();
$forReset = $sendMail->sendMail();

$_SESSION['mailForReset'];
$_SESSION['keyForsendComplete'] = 1;

?>