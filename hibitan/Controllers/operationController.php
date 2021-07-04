<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/setUser.php');
require_once(ROOT_PATH .'/Models/deleteUser.php');
require_once(ROOT_PATH .'/Models/setTeam.php');
require_once(ROOT_PATH .'/Models/withdrawalTeam.php');
require_once(ROOT_PATH .'/Models/deleteTeam.php');
require_once(ROOT_PATH .'/Models/Delegation.php');

class operationController{
    private $request;
    private $setUser;
    private $deleteUser;
    private $validateTeam;
    private $createTeam;
    private $withdrawalTeam;
    private $deleteTeam;
    private $getUser;
    private $delegate;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->setUser = new setUser();
        $dbh = $this->setUser->get_db_handler();

        $this->deleteUser = new deleteUser($dbh);
        $this->validateTeam = new setTeam();
        $this->createTeam = new setTeam();
        $this->withdrawalTeam = new withdrawalTeam($dbh);
        $this->deleteTeam = new deleteTeam($dbh);
        $this->getUser = new delegate($dbh);
        $this->delegate = new delegate();
    }

    //会員設定変更
    public function setUser(){
        $setUser = $this->setUser->set();
    }

    //会員登録削除
    public function deleteUser(){
        $deleteUser = $this->deleteUser->delete();
    }

    //チーム作成時のバリデーション
    public function validate(){
        $validateTeam = $this->validateTeam->validateTeam();
    }

    //チーム作成実行
    public function create(){
        $createTeam = $this->createTeam->createTeam();
        $params_teamId = [
            'teamId' => $createTeam
        ];
        return $params_teamId;
    }

    //チーム脱退
    public function withdrawal(){
        $withdrawalTeam = $this->withdrawalTeam->withdrawalTeam();
    }

    //チーム解散
    public function deleteTeam(){
        $deleteTeam = $this->deleteTeam->delete();
    }

    //チーム設定変更時のバリデーション
    public function validateAndSetTeam(){
        $validateTeam = $this->validateTeam->validateAndSet();
    }

    //リーダー権限委任用にチームメンバー取得
    public function getUser($teamId){
        $delegate = $this->getUser->getUser($teamId);
        $params_user = ['user' => $delegate];
        return $params_user;
    }

    //権限委任の実行
    public function delegate(){
        $delegateUser = $this->delegate->doDelegate();
    }
}