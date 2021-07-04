<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}
require_once('urlForAfterLoginWithoutTeamInfo.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>各種操作 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include('titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>各種操作</h3>
            </div>
        </div>
        <?php include('header.php'); ?>
        <div class='linkToCenter operation-top'><a href='./operation/settingUser.php'>会員名・学習言語・習熟度設定</a></div>
        <div class='linkToCenter operation'><a href='./teamOperation.php'>チーム関連</a></div>
        <div class='linkToCenter operation'><a href='./doLogout.php'>ログアウト</a></div>
        <?php if($_SESSION['loginTeamLeader'] != 1){ 
        echo "<div class='linkToCenter operation'><a href='./operation/deleteUser.php'>会員登録削除</a></div>";
        }?>
    </div>
</body>