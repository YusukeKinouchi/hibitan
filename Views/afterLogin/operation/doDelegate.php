<?php
namespace app\src;
session_start();
require_once('directAccessMeasuresForLeader.php');
require_once(ROOT_PATH .'/Controllers/operationController.php');

$_SESSION['userIdForDelegate'] = $_POST['user'];

$delegateLeader = new operationController();
$delegateLeaderToUser = $delegateLeader->delegate();

$_SESSION['delegateToTeam'] = 1;

$_SESSION['userIdForDelegate'] = NULL;

header('Location: ../team/team.php?teamId='.$_SESSION['loginTeamNo']);
?>