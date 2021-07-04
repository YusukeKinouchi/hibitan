<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
  }
require_once(ROOT_PATH .'/Models/Db.php');
class checkFavorite extends Db{
    function countFavorite($postId){
        $sql = "SELECT * FROM favorites WHERE postId = :postId";
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':postId', $postId, \PDO::PARAM_INT);
        $sth->execute();
        $favorite = $sth->fetchAll();
        return count($favorite);
    }
}    
?>