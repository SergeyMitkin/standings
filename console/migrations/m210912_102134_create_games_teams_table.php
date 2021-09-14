<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%games_teams}}`.
 */
class m210912_102134_create_games_teams_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $sql = "
            CREATE TABLE `games_teams` (
	          `game_id` INT(11) NOT NULL,
	          `home_id` INT(11) NOT NULL,
	          `visitor_id` INT(11) NOT NULL,
	          PRIMARY KEY (`game_id`, `home_id`, `visitor_id`),
	          INDEX `games_teams_teams_id_fk` (`home_id`),
	          INDEX `games_teams_teams_id_fk_2` (`visitor_id`),
	          CONSTRAINT `games_teams_games_id_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	          CONSTRAINT `games_teams_teams_id_fk` FOREIGN KEY (`home_id`) REFERENCES `teams` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
	          CONSTRAINT `games_teams_teams_id_fk_2` FOREIGN KEY (`visitor_id`) REFERENCES `teams` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
            )
            COLLATE='utf8_general_ci'
            ENGINE=InnoDB
        ";

        $this->execute($sql);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%games_teams}}');
    }
}
