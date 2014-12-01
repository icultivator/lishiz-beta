<?php

class m141127_062024_create_group_member_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_group_member(
            user_id INT UNSIGNED NOT NULL,
            group_id INT UNSIGNED NOT NULL,
            PRIMARY KEY (user_id,group_id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_group_member',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_group_member');
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