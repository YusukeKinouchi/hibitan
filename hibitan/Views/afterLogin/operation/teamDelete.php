<?php
session_start();
require_once('directAccessMeasuresForLeader.php');
require_once('urlForOperation.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>チーム解散 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/deleteTeamCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム解散</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <div class='settingCondition'>
            <p>チーム解散は操作を取り消せません。</p>
            <p>それでもチーム解散を実行しますか？</p>
        </div>
        <div class='buttonToCenter'><button onclick='location.href="../operation.php"'>キャンセル</button></div>
        <form action='doDeleteTeam.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>' method='post'>
            <div class='buttonToCenter'><button onclick='return deleteTeamCheck()'>チーム解散</button></div>
        </form>
    </div>
</body>