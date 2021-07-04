<?php
namespace app\src;

if(!defined('ROOT_PATH')){
  define('ROOT_PATH', str_replace('Models', '', __DIR__));
}

include(ROOT_PATH .'database.php');

class Db{
    protected $dbh;

    public function __construct($dbh=null){
        if(!$dbh){
            try{
                $this->dbh = new \PDO(
                    'mysql:dbname='.DB_NAME.';host='.DB_HOST, DB_USER, DB_PASSWD
                );
            }catch(PDOException $e){
                echo '接続失敗：' . $e->getMessage() . "\n";
                exit;
            }
        }else{
            $this->dbh = $dbh;
        }
    }

    public function get_db_handler(){
        return $this->dbh;
    }
}

?>
