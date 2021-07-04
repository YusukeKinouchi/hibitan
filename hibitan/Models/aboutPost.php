<?php
namespace App;
require_once(ROOT_PATH .'/Models/Db.php');

class toPost extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function delete($postId=0){
        $sql = 'DELETE FROM posts WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $postId ,PDO::PARAM_INT);
        $sth->execute();
    }

    function check_favolite_duplicate($userId,$postId){
        $sql = "SELECT * FROM favorite WHERE userId = :userId AND postId = :postId";
        $sth = $dbh->prepare($sql);
        $sth->bindParam(':postId', $postId, PDO::PARAM_INT);
        $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
        $sth->execute();
        $favorite = $sth->fetch();
        return $favorite;
    }
}
