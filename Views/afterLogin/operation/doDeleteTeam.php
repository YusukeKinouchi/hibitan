<?php
namespace app\src;
session_start();
require_once('directAccessMeasuresForLeader.php');

require_once(ROOT_PATH .'Controllers/operationController.php');

$doDeletingTeam = new operationController();
$deleteTeam = $doDeletingTeam->deleteTeam();

header('Location: ../team/NOTbelongingToTeam/myteam.php');
?>