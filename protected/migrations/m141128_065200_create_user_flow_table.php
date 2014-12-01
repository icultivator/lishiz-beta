<?php

class m141128_065200_create_user_flow_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_user_flow(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            user_id INT UNSIGNED NOT NULL,
            obj_id INT UNSIGNED NOT NULL,
            obj_title VARCHAR(100) UNSIGNED NOT NULL,
            obj_type TINYINT(1) UNSIGNED NOT NULL,
            obj_status TINYINT(1) UNSIGNED DEFAULT 0,
            opt_type VARCHAR(6) DEFAULT NULL,
            log_time INT UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_user_flow',$sql);
	}

	public function down()
	{
		$this->dropTable('lsz_user_flow');
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