<?php
namespace app\src;
session_start();
require_once(ROOT_PATH . '/Models/function.php');
$mail = isset($_SESSION['mailForReset']) ? $_SESSION['mailForReset'] : NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>パスワードリセット - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/login/passwordReset.css">
</head>
<body>
<div class='frame'>
    <!--タイトル-->
    <div class='titleArea'>
        <h1 class='title'>日々鍛</h1>
        <h3 class='title'>パスワードリセットフォーム</h3>
    </div>

    <!--入力欄-->
    <form action='sendMail.php' method='post'>
        <div id='passwordReset' class='box'>
            <p>メールアドレス　<input name='mailForReset' value="<?php echo $mail ?>"></p>
        </div>
        <?php if(!empty($_SESSION['error_reset'])){echo "<p class='error linkToCenter'>".$_SESSION['error_reset']."</p>";$_SESSION['error_login'] = NULL;} ?>
        <div class='buttonToCenter'><button type='submit'>パスワードをリセットする</button></div>
    </form>
    <div id='link' class='linkToCenter'><a href='loginForm.php'>ログインフォームに戻る</a></div>  
</div>
</body>