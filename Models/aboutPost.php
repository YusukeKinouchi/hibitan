<?php
namespace app\src;

if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
  }
require_once(ROOT_PATH .'/Models/Db.php');

class toPost extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function delete($postId){
        $sql = 'DELETE FROM posts WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $postId ,\PDO::PARAM_INT);
        $sth->execute();
        $_SESSION['deletePostId'] = NULL;
    }

    function check_favolite_duplicate($userId,$postId){
        $sql = 'SELECT * FROM favorites WHERE userId = :userId AND postId = :postId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':postId', $postId, \PDO::PARAM_INT);
        $sth->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $sth->execute();
        $favorite = $sth->fetch();
        return $favorite;
    }
}
