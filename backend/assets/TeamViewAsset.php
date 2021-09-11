<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 10.09.2021
 * Time: 15:03
 */

namespace backend\assets;


use yii\web\AssetBundle;

class TeamViewAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/team-view.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}