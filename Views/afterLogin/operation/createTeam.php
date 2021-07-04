<?php
namespace app\src;
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../login/loginForm.php');
}

if($_SESSION['loginTeamNo'] != NULL){
    header('Location: ../operation.php');
}
require_once('urlForOperation.php');

$name = isset($_SESSION['nameForCreateTeam']) ? $_SESSION['nameForCreateTeam'] : NULL;
$proficiancy = isset($_SESSION['proficiancyForCreateTeam']) ? $_SESSION['proficiancyForCreateTeam'] : $_SESSION['loginProficiancy'];
$language = isset($_SESSION['languageForCreateTeam']) ? $_SESSION['languageForCreateTeam'] : $_SESSION['loginLanguage'];
$about = isset($_SESSION['aboutForCreateTeam']) ? $_SESSION['aboutForCreateTeam'] : NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>チーム作成 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/createTeamCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'/Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>チーム作成</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'/Views/afterLogin/header.php'); ?>

        <div>
            <div class='settingCondition'  style="margin-bottom:30px;">
                <p>学習言語は自身の学習言語に設定されます。</p>
            </div>
            <form action='doCreateTeam.php' method='post'>
                <div id='register' class='box'>
                    <?php if(!empty($_SESSION['error_nameForCreateTeam'])){echo "<p class='error'>".$_SESSION['error_nameForCreateTeam']."</p>";} ?>
                    <p>　チーム名　<input name = 'name' value=<?=$name ?>></p>
                </div>
                <div class='box dropList'>
                    <!--「習熟度」の後に１文字分空白がある -->
                    <p>　習熟度　　
                        <select name=”proficiancy”>
                            <?php if($_SESSION['loginProficiancy'] == '初級者'){?>
                            <option value='初級者' <?php if($proficiancy == '初級者'){echo 'selected';} ?>>初級者</option>
                            <?php } ?>
                            <?php if($_SESSION['loginProficiancy'] == '中級者'){?>
                            <option value='中級者' <?php if($proficiancy == '中級者'){echo 'selected';} ?>>中級者</option>
                            <?php } ?>
                            <?php if($_SESSION['loginProficiancy'] == '上級者'){?>
                            <option value='上級者' <?php if($proficiancy == '上級者'){echo 'selected';} ?>>上級者</option>
                            <?php } ?>
                            <option value='問わない' <?php if($proficiancy == '問わない'){echo 'selected';} ?>>問わない</option>
                        </select>
                    </p>
                </div>
                <div class='box'>
                    <?php if(!empty($_SESSION['error_aboutForCreateTeam'])){echo "<p class='error'>".$_SESSION['error_aboutForCreateTeam']."</p>";} ?>
                    <p>チーム概要　<textarea name='about' cols='20'><?=$about ?></textarea></p>
                </div>
                <div class='buttonToCenter'><button onclick='return createTeamCheck()' type='submit'>チーム作成</button></div>
            </form>
        </div>
    </div>
</body>