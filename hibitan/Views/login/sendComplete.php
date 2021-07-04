<?php
session_start();
if(!isset($_SESSION['keyForsendComplete'])){
    header('Location:./loginForm.php');
    exit();
}else{
    if($_SESSION['keyForsendComplete'] != 1){
        header('Location:./loginForm.php');
        exit();
    }else{
        $_SESSION['keyForsendComplete'] = NULL;
    }
}
$_SESSION['error_reset'] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>パスワードリセット用メール送付完了 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/login/passwordReset.css">
</head>
<body>
<div class='frame'>
    <!--タイトル-->
    <div class='titleArea'>
        <h1 class='title'>日々鍛</h1>
        <h3 class='title'>パスワードリセット用メール送付完了</h3>
    </div>
    <div class='explain'>
        <p>パスワードリセット用のメールを送付しました。</p>
        <p>送付されたメールにあるリンクからパスワードのリセットをお願いします。</p>
    </div>
    <div id='link' class='linkToCenter'><a href='loginForm.php'>ログインフォームに戻る</a></div>  
</div>
</body>