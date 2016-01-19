Array.prototype.remove = function (from, to) {
    var rest = this.slice((to || from) + 1 || this.length);
    this.length = from < 0 ? this.length + from : from;
    return this.push.apply(this, rest);
};
/**
 * Lock UI
 */
(function ($) {
    $.fn.lock = function () {
        this.unlock();
        $('body').append('<div id="widget-lock-ui" class="lock-ui" style="position:fixed;width:100%;height:100%;top:0;left:0;z-index:1000;background-color:#000;cursor:wait;opacity:.7;filter: alpha(opacity=70);"><div>');
    };
    $.fn.unlock = function () {
        $('#widget-lock-ui').remove();
    };
})(jQuery);
var yadjet = yadjet || {};
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
                var t = trData[key].toString();
                var t = t.toLowerCase();
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
                    $this.hide().parent().addClass('running-c-c');
                }, success: function (response) {
                    if (response.success) {
                        var data = response.data;
                        $this.removeClass(data.value ? 'glyphicon-remove' : 'glyphicon-ok').addClass(data.value ? 'glyphicon-ok' : 'glyphicon-remove');
                        if (data.updatedAt) {
                            $tr.find('td.rb-updated-at').html(data.updatedAt);
                        }
                        if (data.updatedBy) {
                            $tr.find('td.rb-updated-by').html(data.updatedBy);
                        }
                    } else {
                        layer.alert(response.error.message);
                    }
                    $this.show().parent().removeClass('running-c-c');
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText);
                    $this.show().parent().removeClass('running-c-c');
                }
            });

            return false;
        });
    },
    gridColumnConfig: function () {
        jQuery(document).on('click', '#menu-buttons li a.grid-column-config', function () {
            var $this = $(this);
            $.ajax({
                type: 'GET',
                url: $this.attr('href'),
                beforeSend: function (xhr) {
                    $.fn.lock();
                }, success: function (response) {
                    $.dialog({
                        title: '表格栏位设定',
                        content: response,
                        lock: true,
                        padding: '10px'
                    }, function () {
                        $.pjax.reload({container: '#' + $this.attr('data-reload-object')});
                    });
                    $.fn.unlock();
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText);
                    $.fn.unlock();
                }
            });

            return false;
        });
    }
};

yadjet.actions.gridColumnConfig();
var Mai3 = {};
Mai3.vmd = {
    item: {
        brands: [],
        specifications: []
    }
};

var vmItem = new Vue({
    el: '#mai3-item-specifications',
    data: {
        brands: [],
        specifications: [],
        specificationValueCombinationList: [] // 规格值组合列表
    },
    methods: {
        checked: function (event) {
            var self = this;
            console.info(event);
            $('#mai3-item-specifications .tab-content :checkbox').each(function () {
                console.info(self.specificationValueCombinationList);
                var $t = $(this),
                    id = $t.val(),
                    d = {id: id, name: $('#label-' + id).html()},
                    i  = _.findIndex(self.specificationValueCombinationList, d),
                    checked = $t.prop('checked');
                console.info(id);
                console.info(checked);
                if (i === -1 && checked) {
                    self.specificationValueCombinationList.push(d);
                } else if (i && !checked) {
                    self.specificationValueCombinationList = _.reject(self.specificationValueCombinationList, function(data){
                        return data.id == id;
                    })
                }
            });
            console.info(this.specificationValueCombinationList);
        }
    }
});
$(document).ready(function () {
    var sparklineCharts = function () {
        $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });

        $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1ab394',
            fillColor: "transparent"
        });

        $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16, 8], {
            type: 'line',
            width: '100%',
            height: '50',
            lineColor: '#1C84C6',
            fillColor: "transparent"
        });
    };

    var sparkResize;

    $(window).resize(function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineCharts, 500);
    });

    sparklineCharts();




    var data1 = [
        [0, 4], [1, 8], [2, 5], [3, 10], [4, 4], [5, 16], [6, 5], [7, 11], [8, 6], [9, 11], [10, 20], [11, 10], [12, 13], [13, 4], [14, 7], [15, 8], [16, 12]
    ];
    var data2 = [
        [0, 0], [1, 2], [2, 7], [3, 4], [4, 11], [5, 4], [6, 2], [7, 5], [8, 11], [9, 5], [10, 4], [11, 1], [12, 5], [13, 2], [14, 5], [15, 2], [16, 0]
    ];
    $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
        data1, data2
    ],
        {
            series: {
                lines: {
                    show: false,
                    fill: true
                },
                splines: {
                    show: true,
                    tension: 0.4,
                    lineWidth: 1,
                    fill: 0.4
                },
                points: {
                    radius: 0,
                    show: true
                },
                shadowSize: 2
            },
            grid: {
                hoverable: true,
                clickable: true,
                borderWidth: 2,
                color: 'transparent'
            },
            colors: ["#1ab394", "#1C84C6"],
            xaxis: {
            },
            yaxis: {
            },
            tooltip: false
        }
    );

    $(document).on('click', 'a.btn-search', function () {
        var $t = $(this);
        if ($t.attr('data-toggle') === 'show') {
            $t.attr('data-toggle', 'hide');
            $('.form-search').hide();
        } else {
            $t.attr('data-toggle', 'show');
            $('.form-search').show();
        }


        return false;
    });

    // 商品相册图片上传
    $(document).on('click', '#btn-add-new-goods-image-row', function () {
        var $t = $(this),
            $row = $('tr#row-0');
        if ($row.length) {
            $cloneRow = $row.clone();
            $cloneRow
                .find('input')
                .val('')
                .end()
                .find('.btns')
                .html('<a href="javascript:;" title="删除" aria-label="删除" class="btn-remove-dynamic-row"><span class="glyphicon glyphicon-trash"></span></a>');
            $('#grid-goods-images table tbody').append($cloneRow);

            $('#grid-goods-images table tbody tr').each(function (i) {
                $(this).attr('id', 'row-' + i);
            });
        } else {
            layer.alert('不存在参考行。', {icon: -1});
        }

        return false;
    });

    $(document).on('click', 'a.btn-remove-dynamic-row', function () {
        $(this).parent().parent().remove();

        return false;
    });

    // 删除商品图片
    $(document).on('click', '.btn-delete-image', function () {
        if (confirm('是否删除该图片？')) {
            var $t = $(this),
                id = $t.attr('data-key');
            $.ajax({
                type: 'POST',
                url: $t.attr('data-url'),
                data: {id: id},
                dataType: 'json',
                beforeSend: function (xhr) {
                    $.fn.lock();
                }, success: function (response) {
                    if (response.success) {
                        $t.parent().parent().remove();
                    } else {
                        layer.alert(response.error.message, {icon: -1});
                    }
                    $.fn.unlock();
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                    $.fn.unlock();
                }
            });
        }

        return false;
    });

    // 更新商品图片描述文字
    $(document).on('blur', '.update-image-description', function () {
        var $t = $(this),
            id = $t.attr('data-key'),
            originalValue = $t.attr('data-original'),
            value = $t.val();
        if (value != originalValue) {
            $.ajax({
                type: 'POST',
                url: $t.attr('data-url'),
                data: {
                    id: id,
                    description: value
                },
                dataType: 'json',
                beforeSend: function (xhr) {
                    $.fn.lock();
                }, success: function (response) {
                    if (!response.success) {
                        layer.alert(response.error.message, {icon: -1});
                    }
                    $.fn.unlock();
                }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                    layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                    $.fn.unlock();
                }
            });
        }

        return false;
    });

    // 动态添加属性
    $(document).on('click', '#btn-dynamic-add-specifications-row', function () {
        var $t = $(this),
            $tableBody = $t.parent().parent().find('tbody'),
            $cloneRow = $('#row-0').clone(false),
            indexCounter = $('#mai3-index-counter').val(),
            id, name, elements, element, attrs;

        $cloneRow.find('td.btn-render').html('<a class="btn-delete-dynamic-table-row" href="javascript:;" title="删除"><span class="glyphicon glyphicon-trash"></span></a>');
        elements = $cloneRow.find('input,select');
        for (var i = 0, l = elements.length; i < l; i++) {
            element = $(elements[i]);
            if (element.attr('id') === 'specification-valuesdata-0-id') {
                element.val(0).attr({
                    id: 'specification-valuesdata-' + indexCounter + '-id',
                    name: 'Specification[valuesData][' + indexCounter + '][id]'
                });
            } else {
                attrs = {};
                if (element.prev().is("input")) {
                    attrs.value = '';
                } else if (element.prev().is('select')) {
                    attrs.index = 0;
                } else if (element.prev().is('checkbox')) {
                    attrs.checked = 'checked';
                }
                id = element.attr('id')
                if (typeof id !== typeof undefined && id !== false) {
                    attrs.id = id.replace('0', indexCounter);
                }
                name = element.attr('name');
                attrs.name = name.replace('0', indexCounter);
                $(elements[i]).attr(attrs);
            }
        }
        $tableBody.append('<tr id="row-' + $('#mai3-index-counter').val() + '">' + $cloneRow.html() + '</tr>');
        $('#mai3-index-counter').val(parseInt(indexCounter) + 1);

        return false;
    });

    // 删除表格行记录
    $(document).on('click', '.btn-delete-table-row', function () {
        var $t = $(this);

        $.ajax({
            type: 'POST',
            url: $t.attr('href'),
            dataType: 'json',
            beforeSend: function (xhr) {
                $.fn.lock();
            }, success: function (response) {
                if (response.success) {
                    $t.parent().parent().remove();
                } else {
                    layer.alert(response.error.message, {icon: -1});
                }
                $.fn.unlock();
            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                $.fn.unlock();
            }
        });

        return false;
    });

    // 删除表格动态行
    $(document).on('click', '.btn-delete-dynamic-table-row', function () {
        $(this).parent().parent().remove();

        return false;
    });

    // 动态更新商品类型关联数据
    $(document).on('change', '#item-type_id', function () {
        var $t = $(this);
        $.ajax({
            type: 'GET',
            url: $t.attr('data-url'),
            data: {typeId: $t.val()},
            dataType: 'json',
            beforeSend: function (xhr) {
                $.fn.lock();
            }, success: function (response) {
                // 品牌数据处理
                $('#item-brand_id option').remove();
                var brands = response.brands,
                    l = brands.length,
                    $select = $('#item-brand_id');
                if (l > 0) {
                    for (var i = 0; i < l; i++) {
                        $select.append('<option value="' + brands[i].id + '">' + brands[i].name + '</option>');
                    }
                } else {
                    $select.append('<option value="0">无品牌</option>');
                }
                
                vmItem.$set('brands', response.brands);
                vmItem.$set('specifications', response.specifications);
                
                $.fn.unlock();
            }, error: function (XMLHttpRequest, textStatus, errorThrown) {
                layer.alert('[ ' + XMLHttpRequest.status + ' ] ' + XMLHttpRequest.responseText, {icon: -1});
                $.fn.unlock();
            }
        });
    });

});
