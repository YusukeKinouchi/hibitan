<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/operationController.php');

$_SESSION['nameForSet'] = $_POST['name'];
$_SESSION['languageForSet'] = isset($_POST['language']) ? $_POST['language'] : $_SESSION['loginLanguage'];
$_SESSION['proficiancyForSet'] = isset($_POST['proficiancy']) ? $_POST['proficiancy'] : $_SESSION['loginProficiancy'];

$doSettingUser = new operationController();
$setUser = $doSettingUser->setUser();
if($_SESSION['loginTeamNo'] != NULL){
    header('location:/afterLogin/team/team.php?teamId='.$_SESSION['loginTeamNo']);
}else{
    header('location:/afterLogin/team/NOTbelongingToTeam/myteam.php');
}
?>