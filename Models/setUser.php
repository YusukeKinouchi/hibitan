<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH . '/Models/function.php');

class setUser extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    //会員設定変更
    public function set(){
        $error = array();
        if(isset($_SESSION['debugForSetUser'])){
            $_SESSION['error_name'] = NULL;
        }
        if(mb_strlen($_SESSION['nameForSet'])<1 OR 50<mb_strlen($_SESSION['nameForSet'])){
            $error['nameForSet'] = '会員名は1文字以上50字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_name'] = $error['nameForSet'];
            if(!isset($_SESSION['debugForSetUser'])){
                header('Location: ./settingUser.php');
                exit();
            }
        }

        $name = h($_SESSION['nameForSet']);
        $language = h($_SESSION['languageForSet']);
        $proficiancy = h($_SESSION['proficiancyForSet']);

        $sql ='UPDATE users SET name = :name, language = :language, proficiancy = :proficiancy WHERE id = :userId';
        $sth = $this->dbh->prepare($sql);
        $sth->bindValue(':name', $name, \PDO::PARAM_STR);
        $sth->bindValue(':language', $language, \PDO::PARAM_STR);
        $sth->bindValue(':proficiancy', $proficiancy, \PDO::PARAM_STR);
        $sth->bindValue(':userId', $_SESSION['loginId'], \PDO::PARAM_INT);
        $sth->execute();

        $_SESSION['settingUserToTeam'] = 1;
        $_SESSION['loginName'] = $_SESSION['nameForSet'];
        $_SESSION['loginLanguage'] = $_SESSION['languageForSet'];
        $_SESSION['loginProficiancy'] = $_SESSION['proficiancyForSet'];
        $_SESSION['nameForSet'] = NULL;
        $_SESSION['languageForSet'] = NULL;
        $_SESSION['proficiancyForSet'] = NULL;
    }
}?>