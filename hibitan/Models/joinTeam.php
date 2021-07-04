<?php
require_once(ROOT_PATH .'/Models/Db.php');

class joinTeamByClick extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'users';

    public function join($teamId){
        $sql = 'UPDATE users SET teamNo = :teamNo WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':userId', $_SESSION['loginId'], PDO::PARAM_INT);
        $sth->bindValue(':teamNo', $teamId, PDO::PARAM_INT);
        $sth->execute();
        $_SESSION['loginTeamNo'] = $teamId;
        $_SESSION['afterJoinTeam'] = 1;
        header("Location: ./team.php?teamId=$teamId");
        exit;
    }
}
?>