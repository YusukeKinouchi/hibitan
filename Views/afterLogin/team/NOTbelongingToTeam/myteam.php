<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

if($_SESSION['loginTeamNo'] != NULL){
    header('Location: ../team.php?teamId='.$_SESSION['loginTeamNo']);
}

//titleTop用のURL
$postUrl = '../../post.php';
$operationUrl = '../../operation.php';
$logoutUrl ='../../doLogout.php';

//ヘッダー用のURL取得
$mypageUrl = '../../page/page.php?userId='.$_SESSION['loginId'];
$myteamUrl = 'myteam.php';
$searchTeamUrl = '../searchTeam.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>トップ(マイチーム) - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/team/NOTbelongingToTeam.css">
</head>
<body>
    <?php if(isset($_SESSION['teamWithdrawalToMyteam'])){
        if($_SESSION['teamWithdrawalToMyteam'] == 1){
            echo '<script type="text/javascript">alert("チーム脱退が完了しました。");</script>';
            $_SESSION['teamWithdrawalToMyteam'] = NULL;
    }}?>
    <?php if(isset($_SESSION['deleteTeamToMyteam'])){
        if($_SESSION['deleteTeamToMyteam'] == 1){
            echo '<script type="text/javascript">alert("チーム解散が完了しました。");</script>';
            $_SESSION['deleteTeamToMyteam'] = NULL;
    }}?>

    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
           <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>トップ(マイチーム)</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <div id='invite'>
            <h3>チームに所属しよう！</h3>
            <h3>チームに所属すると以下のメリットがあります！</h3>
            <div id='merit'>    
                <p>・学習仲間が得られる！</p>
                <p>・マイページに加えてチームページにも学習記録が投稿され、チームメイトにも学習記録が見てもらえる！</p>
            </div>
            <p id='arrow'>↓</p>
            <p>仲間がモチベーションとなり、学習が継続しやすくなる！</p>
            <p><a href='../searchTeam.php'>チームを探す！</a></p>
            <p><a href='../../operation/createTeam.php'>チームを作成する！</a></p>
        </div>
    </div>
    <?php include(ROOT_PATH .'/Views/afterLogin/popupAfterComplete.php'); ?>
</body>