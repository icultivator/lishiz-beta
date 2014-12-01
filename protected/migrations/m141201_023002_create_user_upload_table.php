<?php

class m141201_023002_create_user_upload_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_user_upload(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED NOT NULL,
            path VARCHAR(100) NOT NULL,
            title VARCHAR(100) DEFAULT NULL,
            description TEXT DEFAULT NULL,
            media_type TINYINT(1) UNSIGNED DEFAULT 1,
            upload_time INT UNSIGNED DEFAULT 0,
            last_update INT UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_user_upload',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_user_upload');
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