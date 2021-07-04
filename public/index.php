<?php
//publicを除いたドキュメントルートのフルパスを'ROOT_PATH'として取得
define('ROOT_PATH', str_replace('public', '', $_SERVER["DOCUMENT_ROOT"]));
//ドメイン以下のパスを取得してURLとして解釈する
$parse = parse_url($_SERVER["REQUEST_URI"]);
//ファイル名がなかった場合、index.phpを呼び出す
if(mb_substr($parse['path'], -1) === '/'){
    $parse['path'] .= $_SERVER["SCRIPT_NAME"];
}
require_once(ROOT_PATH.'Views'.$parse['path']);
?>