<?php
require_once(ROOT_PATH .'/Models/Db.php');

class delegate extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'teams';

    public function getUser($teamId){
        $sql = 'SELECT name,id FROM users';
        $sql .= ' WHERE teamNo = :teamNo';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamNo', $teamId, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function doDelegate(){
        //teamsテーブルの処理
        $sql ='UPDATE teams SET leader = :userId WHERE id = :teamId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['userIdForDelegate'], PDO::PARAM_INT);
        $sth->bindValue(':teamId', $_SESSION['loginTeamNo'], PDO::PARAM_INT);
        $sth->execute();

        //usersテーブルの処理
        $sql ='UPDATE users SET teamLeader = NULL WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['loginId'], PDO::PARAM_INT);
        $sth->execute();
        $_SESSION['loginTeamLeader'] = NULL;

        $sql ='UPDATE users SET teamLeader = 1 WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['userIdForDelegate'], PDO::PARAM_INT);
        $sth->execute();
    }
}