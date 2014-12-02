<?php

class m141202_054320_create_crawler_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_crawler(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) UNIQUE NOT NULL,
            description TEXT NOT NULL,
            target TINYINT(1) UNSIGNED NOT NULL,
            site VARCHAR(100) UNIQUE NOT NULL,
            list VARCHAR(200) UNIQUE NOT NULL,
            detail VARCHAR(200) UNIQUE NOT NULL,
            detail_title VARCHAR(200) NOT NULL,
            detail_content VARCHAR(200) NOT NULL,
            detail_cover VARCHAR(200) NOT NULL,
            detail_tags VARCHAR(200) DEFAULT NULL,
            user_id INT UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_crawler',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_crawler');
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