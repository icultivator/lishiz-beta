<?php

class m141126_083827_create_topic_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_topic(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) UNIQUE NOT NULL,
            content TEXT NOT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            follows INT UNSIGNED DEFAULT 0,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_topic',$sql);
	}

	public function down()
	{
        //return true;
		$this->dropTable('lsz_topic');
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