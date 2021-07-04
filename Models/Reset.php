<?php
namespace app\src;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH . '/Models/function.php');
require_once(ROOT_PATH . '/Models/Db.php');

class Reset extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    public function passwordReset(){
        $error = array();
        $_SESSION['error_reset'] = NULL;
        $mail = $_SESSION['mailForReset'];
        try{
            $sqlForReset = 'select * from users where mail = :mail';
            $resetPassword= $this->dbh->prepare($sqlForReset);
            $resetPassword->bindValue(':mail', $mail, \PDO::PARAM_STR);
            $resetPassword->execute();
            $resetRow = $resetPassword->fetch();
        }catch(\Exception $e){
            echo $e->getMessage() . PHP_EOL;
        }
        //mailがDB内に存在しているか確認
        if(!isset($resetRow['mail'])){
            $error['reset'] = 'メールアドレスが間違っています。';
            $_SESSION['error_reset'] = $error['reset'];
            if($_SESSION['debugForReset'] != 1){
                header('Location: ./passwordReset.php');
                exit();
            }
        }else{
            require_once(ROOT_PATH.'Models/PHPMailer/src/Exception.php');
            require_once(ROOT_PATH.'Models/PHPMailer/src/PHPMailer.php');
            require_once(ROOT_PATH.'Models/PHPMailer/src/SMTP.php');
            $mail = new PHPMailer(true);

            try {
            //Gmail 認証情報
            $host = 'smtp.gmail.com';
            $username = 'KinouchiYusuke3980@gmail.com'; // example@gmail.com
            $password = 'qmbvngoktjqlkbto';

            //差出人
            $from = 'KinouchiYusuke3980@gmail.com';
            $fromname = '日々鍛';

            //宛先
            $to = $resetRow['mail'];
            $toname = $resetRow['name'];

            //件名・本文
            $subject = '日々鍛　パスワード再設定のご案内';
            session_regenerate_id(true);
            $body = $resetRow['name']."様\nこの度は「日々鍛」をご利用いただきまして、誠にありがとうございます。\nお客様のパスワード再設定用のURLをお送りしますので、下記URLよりパスワードの再設定をお願いいたします。\n";
            $body .= 'http://localhost/login/PasswordSet.php?resetId='.session_id();
            $body .= "\n※上記リンクは1時間だけ有効です。";
            $body = wordwrap($body, 70, "\n");

            //メール設定
            $mail->SMTPDebug = 2; //デバッグ用
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->Host = $host;
            $mail->Username = $username;
            $mail->Password = $password;
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->CharSet = "utf-8";
            $mail->Encoding = "base64";
            $mail->setFrom($from, $fromname);
            $mail->addAddress($to, $toname);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            //メール送信
            $mail->send();
            $_SESSION['mailForReset'] = $to;
            } catch (Exception $e) {
                $mail->ErrorInfo;
            }
            $_SESSION['mailForReset'] = $resetRow['mail'];
            if($_SESSION['debugForReset'] != 1){
                header('Location: ./sendComplete.php');
            }
        }
    }

    public function validateAndResetPassword(){
        $error = array();
        $password = $_SESSION['passwordReset'];

        //パスワードのバリデーション
        $patternPassword = '/\A[a-z\d]{8,16}+\z/i';
        if(!preg_match($patternPassword, $password)){
            $error['password'] = 'パスワードは半角英数字で8文字以上16字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_passwordReset'] = $error['password'];
            if(!isset($_SESSION['debugForReset'])){
                header('Location: ./passwordSet.php?resetId='.session_id());
                exit();
            }
        }else{
            $password = password_hash($password,PASSWORD_DEFAULT);
            $mail = $_SESSION['mailForReset'];
            $sql = 'UPDATE users SET password = :password WHERE mail = :mail';
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':mail', $mail, \PDO::PARAM_STR);
            $sth->bindValue(':password', $password, \PDO::PARAM_STR);
            $sth->execute();
            $error['password'] = NULL;
            $_SESSION['passwordSetTologinForm'] = 1;
            $_SESSION['mailForReset'] = NULL;
            if(!isset($_SESSION['debugForReset'])){
                session_regenerate_id();
                header('Location: ./loginForm.php');
            }else{
                $_SESSION['testPassword'] = $password;
            }
        }
    }
}