<?php
namespace app\src;
session_start();
if($_GET['resetId'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}
require_once(ROOT_PATH . '/Models/function.php');
$password = isset($_SESSION['passwordReset']) ? $_SESSION['passwordReset'] : NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>パスワードリセット - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/login/passwordSet.css">
    <script type="text/javascript" src="/js/passwordReset.js"></script>
</head>
<body>
<div class='frame'>
    <!--タイトル-->
    <div class='titleArea'>
        <h1 class='title'>日々鍛</h1>
        <h3 class='title'>新パスワード設定フォーム</h3>
    </div>
    <!--入力欄-->
    <form action='passwordSetCheck.php' method='post'>
        <div id='passwordSet' class='box'>
        <?php if(!empty($_SESSION['error_passwordReset'])){echo "<p class='error'>".$_SESSION['error_passwordReset']."</p>";} ?>
            <p>パスワード　<input type='password' name='passwordReset'></p>
        </div>
        <div class='buttonToCenter'><button type='submit' value="<?php echo h($password); ?>" onclick="return passwordSetPopup()">パスワードを設定する</button></div>
    </form>
    <div id='link' class='linkToCenter'><a href='loginForm.php'>ログインフォームに戻る</a></div>  
</div>
</body>