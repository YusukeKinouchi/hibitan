<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}
date_default_timezone_set('Asia/Tokyo');
function timeLoop($start,$end,$value=null){
    for($i = $start; $i <= $end; $i++){
		if(isset($value) &&  $value == $i){
			echo "<option value=\"{$i}\" selected=\"selected\">{$i}</option>";
		}else{
			echo "<option value=\"{$i}\">{$i}</option>";
		}
	}
}

require_once('urlForAfterLoginWithoutTeamInfo.php');

//投稿の内容
$startDate = isset($_SESSION['startDate']) ? $_SESSION['startDate'] : NULL;
$startHour = isset($_SESSION['startHour']) ? $_SESSION['startHour'] : date('G')-1;
$startMinute = isset($_SESSION['startMinute']) ? $_SESSION['startMinute'] : date('i');
$endDate = isset($_SESSION['endDate']) ? $_SESSION['endDate'] : NULL;
$endHour = isset($_SESSION['endHour']) ? $_SESSION['endHour'] : date('G');
$endMinute = isset($_SESSION['endMinute']) ? $_SESSION['endMinute'] : date('i');
$material = isset($_SESSION['material']) ? $_SESSION['material'] : NULL;
$learningContent = isset($_SESSION['learningContent']) ? $_SESSION['learningContent'] : NULL;

$timetest = isset($_SESSION['timetest']) ? $_SESSION['timetest'] : NULL;

$_SESSION['startDate'] = NULL;
$_SESSION['startHour'] = NULL;
$_SESSION['startMinute'] = NULL;
$_SESSION['endDate'] = NULL;
$_SESSION['endHour'] = NULL;
$_SESSION['endMinute'] = NULL;
$_SESSION['material'] = NULL;
$_SESSION['learningContent'] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>投稿フォーム - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/postCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
           <?php include('titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>投稿フォーム</h3>
            </div>
        </div>
        <?php include('header.php'); ?>
        <form action='./doPost.php' method='post'>
            <div class='box'>
            <?php if(!empty($_SESSION['error_time'])){echo "<p class='error'>".$_SESSION['error_time']."</p>";$_SESSION['error_time'] = NULL;} ?>
                <p>勉強開始時間：<input name='startDate' class='date' type='date' value=<?=$startDate ?>><select name='startHour'><?php timeLoop('0','23',$startHour); ?></select>：<select name='startMinute'><?php timeLoop('0','60',$startMinute); ?></select></p>
                <p>勉強終了時間：<input name='endDate' class='date' type='date' value=<?=$endDate ?>><select name='endHour'><?php timeLoop('0','23',$endHour); ?></select>：<select name='endMinute'><?php timeLoop('0','60',$endMinute); ?></select></p>
            </div>

            <div class='box'>
                <?php if(!empty($_SESSION['error_material'])){echo "<p class='error'>".$_SESSION['error_material']."</p>";$_SESSION['error_material'] = NULL;} ?>
                <p>　　　　教材：<input name='material' value=<?=$material ?>></p>
            </div>
            <div class='box' id='studyInformation'>
                <?php if(!empty($_SESSION['error_learningContent'])){echo "<p class='error'>".$_SESSION['error_learningContent']."</p>";$_SESSION['error_learningContent'] = NULL;} ?>
                <p>　　学習内容：<textarea name='learningContent' cols='20'><?=$learningContent ?></textarea></p>
            </div>
            <div class='buttonToCenter'><button onclick='return postCheck()' type='submit'>投稿</button></div>
        </form>
    </div>
</body>