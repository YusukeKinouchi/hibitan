<?php
namespace app\src;
session_start();
require_once(ROOT_PATH . '/Models/function.php');

$name = isset($_SESSION['nameForRegist']) ? $_SESSION['nameForRegist'] : NULL;
$mail = isset($_SESSION['mailForRegist']) ? $_SESSION['mailForRegist'] : NULL;
$password = isset($_SESSION['passwordForRegist']) ? $_SESSION['passwordForRegist'] : NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会員登録 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <link rel="stylesheet" type="text/css" href="/css/login/register.css">
    <script type="text/javascript" src="/js/register.js"></script>
</head>

<body>
<div class='frame'>
    <!--タイトル-->
    <div class='titleArea'>
        <h1 class='title'>日々鍛</h1>
        <h3 class='title'>会員登録フォーム</h3>
    </div>

    <!--入力欄-->
    <form name='register' action='registUser.php' method='post'>
        <div id='register' class='box'>
            <?php if(!empty($_SESSION['error_mailForRegist'])){echo "<p class='error'>".$_SESSION['error_mailForRegist']."</p>";} ?>
            <p>メールアドレス　<input name='mail' type='text' value="<?php echo h($mail); ?>"></p>
        </div>
        <div class='box'>
            <?php if(!empty($_SESSION['error_passwordForRegist'])){echo "<p class='error'>".$_SESSION['error_passwordForRegist']."</p>";} ?>
            <p>パスワード　　　<input type='password' name='password' value="<?php echo h($password); ?>"></p>
        </div>
        <div class='box'>
            <?php if(!empty($_SESSION['error_nameForRegist'])){echo "<p class='error'>".$_SESSION['error_nameForRegist']."</p>";} ?>
            <p>会員名　　　　　<input name='name' type='text' value="<?php echo h($name); ?>"></p>
        </div>
        <div class='dropList'>
            <!--「学習言語」の後に３文字分空白がある -->
            <p>学習言語　　　　 
                <select name='language'>
                    <option value='PHP'>PHP</option>
                    <option value='Java'>Java</option>
                    <option value='JavaScript'>JavaScript</option>
                    <option value='Python'>Python</option>
                    <option value='C'>C</option>
                    <option value='C++'>C++</option>
                    <option value='C#'>C#</option>
                    <option value='その他言語'>その他言語</option>
                </select>
            </p>
        </div>
        <div class='dropList'>
            <!--「習熟度」の後に４文字分空白がある -->
            <p>習熟度　　　　　 
                <select name='proficiancy'>
                    <option value='初級者'>初級者</option>
                    <option value='中級者'>中級者</option>
                    <option value='上級者'>上級者</option>
                </select>
            </p>
        </div>
        <div class='buttonToCenter'><button type='submit' onclick="return registCheck()">登録</button></div>
    </form>
    <div id='link' class='linkToCenter'><a href='loginForm.php'>ログインフォームに戻る</a></div>
</div>
</body>