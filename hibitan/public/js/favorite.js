$(document).on('click','.favoriteBtn',function(){
    var $_t = $(this).parent().parent().parent();
    var findUserId= $_t.find('.userId'),
        findPostId= $_t.find('.postId');
    var userId = findUserId.val();
    var postId = findPostId.val();
    $.ajax({
        type: 'POST',
        url: '../ajaxGood.php',
        dataType: 'json',
        data: { userId: userId,
                postId: postId}
    }).done(function(data){
        location.reload();
    }).fail(function() {
      location.reload();
    });
  });