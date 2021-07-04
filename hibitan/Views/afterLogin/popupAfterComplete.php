<?php if(isset($_SESSION['postToTeam'])){
        if($_SESSION['postToTeam'] == 1){
        echo '<script type="text/javascript">alert("投稿が完了しました。");</script>';
        $_SESSION['postToTeam'] = NULL;
    }}?>

<?php if(isset($_SESSION['editToTeam'])){
        if($_SESSION['editToTeam'] == 1){
        echo '<script type="text/javascript">alert("編集が完了しました。");</script>';
        $_SESSION['editToTeam'] = NULL;
    }}?>

<?php if(isset($_SESSION['settingUserToTeam'])){
        if($_SESSION['settingUserToTeam'] == 1){
        echo '<script type="text/javascript">alert("設定変更が完了しました。");</script>';
        $_SESSION['settingUserToTeam'] = NULL;
    }}?>