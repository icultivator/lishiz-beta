<?php

class m141126_021549_create_book_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_book(
            id INT UNSIGNED NOT NULL AUTO_INCREMENT,
            title VARCHAR(100) UNIQUE NOT NULL,
            content TEXT NOT NULL,
            cover VARCHAR(100) NOT NULL,
            author VARCHAR(100) NOT NULL,
            tags VARCHAR(100) DEFAULT NULL,
            votes INT UNSIGNED DEFAULT 0,
            views INT UNSIGNED DEFAULT 0,
            url VARCHAR(200) DEFAULT NULL,
            collects INT UNSIGNED DEFAULT 0,
            comments INT UNSIGNED DEFAULT 0,
            user_id INT UNSIGNED DEFAULT 0,
            status TINYINT(1) UNSIGNED DEFAULT 0,
            create_time INT(10) UNSIGNED DEFAULT 0,
            last_update INT(10) UNSIGNED DEFAULT 0,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_book',$sql);
	}

	public function down()
	{
        $this->dropTable('lsz_book');
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