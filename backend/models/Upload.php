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

    // Загрузка изображений в common
    public function uploadCommonImage()
    {
        $file_name = $this->team_logo->baseName . '.' . $this->team_logo->extension;
        $img_path = \Yii::getAlias('@com_images/team_logo/'. $file_name);
        $img_path_small = \Yii::getAlias('@com_images/team_logo/small/'. $file_name);

        $this->team_logo->saveAs($img_path);
        if (Image::thumbnail($img_path, 230, 130)
            ->save($img_path_small)){
            return 'images/team_logo_subdir/small/' . $file_name;
        }
    }

}