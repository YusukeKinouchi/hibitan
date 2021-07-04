<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/operationController.php');

$doWithdrawal = new operationController();
$withdrawal = $doWithdrawal->withdrawal();

header('Location: ../team/NOTbelongingToTeam/myteam.php');
?>