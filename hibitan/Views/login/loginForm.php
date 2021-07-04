<?php
session_start();
if(isset($_SESSION['error_passwordReset'])){
    $_SESSION['error_passwordReset'] = NULL;
}

if(isset($_SESSION['error_mailForRegist'], $_SESSION['error_passwordForRegist'], $_SESSION['error_nameForRegist'])){
    $_SESSION['error_mailForRegist'] = NULL;
    $_SESSION['error_passwordForRegist'] = NULL;
    $_SESSION['error_nameForRegist'] = NULL;
}

if(isset($_SESSION['error_reset'],$_SESSION['mailForReset'])){
    $_SESSION['error_reset'] = NULL;
    $_SESSION['mailForReset'] = NULL;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ログインフォーム - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/login/loginForm.css">
</head>
<body>
    <?php if(isset($_SESSION['registerTologinForm'])){
        if($_SESSION['registerTologinForm'] == 1){
        echo '<script type="text/javascript">alert("会員登録が完了しました。");</script>';
        $_SESSION['registerTologinForm'] = NULL;
    }}?>
    <?php if(isset($_SESSION['passwordSetTologinForm'])){
        if($_SESSION['passwordSetTologinForm'] == 1){
            echo '<script type="text/javascript">alert("パスワードリセットが完了しました。");</script>';
            $_SESSION['passwordSetTologinForm'] = NULL;
    }}?>
       <?php if(isset($_SESSION['deleteUserTologinForm'])){
        if($_SESSION['deleteUserTologinForm'] == 1){
            echo '<script type="text/javascript">alert("会員登録削除が完了しました。");</script>';
            $_SESSION['deleteUserTologinForm'] = NULL;
    }}?>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <h1 class='title'>日々鍛</h1>
            <h3 class='title'>ログインフォーム</h3>
        </div>

        <!--サービス説明-->    
        <div class='explain'>
            <p>日々鍛は学習仲間獲得に特化した、学習記録投稿サイトです。</p>
            <p>ログインすることでサービスをご利用可能です。</p>
            <p>ご登録のメールアドレスとパスワードを入れ、ログインしてください。</p>
            <p>新規登録は左下「新規登録」より行ってください</p>
        </div>
        <!--入力欄-->
        <form action='loginCheck.php' method='post'>
            <div class='box'>
                <p>メールアドレス　<input type='text' name='loginMail'></p>
            </div>
            <div class='box'>
                <p>パスワード　　　<input type='password' name='loginPassword'></p>
            </div>
            <?php if(!empty($_SESSION['error_login'])){echo "<p class='error linkToCenter'>".$_SESSION['error_login']."</p>";$_SESSION['error_login'] = NULL;} ?>
            <div class='buttonToCenter'><button type='submit'>ログイン</button></div>
            <div id='link'>
                <div class='linkToCenter'><a href='passwordReset.php'>パスワードを忘れた方はこちら</a></div>
                <div id='toRegister' class='linkToCenter'><a href='register.php'>会員登録はこちら</a></div>
            </div>
        </form>
    </div>
</body>