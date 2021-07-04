<?php
session_start();
if($_SESSION['login'] != session_id()){
    header('Location: ../../../login/loginForm.php');
}

//チーム情報取得
require_once(ROOT_PATH .'Controllers/teamController.php');
$getTeamInformation = new teamController();
$teamInformation = $getTeamInformation->getTeamInformation($_SESSION['loginTeamNo']);
$information = $teamInformation['team'];

require_once('urlForOperation.php');

//会員設定用に設定内容を取得
$name = isset($_SESSION['nameForSet']) ? $_SESSION['nameForSet'] : $_SESSION['loginName'];
$proficiancy = isset($_SESSION['proficiancyForSet']) ? $_SESSION['proficiancyForSet'] : $_SESSION['loginProficiancy'];
$language = isset($_SESSION['languageForSet']) ? $_SESSION['languageForSet'] : $_SESSION['loginLanguage'];

$_SESSION['nameForSet'] = NULL;
$_SESSION['proficiancyForSet'] = NULL;
$_SESSION['languageForSet'] = NULL;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>会員名・学習言語・習熟度設定 - 日々鍛</title>
    <link rel="stylesheet" type="text/css" href="/css/base.css">
    <script type="text/javascript" src="/js/setCheck.js"></script>
</head>
<body>
    <div class='frame'>
        <!--タイトル-->
        <div class='titleArea'>
            <?php include(ROOT_PATH .'Views/afterLogin/titleTop.php'); ?>
            <div class='titleBottom'>
                <h3 class='title'>会員名・学習言語・習熟度設定</h3>
            </div>
        </div>
        <?php include(ROOT_PATH .'Views/afterLogin/header.php'); ?>

        <form action='doSettingUser.php' method='post'>
            <?php if($_SESSION['loginTeamNo'] != NULL){
                if($information['proficiancy'] != '問わない'){?>
                <div class='settingCondition'>
                    <p>学習言語はチーム未所属時のみ変更できます。</p>
                    <p>習熟度はチーム未所属時または</p>
                    <p>習熟度のチーム加入条件が「問わない」の場合変更できます。</p>
                </div>
            <?php }else{ ?>
                <div class='settingCondition'>
                    <p>学習言語はチーム未所属時のみ変更できます。</p>
                </div>
            <?php }} ?>
            <div class='box'>
            <?php if(!empty($_SESSION['error_name'])){echo "<p class='error'>".$_SESSION['error_name']."</p>";$_SESSION['error_name']=NULL;} ?>
                <p>会員名　<input name='name' value=<?=$name ?>></p>
            </div>
            <?php if($_SESSION['loginTeamNo'] == NULL){ ?>
                <div class='dropList'>
                    <p>学習言語
                        <select name='language'>
                            <option value='PHP' <?php if($language == 'PHP'){echo 'selected';} ?>>PHP</option>
                            <option value='Java' <?php if($language == 'Java'){echo 'selected';} ?>>Java</option>
                            <option value='JavaScript' <?php if($language == 'JavaScript'){echo 'selected';} ?>>JavaScript</option>
                            <option value='Python' <?php if($language == 'Python'){echo 'selected';} ?>>Python</option>
                            <option value='C' <?php if($language == 'C'){echo 'selected';} ?>>C</option>
                            <option value='C++' <?php if($language == 'C++'){echo 'selected';} ?>>C++</option>
                            <option value='C#' <?php if($language == 'C#'){echo 'selected';} ?>>C#</option>
                            <option value='その他言語' <?php if($language == 'その他言語'){echo 'selected';} ?>>その他言語</option>
                        </select>
                    </p>
                </div>
            <?php } ?>
            <?php if($_SESSION['loginTeamNo'] == NULL OR $information['proficiancy'] == '問わない'){ ?>
            <div class='dropList'>
                <!--「習熟度」の後に1文字分空白がある -->
                <p>習熟度　
                    <select name='proficiancy'>
                        <option value='初級者' <?php if($proficiancy == '初級者'){echo 'selected';} ?>>初級者</option>
                        <option value='中級者' <?php if($proficiancy == '中級者'){echo 'selected';} ?>>中級者</option>
                        <option value='上級者' <?php if($proficiancy == '上級者'){echo 'selected';} ?>>上級者</option>
                    </select>
                </p>
            </div>
            <?php } ?>
            <div class='buttonToCenter'><button onclick='return setCheck()'>設定変更を実行する</button></div>
        </form>
    </div>
</body>