<?php
Namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Models', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');

class forEdit extends Db{
    public function __construct($dbh = null){
        parent::__construct($dbh);
    }

    private $table = 'posts';

    //投稿内容を取得
    public function getPost($id=0):Array{
        $sql = 'SELECT id, userId,startTime, endTime, material, learningContent FROM '.$this->table;
        $sql .= ' WHERE id = :id';
        $sth  = $this->dbh->prepare($sql);
        $sth->bindParam(':id', $id, \PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(\PDO::FETCH_ASSOC);
        return $result;
    }

    //編集を実行
    public function editAndMove(){
        $error = array();
        $startDate = h($_SESSION['startDate']);
        $startHour = h($_SESSION['startHour']);
        $startMinute = h($_SESSION['startMinute']);
        $endDate = h($_SESSION['endDate']);
        $endHour = h($_SESSION['endHour']);
        $endMinute = h($_SESSION['endMinute']);
        $material = h($_SESSION['material']);
        $learningContent = h($_SESSION['learningContent']);
        $startTime = $startDate.' '.$startHour.':'.$startMinute.':00';
        $endTime = $endDate.' '.$endHour.':'.$endMinute.':00';

        $_SESSION['error_time'] = NULL;
        $_SESSION['error_material'] = NULL;
        $_SESSION['error_learningContent'] = NULL;
        if(isset($_SESSION['debugForforEdit'])){
            $error['time'] = NULL;
            $error['material'] = NULL;
            $error['learningContent'] = NULL;
        }

        //学習時間のバリデーション
        if(strtotime($startTime) > strtotime($endTime)){
            $error['time'] = '勉強開始時間は勉強終了時間より前の時間を入力してください。';
        }
        if(empty($startDate) OR empty($endDate)){
            $error['time'] = '年月日は必須項目です。';
        }

        //教材のバリデーション
        if(mb_strlen($_SESSION['material'])<1 OR 50<mb_strlen($_SESSION['material'])){
            $error['material'] = '教材は1文字以上50字以内で入力してください。';
        }

        //学習内容のバリデーション
        if(mb_strlen($_SESSION['learningContent'])<1 OR 500<mb_strlen($_SESSION['learningContent'])){
            $error['learningContent'] = '学習内容は1文字以上500字以内で入力してください。';
        }

        if(count($error) >0){
            $_SESSION['error_time'] = $error['time'];
            $_SESSION['error_material'] = $error['material'];
            $_SESSION['error_learningContent'] = $error['learningContent'];
            if(!isset($_SESSION['debugForforEdit'])){
                header('Location: ./edit.php?id='.$_SESSION['postIdForEdit']);
                exit();
            }
        }

        if($error['time'] == NULL AND $error['material'] == NULL AND $error['learningContent'] == NULL){
            $sql ='UPDATE posts SET startTime = :startTime, endTime = :endTime, material = :material, learningContent = :learningContent WHERE id = :postId';
            $sth = $this->dbh->prepare($sql);
            $sth->bindValue(':startTime', $startTime, \PDO::PARAM_STR);
            $sth->bindValue(':endTime', $endTime, \PDO::PARAM_STR);
            $sth->bindValue(':material', $material, \PDO::PARAM_STR);
            $sth->bindValue(':learningContent', $learningContent, \PDO::PARAM_STR);
            $sth->bindValue(':postId', $_SESSION['postIdForEdit'], \PDO::PARAM_INT);
            $sth->execute();
        }

        $_SESSION['editToTeam'] = 1;
        $_SESSION['editPostId'] = NULL;
        $_SESSION['startDate'] = NULL;
        $_SESSION['startHour'] = NULL;
        $_SESSION['startMinute'] = NULL;
        $_SESSION['endDate'] = NULL;
        $_SESSION['endHour'] = NULL;
        $_SESSION['endMinute'] = NULL;
        $_SESSION['material'] = NULL;
        $_SESSION['learningContent'] = NULL;
    }

}
?>
