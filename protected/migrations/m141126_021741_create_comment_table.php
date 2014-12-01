<?php

class m141126_021741_create_comment_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_comment(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            obj_type TINYINT(1) UNSIGNED NOT NULL,
            obj_id INT UNSIGNED NOT NULL,
            parent_id INT UNSIGNED DEFAULT 0,
            comment_to INT UNSIGNED DEFAULT 0,
            content TEXT NOT NULL,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 1,
            comment_time INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_comment',$sql);
	}

	public function down()
	{
        $this->dropTable('lsz_comment');
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