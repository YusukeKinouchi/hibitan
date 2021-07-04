<?php
namespace app\src;
session_start();
require_once('directAccessMeasuresForLeader.php');
require_once('urlForOperation.php');

//チーム情報取得
require_once(ROOT_PATH .'Controllers/teamController.php');
$getTeamInformation = new teamController();
$teamInformation = $getTeamInformation->getTeamInformation($_GET['teamIdForOperation']);
$information = $teamInformation['team'];

$name = isset($_SESSION['nameForSetTeam']) ? $_SESSION['nameForSetTeam'] : $information['teamName'];
$proficiancy = isset($_SESSION['proficiancyForSetTeam']) ? $_SESSION['proficiancyForSetTeam'] : $information['proficiancy'];
$about = isset($_SESSION['aboutForSetTeam']) ? $_SESSION['aboutForSetTeam'] : $information['about'];

$error_name = isset($_SESSION['error_nameForSetTeam']) ? $_SESSION['error_nameForSetTeam']: NULL;
$_SESSION['error_nameForSetTeam'] = NULL;

$error_about = isset($_SESSION['error_aboutForSetTeam']) ? $_SESSION['error_aboutForSetTeam']: NULL;
$_SESSION['error_aboutForSetTeam'] = NULL;

$_SESSION['nameForSetTeam'] = NULL;
$_SESSION['proficiancyForSetTeam'] = NULL;
$_SESSION['aboutForSetTeam'] = NULL;

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>チーム加入条件変更 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/setTeamCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム加入条件変更</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'Views/afterLogin/header.php'); ?>

        <form action='doSetTeam.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>' method='post'>
            <div id='register' class='box'>
                <p class='error'><?=$error_name ?></p>
                <p>　チーム名　<input name = 'name' value=<?=$name ?>></p>
            </div>
            <div class='box dropList'>
                <!--「習熟度」の後に１文字分空白がある -->
                <p>　習熟度　　
                <select name='proficiancy'>
                    <?php if($information['proficiancy'] == '初級者'){?>
                    <option value='初級者' <?php if($proficiancy == '初級者'){echo 'selected';} ?>>初級者</option>
                    <?php } ?>
                    <?php if($information['proficiancy'] == '中級者'){?>
                    <option value='中級者' <?php if($proficiancy == '中級者'){echo 'selected';} ?>>中級者</option>
                    <?php } ?>
                    <?php if($information['proficiancy'] == '上級者'){?>
                    <option value='上級者' <?php if($proficiancy == '上級者'){echo 'selected';} ?>>上級者</option>
                    <?php } ?>
                    <option value='問わない' <?php if($proficiancy == '問わない'){echo 'selected';} ?>>問わない</option>
                </select>
                </p>
            </div>
            <div class='box'>
                <p class='error'><?=$error_about ?></p>
                <p>チーム概要　<textarea name='about' cols='20'><?=$about ?></textarea></p>
            </div>
            <div class='buttonToCenter'><button onclick='return setTeamCheck()' type='submit'>加入条件を変更する</button></div>
        </form>
    </div>
</body>