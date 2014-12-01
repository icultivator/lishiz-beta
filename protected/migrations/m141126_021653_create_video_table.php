<?php

class m141126_021653_create_video_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_video(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            category TINYINT(1) UNSIGNED NOT NULL,
            cover VARCHAR(100) NOT NULL,
            title VARCHAR(100) UNIQUE NOT NULL,
            content TEXT NOT NULL,
            url VARCHAR(200) DEFAULT NULL,
            actor VARCHAR(100) DEFAULT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            collects INT UNSIGNED DEFAULT 0,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_video',$sql);
	}

	public function down()
	{
        $this->dropTable('lsz_video');
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