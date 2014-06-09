<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddAction
 * @created 05.06.2014 15:06:19
 * @author Mihail Kornilov <fix-06 at yandex.ru>
 */
class DeleteAction extends CAction {
	
	public $model;
	
	public function run($id) {
		throw new Exception('Error', 0, $previous);
		$model = new $this->model;
		if ( ! $model->deleteByPk($id)) {
			echo 'Can not delete the row with id = ' . $id . PHP_EOL;
		}
	}

}
