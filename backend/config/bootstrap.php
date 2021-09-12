<?php

// Устанавливаем символическую ссылку из папки сайта на папку с изображениями

$site_folder = array_pop(explode('/', $_SERVER['DOCUMENT_ROOT']));
$link = \Yii::getAlias('@backend/' . $site_folder . '/images/team_logo_subdir');

if(is_link($link) == false){
    symlink(\Yii::getAlias('@common/images/team_logo'), \Yii::getAlias('@backend/' . $site_folder . '/images/team_logo_subdir'));
}
