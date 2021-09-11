<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 11.09.2021
 * Time: 16:47
 */

namespace backend\assets;


use yii\web\AssetBundle;

class GameUpdateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/game-update.css',
    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap4\BootstrapAsset',
    ];
}