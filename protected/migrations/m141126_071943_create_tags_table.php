<?php

class m141126_071943_create_tags_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_tags(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(32) UNIQUE NOT NULL,
            nums INT UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_tags',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_tags');
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