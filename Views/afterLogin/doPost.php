<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/userController.php');

$_SESSION['startDate'] = $_POST['startDate'];
$_SESSION['startHour'] = $_POST['startHour'];
$_SESSION['startMinute'] = $_POST['startMinute'];
$_SESSION['endDate'] = $_POST['endDate'];
$_SESSION['endHour'] = $_POST['endHour'];
$_SESSION['endMinute'] = $_POST['endMinute'];
$_SESSION['material'] = $_POST['material'];
$_SESSION['learningContent'] = $_POST['learningContent'];


$doPost = new userController();
$post = $doPost->post();
if($_SESSION['loginTeamNo'] == NULL){
    if(isset($_SESSION['debugForLogin'])){
        $_SESSION['debugAccount'] = 'noteam';
    }
    header('Location: ../afterLogin/team/NotbelongingToTeam/myteam.php');
}else{
    if(isset($_SESSION['debugForLogin'])){
        $_SESSION['debugAccount'] = 'team';
    }
    header('Location: ../afterLogin/team/team.php?teamId='.$_SESSION['loginTeamNo']);
}
?>