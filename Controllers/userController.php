<?php
namespace app\src;
if(!defined('ROOT_PATH')){
    define('ROOT_PATH', str_replace('Controllers', '', __DIR__));
}
require_once(ROOT_PATH .'/Models/Db.php');
require_once(ROOT_PATH .'/Models/aboutPost.php');
require_once(ROOT_PATH .'/Models/forEdit.php');
require_once(ROOT_PATH .'/Models/Post.php');

class userController{
    private $request;
    private $deletePost;
    private $getFavorite;
    private $getPostForEdit;
    private $doPostAndMove;
    private $doEditAndMove;

    public function __construct(){
        $this->request['get'] = $_GET;
        $this->request['post'] = $_POST;

        $this->deletePost = new toPost();

        $dbh = $this->deletePost->get_db_handler();
        $this->getFavorite = new toPost($dbh);
        $this->getPostForEdit = new forEdit($dbh);
        $this->doPostAndMove = new post($dbh);
        $this->doEditAndMove = new forEdit($dbh);
    }

    //投稿削除
    public function deletePost(){
        $delete = $this->deletePost->delete($_SESSION['deletePostId']);
    }

    public function getFavorites(){
        $favorite = $this->getFavorite->check_favolite_duplicate($this->request['get']['userId'],$this->request['get']['postId']);
    }

    public function getPostForEdit(){
        $editPostId = isset($_SESSION['editPostId']) ? $_SESSION['editPostId'] : $_GET['id'];
        $post = $this->getPostForEdit->getPost($editPostId);
        $params_post = [
            'post' => $post
        ];
        return $params_post;
    }

    public function post(){
        $postAndMove = $this->doPostAndMove->postAndMove();
    }

    public function edit(){
        $postAndMove = $this->doEditAndMove->editAndMove();
    }

}
?>
