<?php

class m141127_041852_create_user_vote_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_user_vote(
            user_id INT UNSIGNED NOT NULL,
            obj_id INT UNSIGNED NOT NULL,
            obj_type TINYINT UNSIGNED NOT NULL,
            PRIMARY KEY (user_id,obj_id,obj_type)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_user_vote',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_user_vote');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}