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

    // Редактируем записи команд после игры
    public function gamePlayed($home_id, $visitor_id, $home_goals, $visitor_goals){

        $home_team = $this::findOne($home_id);
        $visitor_team = $this::findOne($visitor_id);

        $home_team->updateCounters([
            'games' => 1,
            'gf' => $home_goals,
            'ga' => $visitor_goals,
            'points' => $this->getPoints($home_goals, $visitor_goals)
        ]);

        $visitor_team->updateCounters([
            'games' => 1,
            'gf' => $visitor_goals,
            'ga' => $home_goals,
            'points' => $this->getPoints($visitor_goals, $home_goals)
        ]);
    }

    // По разнице забитых и пропущенных мячей в игре, определяем количество набранных очков
    private function getPoints($gf, $ga){

        if ($gf > $ga){
            return 3;
        } elseif ($gf < $ga){
            return 0;
        } elseif ($gf == $ga){
            return 1;
        }

    }

}
