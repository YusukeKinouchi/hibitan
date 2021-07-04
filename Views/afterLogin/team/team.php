<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/teamController.php');
require_once(ROOT_PATH .'Controllers/userController.php');
require_once(ROOT_PATH .'Controllers/pageController.php');

//チーム名取得
$getTeamName = new teamController();
$nameOfTeam = $getTeamName->getTeamName($_GET['teamId']);
if($_GET['teamId'] == $_SESSION['loginTeamNo']){
    $teamName = 'トップ(マイチーム)';
}else{
    $teamName = $nameOfTeam['team']['teamName'].'の学習記録';
}

//投稿取得
$postsOnMyteam = new teamController();
$params = $postsOnMyteam->getPosts($_GET['teamId']);

require_once('urlForTeam.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?=$nameOfTeam['team']['teamName'] ?> - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/deletePostCheck.js"></script>
    <script type="text/javascript" src="/js/favorite.js"></script>
    <script type="text/javascript" src="/js/joinCheck.js"></script>
    <script type="text/javascript" src="/js/scroll.js"></script>
</head>
<body>
    <?php if(isset($_SESSION['afterJoinTeam'])){
        if($_SESSION['afterJoinTeam'] == 1){
            echo '<script type="text/javascript">alert("チームに参加しました。");</script>';
            $_SESSION['afterJoinTeam'] = NULL;
    }}?>
    <?php if(isset($_SESSION['createTeamToTeam'])){
        if($_SESSION['createTeamToTeam'] == 1){
            echo '<script type="text/javascript">alert("チーム作成が完了しました。");</script>';
            $_SESSION['createTeamToTeam'] = NULL;
    }}?>
    <?php if(isset($_SESSION['setTeamToTeam'])){
        if($_SESSION['setTeamToTeam'] == 1){
            echo '<script type="text/javascript">alert("チーム設定の変更が完了しました。");</script>';
            $_SESSION['setTeamToTeam'] = NULL;
    }}?>
        <?php if(isset($_SESSION['delegateToTeam'])){
        if($_SESSION['delegateToTeam'] == 1){
            echo '<script type="text/javascript">alert("チームリーダーの権限委任が完了しました。");</script>';
            $_SESSION['delegateToTeam'] = NULL;
    }}?>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
           <?php include(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'><?=$teamName ?></h3>
                <?php if($_SESSION['loginTeamNo'] == NULL){?>
                <form action="joinTeam.php?teamId=<?=$_GET['teamId'] ?>" method='post'>
                    <div class='joinTeam'><button onclick='return joinCheck()' type='submit'>このチームに参加する</button></div>
                </form>
                <?php }?>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>
        <!--投稿表示 -->
        <?php foreach($params['posts'] as $post): ?>
            <?php
                $_SESSION['postUserId'] = $post['userId'];
                $postsUserId = new teamController();
                $nameOfPost = $postsUserId->getUser($post['userId']);
                $favorite = new pageController();
                $countFavorite = $favorite->countFavorite($post['id']);
            ?>
            <div class='postContent'>
                <div class='name-edit-delete'>
                    <a href="../page/page.php?userId=<?=$post['userId']?>"><?=$nameOfPost['user']['name'] ?></a>
                    <?php if($post['userId'] == $_SESSION['loginId']){?>
                        <a href='../edit.php?id=<?=$post['id'] ?>'>[編集]</a>
                        <a href="../deletePost.php?postId=<?=$post['id'] ?>" onclick='return deletePostCheck()'>[削除]</a>
                    <?php }?>
                </div>
                <p>勉強時間：<?php echo date('Y年m月d日H:i',  strtotime($post['startTime'])) ?>〜<?php echo date('Y年m月d日H:i',  strtotime($post['endTime'])) ?></p>
                <p>教材　　：<?=$post['material'] ?></p>
                <div class='studyContent'>
                    <p class='studyContentTitle'>学習内容：</p>
                    <div class='studyDetail'><p><?=nl2br($post['learningContent']) ?></p></div>
                </div>
                <div id='postId'>
                <input type="hidden" name="userId" class="userId" value="<?php echo $post['userId'] ?>">
                <input type="hidden" name="postId" class="postId" value="<?php echo $post['id'] ?>">
                <?php if($countFavorite == 0){
                    echo "<div class ='favoriteContent'>";
                    echo "<div><button class='favoriteBtn'>&#9734</button></div>";
                    echo '<p>'.$countFavorite.'</p>';
                    echo "</div>";
                }else{
                    echo "<div class ='favoriteContent'>";
                    echo "<div><button class='favoriteBtn'>&#9733</button></div>";
                    echo '<p>'.$countFavorite.'</p>';
                    echo "</div>";
                } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php include(ROOT_PATH .'/Views/afterLogin/popupAfterComplete.php'); ?>
</body>
