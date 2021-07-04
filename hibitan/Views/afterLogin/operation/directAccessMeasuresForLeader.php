<?php
if($_SESSION['login'] != session_id()){
    $_SESSION = array();
    session_destroy();
    header('Location: ../../../login/loginForm.php');
}

if(!($_SESSION['loginTeamLeader'] ==1 AND $_SESSION['loginTeamNo'] == $_GET['teamIdForOperation'])){
    $_SESSION = array();
    session_destroy();
    header('Location: ../../../login/loginForm.php');
}
?>