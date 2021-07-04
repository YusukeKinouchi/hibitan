<?php
//titleTop用のURL
$postUrl = './post.php';
$operationUrl = './operation.php';
$logoutUrl ='./doLogout.php';

//ヘッダー用のURL取得
$mypageUrl = './page/page.php?userId='.$_SESSION['loginId'];
if($_SESSION['loginTeamNo'] !=NULL){
    $myteamUrl = './team/team.php?teamId='.$_SESSION['loginTeamNo'];
}else{
    $myteamUrl = './team/NOTbelongingToTeam/myteam.php';
}
$searchTeamUrl = './team/searchTeam.php';

?>