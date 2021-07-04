<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

//チーム一覧取得
require_once(ROOT_PATH .'Controllers/teamController.php');
if(!isset($_GET['proficiancy'])){
    $getTeams = new teamController();
    $teams = $getTeams->getTeams();
}else{
    if($_GET['proficiancy']=='指定なし'){
        $getTeams = new teamController();
        $teams = $getTeams->getTeams();
    }else{
    $getTeams = new teamController();
    $teams = $getTeams->getTeamsWithProficiancy($_GET['proficiancy']);
    }
}

require_once('urlForTeam.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>チーム検索 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/team/searchTeam.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/scroll.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
        <?php include(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム検索</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
    </div>
    <div id='levelFilter'>
    <form action="searchTeam.php" method='get'>
        <p>習熟度を指定する</p>
        <select name='proficiancy' id='level'>
            <option selected>指定なし</option>
            <option>初級者</option>
            <option>中級者</option>
            <option>上級者</option>
        </select>
        <button type='submit'>絞り込む</button>
    </form>
    </div>

    <?php foreach($teams['team'] as $team): ?>
        <?php
            $getTeamName = new teamController();
            $nameOfTeam = $getTeamName->getTeamName($team['id']);
            $getUserCount = new teamController();
            $userCount = $getUserCount->getUserCount($team['id']);
        ?>
    <div class='postContent'>
        <p>チーム名　：<a href='team.php?teamId=<?=$team['id'] ?>'><?=$nameOfTeam['team']['teamName'] ?></a></p>
        <p>人数　　　：<?=$userCount ?>人</p>
        <p>習熟度条件：<?=$team['proficiancy'] ?></p>
        <div class='studyContent'>
            <p class='studyContentTitle'>チーム概要：</p>
            <div id='teamDetail'><p><?=nl2br($team['about']) ?></p></div>
        </div>
    </div>
    <?php endforeach; ?>
</body>