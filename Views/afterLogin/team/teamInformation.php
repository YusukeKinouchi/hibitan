<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

//チーム情報取得
require_once(ROOT_PATH .'Controllers/teamController.php');
$getTeamInformation = new teamController();
$teamInformation = $getTeamInformation->getTeamInformation($_GET['teamId']);
$information = $teamInformation['team'];

//チーム名取得
$getTeamName = new teamController();
$nameOfTeam = $getTeamName->getTeamName($_GET['teamId']);
$getUserCount = new teamController();
$userCount = $getUserCount->getUserCount($_GET['teamId']);

//ランキング取得
$getRanking = new teamController();
$ranking = $getRanking->getRanking($_GET['teamId']);
$i = 0;

require_once('urlForTeam.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$nameOfTeam['team']['teamName'] ?> 詳細情報 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/team/teamInformation.css">
    <script type="text/javascript" src="/js/joinCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
           <?php require(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'><?=$nameOfTeam['team']['teamName'] ?>　詳細情報</h3>
                <?php if($_SESSION['loginTeamNo'] == NULL){?>
                <form action="joinTeam.php?teamId=<?=$_GET['teamId'] ?>" method='post'>
                    <div class='joinTeam'><button onclick='return joinCheck()' type='submit'>このチームに参加する</button></div>
                </form>
                <?php }?>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <div id='back'><a href='./team.php?teamId=<?=$_GET['teamId'] ?>'>←チーム画面に戻る</a></div>
        <div id='information'>
            <p>チーム名　：<?=$nameOfTeam['team']['teamName'] ?></p>
            <p>学習言語　：<?=$information['language'] ?></p>
            <p>習熟度条件：<?=$information['proficiancy'] ?></p>
            <div class='studyContent'>
                <p class='studyContentTitle'>チーム概要：</p>
                <div class='studyDetail'><p><?=nl2br($information['about']) ?></p></div>
            </div>
        <p>○所属会員の勉強時間ランキング（★はチームリーダー）</p>
        <p>※チーム内投稿がない会員は表示されません。また、過去に在籍した会員が表示されることがあるため、現在の所属人数とランキングに表示される人数が異なる場合があります。</p>
        <?php foreach($ranking['ranking'] as $rankingInTeam): ?>
        <?php $i += 1;
              $_SESSION['postUserId'] = $rankingInTeam['userId'];
              $postsUserId = new teamController();
              $nameOfPost = $postsUserId->getUser($rankingInTeam['userId']);
        ?> 
        <p><?=$i ?>位：<?php if($nameOfPost['user']['teamLeader']==1){echo '★';} ?><?=$nameOfPost['user']['name'] ?></p>
        <?php endforeach; ?>
        </div>
    </div>
</body>