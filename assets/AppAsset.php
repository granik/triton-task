<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/datatables.min.css',
        'css/site.css'
    ];
    public $publishOptions = [
        'forceCopy' => true
    ];
    public $js = [
        'js/swal/sweetalert.min.js',
        'js/main.js',
        'js/jquery.maskedinput.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset'

    ];
    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
