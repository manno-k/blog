jQuery(function ($) {

//スクロール量を取得する関数
    function getScrolled() {
        return (window.pageYOffset !== undefined) ? window.pageYOffset : document.documentElement.scrollTop;
    }

//トップに戻るボタンの要素を取得
    var topButton = document.getElementById('js-top');

//ボタンの表示・非表示
    window.onscroll = function () {
        (getScrolled() > 500) ? topButton.classList.add('fade-in') : topButton.classList.remove('fade-in');
    };

//トップに移動する関数
    function scrollToTop() {
        var scrolled = getScrolled();
        window.scrollTo(0, Math.floor(scrolled / 2));
        if (scrolled > 0) {
            window.setTimeout(scrollToTop, 30);
        }
    };

//イベント登録
    topButton.onclick = function () {
        scrollToTop();
    };

    $(function() {
        var before = $(window).scrollTop();
        $(window).scroll(function() {
            var after = $(window).scrollTop();
            if(before > after) {
                setTimeout(function(){
                    $('.js-header').removeClass('active');
                },100);
                $('.js-footer').removeClass('active');

            }
            else if(before < after) {
                setTimeout(function(){
                    $('.js-header').addClass('active');
                },100);
                $('.js-footer').addClass('active');

            }
            before = after;
        });
    });

});