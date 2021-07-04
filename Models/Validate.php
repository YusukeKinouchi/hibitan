<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}

require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH . '/Models/function.php');

class Validate extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function validateRegister(){
        $error = array();
        $mail = h($_SESSION['mailForRegist']);
        $password = h($_SESSION['passwordForRegist']);
        $name = h($_SESSION['nameForRegist']);

        if(isset($_SESSION['debugForLogin'])){
            $error['mail'] = NULL;
            $error['password'] = NULL;
            $error['name'] = NULL;
        }
        $_SESSION['error_mailForRegist'] = NULL;
        $_SESSION['error_passwordForRegist'] = NULL;
        $_SESSION['error_nameForRegist'] = NULL;

        //メールアドレスのバリデーション
        $patternMail = "/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
        
        $sqlForGettingMail = 'SELECT * FROM users WHERE mail = :mail';
        $searchMail = $this->dbh->prepare($sqlForGettingMail);
        $searchMail->bindValue(':mail', $mail, \PDO::PARAM_STR);
        $searchMail->execute();
        $existingMail = $searchMail->fetch();

        if($mail == NULL or !preg_match($patternMail, $mail)){
            $error['mail'] = 'メールアドレスはxxx@xxxの型で入力してください。';
        }elseif(100<mb_strlen($mail)){
            $error['mail'] = 'メールアドレスは100字以内で入力してください。';
        }elseif($existingMail != 0){
            $error['mail'] = 'このメールアドレスはすでに使用されています。';
        }

        //パスワードのバリデーション
        $patternPassword = '/\A[a-z\d]{8,16}+\z/i';
        if(!preg_match($patternPassword, $password)){
            $error['password'] = 'パスワードは半角英数字で8文字以上16字以内で入力してください。';
        }

        //会員名のバリデーション
        if(mb_strlen($name)<1 OR 50<mb_strlen($name)){
            $error['name'] = '会員名は1文字以上50字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_mailForRegist'] = $error['mail'];
            $_SESSION['error_passwordForRegist'] = $error['password'];
            $_SESSION['error_nameForRegist'] = $error['name'];
            if(!isset($_SESSION['debugForLogin'])){
            header('Location: ./register.php');
            exit();
            }
        }
    }

    public function loginCheck(){
        //ログインのバリデーション
        $error = array();

        try{
            $_SESSION['error_login'] == NULL;
            $mail = h($_SESSION['loginMail']);
            $password = h($_SESSION['loginPassword']);
            $sqlForLoginMail = 'select * from users where mail = :mail';
            $loginMail= $this->dbh->prepare($sqlForLoginMail);
            $loginMail->bindValue(':mail', $mail, \PDO::PARAM_STR);
            $loginMail->execute();
            $loginMailRow = $loginMail->fetch();
        }catch(\Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
        //mailがDB内に存在しているか確認
        if(!isset($loginMailRow['mail'])){
            $error['login'] = 'メールアドレス又はパスワードが間違っています。';
            $_SESSION['error_login'] = $error['login'];
            if(!isset($_SESSION['debugForLogin'])){
                header('Location: ./loginForm.php');
                exit();
            }
        }
        if($_SESSION['error_login'] == NULL){
            //パスワード確認後sessionにメールアドレスを渡す
            if(password_verify($password, $loginMailRow['password'])){
                $_SESSION['error_login'] = NULL;
                session_regenerate_id(true); //session_idを新しく生成し、置き換える
                $_SESSION['login'] = session_id();
                $_SESSION['loginId'] = $loginMailRow['id'];
                $_SESSION['loginName'] = $loginMailRow['name'];
                $_SESSION['loginLanguage'] = $loginMailRow['language'];
                $_SESSION['loginProficiancy'] = $loginMailRow['proficiancy'];
                $_SESSION['loginTeamNo'] = $loginMailRow['teamNo'];
                $_SESSION['loginTeamLeader'] = $loginMailRow['teamLeader'];
            }else{
                $error['login'] = 'メールアドレス又はパスワードが間違っています。';
                $_SESSION['error_login'] = $error['login'];
                if(!isset($_SESSION['debugForLogin'])){
                    header('Location: ./loginForm.php');
                    exit();
                }
            }
        }

        if($_SESSION['error_login'] == NULL){
            $_SESSION['loginMail'] = NULL;
            $_SESSION['loginPassword'] = NULL;
            //ログイン処理
            if($_SESSION['loginTeamNo'] == NULL){
                if(isset($_SESSION['debugForLogin'])){
                    $_SESSION['debugAccount'] = 'noteam';
                }
                header('Location: ../afterLogin/team/NotbelongingToTeam/myteam.php');
            }else{
                if(isset($_SESSION['debugForLogin'])){
                    $_SESSION['debugAccount'] = 'team';
                }
                header('Location: ../afterLogin/team/team.php?teamId='.$_SESSION['loginTeamNo']);
            }
        }
    }

}
?>