<?php
require_once(ROOT_PATH .'/Models/Db.php');

class deleteUser extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function delete(){
        $sql = 'DELETE FROM users WHERE id = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $_SESSION['loginId'] ,PDO::PARAM_INT);
        $sth->execute();

        $sql = 'DELETE FROM posts WHERE userId = :id';
        $sth = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $_SESSION['loginId'] ,PDO::PARAM_INT);
        $sth->execute();
        
        $_SESSION = array();
        $_SESSION['deleteUserTologinForm'] = 1;
    }
}
?>