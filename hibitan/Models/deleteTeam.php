<?php
require_once(ROOT_PATH .'/Models/Db.php');

class deleteTeam extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function delete(){
        //チームの削除
        $sql = 'DELETE FROM teams WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $_SESSION['loginTeamNo'] ,PDO::PARAM_INT);
        $sth->execute();

        //usersテーブルのチーム関連情報の削除（NULL）※所属会員全員に実行
        $sql = 'UPDATE users SET teamNo = NULL, teamLeader = NULL WHERE teamNo = :teamId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':teamId', $_SESSION['loginTeamNo'] ,PDO::PARAM_INT);
        $sth->execute();

        //session上のログイン時のチーム情報を削除
        $_SESSION['loginTeamNo'] = NULL;
        $_SESSION['loginTeamLeader'] = NULL;
        
        $_SESSION['deleteTeamToMyteam'] = 1;
    }
}
?>