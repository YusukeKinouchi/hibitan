<?php
Namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');

class getTeam extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'teams';

    //チーム取得
    public function getTeamsOfMyLanguage($language):Array{
        $sql = 'SELECT id,leader,teamName,language,proficiancy,about FROM '.$this->table;
        $sql .= ' WHERE language = :language';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':language', $language, \PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    //チーム取得（習熟度縛り）
    public function getTeamsOfMyLanguageWithProficiancy($language,$proficiancy):Array{
        $sql = 'SELECT id,leader,teamName,language,proficiancy,about FROM '.$this->table;
        $sql .= ' WHERE language = :language AND proficiancy = :proficiancy';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':language', $language, \PDO::PARAM_STR);
        $sth->bindParam(':proficiancy', $proficiancy, \PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    //チーム名取得
    public function getTeamNameForSearch($teamId):Array{
        $sql = 'SELECT teamName FROM '.$this->table;
        $sql .= ' WHERE id = :teamId';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamId', $teamId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    //チーム所属人数取得
    public function getCount($teamId){
        $sql = 'SELECT id FROM users';
        $sql .= ' WHERE teamNo = :teamNo';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamNo', $teamId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return count($result);
    }


    //チーム詳細情報取得
    public function getTeamInformations($teamId){
        $sql = 'SELECT * FROM '.$this->table;
        $sql .= ' WHERE id = :teamNo';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamNo', $teamId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    //チーム内ランキング取得
    public function getRanking($teamId){
        $sql = 'SELECT userId,sum(endTime-startTime) as time FROM posts ';
        $sql .= 'WHERE teamId = :teamId GROUP BY userId ORDER BY time DESC';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':teamId', $teamId, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }
}
?>