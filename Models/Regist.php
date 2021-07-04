<?php
namespace app\src;

if(!defined('ROOT_PATH')){
  define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH . '/Models/Db.php');
require_once(ROOT_PATH . '/Models/function.php');

class Regist extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function registUser(){
        $registMail = h($_SESSION['mailForRegist']);
        $registPassword = password_hash($_SESSION['passwordForRegist'],PASSWORD_DEFAULT);
        $registName = h($_SESSION['nameForRegist']);
        $registLanguage = h($_SESSION['languageForRegist']);
        $registProficiancy = h($_SESSION['proficiancyForRegist']);

        $sql ='INSERT INTO users (mail,password,name,language,proficiancy) VALUES (:mail,:password,:name,:language,:proficiancy)';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':mail', $registMail, \PDO::PARAM_STR);
        $sth->bindValue(':password', $registPassword, \PDO::PARAM_STR);
        $sth->bindValue(':name', $registName, \PDO::PARAM_STR);
        $sth->bindValue(':language', $registLanguage, \PDO::PARAM_STR);
        $sth->bindValue(':proficiancy', $registProficiancy, \PDO::PARAM_STR);
        $sth->execute();

        //debug
        if(isset($_SESSION['debugForRegist'])){
            $_SESSION['testPassword'] = $registPassword;
        }
    }
}

?>
