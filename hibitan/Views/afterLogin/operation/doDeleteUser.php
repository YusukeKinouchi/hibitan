<?php
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/operationController.php');

$doDeletingUser = new operationController();
$deleteUser = $doDeletingUser->deleteUser();

header('Location: ../../login/loginForm.php');
?>