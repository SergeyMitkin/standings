<?php

namespace backend\models\tables;

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
            [['games', 'gf', 'ga','points'], 'integer'],
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
            'logo_source' => 'Эмблема',
            'goalsAmount' => 'Мячи'
        ];
    }

    // Изменяем данные команд после игры
    public function gamePlayed($game_id, $home_id, $visitor_id, $home_goals, $visitor_goals){

        $home_team = $this::findOne($home_id);
        $visitor_team = $this::findOne($visitor_id);

        // Добавляем запись в составную таблицу games_teams
        Yii::$app->db
            ->createCommand
            ('INSERT INTO games_teams (game_id, home_id, visitor_id)
              VALUES (' . $game_id . ', ' . $home_id . ', ' . $visitor_id .');')
            ->execute();

        // Обновляем запись команды хозяев
        $home_team->updateCounters([
            'games' => 1,
            'gf' => $home_goals,
            'ga' => $visitor_goals,
            'points' => $this->getPoints($home_goals, $visitor_goals)
        ]);

        // Обновляем запись команды гостей
        $visitor_team->updateCounters([
            'games' => 1,
            'gf' => $visitor_goals,
            'ga' => $home_goals,
            'points' => $this->getPoints($visitor_goals, $home_goals)
        ]);
    }

    // Изменяем данные команд после редактирования игры
    public function gameUpdated($game_id, $home_id, $visitor_id, $home_goals, $visitor_goals){

        $home_team = $this::findOne($home_id);
        $visitor_team = $this::findOne($visitor_id);

        // Редактируем запись в составной таблице games_teams
        Yii::$app->db
            ->createCommand
            ('UPDATE games_teams SET home_id = '. $home_id . ', visitor_id = ' . $visitor_id .
                ' WHERE game_id = ' . $game_id . ';')
            ->execute();

        // Обновляем запись команды хозяев
        $home_team->updateCounters([
            'games' => 1,
            'gf' => $home_goals,
            'ga' => $visitor_goals,
            'points' => $this->getPoints($home_goals, $visitor_goals)
        ]);

        // Обновляем запись команды гостей
        $visitor_team->updateCounters([
            'games' => 1,
            'gf' => $visitor_goals,
            'ga' => $home_goals,
            'points' => $this->getPoints($visitor_goals, $home_goals)
        ]);
    }

    // Изменяем данные команд перед удалением или редактированием игры
    public function gameDeleted($game_id){

        // Определяем id команды хазяев
        $home_id = Yii::$app->db
            ->createCommand
            ('SELECT home_id FROM games_teams WHERE game_id = ' . $game_id . ';')
            ->queryOne()['home_id'];

        // Определяем id команды гостей
        $visitor_id = Yii::$app->db
            ->createCommand
            ('SELECT visitor_id FROM games_teams WHERE game_id = ' . $game_id . ';')
            ->queryOne()['visitor_id'];

        // Определяем голы команды хазяев
        $home_goals = Yii::$app->db
            ->createCommand
            ('SELECT home_goals FROM games WHERE id = ' . $game_id. ' AND home_id = ' . $home_id  . ';')
            ->queryOne()['home_goals'];

        // Определяем голы команды гостей
        $visitor_goals = Yii::$app->db
            ->createCommand
            ('SELECT visitor_goals FROM games WHERE id = ' . $game_id. ' AND visitor_id = ' . $visitor_id  . ';')
            ->queryOne()['visitor_goals'];

        // Очки команд за игру
        $home_points = $this->getPoints($home_goals, $visitor_goals);
        $visitor_points = $this->getPoints($visitor_goals, $home_goals);

        // ActiveRecord команд
        $home_team = $this::findOne($home_id);
        $visitor_team = $this::findOne($visitor_id);

        // Обновляем запись команды хозяев
        $home_team->updateCounters([
            'games' => -1,
            'gf' => -$home_goals,
            'ga' => -$visitor_goals,
            'points' => -$home_points
        ]);

        // Обновляем запись команды гостей
        $visitor_team->updateCounters([
            'games' => -1,
            'gf' => -$visitor_goals,
            'ga' => -$home_goals,
            'points' => -$visitor_points
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
