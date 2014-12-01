<?php

class m141128_070255_create_user_message_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_user_message(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED NOT NULL,
            subject VARCHAR(100) NOT NULL,
            content TEXT NOT NULL,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            send_time INT UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_user_message',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_user_message');
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