<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

require_once(ROOT_PATH .'Controllers/pageController.php');
require_once(ROOT_PATH .'Controllers/teamController.php');
//userId受け取って投稿取得
$_SESSION['userId'] = $_GET['userId'];
$postsOnPage = new pageController();
$params = $postsOnPage->getPosts();

//titleTop用のURL
$postUrl = '../post.php';
$operationUrl = '../operation.php';
$logoutUrl ='../doLogout.php';

//ヘッダー用のURL取得
$mypageUrl = 'page.php?userId='.$_SESSION['loginId'];
if($_SESSION['loginTeamNo'] !=NULL){
    $myteamUrl = '../team/team.php?teamId='.$_SESSION['loginTeamNo'];
}else{
    $myteamUrl = '../team/NOTbelongingToTeam/myteam.php';
}
$searchTeamUrl = '../team/searchTeam.php';

//タイトル用に一度取得
$postsUserId = new teamController();
$nameOfPost = $postsUserId->getUser($_GET['userId']);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php if($_GET['userId'] == $_SESSION['loginId']){echo 'マイページ';}else{echo $nameOfPost['user']['name'].'のページ'; }?> - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="/js/deletePostCheck.js"></script>
    <script type="text/javascript" src="/js/favorite.js"></script>
    <script type="text/javascript" src="/js/scroll.js"></script>
</head>
<body>

    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
           <?php include(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'><?php if($_GET['userId'] == $_SESSION['loginId']){echo 'マイページ';}else{echo $nameOfPost['user']['name'].'のページ'; }?></h3>
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
                    <a href="./page.php?userId=<?=$post['userId']?>"><?=$nameOfPost['user']['name'] ?></a>
                    <?php if($post['userId'] == $_SESSION['loginId']){?>
                        <a href='../edit.php?id=<?=$post['id'] ?>'>[編集]</a>
                        <a href="../deletePostOnMypage.php?postId=<?=$post['id'] ?>" onclick='return deletePostCheck()'>[削除]</a>
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
</body>