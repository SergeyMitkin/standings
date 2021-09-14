<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%teams}}`.
 */
class m210912_064057_create_teams_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%teams}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(250)->notNull(),
            'games' => $this->integer(11)->defaultValue(0),
            'gf' => $this->integer(11)->defaultValue(0)->comment('забитые мячи'),
            'ga'  => $this->integer(11)->defaultValue(0)->comment('пропущенные мячи'),
            'points' => $this->integer(11)->defaultValue(0),
            'logo_source' => $this->string(250),
            'logo_source_small' => $this->string(250)
        ]);

        $this->insert('teams', array('name'=>'Зенит', 'logo_source' => 'images/team_logo_subdir/zenit-logo.jpg', 'logo_source_small' => 'images/team_logo_subdir/small/zenit-logo.jpg'));
        $this->insert('teams', array('name'=>'Рубин', 'logo_source' => 'images/team_logo_subdir/rubin-logo.png', 'logo_source_small' => 'images/team_logo_subdir/small/rubin-logo.png'));
        $this->insert('teams', array('name'=>'Сочи', 'logo_source' => 'images/team_logo_subdir/sochi-logo.jpg', 'logo_source_small' => 'images/team_logo_subdir/small/sochi-logo.jpg'));
        $this->insert('teams', array('name'=>'Динамо', 'logo_source' => 'images/team_logo_subdir/dinamo-logo.png', 'logo_source_small' => 'images/team_logo_subdir/small/dinamo-logo.png'));
        $this->insert('teams', array('name'=>'Локомотив', 'logo_source' => 'images/team_logo_subdir/lokomotiv-logo.jpg', 'logo_source_small' => 'images/team_logo_subdir/small/lokomotiv-logo.jpg'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%teams}}');
    }
}
