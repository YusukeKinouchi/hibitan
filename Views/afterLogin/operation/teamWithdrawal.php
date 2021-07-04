<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../login/loginForm.php');
}

if($_SESSION['loginTeamNo'] == NULL){
    header('Location: ../operation.php');
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
    <title>チーム脱退 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/withdrawalCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
        <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム脱退</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <div class='settingCondition'>
            <p>チーム脱退は操作を取り消せません。</p>
            <p>それでもチーム脱退を実行しますか？</p>
        </div>
        <div class='buttonToCenter'><button onclick='location.href="../operation.php"'>キャンセル</button></div>
        <form action='doWithdrawal.php'>
            <div class='buttonToCenter'><button onclick='return withdrawalCheck()'>チーム脱退</button></div>
        </form>
    </div>
</body>