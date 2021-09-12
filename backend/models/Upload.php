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

    // Удаление изобрахений
    public function delImageFile($img_path, $img_path_small)
    {
        if (is_file($img_path)){
            unlink($img_path);
        }

        if (is_file($img_path_small)){
            unlink($img_path_small);
        }
    }

    // Загрузка изображений в common
    public function uploadCommonImage()
    {
        // Добавляем уникаольный id к имени изображения
        $file_name = uniqid() . $this->team_logo->baseName . '.' . $this->team_logo->extension;

        // Определяем пути, для сохранения в БД
        $img_path = \Yii::getAlias('@com_images/team_logo/'. $file_name);
        $img_path_small = \Yii::getAlias('@com_images/team_logo/small/'. $file_name);

        // Загружаем полное и уменьшенное изображения
        $this->team_logo->saveAs($img_path);
        if (Image::thumbnail($img_path, 150, 150)
            ->save($img_path_small)){

            // Возвращаем пути к изображениям
            return [
                'logo_source' => 'images/team_logo_subdir/' . $file_name,
                'logo_source_small' => 'images/team_logo_subdir/small/' . $file_name
            ];
        }
    }

}