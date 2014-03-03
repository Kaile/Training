<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UnitAddForm
 *
 * @author mihail
 */
class UnitAddForm extends CFormModel {
    public $text;
    public $count;
    public $type;
    
    public function rules() {
        return array(
            array('text, count', 'required')
        );
    }
}
