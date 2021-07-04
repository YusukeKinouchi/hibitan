<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Controllers', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/getPostForPage.php');
require_once(ROOT_PATH .'/Models/checkFavorite.php');

class pageController{
    private $request;
    private $getPostForPage;
    private $favorite;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->getPostForPage = new getPostForPage();

        $dbh = $this->getPostForPage->get_db_handler();
        $this->favorite = new checkFavorite($dbh);
    }

    //myteamの投稿を取得
    public function getPosts(){
        $forPage = $this->getPostForPage->getPost($_SESSION['userId']);
        $params_post = [
           'posts' => $forPage
        ];
        $_SESSION['userId'] = NULL;
        return $params_post;
    }

    public function countFavorite($postId){
        $favorite = $this->favorite->countFavorite($postId);
        return $favorite;
    }
}

?>