<?php
session_start();
require_once('directAccessMeasuresForLeader.php');
require_once('urlForOperation.php');

require_once(ROOT_PATH .'Controllers/operationController.php');
$getUserForDelegation = new operationController();
$getUser = $getUserForDelegation->getUser($_GET['teamIdForOperation']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>チームリーダー権限委任 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/delegateCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チームリーダー権限委任</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>

        <form action='doDelegate.php?teamIdForOperation=<?=$_SESSION['loginTeamNo'] ?>' method='post'>
            <div class='box dropList authority'>
                <!--「委任相手」の後に１文字分空白がある -->
                <p>委任相手　
                    <select name='user'>
                        <?php foreach($getUser['user'] as $user){
                            if($user['id'] == $_SESSION['loginId']){continue;}
                            echo '<option value='.$user['id'].' >'.$user['name'].'</option>';
                        } ?>
                    </select>
                </p>
            </div>
            <div class='buttonToCenter'><button onclick='delegateCheck()'>チームリーダー権限を委任する</button></div>
        </form>
    </div>
</body>