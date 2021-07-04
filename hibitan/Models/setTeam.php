<?php
require_once(ROOT_PATH . '/Models/function.php');

class setTeam extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function validateTeam(){
        $error = array();
        $name = $_SESSION['nameForCreateTeam'];
        $about = $_SESSION['aboutForCreateTeam'];

        $_SESSION['error_nameForCreateTeam'] = NULL;
        $_SESSION['error_aboutForCreateTeam'] = NULL;

        //チーム名のバリデーション
        if(mb_strlen($name)<1 OR 50<mb_strlen($name)){
            $error['name'] = 'チーム名は1文字以上50字以内で入力してください。';
        }

        //チーム概要のバリデーション
        if(mb_strlen($about)<1 OR 500<mb_strlen($about)){
            $error['about'] = 'チーム概要は1文字以上500字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_nameForCreateTeam'] = $error['name'];
            $_SESSION['error_aboutForCreateTeam'] = $error['about'];
            header('Location: ./createTeam.php');
            exit();
        }
    }

    public function createTeam():Array{
        $createName = h($_SESSION['nameForCreateTeam']);
        $createProficiancy = h($_SESSION['proficiancyForCreateTeam']);
        $createAbout = h($_SESSION['aboutForCreateTeam']);

        $sqlForteams ='INSERT INTO teams (leader,teamName,language,proficiancy,about) VALUES (:leader,:teamName,:language,:proficiancy,:about)';
        $sthForteams = $this->dbh->prepare($sqlForteams);
        $sthForteams->bindValue(':leader', $_SESSION['loginId'], PDO::PARAM_INT);
        $sthForteams->bindValue(':teamName', $createName, PDO::PARAM_STR);
        $sthForteams->bindValue(':language',  $_SESSION['loginLanguage'], PDO::PARAM_STR);
        $sthForteams->bindValue(':proficiancy',$createProficiancy, PDO::PARAM_STR);
        $sthForteams->bindValue(':about',$createAbout , PDO::PARAM_STR);
        $sthForteams->execute();

        $sqlForGetTeamId = 'SELECT id FROM teams WHERE leader = :leader';
        $sthForGetTeamId = $this->dbh->prepare($sqlForGetTeamId);
        $sthForGetTeamId->bindValue(':leader', $_SESSION['loginId'], PDO::PARAM_INT);
        $sthForGetTeamId->execute();

        $teamId = $sthForGetTeamId->fetch(PDO::FETCH_ASSOC);

        $sqlForusers ='UPDATE users SET teamNo = :teamId,teamLeader = 1 WHERE id = '.$_SESSION['loginId'];
        $sthForusers = $this->dbh->prepare($sqlForusers);
        $sthForusers->bindValue(':teamId', $teamId['id'], PDO::PARAM_INT);
        $sthForusers->execute();

        return $teamId;
    }

    public function validateAndSet(){
        $error = array();
        $name = $_SESSION['nameForSetTeam'];
        $about = $_SESSION['aboutForSetTeam'];

        $_SESSION['error_nameForSetTeam'] = NULL;
        $_SESSION['error_aboutForSetTeam'] = NULL;

        //チーム名のバリデーション
        if(mb_strlen($name)<1 OR 50<mb_strlen($name)){
            $error['name'] = 'チーム名は1文字以上50字以内で入力してください。';
        }

        //チーム概要のバリデーション
        if(mb_strlen($about)<1 OR 500<mb_strlen($about)){
            $error['about'] = 'チーム概要は1文字以上500字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_nameForSetTeam'] = $error['name'];
            $_SESSION['error_aboutForSetTeam'] = $error['about'];
            header('Location: ./settingTeam.php?teamIdForOperation='.$_SESSION['loginTeamNo']);
            exit();
        }

        $name = h($name);
        $about = h($about);

        $sql ='UPDATE teams SET teamName = :name, proficiancy = :proficiancy, about = :about WHERE id = :teamId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':name', $name, PDO::PARAM_STR);
        $sth->bindValue(':proficiancy', $_SESSION['proficiancyForSetTeam'], PDO::PARAM_STR);
        $sth->bindValue(':about', $about, PDO::PARAM_STR);
        $sth->bindValue(':teamId', $_SESSION['loginTeamNo'], PDO::PARAM_INT);
        $sth->execute();
    }
}
?>