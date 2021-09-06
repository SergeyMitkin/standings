<?php

namespace app\models\tables;

use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string $name
 * @property int|null $games
 * @property int|null $gf
 * @property int|null $ga
 * @property int|null $points
 * @property string $logo_source
 */
class Teams extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['games', 'gf', 'ga', 'points'], 'integer'],
            [['name'], 'string', 'max' => 250],
            [['name'], 'unique'],
            [['logo_source'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Команда',
            'games' => 'Игры',
            'gf' => 'ЗМ',
            'ga' => 'ПМ',
            'points' => 'Очки',
            'logo_source' => 'Эмблема'
        ];
    }



    // Записываем адрес изображения в БД
    /*
    public function setImageSource($image_source){
        $this->image_source = $image_source;
        $this->save();
    }
    */
}
