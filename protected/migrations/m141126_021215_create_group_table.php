<?php

class m141126_021215_create_group_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_group(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(32) UNIQUE NOT NULL,
            intro VARCHAR(255) NOT NULL,
            cover VARCHAR(100) DEFAULT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            members INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_group',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_group');
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