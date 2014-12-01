<?php

class m141126_021137_create_post_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_post(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) UNIQUE NOT NULL,
            summary TEXT DEFAULT NULL,
            content TEXT NOT NULL,
            cover VARCHAR(100) DEFAULT NULL,
            cover_in_post TINYINT(1) UNSIGNED DEFAULT 1,
            url VARCHAR(200) DEFAULT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            collects INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 1,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_post',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_post');
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