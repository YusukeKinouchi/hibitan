<?php
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/getPostForPage.php');

class pageController{
    private $request;
    private $getPostForPage;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->getPostForPage = new getPostForPage();

        $dbh = $this->getPostForPage->get_db_handler();
    }

    //myteamの投稿を取得
    public function getPosts(){
        $forPage = $this->getPostForPage->getPost($this->request['get']['userId']);
        $params_post = [
           'posts' => $forPage
        ];
        return $params_post;
    }
}

?>