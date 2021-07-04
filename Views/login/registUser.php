<?php
namespace app\src;
session_start();
require_once(ROOT_PATH .'/Controllers/loginController.php');
require_once(ROOT_PATH .'/Views/login/directAccessMeasuresForLogin.php');

$_SESSION['mailForRegist'] = $_POST['mail'];
$_SESSION['passwordForRegist'] = $_POST['password'];
$_SESSION['nameForRegist'] = $_POST['name'];
$_SESSION['languageForRegist'] = $_POST['language'];
$_SESSION['proficiancyForRegist'] = $_POST['proficiancy'];

$validateRegister = new loginController();
$validation = $validateRegister->validate();

$registUser = new loginController();
$regist = $registUser->regist();

$_SESSION['mailForRegist'] = NULL;
$_SESSION['passwordForRegist'] = NULL;
$_SESSION['nameForRegist'] = NULL;
$_SESSION['languageForRegist'] = NULL;
$_SESSION['proficiancyForRegist'] = NULL;

$_SESSION['error_mailForRegist'] = NULL;
$_SESSION['error_passwordForRegist'] = NULL;
$_SESSION['error_nameForRegist'] = NULL;

header('Location: ./loginForm.php');
?>
