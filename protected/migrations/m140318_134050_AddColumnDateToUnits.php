<?php

class m140318_134050_AddColumnDateToUnits extends CDbMigration
{
	public function up() {
        $this->addColumn('Units', 'date_create', 'datetime');
    }

    public function down() {
        $this->dropColumn('Units', 'date_create');
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
