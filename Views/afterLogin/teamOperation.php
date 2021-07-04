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
    <title>チーム関連画面 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include('titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム関連画面</h3>
            </div>
        </div>
        <?php include('header.php'); ?>
        <!-- チーム未所属時 -->
        <?php if($_SESSION['loginTeamNo'] == NULL){ ?>
            <div class='linkToCenter operation-top'><a href='./operation/createTeam.php'>チーム作成</a></div>
        <!-- チーム所属時 -->
        <!-- チームリーダー時 -->
        <?php }else{if($_SESSION['loginTeamLeader'] == 1){ ?>
            <div class='linkToCenter operation-top'><a href='./operation/teamDelete.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>'>チーム解散</a></div>
            <div class='linkToCenter aboutTeam'><a href='./operation/settingTeam.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>'>チーム加入条件設定</a></div>
            <div class='linkToCenter aboutTeam'><a href='./operation/delegation.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>'>チームリーダー権限委任</a></div>
        <!-- 非チームリーダー時 -->
        <?php }else{ ?>
            <div class='linkToCenter operation-top'><a href='./operation/teamWithdrawal.php'>チーム脱退</a></div>
        <?php }} ?>
    </div>
</body>