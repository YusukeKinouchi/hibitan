<?php
// postがある場合
if(isset($_POST['postId'])){
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];

    try{
      $dsn='mysql:dbname=hibitan;host=localhost;charset=utf8';
      $user='root';
      $password='root';
      $dbh=new PDO($dsn,$user,$password);
      $sqlForAjax = "SELECT * FROM favorites WHERE userId = :userId AND postId = :postId";
      $sthForAjax = $dbh->prepare($sqlForAjax);
      $sthForAjax->bindParam(':userId', $userId, PDO::PARAM_INT);
      $sthForAjax->bindParam(':postId', $postId, PDO::PARAM_INT);
      $sthForAjax->execute();
      $favoriteForAjax = $sthForAjax->fetch();
        // レコードが1件でもある場合
        if(!empty($favoriteForAjax)){
            // レコードを削除する
            $sqlForAjax = 'DELETE FROM favorites WHERE postId = :postId AND userId = :userId';
            $sthForAjax = $dbh->prepare($sqlForAjax);
            $sthForAjax->bindParam(':userId', $userId, PDO::PARAM_INT);
            $sthForAjax->bindParam(':postId', $postId, PDO::PARAM_INT);
            $sthForAjax->execute();
        }else{
            // レコードを挿入する
            $sqlForAjax = 'INSERT INTO favorites (postId, userId) VALUES (:postId, :userId)';
            $sthForAjax = $dbh->prepare($sqlForAjax);
            $sthForAjax->bindParam(':userId', $userId, PDO::PARAM_INT);
            $sthForAjax->bindParam(':postId', $postId, PDO::PARAM_INT);
            $sthForAjax->execute();
        }
    }catch(Exception $e){
        error_log('エラー発生：'.$e->getMessage());
    }
}