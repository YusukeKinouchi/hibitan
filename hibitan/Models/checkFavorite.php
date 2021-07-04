<?php
function checkFavolite($userId,$postId){
    $dsn='mysql:dbname=hibitan;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh=new PDO($dsn,$user,$password);
    $sql = "SELECT * FROM favorites WHERE userId = :userId AND postId = :postId";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':userId', $userId, PDO::PARAM_INT);
    $sth->bindParam(':postId', $postId, PDO::PARAM_INT);
    $sth->execute();
    $favorite = $sth->fetch();
    return $favorite;
}

function countFavorite($postId){
    $dsn='mysql:dbname=hibitan;host=localhost;charset=utf8';
    $user='root';
    $password='root';
    $dbh=new PDO($dsn,$user,$password);
    $sql = "SELECT * FROM favorites WHERE postId = :postId";
    $sth = $dbh->prepare($sql);
    $sth->bindParam(':postId', $postId, PDO::PARAM_INT);
    $sth->execute();
    $favorite = $sth->fetchAll();
    return count($favorite);
}
?>