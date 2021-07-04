<?php
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/userController.php');

$deletePost = new userController();
$delete = $deletePost->deletePost();
header('location:/afterLogin/page/page.php?userId='.$_SESSION['loginId']);
?>