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
 */
class Teams extends \yii\db\ActiveRecord
{
    /** @var UploadedFile*/
    public $image;

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
            [['image'], 'file']
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
        ];
    }

    public function uploadBackendImage()
    {
        $fileName = $this->image->baseName . '.' . $this->image->extension;
        $img_path = Yii::getAlias('@webroot/img/'. $fileName);
        $img_path_small = Yii::getAlias('@webroot/img/small/'. $fileName);

        $this->image->saveAs($img_path);
        Image::thumbnail($img_path, 230, 150)
            ->save($img_path_small);
    }
}
