<?php
require_once(ROOT_PATH .'/Models/Db.php');

class getPostForPage extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'posts';

    //投稿を取得
    public function getPost($userId):Array{
        $sql = 'SELECT id, userId,startTime, endTime, material, learningContent FROM '.$this->table;
        $sql .= ' WHERE userId = :userId ORDER BY id DESC';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':userId',$userId , PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserOfPost($userId){
        $sql = 'SELECT name FROM users WHERE id = :userId';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>