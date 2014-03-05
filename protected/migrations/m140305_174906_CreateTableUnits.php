<?php

class m140305_174906_CreateTableUnits extends CDbMigration
{
	public function up()
	{
            $columns = array(
                'id' => 'pk',
                'text' => 'string NOT NULL',
                'count' => 'integer NOT NULL',
                'type' => 'string NOT NULL'
            );
            $this->createTable('Units', $columns);
	}

	public function down()
	{
		return $this->dropTable('Users');
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