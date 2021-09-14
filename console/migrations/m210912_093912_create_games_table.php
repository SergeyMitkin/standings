<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%games}}`.
 */
class m210912_093912_create_games_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%games}}', [
            'id' => $this->primaryKey(),
            'home_id' => $this->integer(11),
            'visitor_id' => $this->integer(11),
            'date' => $this->date(),
            'home_goals' => $this->tinyInteger(4),
            'visitor_goals' => $this->tinyInteger()
        ]);

        $this->addForeignKey('games_teams_id_home_fk', 'games', 'home_id', 'teams', 'id');
        $this->addForeignKey('games_teams_id_visitor_fk', 'games', 'visitor_id', 'teams', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%games}}');
    }
}
