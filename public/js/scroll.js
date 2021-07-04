var _window = $(window),
    _header = $('.header'),
    headerFix;

_window.on('scroll',function(){
    headerFix = $('.titleArea').height();
    if(_window.scrollTop() > headerFix){
        $('.header').css('position', 'fixed');
        $('.header').css('top', '140px');
        $('.header').css('width', '96.5%');
        $('.header').css('z-index', '2');
        $('.titleArea').css('position', 'fixed');
        $('.titleArea').css('top', '0');
        $('.titleArea').css('width', '96.5%');
        $('.titleArea').css('z-index', '2');
        $('.titleArea').css('background-color', 'rgb(255, 255, 255)');
        $('.titleArea').css('border', 'none');
    }else{
        $('.header').css('position', '');
        $('.header').css('top', '');
        $('.header').css('width', '');
        $('.header').css('z-index', '');
        $('.titleArea').css('position', '');
        $('.titleArea').css('top', '');
        $('.titleArea').css('width', '');
        $('.titleArea').css('z-index', '');
        $('.titleArea').css('background-color', '');
        $('.titleArea').css('border', '3px solid');
    }
});

_window.trigger('scroll');

jQuery(function() {
    var appear = false;
    var pagetop = $('#page_top');
    $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {  //100pxスクロールしたら
        if (appear == false) {
          appear = true;
          pagetop.stop().animate({
            'bottom': '10px' //下から50pxの位置に
          }, 300); //0.3秒かけて現れる
        }
      } else {
        if (appear) {
          appear = false;
          pagetop.stop().animate({
            'bottom': '-50px' //下から-50pxの位置に
          }, 300); //0.3秒かけて隠れる
        }
      }
    });
    pagetop.click(function () {
      $('body, html').animate({ scrollTop: 0 }, 500); //0.5秒かけてトップへ戻る
      return false;
    });
  });
  