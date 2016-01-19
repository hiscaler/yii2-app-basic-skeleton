<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/font-awesome.min.css',
        'css/animate.css',
        'css/inspinia.css',
        'css/application.css',
        'layer/skin/layer.css',
        'layer/skin/layer.ext.css',
    ];
    public $js = [
        'js/jquery.metisMenu.js',
        'js/jquery.slimscroll.min.js',
        'js/flot/jquery.flot.js',
        'js/flot/jquery.flot.tooltip.min.js',
        'js/flot/jquery.flot.spline.js',
        'js/flot/jquery.flot.resize.js',
        'js/flot/jquery.flot.pie.js',
        'js/flot/jquery.flot.symbol.js',
        'js/flot/jquery.flot.time.js',
        'js/inspinia.js',
        'js/pace.min.js',
        'js/jquery.sparkline.min.js',
        'layer/layer.js',
        'layer/extend/layer.ext.js',
        'js/vue.js',
        'js/underscore-min.js',
        'js/application.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
