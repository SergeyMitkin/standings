<?php

namespace app\models\tables;

use Yii;

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
}
