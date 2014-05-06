<?php

class m140317_130400_BaseFillUnitTypes extends CDbMigration
{
	public function up()
	{
        $this->insert('UnitTypes', array('type' => 'hour', 'name_ru' => 'час'));
        $this->insert('UnitTypes', array('type' => 'minute', 'name_ru' => 'минута'));
        $this->insert('UnitTypes', array('type' => 'bout', 'name_ru' => 'штука'));
        $this->insert('UnitTypes', array('type' => 'time', 'name_ru' => 'раз'));
	}

	public function down()
	{
		echo "m140317_130400_BaseFillUnitTypes does not support migration down.\n";
		return false;
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