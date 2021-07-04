<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH . '/Models/function.php');

class withdrawalTeam extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    //会員設定変更
    public function withdrawalTeam(){

        $sql ='UPDATE users SET teamNo = NULL WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['loginId'], PDO::PARAM_INT);
        $sth->execute();

        $sqlForPosts ='UPDATE posts SET teamNo = NULL WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['loginId'], PDO::PARAM_INT);
        $sth->execute();

        $_SESSION['loginTeamNo'] = NULL;
        $_SESSION['teamWithdrawalToMyteam'] = 1;
    }
}?>