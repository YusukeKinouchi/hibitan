<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Controllers', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/Regist.php');
require_once(ROOT_PATH .'/Models/Validate.php');
require_once(ROOT_PATH .'/Models/Reset.php');

class loginController{
    private $request;
    private $Regist;
    private $Validate;
    private $Login;
    private $Reset;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->Regist = new Regist();
        $this->Validate = new Validate();
        $this->Reset = new Reset();

        $dbh = $this->Regist->get_db_handler();
    }

    //会員登録のバリデーション
    public function validate(){
        $validate = $this->Validate->validateRegister();
    }

    //会員登録
    public function regist(){
        $regist = $this->Regist->registUser();
        //ポップアップ表示用
        $_SESSION['registerTologinForm'] = 1;
    }

    //ログイン
    public function validateLogin(){
        $login = $this->Validate->loginCheck();
    }

    //パスワードリセット用のメール送信
    public function sendMail(){
        $passwordReset = $this->Reset->passwordReset();
    }

    //パスワードリセットのバリデーション・実行
    public function doValidateAndResetPassword(){
        $validateAndReset = $this->Reset->validateAndResetPassword();
    }
}

?>