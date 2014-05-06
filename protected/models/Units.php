<?php
/**
 * Created by PhpStorm.
 * User: kaile
 * Date: 24.02.14
 * Time: 22:45
 */

class Units extends CActiveRecord {
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function primaryKey() {
        return 'id';
    }
    
    public function relations() {
        return array(
            'Units' => array(self::BELONGS_TO, 'UnitTypes', 'id')
        );
    }

} 