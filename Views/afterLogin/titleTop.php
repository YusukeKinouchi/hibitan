<div class='titleTop'>
    <div class='titleLeft'><button onclick='location.href="<?=$postUrl ?>"'>投稿</button></div>
    <h1 class='title'>日々鍛</h1>
    <div class='titleRight'>
        <button onclick='location.href="<?=$operationUrl ?>"'>各種操作</button>
        <button onclick='location.href="<?=$logoutUrl ?>"'>ログアウト</button>
        <?php if(isset($_GET['teamId'])){ ?>
            <button onclick='location.href="<?=$teamInformationUrl ?>"'>チーム情報</button>
        <?php }else{?>
            <div style="height:25px;"></div>
        <?php } ?>
    </div>
</div>