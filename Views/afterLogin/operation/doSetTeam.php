<?php
namespace app\src;
session_start();
require_once('directAccessMeasuresForLeader.php');
require_once(ROOT_PATH .'/Controllers/operationController.php');

$_SESSION['nameForSetTeam'] = $_POST['name'];
$_SESSION['proficiancyForSetTeam'] = $_POST['proficiancy'];
$_SESSION['aboutForSetTeam'] = $_POST['about'];

$validateSetTeam = new operationController();
$validation = $validateSetTeam->validateAndSetTeam();

$_SESSION['setTeamToTeam'] = 1;

$_SESSION['nameForSetTeam'] = NULL;
$_SESSION['proficiancyForSetTeam'] = NULL;
$_SESSION['aboutForSetTeam'] = NULL;

$_SESSION['error_nameForSetTeam'] = NULL;
$_SESSION['error_aboutForSetTeam'] = NULL;

header('Location: ../team/team.php?teamId='.$_SESSION['loginTeamNo']);
?>