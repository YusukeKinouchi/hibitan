<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../login/loginForm.php');
}
require_once(ROOT_PATH .'/Controllers/operationController.php');

$_SESSION['nameForCreateTeam'] = $_POST['name'];
$_SESSION['proficiancyForCreateTeam'] = $_POST['proficiancy'];
$_SESSION['aboutForCreateTeam'] = $_POST['about'];

$validateCreateTeam = new operationController();
$validation = $validateCreateTeam->validate();

$createTeam = new operationController();
$create = $createTeam->create();

$_SESSION['loginTeamNo'] = $create['teamId']['id'];
$_SESSION['loginTeamLeader'] = 1;
$_SESSION['createTeamToTeam'] = 1;

$_SESSION['nameForCreateTeam'] = NULL;
$_SESSION['proficiancyForCreateTeam'] = NULL;
$_SESSION['aboutForCreateTeam'] = NULL;

$_SESSION['error_nameForCreateTeam'] = NULL;
$_SESSION['error_aboutForCreateTeam'] = NULL;

header('Location: ../team/team.php?teamId='.$_SESSION['loginTeamNo']);
?>