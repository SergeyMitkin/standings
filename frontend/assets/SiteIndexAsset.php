<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.09.2021
 * Time: 13:03
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class SiteIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site-index.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}