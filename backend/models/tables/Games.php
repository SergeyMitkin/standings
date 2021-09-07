<?php

namespace app\models\tables;

use Yii;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property int $home_id
 * @property int $visitor_id
 * @property string $date
 * @property int|null $home_goals
 * @property int|null $visitor_goals
 *
 * @property Teams $home
 * @property Teams $visitor
 */
class Games extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';// games
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['home_id', 'visitor_id', 'date'], 'required'],
            [['home_id', 'visitor_id', 'home_goals', 'visitor_goals'], 'integer'],
            [['date'], 'safe'],
            [['home_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['home_id' => 'id']],
            [['visitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Teams::className(), 'targetAttribute' => ['visitor_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'home_id' => 'Home ID',
            'visitor_id' => 'Visitor ID',
            'date' => 'Date',
            'home_goals' => 'Home Goals',
            'visitor_goals' => 'Visitor Goals',
        ];
    }

    /**
     * Gets query for [[Home]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHome()
    {
        return $this->hasOne(Teams::className(), ['id' => 'home_id']);
    }

    /**
     * Gets query for [[Visitor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVisitor()
    {
        return $this->hasOne(Teams::className(), ['id' => 'visitor_id']);
    }
}
