<?php
Namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');

class getPost extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'posts';

    //投稿をチームごとに取得
    public function getPost($teamId):Array{
        $sql = 'SELECT id, userId,startTime, endTime, material, learningContent FROM '.$this->table;
        $sql .= ' WHERE teamId = :teamId ORDER BY id DESC';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamId', $teamId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserOfPost($userId){
        $sql = 'SELECT name,teamLeader FROM users WHERE id = :userId';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }
}
?>