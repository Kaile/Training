<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnitTypes
 *
 * @author mihail
 */
class UnitTypes extends CActiveRecord 
{
    
    public static function model($className = __CLASS__) 
	{
        return parent::model($className);
    }

    public function getPrimaryKey() 
	{
        return 'id';
    }
	
	public function rules() 
	{
		return array(
				array('name_ru, type', 'required', 'on' => 'AddUnitType')
		);
	}
	
	public function attributeLabels() 
	{
		return array(
				'name_ru' => 'Имя типа единицы измерения',
				'type'    => 'Обозначение типа'
		);
	}

}
