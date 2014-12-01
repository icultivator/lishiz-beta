<?php

class m141201_044721_create_image_upload_table extends MDbMigration
{
	public function up()
	{
        $sql = "CREATE TABLE IF NOT EXISTS lsz_image_upload(
            image_id INT UNSIGNED NOT NULL,
            upload_id INT UNSIGNED NOT NULL,
            PRIMARY KEY (image_id,upload_id)
        ) ENGINE=InnoDB DEFAULT charset=utf8";
        $this->createTableBySql('lsz_image_upload',$sql);
	}

	public function down()
	{
        $this->dropTable('lsz_image_upload');
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