<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 06.09.2021
 * Time: 5:37
 */

namespace backend\models;

use yii\base\Model;
use yii\imagine\Image;

class Upload extends Model
{
    /** @var UploadedFile*/
    public $team_logo;

    public function rules()
    {
        return[
            [['team_logo'], 'file']
        ];
    }

    // Загрузка изображений для бэкенда
    public function uploadBackendImage()
    {

        $file_name = $this->team_logo->baseName . '.' . $this->team_logo->extension;
        $img_path = \Yii::getAlias('@webroot/img/'. $file_name);
        $img_path_small = \Yii::getAlias('@webroot/img/small/'. $file_name);

        $this->team_logo->saveAs($img_path);
        if (Image::thumbnail($img_path, 230, 150)
            ->save($img_path_small)){
            return 'img/small/' . $file_name;
        }
    }

}