<?php

class m141201_020735_create_image_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_image(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) NOT NULL UNIQUE,
            cover VARCHAR(100) NOT NULL,
            content TEXT DEFAULT NULL,
            status TINYINT(0) UNSIGNED DEFAULT 1,
            views INT UNSIGNED DEFAULT 0,
            votes INT UNSIGNED DEFAULT 0,
            collects INT UNSIGNED DEFAULT 0,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            upload_time INT UNSIGNED DEFAULT 0,
            last_update INT UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_image',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_image');
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