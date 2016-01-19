/**
 * Lock UI
 */
;(function ($) {
    $.fn.lock = function () {
        this.unlock();
        $('body').append('<div id="widget-lock-ui" class="lock-ui" style="position:fixed;width:100%;height:100%;top:0;left:0;z-index:1000;background-color:#000;cursor:wait;opacity:.7;filter: alpha(opacity=70);"><div>');
    };
    $.fn.unlock = function () {
        $('#widget-lock-ui').remove();
    };
})(jQuery);

var yadjet = yadjet || {};
yadjet.urls = yadjet.urls || {
    memberCertificationAudit: undefined
};
yadjet.icons = yadjet.icon || {};
yadjet.icons.boolean = [
    '/images/no.png',
    '/images/yes.png'
];
yadjet.actions = yadjet.actions || {
    toggle: function (selector, url) {
        var dataExt = arguments[2] ? arguments[2] : {};
        var trData = arguments[3] ? arguments[3] : [];
        jQuery(document).on('click', selector, function () {
            var $this = $(this);
            var $tr = $this.parent().parent();
            var data = {
                id: $tr.attr('data-key')
            };
            for (var key in dataExt) {
                data[key] = dataExt[key];
            }
            console.info(trData);
            for (var key in trData) {
                // `data-key` To `dataKey`
                var t = trData[key].toLowerCase();
                t = t.replace(/\b\w+\b/g, function (word) {
                    return word.substring(0, 1).toUpperCase() + word.substring(1);
                });
                t = t.replace('-', '');
                t = t.substring(0, 1).toLowerCase() + t.substring(1);
                data[t] = $tr.attr('data-' + trData[key]);
            }
            console.info(data);
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                dataType: 'json',
                beforeSend: function (xhr) {
                }, success: function (response) {
                    if (response.success) {
                        var data = response.data;
                        $this.attr('src', yadjet.icons.boolean[data.value ? 1 : 0]);
                    } else {
                        layer.alert(response.error.message, {icon: -1});
                    }
                    $this.show().parent().removeClass('running-c-c');
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                }
            });

            return false;
        });
    }
};

$(function () {
    // 切换商品布尔属性值
    $(document).on('click', '.btn-toggle span.glyphicon', function () {
        var $t = $(this);
            id = $t.parent().parent().attr('data-key'),
            url = yadjet.urls.memberCertificationAudit;
        url = url.replace('0', id);
        $.ajax({
            type: 'POST',
            url: url,
            dataType: 'json',
            beforeSend: function (xhr) {
                $.fn.lock();
            }, success: function (response) {
                if (response.success) {
                    var removeClassName, addClassName;
                    if (response.data) {
                        removeClassName = 'glyphicon-remove';
                        addClassName = 'glyphicon-ok';
                    } else {
                        removeClassName = 'glyphicon-ok';
                        addClassName = 'glyphicon-remove';
                    }
                    $t.removeClass(removeClassName).addClass(addClassName);
                } else {
                    layer.alert(response.error.message);
                }
                $.fn.unlock();
            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                $.fn.unlock();
            }
        });
        
        return false;
    });

});