<?php
//titleTop用のURL
$postUrl = '../post.php';
$operationUrl = '../operation.php';
if(isset($_GET['teamId'])){
    $teamInformationUrl = './teamInformation.php?teamId='.$_GET['teamId'];
}
$logoutUrl ='../doLogout.php';

//ヘッダー用のURL取得
$mypageUrl = '../page/page.php?userId='.$_SESSION['loginId'];
if($_SESSION['loginTeamNo'] !=NULL){
    $myteamUrl = './team.php?teamId='.$_SESSION['loginTeamNo'];
}else{
    $myteamUrl = './NOTbelongingToTeam/myteam.php';
}
$searchTeamUrl = './searchTeam.php';

?>