<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/teamController.php');

$joinTeam = new teamController();
$join = $joinTeam->joinTeam($_GET['teamId']);
?>