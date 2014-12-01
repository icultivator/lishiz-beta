<?php

class m141126_021055_create_user_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_user(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(16) UNIQUE NOT NULL,
            `email` VARCHAR(32) UNIQUE NOT NULL,
            `pass` VARCHAR(32) NOT NULL,
            avatar VARCHAR(100) DEFAULT NULL,
            intro VARCHAR(200) DEFAULT NULL,
            follows INT UNSIGNED DEFAULT 0,
            followd INT UNSIGNED DEFAULT 0,
            role TINYINT(1) UNSIGNED DEFAULT 1,
            `level` TINYINT UNSIGNED DEFAULT 0,
            point INT UNSIGNED DEFAULT 0,
            qq VARCHAR(16) UNIQUE DEFAULT NULL,
            weixin VARCHAR(32) UNIQUE DEFAULT NULL,
            weibo VARCHAR(100) UNIQUE DEFAULT NULL,
            site VARCHAR(100) UNIQUE DEFAULT NULL,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            register_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            last_login INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_user',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_user');
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