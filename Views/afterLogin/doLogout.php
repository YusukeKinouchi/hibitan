<?php
namespace app\src;
session_start();
$_SESSION = NULL;
session_destroy();
header('Location:../login/loginForm.php');
?>