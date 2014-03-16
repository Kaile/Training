<?php

class m140316_121023_CreateTableUnitTypes extends CDbMigration
{
	// public function up()
	// {

	// }

	// public function down()
	// {
	// 	echo "m140316_121023_CreateTableUnitTypes does not support migration down.\n";
	// 	return false;
	// }

	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
		$columns = array(
            'id' => 'pk',
            'type' => 'string NOT NULL',
            'name_ru' => 'string NOT NULL'
        );
        $this->createTable('UnitTypes', $columns);

        $this->dropTable('Units');

        $columns = array(
            'id' => 'pk',
            'text' => 'string NOT NULL',
            'count' => 'integer NOT NULL',
            'type' => 'integer NOT NULL'
        );
        $this->createTable('Units', $columns);
	}

	public function safeDown()
	{
		$this->dropTable('UnitTypes');

		$this->dropTable('Units');

		$columns = array(
            'id' => 'pk',
            'text' => 'string NOT NULL',
            'count' => 'integer NOT NULL',
            'type' => 'string NOT NULL'
        );
        $this->createTable('Units', $columns);
	}
	
}