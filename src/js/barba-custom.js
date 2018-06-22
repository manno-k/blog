jQuery(function ($) {
// 現在と同じページのリンクをクリックした場合、リロードをしない設定(オプション)
// リロードしたい場合は削除してOKです。
    var links = document.querySelectorAll('a[href]');
    var cbk = function (e) {
        if (e.currentTarget.href === window.location.href) {
            e.preventDefault();
            e.stopPropagation();
        }
    };
    for (var i = 0; i < links.length; i++) {
        links[i].addEventListener('click', cbk);
    }

    /*
    * 遷移時に変更したい処理
    * デフォルトではhead内のmetaタグは変わりません。(titleタグは変わります)
    * また、barba-container内のjsは実行されないので個別に変更・実行したい処理をココに書きます。
    */
    Barba.Dispatcher.on('newPageReady', function (currentStatus, oldStatus, barbaContainer, newPageRawHTML) {

        if (Barba.HistoryManager.history.length === 1) {  // ファーストビュー
            return; // この時に更新は必要ありません
        }

        // jquery-pjaxから借りた
        var $newPageHead = $('<head />').html(
            $.parseHTML(
                newPageRawHTML.match(/<head[^>]*>([\s\S.]*)<\/head>/i)[0],
                document,
                true
            )
        );
        // 変更したいタグ(ご自身の環境に合わせて適宜変更してください)
        var headTags = [
            "link[rel='canonical']",
            "link[rel='shortlink']",
            "link[rel='alternate']",
            "meta[name='description']",
            "meta[property^='og']",
            "meta[name^='twitter']",
            "meta[name='robots']"
        ].join(',');
        $('head').find(headTags).remove(); // タグを削除する
        $newPageHead.find(headTags).appendTo('head'); // タグを追加する

        // Analyticsにヒットを送信(Google Analyticsを導入している場合)
        if (typeof ga === 'function') {
            ga('send', 'pageview', location.pathname);
        }
    }); // End Dispatcher

// アニメーションの設定(フェードアウト→フェードイン)(オプション)
// 必要ない場合は削除してOKです。
    var fadeTransition = Barba.BaseTransition.extend({
        start: function () {
            //startはトランジションが起動した直後の一番最初に呼び出される。

            //promise.allを使うと、配列で渡された処理が全て終わった後に.thenを実行。
            //この場合は.newContainerLOadingと.fadeOutが終わってから.thenが実行される。
            Promise
                .all([this.newContainerLoading, this.fadeOut()])
                .then(this.fadeIn.bind(this));
        }, // End start function

        fadeOut: function () {
            //古いページコンテンツに対して行う処理。
            //ここでは、animateを使って、fadeoutさせている。
             $(this.oldContainer).animate({opacity: 0}, {duration: 'slow'}).promise();
             $('.js-loader').css('display', 'none').fadeIn(1000).promise();
        },

        fadeIn: function () {
            document.scrollingElement.scrollTop = 0;
            //startに記述したallによって、fadeOutが終わったらこのfadeIn関数が呼び出されている。

            var _this = this;
            //ここでのnewContainerは、ajaxで読み込まれてきた新しい方の.barba-containerにあたる。
            var $el = $(this.newContainer);

            //opacity:0;になっていた古いbarba-containerをdisplay:none;に。
            //こちらおそらくfadeIn発動時古いbarba-containerの初期設定として。
            $(this.oldContainer).hide();
            //こちらも新しいbarba-containerの初期設定。
            //visiblityがあるのは、デフォルトではこれがhiddenになってるっぽいから。
            $el.css({
                visibility: 'visible',
                opacity: 0
            });
            $('.js-loader').css('display', 'none').fadeOut(1000).promise();
            $el.animate({opacity: 1}, 200, function () {
                //.done()をつけることで古いbarba-containerのDOMは削除され、transitionが終了する。
                _this.done();
            });
        }
    }); // End BaseTransition

// returnに作ったトランジションを設定
    Barba.Pjax.getTransition = function () {

        return fadeTransition;
    };

// barba実行
    $().ready(function () {
        Barba.Pjax.start();
        Barba.Prefetch.init(); // prefetchを有効化
    });


});