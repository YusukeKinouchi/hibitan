<?php
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../login/loginForm.php');
}

if($_SESSION['loginTeamLeader'] == 1){
    header('Location: ../operation.php');
}

require_once('urlForOperation.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会員登録削除 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/deleteUserCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>会員登録削除</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <div class='settingCondition'>
            <p>会員登録を削除すると復元できません。</p>
            <p>それでも削除しますか？</p>
        </div>
        <div class='buttonToCenter'><button onclick='location.href="../operation.php"'>キャンセル</button></div>
        <form action='doDeleteUser.php'>
            <div class='buttonToCenter'><button onclick='return deleteUserCheck()'>会員登録を削除する</button></div>
        </form>
    </div>
</body>