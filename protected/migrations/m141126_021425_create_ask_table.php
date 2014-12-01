<?php

class m141126_021425_create_ask_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_ask(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            question VARCHAR(100) UNIQUE NOT NULL,
            `desc` TEXT NOT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            answers INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_ask',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_ask');
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