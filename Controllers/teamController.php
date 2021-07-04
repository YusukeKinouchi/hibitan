<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Controllers', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/getPost.php');
require_once(ROOT_PATH .'/Models/getTeam.php');
require_once(ROOT_PATH .'/Models/joinTeam.php');

class teamController{
    private $request;
    private $getPostForMyteam;
    private $getTeam;
    private $getTeamName;
    private $getTeamUserCount;
    private $joinTeamByClick;
    private $getTeamInformation;
    private $getRankingInTeam;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->GetPostForMyteam = new getPost();

        $dbh = $this->GetPostForMyteam->get_db_handler();
        $this->getTeam = new getTeam($dbh);
        $this->getTeamName = new getTeam($dbh);
        $this->getTeamUserCount = new getTeam($dbh);
        $this->joinTeamByClick = new joinTeamByClick($dbh);
        $this->getTeamInformation = new getTeam($dbh);
        $this->getRankingInTeam = new getTeam($dbh);
    }

    //myteamの投稿を取得
    public function getPosts($teamId){
        $forMyteam = $this->GetPostForMyteam->getPost($teamId);
        $params_post = [
           'posts' => $forMyteam
        ];
        return $params_post;
    }

    public function getUser($userId){
        $user = $this->GetPostForMyteam->getUserOfPost($userId);
        $params_user = [
            'user' => $user
        ];
        return $params_user;
    }

    public function getTeams(){
        $teams = $this->getTeam->getTeamsOfMyLanguage($_SESSION['loginLanguage']);
        $params_teams =[
            'team' => $teams
        ];
        return $params_teams;
    }

    public function getTeamsWithProficiancy($proficiancy){
        $teams = $this->getTeam->getTeamsOfMyLanguageWithProficiancy($_SESSION['loginLanguage'],$proficiancy);
        $params_teams =[
            'team' => $teams
        ];
        return $params_teams;
    }

    public function getTeamName($teamId){
        $teamName = $this->getTeamName->getTeamNameForSearch($teamId);
        $param_teamName = [
            'team' => $teamName
        ];
        return $param_teamName;
    }

    public function getUserCount($teamId){
        $userCount = $this->getTeamUserCount->getCount($teamId);
        return $userCount;
    }

    public function joinTeam($teamId){
        $joinTeam = $this->joinTeamByClick->join($teamId);
    }

    public function getTeamInformation($teamId){
        $teamInformations = $this->getTeamInformation->getTeamInformations($teamId);
        $params_teamInformation = [
            'team' => $teamInformations
        ];
        return $params_teamInformation;
    }

    public function getRanking($teamId){
        $rankingInTeam = $this->getRankingInTeam->getRanking($teamId);
        $params_ranking = [
            'ranking' =>$rankingInTeam
        ];
        return $params_ranking;
    }
}
?>